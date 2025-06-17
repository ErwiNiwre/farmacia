<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\VentaDetalle;
use App\Models\CompraDetalle;
use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use DataTables;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $producto = Producto::All();
        $permissions = Venta::get();

        return view(
            'ventas.create',
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
        //$detalle_compras = json_decode($request->input('productos'), true);
        // print_r($detalle_compras);
        // exit;
          DB::beginTransaction();
       try {
            $venta = new Venta();
            $venta->venta_fecha = date("Y-m-d H:i:s");
            $venta->user_id =  $session_auth->id;
            $venta->cliente = Str::upper(preg_replace('/\s+/', ' ', trim($request->cliente)));
            $venta->metodo_pago = $request->tipo;
            $venta->numero_venta = 1;
            $venta->total = $request->total;  
            $venta->efectivo =  $request->efectivo;;
            $venta->qr =  $request->qr;;   
                    
            $venta->created_by = $session_auth->id;
           
            $venta->save();
            
       
            $venta_detalles = json_decode($request->input('productos'), true);
            
            
            $cantidad_total=0;
            $i=0;
            foreach ($venta_detalles as $detalle) {
                    

                 $cantidad_total=$detalle['cantidad'];
                //  echo $detalle['cantidad'];
                //  exit;
                 $producto = Producto::find($detalle['producto_id']);
                 $compraDetalles = CompraDetalle::where('producto_id', '=', $detalle['producto_id'])->
                 where('cantidad_total', '<>','0')
                 ->orderBy('vencimiento', 'asc')
                 ->get();
            //  print_r($compraDetalles);
            //   exit;
                 foreach ($compraDetalles as $compradetalle) {
                   
                    $compraDet = CompraDetalle::find($compradetalle->id);
            //             if($i==1){
            //             print_r($compraDet->cantidad_total.'-'.$cantidad_total);
            //   exit;
            //         }
                    $cantidad_total=$compraDet->cantidad_total-$cantidad_total;
                    

                    if($cantidad_total<=0){
                        $compraDet->cantidad_total=0;
                        $cantidad_total=$cantidad_total*-1;
            //                 print_r($cantidad_total);
            //   exit;
                    }else{
                        $compraDet->cantidad_total=$cantidad_total;
                                
                        $cantidad_total=0;
                    }
                     $compraDet->save();
                     $i++;
                 }

                $venta_detalle = new VentaDetalle();
                // print_r($detalle);
                // exit;
                $venta_detalle->venta_id = $venta->id; 
                $venta_detalle->producto_id = $detalle['producto_id'];
                $venta_detalle->precio_unitario = $detalle['unidad_precio'];
                $venta_detalle->cantidad = $detalle['cantidad'];
                
               
                if ($detalle['subtotal'] == ($venta_detalle->precio_unitario * $venta_detalle->cantidad)) {
                    $venta_detalle->subtotal = $detalle['subtotal'];
                }
                $venta_detalle->created_by = $session_auth->id;
                $venta_detalle->save();
                $producto->stock_minimo=$producto->stock_minimo-$detalle['cantidad'];
                if(!empty($detalle['estado'])){
                     $producto->precio_venta=(($producto->porcentaje/100)*$detalle['unidad_precio'])+$detalle['unidad_precio'];
                     $producto->precio_unitario=$detalle['unidad_precio'];
                }
                $producto->save();
            }
           
            DB::commit(); // Confirmar la transacción
            // print_r($compraDetalle);
            //  exit;
            // flash('Compra creada correctamente.', 'alert alert-success alert-dismissible');
            // return redirect()->route('purchases.index');
            return response()->json([
                'status' => 200,
                'message' => 'Datos de la Compra Creada.',
            ]);
         } catch (\Exception $e) {
            DB::rollBack();
            // flash('Error al crear la compra. Por favor, intente nuevamente.', 'alert alert-danger alert-dismissible');
            // return redirect()->back()->withInput();
            return response()->json([
                'status' => 500,
                'message' => 'Error al guardar la atención: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
