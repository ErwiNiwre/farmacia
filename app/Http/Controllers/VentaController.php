<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\VentaDetalle;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Kardex;
use Carbon\Carbon;
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




        $ventas = DB::table('ventas')
    ->select(
        'id',
        'numero_venta',
        'venta_fecha',
        'tipo',
        'cliente',
        'total',
        'efectivo',
        'qr',
        'metodo_pago',
        DB::raw("CASE 
                    WHEN metodo_pago = 'E' THEN 'Efectivo'
                    WHEN metodo_pago = 'Q' THEN 'QR'
                    WHEN metodo_pago = 'M' THEN 'Efectivo y QR'
                    WHEN metodo_pago = 'N' THEN 'Ninguno'
                    ELSE 'Ninguno'
                 END as metodo_pago")
    )
    ->whereNull('deleted_at')
    ->get();
      
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
       
          DB::beginTransaction();
       try {
            $venta = new Venta();
            $venta->venta_fecha = date("Y-m-d H:i:s");
            $venta->user_id =  $session_auth->id;
            $venta->cliente = Str::upper(preg_replace('/\s+/', ' ', trim($request->cliente)));
            $venta->tipo = $request->tipo;
            
            $venta->numero_venta = count(Venta::withTrashed()->get())+1;
            if( $venta->tipo=='Salida Directa'){
            $venta->total =0;  
            $venta->efectivo =  0;
            $venta->qr =  0;
            $venta->observacion = $request->observacion;
            $venta->metodo_pago = 'N'; 
            }else{
                $venta->total = $request->total;  
            $venta->efectivo =  $request->efectivo;
            $venta->qr =  $request->qr;
            $venta->observacion = $request->observacion;
            $venta->metodo_pago = $request->metodo_pago;  
            }
            $venta->created_by = $session_auth->id;
           
            $venta->save();
            
       
            $venta_detalles = json_decode($request->input('productos'), true);
            
            
            $cantidad_total=0;
            foreach ($venta_detalles as $detalle) {
                    

                 
                 $producto = Producto::find($detalle['producto_id']);
                 $compraDetalles = CompraDetalle::where('producto_id', '=', $detalle['producto_id'])->
                 where('cantidad_total', '<>','0')
                 ->orderBy('vencimiento', 'asc','id','asc')
                 ->get();
                $cantidad_total=$detalle['cantidad'];
                $lote="";
                $estado=0;
                $cantidad;
                 foreach ($compraDetalles as $compradetalle) {
                   
               
           if($estado==0){
        
                    $cantidad_total=$compradetalle->cantidad_total-$cantidad_total;
                    

                    if($cantidad_total<=0){
                        $cantidad=$compradetalle->cantidad_total;
                        $compradetalle->cantidad_total=0;
                        $cantidad_total=abs($cantidad_total);
            
            if($cantidad_total==0){
                $estado=1;
            }
                    }else{
                         $cantidad= $compradetalle->cantidad_total-$cantidad_total; 
                        $compradetalle->cantidad_total=$cantidad_total;
                               
                        $estado=1;
                    }
                     $lote=$lote.' '.$compradetalle->id.';'.$cantidad;
                   
                     $compradetalle->save();
                }
                }


                $venta_detalle = new VentaDetalle();
              
                $venta_detalle->venta_id = $venta->id; 
                $venta_detalle->producto_id = $detalle['producto_id'];
                if( $venta->tipo=='Salida Directa')
                $venta_detalle->precio_unitario = 0;
                else
                $venta_detalle->precio_unitario = $detalle['unidad_precio'];

                $venta_detalle->cantidad = $detalle['cantidad'];
                $venta_detalle->lote = trim($lote);
                
                $venta_detalle->subtotal = $venta_detalle->precio_unitario * $venta_detalle->cantidad;
             
                $venta_detalle->created_by = $session_auth->id;
                 $this->kardex($venta,$venta_detalle,'A');
                $venta_detalle->save();
                
                $producto->cantidad=$producto->cantidad-$detalle['cantidad'];
                if(!empty($detalle['estado'])){
                     $producto->precio_venta=(($producto->porcentaje/100)*$detalle['unidad_precio'])+$detalle['unidad_precio'];
                     $producto->precio_unitario=$detalle['unidad_precio'];
                }
                $producto->save();
                
                
               
                

            }
           
            DB::commit(); // Confirmar la transacción
            
            return response()->json([
                'status' => 200,
                'message' => 'Datos de la Compra Creada.',
                'pdf_url' => route('ventas.print',$venta->id)
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

       
         $ventas = DB::table('ventas')
    ->select(
        'id',
        'numero_venta',
        'venta_fecha',
        'tipo',
        'cliente',
        'total',
        'efectivo',
        'qr',
        'metodo_pago',
        DB::raw("CASE 
                    WHEN metodo_pago = 'E' THEN 'Efectivo'
                    WHEN metodo_pago = 'Q' THEN 'QR'
                    WHEN metodo_pago = 'M' THEN 'Efectivo y QR'
                    WHEN metodo_pago = 'N' THEN 'Ninguno'
                    ELSE 'Ninguno'
                 END as metodo_pago")
    )
    ->where('id',$id)
    ->whereNull('deleted_at')
    ->get();
     
        if (!$ventas) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }
        
    
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

try{
        $ventas = Venta::find($id);

        if ($ventas) {
             $ventas->deleted_by = $session_auth->id;
             $ventas->save();
$cantidad_total=0;
            VentaDetalle::where('venta_id', '=', $ventas->id)
                ->update(['deleted_by' => $session_auth->id]);
            $ventaDetalles = VentaDetalle::where('venta_id', '=', $ventas->id)->get();
            
           
          
            foreach ($ventaDetalles as $ventaDetalle) {
              
                $lotes=explode(" ",$ventaDetalle->lote);
               $cantidad_total=$ventaDetalle->cantidad;
                foreach ($lotes as $lote_array) {
              
                    $lote=explode(";",$lote_array);
                
                    $detalleCompra=CompraDetalle::find($lote[0]);

                   $detalleCompra->cantidad_total=$detalleCompra->cantidad_total+$lote[1];
                      $this->kardex($ventas,$ventaDetalle,'B');
                    $detalleCompra->save();
                   
               
            }
        



                if ($ventaDetalle) {
                     $productos = Producto::find($ventaDetalle->producto_id);
                     $productos->cantidad=$productos->cantidad+$ventaDetalle->cantidad;
                         
                     $productos->save();

                    
                }
            }
            VentaDetalle::where('venta_id', '=', $ventas->id)->delete();
            $ventas->delete();

             return response()->json([
                'status' => 200,
                'message' => 'Datos de la Compra Creada.',
            ]);
        }
         } catch (\Exception $e) {
            DB::rollBack();
        
            return response()->json([
                'status' => 500,
                'message' => 'Error al guardar la atención: ' . $e->getMessage()
            ], 500);
        } 

    }
    function kardex($venta,$detalles,$accion){
        
       
      
             $kardex = new Kardex();
         $kardex->fecha = date("Y-m-d H:i:s");
         $kardex->producto_id = $detalles->producto_id;
         $kardex->tipo_movimiento = $venta->tipo;
         $kardex->accion=$accion;
         $kardex->cantidad = $detalles->cantidad;
         $kardex->precio_unitario = $detalles->precio_unitario;
         $kardex->subtotal = $detalles->subtotal;
         
         if($accion=='A')
          $kardex->created_by =$venta->user_id;
        if($accion=='M')
        $kardex->updated_by =$venta->user_id;
    if($accion=='B')
        $kardex->deleted_by =$venta->user_id;

         $kardex->save();
    
    }

     public function print($id)
    {
        
          $ventas = Venta::find($id);
       

        if (!$ventas) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Compra'
            ], 404);
        }
        
     
       $venta_detalles= DB::table('venta_detalles')
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

        
        $ventas->venta_fecha = Carbon::parse($ventas->venta_fecha)->format('d-m-Y H:i:s');
        $ventas->user_id = str_pad($ventas->user_id, 4, '0', STR_PAD_LEFT);
        $ventas->numero_venta = str_pad($ventas->numero_venta, 10, '0', STR_PAD_LEFT);

        $ventas->metodo_pago = match ($ventas->metodo_pago) {
            'E' => 'EFECTIVO',
            'Q' => 'QR',
            'M' => 'MIXTO',
            default => 'NINGUNO',
        };

        
        // return $venta_detalles;
        return \PDF::loadView(
            'pdf.app',
            compact(
                'ventas',
                'venta_detalles'
            )
        )
            ->setOption('page-width', '80mm')        // ancho del recibo
            ->setOption('page-height', '297mm')      // alto estimado; puede ser más
            ->setOption('margin-top', '0mm')
            ->setOption('margin-bottom', '5mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '5mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('encoding', 'utf-8')
            ->setOption('no-stop-slow-scripts', true)
            ->stream('recibo');
    }

   
       
}
