<?php

namespace App\Http\Controllers;

use App\Models\CompraDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Compra;
use App\Models\Producto;
use DataTables;

class CompraDetalleController extends Controller
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
        //
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
          
        try{
            $compraDetalle = new CompraDetalle();
            $compraDetalle->created_by = $session_auth->id;
            $compraDetalle->compra_id = $request->create_compra_id ;
            $compraDetalle->cantidad =  $request->edit_cantidad;
            $compraDetalle->precio_unitario = $request->edit_precio_unitario;
            $compraDetalle->producto_id = $request->create_producto_id;
            $compraDetalle->subtotal = $request->create_subtotal;
            if($request->edit_vencimiento){
                $compraDetalle->vencimiento= $request->edit_vencimiento;
                }
            
            $compraDetalle->cantidad_total= $request->edit_cantidad;
            // print_r($compraDetalle);
            // exit;
            $compraDetalle->save();
            $producto = Producto::find($request->create_producto_id);
            $producto->stock_minimo=$producto->stock_minimo+$request->edit_cantidad;
            if( $request->create_estado=="1"){
        //             print_r($request->create_estado);
        //    exit;
                       $producto->precio_unitario=$request->edit_precio_unitario;
                       $precio=($producto->porcentaje/100)*$request->edit_precio_unitario;
                       $producto->precio_venta=$precio+$request->edit_precio_unitario;
                    
                }
            $producto->save();

             DB::commit();
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
    public function show(CompraDetalle $compraDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompraDetalle $compraDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompraDetalle $compraDetalle)
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
        // print_r($id);
        // exit;
        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        try{
        $comprasDetalle = CompraDetalle::find($id);
        
                       $comprasDetalle->deleted_by = $session_auth->id;
             $comprasDetalle->save();
// print_r($comprasDetalle);
//             exit;
        if ($comprasDetalle) {
            

            // CompraDetalle::where('compra_id', '=', $comprasDetalle->compra_id)
            //     ->update(['deleted_by' => $session_auth->id]);

            // $compraDetalles = CompraDetalle::where('compra_id', '=', $compras->id)->get();
            
           
           // $price = DB::table('orders')->max('price');
            // print_r($compraDetalles);
            // exit;

             $precio_maximo = CompraDetalle::where('producto_id', '=', $comprasDetalle->producto_id)->
                 where('id', '<>', $comprasDetalle->id)->max('precio_unitario');
                //  echo  $precio_maximo;
                //  exit;
            $productos = Producto::find($comprasDetalle->producto_id);
                     $productos->stock_minimo=$productos->stock_minimo-$comprasDetalle->cantidad;
                      if($precio_maximo){
                     $productos->precio_unitario=$precio_maximo;
                     $productos->precio_venta=(($productos->porcentaje/100)*$precio_maximo)+$precio_maximo;
                      }
                     $productos->save();
                     $comprasDetalle->delete();
           /* foreach ($compraDetalles as $compraDetalle) {
                 $precio_maximo = CompraDetalle::where('producto_id', '=', $compraDetalle->producto_id)->
                 where('compra_id', '<>', $compras->id)->max('precio_unitario');
                //  print_r($precio_maximo);
                //  exit;
                if ($compraDetalle) {
                     $productos = Producto::find($compraDetalle->producto_id);
                     $productos->stock_minimo=$productos->stock_minimo-$compraDetalle->cantidad;
                         if($precio_maximo){
                     $productos->precio_unitario=$precio_maximo;
                     $productos->precio_venta=(($productos->porcentaje/100)*$precio_maximo)+$precio_maximo;
                      }
                     $productos->save();

                    
                }
            }*/
            //CompraDetalle::where('compra_id', '=', $compras->id)->delete();
            //$compras->delete();

            // return redirect()->route('compras.index');
        } 
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
}
