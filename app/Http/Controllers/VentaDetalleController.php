<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\VentaDetalle;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\CompraDetalle;
use App\Models\Kardex;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use DataTables;

class VentaDetalleController extends Controller
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
      //   dd($request);
        // exit;
        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }
         DB::beginTransaction();
        try {
            //$ventaDetalle = VentaDetalle::find($request->edit_venta_id);
            $ventaDetalle = new VentaDetalle();
        
            if (!$ventaDetalle) {
                return response()->json([
                    'status' => 404,
                    'message' => 'veb no encontrada'
                ]);
            }

            
                $compraDetalles = CompraDetalle::where('producto_id', '=',$request->create_producto_id)->where('cantidad_total', '<>', '0')
                    ->orderBy('vencimiento', 'asc', 'id', 'asc')
                    ->get();
                $cantidad_total = $request->create_cantidad;
                $lote = "";
                $estado = 0;
                $cantidad;
                foreach ($compraDetalles as $compradetalle) {


                    if ($estado == 0) {

                        $cantidad_total = $compradetalle->cantidad_total - $cantidad_total;


                        if ($cantidad_total <= 0) {
                            $cantidad = $compradetalle->cantidad_total;
                            $compradetalle->cantidad_total = 0;
                            $cantidad_total = abs($cantidad_total);

                            if ($cantidad_total == 0) {
                                $estado = 1;
                            }
                        } else {
                            $cantidad = $compradetalle->cantidad_total - $cantidad_total;
                            $compradetalle->cantidad_total = $cantidad_total;

                            $estado = 1;
                        }
                        $lote = $lote . ' ' . $compradetalle->id . ';' . $cantidad;

                        $compradetalle->save();
                    }
                }

            $ventaDetalle->lote = trim($lote);
            $subtotal = $ventaDetalle->subtotal;
            $cantidad_anterior = $ventaDetalle->cantidad;            
            $ventaDetalle->producto_id=$request->create_producto_id;
            $ventaDetalle->venta_id = $request->create_venta_id;
            $ventaDetalle->cantidad = $request->create_cantidad;
            $ventaDetalle->precio_unitario = $request->create_precio_unitario;
            $ventaDetalle->subtotal = $request->create_precio_unitario * $request->create_cantidad;
            $ventaDetalle->created_by = $session_auth->id;
            $ventaDetalle->created_at = Carbon::now();
            
            $ventaDetalle->save();
            // $producto = Producto::find($request->create_producto_id);

           
            //dd($request->edit_cantidad - $cantidad_anterior);
            
            $venta = Venta::find($request->create_venta_id);
            //$venta->observacion=$request->observacion_create
            $venta->total+=$ventaDetalle->subtotal;
             $venta->save();
                //$total_anterior=$venta->total;
             


            // $total = $venta->total;
            // $venta->total = $total - $subtotal + $ventaDetalle->subtotal;
           
            Kardex::registrarKardex([
                'producto_id'     => $ventaDetalle->producto_id,
                'tipo_movimiento' => $venta->tipo,
                'accion'          => 'A',
                'cantidad'        => $ventaDetalle->cantidad,
                'precio_unitario' => $ventaDetalle->precio_unitario,
                'subtotal'        => $ventaDetalle->subtotal,
                'user_id'         => $session_auth->id,
            ]);
            $producto = Producto::find($ventaDetalle->producto_id);
               $diferencia = $request->create_cantidad - $cantidad_anterior;

            if ($diferencia > 0) {
               $producto->ajustarStock(-$diferencia);   
                            
            } elseif ($diferencia < 0) {
                $producto->ajustarStock(abs(+$diferencia));  
                            
            }
            //dd($request->edit_cantidad);
            //$producto->ajustarStock(-$request->edit_cantidad);  
            /*$diferencia = $request->edit_cantidad - $cantidad_anterior;

            if ($diferencia > 0) {
               $producto->ajustarStock(-$diferencia);                
            } elseif ($diferencia < 0) {
                $producto->ajustarStock(abs(+$diferencia));                
            }*/
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Datos del Detalle de Compra Actualizada'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error al actualizar los datos de la Compra.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VentaDetalle $ventaDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VentaDetalle $ventaDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $session_auth = auth()->user();
        $session_name = "";
        // dd($request->all());
        // exit;
        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }
         DB::beginTransaction();
        try {
            $ventaDetalle = VentaDetalle::find($request->edit_venta_id);
            if (!$ventaDetalle) {
                return response()->json([
                    'status' => 404,
                    'message' => ' no encontrada'
                ]);
            }

              $compraDetalles = CompraDetalle::where('producto_id', '=',$ventaDetalle->producto_id)->where('cantidad_total', '<>', '0')
                    ->orderBy('vencimiento', 'asc', 'id', 'asc')
                    ->get();
                    // print_r($compraDetalles);
                    // exit;
                $cantidad_total = $request->edit_cantidad;
                $lote = "";
                $estado = 0;
                $cantidad;
                foreach ($compraDetalles as $compradetalle) {


                    if ($estado == 0) {

                        $cantidad_total = $compradetalle->cantidad_total - $cantidad_total;


                        if ($cantidad_total <= 0) {
                            $cantidad = $compradetalle->cantidad_total;
                            $compradetalle->cantidad_total = 0;
                            $cantidad_total = abs($cantidad_total);

                            if ($cantidad_total == 0) {
                                $estado = 1;
                            }
                        } else {
                            $cantidad = $compradetalle->cantidad_total - $cantidad_total;
                            $compradetalle->cantidad_total = $cantidad_total;

                            $estado = 1;
                        }
                        $lote = $lote . ' ' . $compradetalle->id . ';' . $cantidad;

                        $compradetalle->save();
                    }
                }
            $subtotal = $ventaDetalle->subtotal;
            $cantidad_anterior = $ventaDetalle->cantidad;
            $ventaDetalle->lote = trim($lote);
            $ventaDetalle->cantidad = $request->edit_cantidad;
            $ventaDetalle->precio_unitario = $request->edit_precio_unitario;
            $ventaDetalle->subtotal = $request->edit_precio_unitario * $request->edit_cantidad;
            $ventaDetalle->updated_by = $session_auth->id;
            $ventaDetalle->updated_at = Carbon::now();
            
            $ventaDetalle->save();
            // $producto = Producto::find($request->create_producto_id);

           
            //dd($request->edit_cantidad - $cantidad_anterior);
            
            $venta = Venta::find($ventaDetalle->venta_id);
            $total = $venta->total;
            $venta->total = $total - $subtotal + $ventaDetalle->subtotal;
            $venta->save();
            Kardex::registrarKardex([
                'producto_id'     => $ventaDetalle->producto_id,
                'tipo_movimiento' => $venta->tipo,
                'accion'          => 'M',
                'cantidad'        => $ventaDetalle->cantidad,
                'precio_unitario' => $ventaDetalle->precio_unitario,
                'subtotal'        => $ventaDetalle->subtotal,
                'user_id'         => $session_auth->id,
            ]);
            $producto = Producto::find($ventaDetalle->producto_id);
           // $diferencia = $request->edit_cantidad - $cantidad_anterior;
            $productos->ajustarStock(-$ventaDetalle->cantidad);
            // if ($diferencia > 0) {
            //    $producto->ajustarStock(-$diferencia);                
            // } elseif ($diferencia < 0) {
            //     $producto->ajustarStock(abs(+$diferencia));                
            // }
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Datos del Detalle de Compra Actualizada'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error al actualizar los datos de la Compra.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        try {
             $ventaDetalle = VentaDetalle::find( $id);
            //  print_r($ventaDetalle->venta_id);
            //  exit;
            $ventas = Venta::find($ventaDetalle->venta_id);
            $ventas->total -= $ventaDetalle->subtotal;
            if ($ventaDetalle) {
                
                $cantidad_total = 0;
               
              

                    $lotes = explode(" ", $ventaDetalle->lote);
                    $cantidad_total = $ventaDetalle->cantidad;
                    foreach ($lotes as $lote_array) {

                        $lote = explode(";", $lote_array);

                        $detalleCompra = CompraDetalle::find($lote[0]);

                        $detalleCompra->cantidad_total = $detalleCompra->cantidad_total + $lote[1];
                        // $this->kardex($ventas, $ventaDetalle, 'B');
                        Kardex::registrarKardex([
                            'producto_id'     => $ventaDetalle->producto_id,
                            'tipo_movimiento' => $ventas->tipo,
                            'accion'          => 'B',
                            'cantidad'        => $ventaDetalle->cantidad,
                            'precio_unitario' => $ventaDetalle->precio_unitario,
                            'subtotal'        => $ventaDetalle->subtotal,
                            'user_id'         => $session_auth->id
                        ]);
                        $detalleCompra->save();
                    }

                   
                        $productos = Producto::find($ventaDetalle->producto_id);
                        $productos->ajustarStock(+$ventaDetalle->cantidad);
                    
                $ventaDetalle->deleted_at=Carbon::now();
                $ventaDetalle->deleted_by=$session_auth->id;
               
                $ventaDetalle->delete();
                $ventas->save();
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
}
