<?php

namespace App\Http\Controllers;

use App\Models\AccionTerapeutica;
use App\Models\Concentracion;
use App\Models\Marca;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoController extends Controller
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

        $productos = Producto::all()->map(function ($producto) {
            return [
                'id'              => $producto->id,
                'producto'        => $producto->producto,
                'generico'        => $producto->generico,
                'tipo_producto'   => $producto->tipo_producto == 'M' ? 'Medicamento' : 'Insumo',
                'precio_unitario' => $producto->precio_unitario,
                'porcentaje'      => number_format($producto->porcentaje, 0),
                'precio_venta'    => $producto->precio_venta,
                'cantidad'        => $producto->cantidad,
                'estado'          => $producto->estado,
                'edit_url'           => route('productos.edit', $producto->id),
            ];
        });

        return view(
            'productos.index',
            compact(
                'session_auth',
                'session_name',
                'productos'
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

        $concentraciones = Concentracion::get();
        $marcas = Marca::get();
        $presentaciones = Presentacion::get();
        $accionTerapeuticas = AccionTerapeutica::get();
        $unidadMedidas = UnidadMedida::get();

        return view(
            'productos.create',
            compact(
                'session_auth',
                'session_name',
                'concentraciones',
                'marcas',
                'presentaciones',
                'accionTerapeuticas',
                'unidadMedidas'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barras' => 'required|unique:productos,barras',
            'producto' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'generico' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
            'precio_unitario' => 'required|numeric|gt:0'
        ]);

        $producto = new Producto();
        $producto->tipo_producto = $request->tipo_producto;
        $producto->barras = $request->barras;
        $producto->producto = $request->producto;
        $producto->generico = $request->generico;
        $producto->concentracion_id = $request->concentracion_id;
        $producto->marca_id = $request->marca_id;
        $producto->accion_terapeutica_id = $request->accion_terapeutica_id;
        $producto->presentacion_id = $request->presentacion_id;
        $producto->unidad_medida_id = $request->unidad_medida_id;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->porcentaje = $request->porcentaje;
        $producto->precio_venta = $request->precio_venta;

        $producto->created_by = auth()->id();
        $producto->created_at = Carbon::now();
        $producto->save();

        $producto->codigo = 'FAR-' . $producto->id;

        if ($request->codigo_generado == 1) {
            $base = str_pad($producto->id, 12, '0', STR_PAD_LEFT);

            $suma = 0;
            for ($i = 0; $i < 12; $i++) {
                $digito = (int)$base[$i];
                $suma += ($i % 2 === 0) ? $digito : $digito * 3;
            }
            $resto = $suma % 10;
            $verificador = ($resto === 0) ? 0 : 10 - $resto;

            $codigoEan13 = $base . $verificador;
            $producto->barras = $codigoEan13;
            $producto->codigo_generado = 'S';
        }

        $producto->save();

        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $concentracion = Concentracion::find($producto->concentracion_id);
        $marca = Marca::find($producto->marca_id);
        $presentacion = Presentacion::find($producto->presentacion_id);
        $accionTerapeutica = AccionTerapeutica::find($producto->accion_terapeutica_id);
        $unidadMedida = UnidadMedida::find($producto->unidad_medida_id);

        if (!$producto) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos de la Atención.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => [
                'producto' => $producto,
                'concentracion' => $concentracion,
                'marca' => $marca,
                'presentacion' => $presentacion,
                'accionTerapeutica' => $accionTerapeutica,
                'unidadMedida' => $unidadMedida
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

        $producto = Producto::find($id);
        $concentraciones = Concentracion::get();
        $marcas = Marca::get();
        $presentaciones = Presentacion::get();
        $accionTerapeuticas = AccionTerapeutica::get();
        $unidadMedidas = UnidadMedida::get();

        return view(
            'productos.edit',
            compact(
                'session_auth',
                'session_name',
                'producto',
                'concentraciones',
                'marcas',
                'presentaciones',
                'accionTerapeuticas',
                'unidadMedidas'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->tipo_producto = $request->tipo_producto;

        if ($request->codigo_generado == 1) {
            $base = str_pad($producto->id, 12, '0', STR_PAD_LEFT);

            $suma = 0;
            for ($i = 0; $i < 12; $i++) {
                $digito = (int)$base[$i];
                $suma += ($i % 2 === 0) ? $digito : $digito * 3;
            }
            $resto = $suma % 10;
            $verificador = ($resto === 0) ? 0 : 10 - $resto;

            $codigoEan13 = $base . $verificador;
            $producto->barras = $codigoEan13;
            $producto->codigo_generado = 'S';
        } else {
            $producto->barras = $request->barras;
            $producto->codigo_generado = 'N';
        }
        $producto->producto = $request->producto;
        $producto->generico = $request->generico;
        $producto->concentracion_id = $request->concentracion_id;
        $producto->marca_id = $request->marca_id;
        $producto->accion_terapeutica_id = $request->accion_terapeutica_id;
        $producto->presentacion_id = $request->presentacion_id;
        $producto->unidad_medida_id = $request->unidad_medida_id;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->porcentaje = $request->porcentaje;
        $producto->precio_venta = $request->precio_venta;

        $producto->updated_by = auth()->id();
        $producto->updated_at = Carbon::now();
        $producto->save();

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $producto = Producto::find($id);

            if (!$producto) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Producto no encontrado.'
                ], 404);
            }

            $producto->deleted_by = auth()->id();
            $producto->save();

            $producto->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Producto eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Ocurrió un error al eliminar el Producto.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
