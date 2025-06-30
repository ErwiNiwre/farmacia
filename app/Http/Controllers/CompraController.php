<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\kardex;
use DataTables;
use Carbon\Carbon;
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
        $detalle = Compra::query()
    ->select('compras.id','compras.compra_fecha','compras.numero_compra','compras.proveedor','compras.tipo','compras.total')
    ->addSelect(DB::raw('(SELECT cantidad=cantidad_total as estado FROM public.compra_detalles  where compra_id=compras.id 
ORDER BY estado ASC limit 1) as estado'))
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
       
          DB::beginTransaction();
       try {
            $compra = new Compra();
           
            $compra->compra_fecha = date("Y-m-d H:i:s");
            $compra->user_id =  $session_auth->id;
            $compra->proveedor = Str::upper(preg_replace('/\s+/', ' ', trim($request->proveedor)));
            $compra->tipo = $request->tipo;
            

            $compra->numero_compra = count(Compra::withTrashed()->get())+1;
            if( $compra->tipo=='Compra')
            $compra->total = $request->total;    
            else
            $compra->total=0;
        
            $compra->created_by = $session_auth->id;
           
            $compra->save();
            
       
            $compra_detalles = json_decode($request->input('productos'), true);
            foreach ($compra_detalles as $detalle) {
                $producto = Producto::find($detalle['producto_id']);
                $compraDetalle = new CompraDetalle();
                
                $compraDetalle->created_by = $session_auth->id;
                $compraDetalle->compra_id = $compra->id; 
                $compraDetalle->producto_id = $detalle['producto_id'];
                
                $compraDetalle->cantidad = $detalle['cantidad'];
                $compraDetalle->cantidad_total = $detalle['cantidad'];
                if($detalle['vencimiento']){
                $compraDetalle->vencimiento = $detalle['vencimiento'];
                }
                if($compra->tipo=='Compra')
                $compraDetalle->precio_unitario = $detalle['unidad_precio'];
                else{
                $compraDetalle->precio_unitario = 0;
                 $compraDetalle->subtotal = 0;
                
                }

                if ($detalle['subtotal'] == ($compraDetalle->precio_unitario * $compraDetalle->cantidad)) {
                    $compraDetalle->subtotal = $detalle['subtotal'];
                }
                
                $compraDetalle->save();
                  $this->kardex($compra,$compraDetalle,'A');
                $producto->cantidad=$producto->cantidad+$detalle['cantidad'];
              
               
                if($detalle['estado']==1&&$compra->tipo=='Compra'){
                   
                         $producto->precio_unitario=$detalle['unidad_precio'];
                       $precio=($producto->porcentaje/100)*$detalle['unidad_precio'];
                       $producto->precio_venta=$precio+$detalle['unidad_precio'];
                    
               
                }
                $producto->save();
              
           
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
            
           
            foreach ($compraDetalles as $compraDetalle) {
                 $precio_maximo = CompraDetalle::where('producto_id', '=', $compraDetalle->producto_id)->
                 where('compra_id', '<>', $compras->id)->max('precio_unitario');
                 $kardex = Kardex::where('producto_id', '=', $compraDetalle->producto_id)->
                 where('tipo_movimiento', 'Producto')->orderBy('id', 'desc')->first();
                 if(empty($kardex))
                        $precio_maximo_kardex=0;
                    else
                 $precio_maximo_kardex = $kardex->precio_unitario;
              
                if ($compraDetalle) {
                     $productos = Producto::find($compraDetalle->producto_id);
                     $productos->cantidad=$productos->cantidad-$compraDetalle->cantidad;
                    
                  

                         if($precio_maximo>$precio_maximo_kardex&&Carbon::parse($kardex->fecha)->gt(Carbon::parse($compraDetalle->updated_at))){
                     $productos->precio_unitario=$precio_maximo;
                     $productos->precio_venta=(($productos->porcentaje/100)*$precio_maximo_kardex)+$precio_maximo_kardex;
                      }else{
                      
                     $productos->precio_unitario=$precio_maximo_kardex;
                     $productos->precio_venta=(($productos->porcentaje/100)*$precio_maximo_kardex)+$precio_maximo_kardex;  
                      }
                 
                       $this->kardex($compras,$compraDetalle,'B');
                     $productos->save();
                }
                    
              
            }
            CompraDetalle::where('compra_id', '=', $compras->id)->delete();
            $compras->delete();

             return redirect()->route('compras.index');
        } 

    }
    

    /* public function getListCompras()
    {
      

           $listCompras= Compra::query()
    ->select('compras.id','compras.compra_fecha','compras.numero_compra','compras.proveedor','compras.tipo','compras.total')
    ->addSelect(DB::raw('(SELECT cantidad=cantidad_total as estado FROM public.compra_detalles  where compra_id=compras.id 
ORDER BY estado ASC limit 1) as estado'))
    ->get();
               

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
    }*/

   

    function kardex($compra,$detalles,$accion){
     
             $kardex = new Kardex();
         $kardex->fecha = date("Y-m-d H:i:s");
         $kardex->producto_id = $detalles->producto_id;
         $kardex->tipo_movimiento = $compra->tipo;
         $kardex->accion=$accion;
         $kardex->cantidad = $detalles->cantidad;
         $kardex->precio_unitario = $detalles->precio_unitario;
         $kardex->subtotal = $detalles->subtotal;
         
         if($accion=='A')
          $kardex->created_by =$compra->user_id;
        if($accion=='M')
        $kardex->updated_by =$compra->user_id;
    if($accion=='B')
        $kardex->deleted_by =$compra->user_id;

         $kardex->save();
    
    }
}