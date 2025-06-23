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
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }




        $ventas = Venta::all();
      
        return view(
            'ventas.index',
            compact(
                'session_auth',
                'session_name',
                'ventas'
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
            foreach ($venta_detalles as $detalle) {
                    

                 
                 $producto = Producto::find($detalle['producto_id']);
                 $compraDetalles = CompraDetalle::where('producto_id', '=', $detalle['producto_id'])->
                 where('cantidad_total', '<>','0')
                 ->orderBy('vencimiento', 'asc')
                 ->get();
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

                $cantidad_total=$detalle['cantidad'];
                //  echo $detalle['cantidad'];
                //  exit;
                
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
                        $cantidad_total=abs($cantidad_total);
            //                 print_r($cantidad_total);
            //   exit;
                    }else{
                        $compraDet->cantidad_total=$cantidad_total;
                                
                        $cantidad_total=0;
                    }
                     $compraDet->lote=$venta_detalle->id;
                    // echo $venta_detalle->id;
                     $compraDet->save();
                    
                 }

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

        $ventas = Venta::find($id);
       

        if (!$ventas) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }
        
      // $compraDetalle = CompraDetalle::where('compra_id', '=', 1);
       $ventaDetalle= DB::table('venta_detalles')
            ->select(
                'venta_detalles.id as id',
                'productos.producto',
                
                'venta_detalles.precio_unitario',
                'venta_detalles.cantidad',
                'venta_detalles.subtotal'
            )
           
           ->join('productos', 'productos.id', '=', 'venta_detalles.producto_id')
           ->where('venta_detalles.venta_id',"=",$id)
            ->whereNull('venta_detalles.deleted_at')
            ->orderBy('venta_detalles.id', 'desc')
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
                'ventas' => $ventas,
                'ventaDetalles' => $ventaDetalle
            ]
        ]);
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
    public function destroy($id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }


        $ventas = Venta::find($id);

        if ($ventas) {
             $ventas->deleted_by = $session_auth->id;
             $ventas->save();

            VentaDetalle::where('venta_id', '=', $ventas->id)
                ->update(['deleted_by' => $session_auth->id]);
            $ventaDetalles = VentaDetalle::where('venta_id', '=', $ventas->id)->get();
            
           
           // $price = DB::table('orders')->max('price');
            // print_r($compraDetalles);
            // exit;
            foreach ($ventaDetalles as $ventaDetalle) {
                // $precio_maximo = CompraDetalle::where('producto_id', '=', $compraDetalle->producto_id)->
                // where('compra_id', '<>', $compras->id)->max('precio_unitario');
                //  print_r($precio_maximo);
                //  exit;

                 $compraDetalles = CompraDetalle::where('producto_id', '=', $ventaDetalle->producto_id)
                 //->where('cantidad_total', '<>','0')
                 ->orderBy('vencimiento', 'asc')
                 ->get();



                if ($ventaDetalle) {
                     $productos = Producto::find($ventaDetalle->producto_id);
                     $productos->stock_minimo=$productos->stock_minimo-$compraDetalle->cantidad;
                         if($precio_maximo){
                     $productos->precio_unitario=$precio_maximo;
                     $productos->precio_venta=(($productos->porcentaje/100)*$precio_maximo)+$precio_maximo;
                      }
                     $productos->save();

                    
                }
            }
            VentaDetalle::where('venta_id', '=', $ventas->id)->delete();
            $ventas->delete();

             return redirect()->route('ventas.index');
        } 

    }
}
