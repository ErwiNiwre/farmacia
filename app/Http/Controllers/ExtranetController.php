<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtranetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $medicamentos = Producto::where('tipo_producto', 'M')->get();
        $insumos = Producto::where('tipo_producto', 'I')->get();

        // return $medicamentos;
        return view(
            'extranet.welcome',
            compact(
                'medicamentos',
                'insumos'
            )
        );
    }

    public function farmacia()
    {
        //
        $medicamentos = DB::table('productos')
            ->select(
                'productos.id',
                'producto',
                'generico',
                'concentracion',
                'marca',
                'presentacion',
                'accion_terapeutica',
                'unidad_medida',
                'estado',
                'cantidad',
                'precio_venta'
            )
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('accion_terapeuticas', 'accion_terapeuticas.id', '=', 'productos.accion_terapeutica_id')
            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id')
            ->where('tipo_producto', 'M')
            ->whereNull('productos.deleted_at')
            ->get();

        $insumos = DB::table('productos')
            ->select(
                'productos.id',
                'producto',
                'generico',
                'concentracion',
                'marca',
                'presentacion',
                'accion_terapeutica',
                'unidad_medida',
                'estado',
                'cantidad',
                'precio_venta'
            )
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('accion_terapeuticas', 'accion_terapeuticas.id', '=', 'productos.accion_terapeutica_id')
            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id')
            ->where('tipo_producto', 'I')
            ->whereNull('productos.deleted_at')
            ->get();

        return view(
            'extranet.farmacia',
            compact(
                'medicamentos',
                'insumos'
            )
        );
    }

    public function servicios()
    {
        $laboratorio_servicios = DB::table('laboratorio_servicios')
            ->select(
                'laboratorio_servicios.id',
                'servicio',
                'precio',
                'clasificacion'
            )
            ->join('clasificaciones', 'clasificaciones.id', '=', 'laboratorio_servicios.clasificacion_id')
            ->whereNull('laboratorio_servicios.deleted_at')
            ->get();

        return view(
            'extranet.servicios',
            compact(
                'laboratorio_servicios'
            )
        );
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
