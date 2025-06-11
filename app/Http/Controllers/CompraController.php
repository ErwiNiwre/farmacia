<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\CompraDetalle;
use App\Models\Producto;
use DataTables;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use SoftDeletes;
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
      
        return view(
            'compras.index',
            compact(
                'session_auth',
                'session_name',
                'compras'
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

        $producto = Producto::All();
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
        //$detalle_compras = json_decode($request->input('productos'), true);
        // print_r($detalle_compras);
        // exit;
          DB::beginTransaction();
       try {
            $compra = new Compra();
            $compra->compra_fecha = date("Y-m-d H:i:s");
            $compra->user_id =  $session_auth->id;
            $compra->proveedor = Str::upper(preg_replace('/\s+/', ' ', trim($request->proveedor)));
            $compra->tipo = $request->tipo;
            $compra->numero_compra = 1;
            $compra->total = $request->total;    
                    
            $compra->created_by = $session_auth->id;
           
            $compra->save();
            
       
            $compra_detalles = json_decode($request->input('productos'), true);
            foreach ($compra_detalles as $detalle) {
                 $producto = Producto::find($detalle['producto_id']);
                $compraDetalle = new CompraDetalle();
                $compraDetalle->compra_id = $compra->id; 
                $compraDetalle->producto_id = $detalle['producto_id'];
                $compraDetalle->precio_unitario = $detalle['unidad_precio'];
                $compraDetalle->cantidad = $detalle['cantidad'];
                if ($detalle['subtotal'] == ($compraDetalle->precio_unitario * $compraDetalle->cantidad)) {
                    $compraDetalle->subtotal = $detalle['subtotal'];
                }
                $compraDetalle->created_by = $session_auth->id;
                $compraDetalle->save();
                $producto->stock_minimo=$producto->stock_minimo+$detalle['cantidad'];
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
        
       /* $permissions = Compra::get();

        $listCompraDetalles= DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                'productos.producto',
                'compra_detalles.precio_unitario',
                'compra_detalles.cantidad',
                'compra_detalles.subtotal'
            )
           
           ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
           ->where('compra_detalles.compra_id',"=",$id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'desc')
            ->get();

                
                
        $compraDetalle= $listCompraDetalles;
        // return $especialidad;
        return view(
            'compras.show',
            compact(
               'session_auth',
                'session_name',
                'permissions',
                'compras',
                'compraDetalle'
            )
        );*/

        if (!$compras) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }
        
      // $compraDetalle = CompraDetalle::where('compra_id', '=', 1);
       $compraDetalle= DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                'productos.producto',
                'compra_detalles.precio_unitario',
                'compra_detalles.cantidad',
                'compra_detalles.subtotal'
            )
           
           ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
           ->where('compra_detalles.compra_id',"=",$id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'desc')
            ->get();
       //$compraDetalle ="";
        // print_r( $compraDetalle->all());
        // exit;
        /*if ($compraDetalle->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay detalles de la Compra.'
            ], 404);
        }
*/
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
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
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

        if ($compras) {
             $compras->deleted_by = $session_auth->id;
             $compras->save();

            CompraDetalle::where('compra_id', '=', $compras->id)
                ->update(['deleted_by' => $session_auth->id]);

            CompraDetalle::where('compra_id', '=', $compras->id)->delete();
            // $purchaseDetails = PurchaseDetail::where('purchase_id', '=', $purchase->id)->get();
            // foreach ($purchaseDetails as $purchaseDetail) {
            //     if ($purchaseDetail) {
            //         $purchaseDetail->user_delete = Str::upper($session_name);
            //         $purchaseDetail->save();

            //         $purchaseDetail->delete();
            //     }
            // }
            $compras->delete();

             return redirect()->route('compras.index');
        } 

    }
    

     public function getListCompras()
    {
        $listCompras= DB::table('compras')
            ->select(
                'compras.id as id',
                'compras.compra_fecha',
                'compras.tipo',
                'compras.proveedor',
                'compras.numero_compra',
                'compras.total'
            )
            ->whereNull('compras.deleted_at')
            ->orderBy('compras.id', 'desc')
            ->get();

                

        return DataTables::of($listCompras)
            ->addColumn('action', function ($listCompras) {
                $buttons = [];

                $buttons[] = '<button type="button" onclick="modalCompras('.$listCompras ->id.')" id="btn_view_compras" value='.$listCompras ->id.' class="btn btn-info" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Ver Compra"><i class="mdi mdi-eye"></i></button>';
                $buttons[] = '<a onclick="return confirm(\'Esta seguro que desea eliminar el registo?\')" href="' . route('compras.destroy', $listCompras->id) . '" class="waves-effect waves-light btn btn-danger mb-5" title="Eliminar"><i class="fa fa-bitbucket" aria-hidden="true"></i></a>';
                return implode(' ', $buttons);    
        })
            ->toJson();
    }

    //    public function getListCompraDetalles(Request $request)
    // {
    //    print_r($_GET);
    //    exit;
    //     $listCompraDetalles= DB::table('compra_detalles')
    //         ->select(
    //             'compra_detalles.id as id',
    //             'productos.producto',
    //             'compra_detalles.precio_unitario',
    //             'compra_detalles.cantidad',
    //             'compra_detalles.subtotal'
    //         )
           
    //        ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
    //        ->where('compra_detalles.compra_id',"=",$request->compra_id)
    //         ->whereNull('compra_detalles.deleted_at')
    //         ->orderBy('compra_detalles.id', 'desc')
    //         ->get();

                
                
    //     return DataTables::of($listCompraDetalles)->toJson();
    // }
}
