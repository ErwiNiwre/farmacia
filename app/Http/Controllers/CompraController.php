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
            // print_r(count(Compra::withTrashed()->get())+1);
            // exit;
            $compra->numero_compra = count(Compra::withTrashed()->get())+1;
            $compra->total = $request->total;    
                    
            $compra->created_by = $session_auth->id;
           
            $compra->save();
            
       
            $compra_detalles = json_decode($request->input('productos'), true);
            foreach ($compra_detalles as $detalle) {
                $producto = Producto::find($detalle['producto_id']);
                $compraDetalle = new CompraDetalle();
                // print_r($detalle);
                // exit;
                $compraDetalle->created_by = $session_auth->id;
                $compraDetalle->compra_id = $compra->id; 
                $compraDetalle->producto_id = $detalle['producto_id'];
                $compraDetalle->precio_unitario = $detalle['unidad_precio'];
                $compraDetalle->cantidad = $detalle['cantidad'];
                $compraDetalle->cantidad_total = $detalle['cantidad'];
                if($detalle['vencimiento']){
                $compraDetalle->vencimiento = $detalle['vencimiento'];
                }
                

                if ($detalle['subtotal'] == ($compraDetalle->precio_unitario * $compraDetalle->cantidad)) {
                    $compraDetalle->subtotal = $detalle['subtotal'];
                }
                
                $compraDetalle->save();
                $producto->stock_minimo=$producto->stock_minimo+$detalle['cantidad'];
                // echo $detalle['estado'];
                // exit;
                if($detalle['estado']==1){
                   
                         $producto->precio_unitario=$detalle['unidad_precio'];
                       $precio=($producto->porcentaje/100)*$detalle['unidad_precio'];
                       $producto->precio_venta=$precio+$detalle['unidad_precio'];
                    
                //       echo $producto->precio_venta.'=='.$producto->precio_unitario;
                // exit;
                }
                $producto->save();
                
           
            }
             DB::commit();
            // Confirmar la transacción
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
                'compra_detalles.vencimiento',
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
       $compraDetalles= DB::table('compra_detalles')
            ->select(
                'compra_detalles.id as id',
                'productos.id as producto_id',
                'productos.producto',
                'compra_detalles.vencimiento',
                'compra_detalles.precio_unitario',
                'compra_detalles.cantidad',
                'compra_detalles.subtotal',
                'compra_detalles.cantidad_total'
            )
           
           ->join('productos', 'productos.id', '=', 'compra_detalles.producto_id')
           ->where('compra_detalles.compra_id',"=",$id)
            ->whereNull('compra_detalles.deleted_at')
            ->orderBy('compra_detalles.id', 'desc')
            ->get();
        $producto = Producto::All();
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
            $session_staff = Staff::where('user_id', '=', $session_auth->id)->first();
            $session_name = $session_staff->paternal_surname . ' ' . $session_staff->maternal_surname . ' ' . $session_staff->names;
        }
// print_r($request->All());
// exit;
        $compras = Compra::find($id);
        if (!$compras) {
            return response()->json([
                'status' => 404,
                'message' => 'Compra no encontrada'
            ]);
        }
        $compras->proveedor = $request->proveedor;
        $compras->tipo = $request->tipo;
        $compras->updated_by = $session_auth->id;
        $compras->save();

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

        if ($compras) {
             $compras->deleted_by = $session_auth->id;
             $compras->save();

            CompraDetalle::where('compra_id', '=', $compras->id)
                ->update(['deleted_by' => $session_auth->id]);
            $compraDetalles = CompraDetalle::where('compra_id', '=', $compras->id)->get();
            
           
           // $price = DB::table('orders')->max('price');
            // print_r($compraDetalles);
            // exit;
            foreach ($compraDetalles as $compraDetalle) {
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
            }
            CompraDetalle::where('compra_id', '=', $compras->id)->delete();
            $compras->delete();

             return redirect()->route('compras.index');
        } 

    }
    

     public function getListCompras()
    {
       /* $listCompras= DB::table('compras')
            ->select(DB::raw('sum(compra_detalles.cantidad) AS total_sales'),
              //   'compras.id as id',
            //     'compras.compra_fecha',
            //     'compras.tipo',
            //     'compras.proveedor',
            //     'compras.numero_compra',
            //     'compras.total',
            //    'compra_detalles.cantidad',
            //     'compra_detalles.cantidad_total',
                //'compra_detalles.cantidad=compra_detalles.cantidad_total as estado'
            )
             
           ->join('compra_detalles', 'compra_detalles.compra_id', '=', 'compras.id')
          
            ->whereNull('compras.deleted_at')
            ->orderBy('compras.id', 'desc')
            ->get();*/

           $listCompras= Compra::query()
    ->select('compras.*')
    ->addSelect(DB::raw('(SELECT cantidad=cantidad_total FROM public.compra_detalles as estado where compra_id=compras.id 
ORDER BY estado ASC limit 1) as estado'))
    ->get();
                // print_r($listCompras);
                // exit;

        return DataTables::of($listCompras)
            ->addColumn('action', function ($listCompras) {
                $buttons = [];

                $buttons[] = '<button type="button" onclick="modalCompras('.$listCompras ->id.')" id="btn_view_compras" value='.$listCompras ->id.' class="btn btn-info" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Ver Compra"><i class="mdi mdi-eye"></i></button>';
                $buttons[] = '<a href="' . route('compras.edit', $listCompras->id) . '"  id="btn_edit_compras" value='.$listCompras ->id.'  class="btn btn-secondary" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></button>';
                
                 if($listCompras->estado==1)
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


           public function destroyDetalle($id)
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
