<?php

namespace App\Http\Controllers;

use App\Models\CompraDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Kardex;
use Carbon\Carbon;
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

        try {
            $compraDetalle = new CompraDetalle();
            $compras = Compra::find($request->create_compra_id);
            $compras->total = $compras->total + $request->create_subtotal;
            $compras->save();

            $compraDetalle->created_by = $session_auth->id;
            $compraDetalle->compra_id = $request->create_compra_id;
            $compraDetalle->cantidad =  $request->edit_cantidad;
            $compraDetalle->precio_unitario = $request->edit_precio_unitario;
            $compraDetalle->producto_id = $request->create_producto_id;
            $compraDetalle->subtotal = $request->create_subtotal;
            if ($request->edit_vencimiento) {
                $compraDetalle->vencimiento = $request->edit_vencimiento;
            }

            $compraDetalle->cantidad_total = $request->edit_cantidad;

            // $this->kardex($compras, $compraDetalle, 'A');
            Kardex::registrarKardex([
                'producto_id'     => $compraDetalle->producto_id,
                'tipo_movimiento' => $compras->tipo,
                'accion'          => 'A',
                'cantidad'        => $compraDetalle->cantidad,
                'precio_unitario' => $compraDetalle->precio_unitario,
                'subtotal'        => $compraDetalle->subtotal,
                'user_id'         => $compras->user_id
            ]);

            $compraDetalle->save();
            $producto = Producto::find($request->create_producto_id);
            //$producto->cantidad = $producto->cantidad + $request->edit_cantidad;
            $producto->ajustarStock($request->edit_cantidad);
            if ($request->create_estado == "1") {

                $producto->precio_unitario = $request->edit_precio_unitario;
                $precio = ($producto->porcentaje / 100) * $request->edit_precio_unitario;
                $producto->precio_venta = $precio + $request->edit_precio_unitario;
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

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        try {
            $comprasDetalle = CompraDetalle::find($id);
            $precio_maximo = 0;
            $compras = Compra::find($comprasDetalle->compra_id);

            $compras->total = $compras->total - ($comprasDetalle->cantidad * $comprasDetalle->precio_unitario);

            $compras->save();
            // $this->kardex($compras, $comprasDetalle, 'B');
            Kardex::registrarKardex([
                'producto_id'     => $comprasDetalle->producto_id,
                'tipo_movimiento' => $compras->tipo,
                'accion'          => 'B',
                'cantidad'        => $comprasDetalle->cantidad,
                'precio_unitario' => $comprasDetalle->precio_unitario,
                'subtotal'        => $comprasDetalle->subtotal,
                'user_id'         => $compras->user_id
            ]);
            $comprasDetalle->deleted_by = $session_auth->id;

            $comprasDetalle->save();

            if ($comprasDetalle) {

                $detalle_max = CompraDetalle::where('producto_id', $comprasDetalle->producto_id)
                    ->where('id', '!=', $comprasDetalle->id)
                    ->orderByDesc('precio_unitario')
                    ->first();
                if ($detalle_max)
                    $precio_maximo = $detalle_max->precio_unitario;

                $kardex = Kardex::where('producto_id', '=', $comprasDetalle->producto_id)->where('tipo_movimiento', 'Producto')->orderBy('id', 'desc')->first();

                if (empty($kardex))
                    $precio_maximo_kardex = 0;
                else
                    $precio_maximo_kardex = $kardex->precio_unitario;
                $productos = Producto::find($comprasDetalle->producto_id);
                // $productos->cantidad = $productos->cantidad - $comprasDetalle->cantidad;

                if ($precio_maximo > $precio_maximo_kardex && Carbon::parse($detalle_max->created_at)->gt(Carbon::parse($kardex->fecha))) {
                    $productos->precio_unitario = $precio_maximo;
                    $productos->precio_venta = (($productos->porcentaje / 100) * $precio_maximo) + $precio_maximo;
                } else {

                    $productos->precio_unitario = $precio_maximo_kardex;
                    $productos->precio_venta = (($productos->porcentaje / 100) * $precio_maximo_kardex) + $precio_maximo_kardex;
                }
                $productos->save();
                $productos->ajustarStock(-$comprasDetalle->cantidad);

                $comprasDetalle->delete();
            }
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
}
