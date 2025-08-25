<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\kardex;
use DataTables;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:compra.index|compra.create|compra.show', ['only' => ['index']]);
        $this->middleware('permission:compra.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:compra.show', ['only' => ['show']]);
        $this->middleware('permission:compra.destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $compras = Compra::all();
        $detalle = Compra::query()
            ->select(
                'compras.id',
                'compras.compra_fecha',
                'compras.numero_compra',
                'compras.proveedor',
                'compras.tipo',
                'compras.total',
                'compras.observacion',
                DB::raw('MAX(productos.clasificacion) as clasificacion'),
                DB::raw("
            BOOL_AND(
                CASE 
                    WHEN productos.clasificacion = '1' THEN true
                    ELSE compra_detalles.cantidad = compra_detalles.cantidad_total
                END
            ) as estado
        ")
            )
            ->join('compra_detalles', 'compra_detalles.compra_id', '=', 'compras.id')
            ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
            ->groupBy(
                'compras.id',
                'compras.compra_fecha',
                'compras.numero_compra',
                'compras.proveedor',
                'compras.tipo',
                'compras.total',
                'compras.observacion'
            )
            ->get();

        return view(
            'compras.index',
            compact(
                'session_auth',
                'session_name',
                'compras',
                'detalle'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        //$producto = Producto::All();
        $producto = DB::table('productos')
            ->join('concentraciones', 'productos.concentracion_id', '=', 'concentraciones.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('presentaciones', 'productos.presentacion_id', '=', 'presentaciones.id')
            ->select(
                'productos.id',
                'barras',
                'producto',
                'tipo_producto',
                'codigo',
                'cantidad',
                'precio_unitario',
                DB::raw("CONCAT(productos.codigo, ' - ',productos.producto, ' - ', concentraciones.concentracion, ' - ', marcas.marca, ' - ', presentaciones.presentacion) AS descripcion")
            )->whereNull('productos.deleted_at')
            ->get();

        $permissions = Compra::get();

        return view(
            'compras.create',
            compact(
                'session_auth',
                'session_name',
                'permissions',
                'producto'
            )
        );
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        DB::beginTransaction();
        try {
            $compra = new Compra();

            $compra->compra_fecha = date("Y-m-d H:i:s");
            $compra->user_id =  $session_auth->id;
            $compra->proveedor = Str::upper(preg_replace('/\s+/', ' ', trim($request->proveedor)));
            $compra->tipo = $request->tipo;


            $compra->numero_compra = count(Compra::withTrashed()->get()) + 1;
            if ($compra->tipo == 'Compra')
                $compra->total = $request->total;
            else
                $compra->total = 0;
            $compra->created_by = $session_auth->id;
            $compra->observacion = $request->observacion;

            $compra->save();


            $compra_detalles = json_decode($request->input('productos'), true);

            $mayoresPrecioUnidad = collect($compra_detalles)
                ->groupBy('producto_id')
                ->map(function ($items) {
                    return collect($items)->max('unidad_precio');
                })
                ->toArray();

            // print_r($compra_detalles);
            // exit;
            foreach ($compra_detalles as $detalle) {
                $producto = Producto::find($detalle['producto_id']);
                $compraDetalle = new CompraDetalle();

                $compraDetalle->created_by = $session_auth->id;
                $compraDetalle->compra_id = $compra->id;
                $compraDetalle->producto_id = $detalle['producto_id'];

                $compraDetalle->cantidad = $detalle['cantidad'];
                $compraDetalle->cantidad_total = $detalle['cantidad'];
                if ($detalle['vencimiento']) {
                    $compraDetalle->vencimiento = $detalle['vencimiento'];
                }
                if ($compra->tipo == 'Compra')
                    $compraDetalle->precio_unitario = $detalle['unidad_precio'];
                else {
                    $compraDetalle->precio_unitario = 0;
                    $compraDetalle->subtotal = 0;
                }
                // dd($compraDetalle->precio_unitario * $compraDetalle->cantidad.'= '.$detalle['subtotal']);
                if ($detalle['subtotal'] == ($compraDetalle->precio_unitario * $compraDetalle->cantidad)) {

                    $compraDetalle->subtotal = $detalle['subtotal'];
                } else {
                    $compraDetalle->subtotal = round($compraDetalle->precio_unitario * $compraDetalle->cantidad, 2);
                }

                // dd($compraDetalle->subtotal);
                $compraDetalle->save();
                // $this->kardex($compra, $compraDetalle, 'A');
                Kardex::registrarKardex([
                    'producto_id'     => $compraDetalle->producto_id,
                    'tipo_movimiento' => $compra->tipo,
                    'accion'          => 'A',
                    'cantidad'        => $compraDetalle->cantidad,
                    'precio_unitario' => $compraDetalle->precio_unitario,
                    'subtotal'        => $compraDetalle->subtotal,
                    'user_id'         => $session_auth->id
                ]);
                // $producto->cantidad = $producto->cantidad + $detalle['cantidad'];
                if ($producto->clasificacion == 1) {
                    $compraDetalle->cantidad_total = 0;
                    $compraDetalle->save();
                } else {
                    $producto->ajustarStock($detalle['cantidad']);
                }


                if ($detalle['estado'] == 1 && $compra->tipo == 'Compra') {
                    $precioMayor = $mayoresPrecioUnidad[$detalle['producto_id']] ?? null;

                    if ($detalle['unidad_precio'] == $precioMayor) {
                        $producto->precio_unitario = $detalle['unidad_precio'];

                        $precio = ($producto->porcentaje / 100) * $detalle['unidad_precio'];
                        $producto->precio_venta = $precio + $detalle['unidad_precio'];
                    }
                    $producto->save();
                }
            }
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Datos de la Compra Creada.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Error al guardar la atención: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $compras = Compra::find($id);



        if (!$compras) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }

        // $compraDetalle = CompraDetalle::where('compra_id', '=', 1);
        $compraDetalle = DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                'productos.producto',
                'compra_detalles.vencimiento',
                'compra_detalles.precio_unitario',
                'compra_detalles.cantidad',
                'compra_detalles.subtotal'
            )

            ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
            ->where('compra_detalles.compra_id', "=", $id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => [
                'compras' => $compras,
                'compraDetalles' => $compraDetalle
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $compras = Compra::find($id);
        $compraDetalles = DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                'productos.id as producto_id',
                'productos.producto',
                'productos.clasificacion',
                'compra_detalles.vencimiento',
                'compra_detalles.precio_unitario',
                'compra_detalles.cantidad',
                'compra_detalles.subtotal',
                'compra_detalles.cantidad_total',
                DB::raw("CONCAT(productos.codigo, ' - ',productos.producto, ' - ', concentraciones.concentracion, ' - ', marcas.marca, ' - ', presentaciones.presentacion) AS descripcion")
            )

            ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
            ->join('concentraciones', 'productos.concentracion_id', '=', 'concentraciones.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('presentaciones', 'productos.presentacion_id', '=', 'presentaciones.id')
            ->where('compra_detalles.compra_id', "=", $id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'desc')
            ->get();
        $producto = DB::table('productos')
            ->join('concentraciones', 'productos.concentracion_id', '=', 'concentraciones.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('presentaciones', 'productos.presentacion_id', '=', 'presentaciones.id')
            ->select(
                'productos.id',
                'barras',
                'producto',
                'tipo_producto',
                'codigo',
                'cantidad',
                'precio_unitario',
                DB::raw("CONCAT(productos.codigo, ' - ',productos.producto, ' - ', concentraciones.concentracion, ' - ', marcas.marca, ' - ', presentaciones.presentacion) AS descripcion")
            )->whereNull('productos.deleted_at')
            ->get();
        $permissions = Compra::get();

        // return $especialidad;
        return view(
            'compras.edit',
            compact(
                'session_auth',
                'session_name',
                'permissions',
                'compras',
                'compraDetalles',
                'producto',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $compras = Compra::find($id);
        if (!$compras) {
            return response()->json([
                'status' => 404,
                'message' => 'Compra no encontrada'
            ]);
        }
        $compras->proveedor = $request->proveedor;
        $compras->observacion = $request->observacion;
        //$compras->tipo = $request->tipo;
        //$compraDetalles = CompraDetalle::where('compra_id', '=', $compras->id)->get();
        /*foreach ($compraDetalles as $compraDetalle) {

            if ($compras->tipo == 'Compra'){
                   // $compraDetalle->precio_unitario = $detalle['unidad_precio'];
                
                }
                else {
                     $compras->total=0;
                    $compraDetalle->precio_unitario = 0;
                    $compraDetalle->subtotal = 0;
                    
                }
                 $compraDetalle->save();
        }*/



        $compras->save();

        CompraDetalle::where('compra_id', '=', $compras->id)
            ->update(['deleted_by' => $session_auth->id]);




        return response()->json([
            'status' => 200,
            'message' => 'Datos Actualizados'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }


        $compras = Compra::find($id);
        $precio_maximo = 0;
        if ($compras) {
            $compras->deleted_by = $session_auth->id;
            $compras->save();

            CompraDetalle::where('compra_id', '=', $compras->id)
                ->update(['deleted_by' => $session_auth->id]);
            $compraDetalles = CompraDetalle::where('compra_id', '=', $compras->id)->get();


            foreach ($compraDetalles as $compraDetalle) {

                $detalle_max = CompraDetalle::where('producto_id', $compraDetalle->producto_id)
                    ->where('compra_id', '!=', $compras->id)
                    ->whereNull('compra_detalles.deleted_at')
                    ->orderByDesc('precio_unitario')
                    ->first();
                if ($detalle_max)
                    $precio_maximo = $detalle_max->precio_unitario;
                $kardex = Kardex::where('producto_id', '=', $compraDetalle->producto_id)->where('tipo_movimiento', 'Producto')->orderBy('id', 'desc')->first();
                if (empty($kardex))
                    $precio_maximo_kardex = 0;
                else
                    $precio_maximo_kardex = $kardex->precio_unitario;

                if ($compraDetalle) {
                    $productos = Producto::find($compraDetalle->producto_id);
                    // $productos->cantidad = $productos->cantidad - $compraDetalle->cantidad;



                    if ($precio_maximo > $precio_maximo_kardex  && !empty($detalle_max->created_at) &&  Carbon::parse($detalle_max->created_at)->gt(Carbon::parse($kardex->fecha))) {
                        $productos->precio_unitario = $precio_maximo;
                        $productos->precio_venta = (($productos->porcentaje / 100) * $precio_maximo) + $precio_maximo;
                    } else {

                        $productos->precio_unitario = $precio_maximo_kardex;
                        $productos->precio_venta = (($productos->porcentaje / 100) * $precio_maximo_kardex) + $precio_maximo_kardex;
                    }

                    // $this->kardex($compras, $compraDetalle, 'B');
                    Kardex::registrarKardex([
                        'producto_id'     => $compraDetalle->producto_id,
                        'tipo_movimiento' => $compras->tipo,
                        'accion'          => 'B',
                        'cantidad'        => $compraDetalle->cantidad,
                        'precio_unitario' => $compraDetalle->precio_unitario,
                        'subtotal'        => $compraDetalle->subtotal,
                        'user_id'         => $compras->user_id
                    ]);
                    $productos->save();

                    if ($productos->clasificacion == 0) {
                        $productos->ajustarStock(-$compraDetalle->cantidad);
                    }
                }
            }
            CompraDetalle::where('compra_id', '=', $compras->id)->delete();
            $compras->delete();

            return redirect()->route('compras.index');
        }
    }

    public function print($id)
    {
        $compras = Compra::find($id);

        if (!$compras) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }


        $compra_detalles = DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                DB::raw("CONCAT(productos.producto, ' - ', concentraciones.concentracion, ' - ', presentaciones.presentacion, ' - ', marcas.marca) as producto"),
                'compra_detalles.cantidad',
                'compra_detalles.precio_unitario',
                'compra_detalles.subtotal'
            )
            ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->where('compra_detalles.compra_id', "=", $id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'asc')
            ->get();

        $id_recibo = str_pad($compras->id, 6, '0', STR_PAD_LEFT);
        $compras->compra_fecha = Carbon::parse($compras->compra_fecha)->format('d-m-Y H:i:s');
        $compras->user_id = str_pad($compras->user_id, 4, '0', STR_PAD_LEFT);
        $compras->numero_compra = str_pad($compras->numero_compra, 6, '0', STR_PAD_LEFT);

        // literal
        $formatter = new \NumberFormatter("es", \NumberFormatter::SPELLOUT);

        $entero = floor($compras->total);
        $decimal = round(($compras->total - $entero) * 100);

        $literalEntero = mb_strtoupper($formatter->format($entero), 'UTF-8');

        $totalLiteral = trim($literalEntero . ' ' . str_pad($decimal, 2, '0', STR_PAD_LEFT) . '/100 ' . mb_strtoupper('BOLIVIANOS', 'UTF-8'));

        // return $venta_detalles;
        return \PDF::loadView(
            'pdf.appRecibo',
            compact(
                'compras',
                'id_recibo',
                'compra_detalles',
                'totalLiteral'
            )
        )
            ->setPaper('letter')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '10mm')
            ->setOption('margin-right', '10mm')
            ->setOption('margin-left', '15mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('encoding', 'utf-8')
            ->setOption('no-stop-slow-scripts', true)
            ->stream('recibo');
    }
}