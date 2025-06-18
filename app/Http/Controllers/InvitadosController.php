<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class InvitadosController extends Controller
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
            'welcome',
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
            'invitados.farmacia',
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
            'invitados.servicios',
            compact(
                'laboratorio_servicios'
            )
        );
    }

    public function print()
    {

        return \PDF::loadView(
            'pdf.app',

        )
            // ->setPaper('letter')
            ->setPaper('a4')
            ->setOption('encoding', 'utf-8')
            ->setOption('margin-top', '15mm')
            ->setOption('margin-bottom', '15mm')
            ->setOption('margin-right', '10mm')
            ->setOption('margin-left', '0mm')
            // ->setOption('header-html', route('pdf.header'))
            // ->setOption('footer-right', 'Página [page] de [toPage]')
            // ->setOption('footer-html', route('pdf.footer'))
            ->stream('recibo');

        // Aquí puedes pasar datos dinámicos a la vista si quieres.

        // return \PDF::loadView('pdf.app')
        //     ->setPaper([0, 0, 226.77, 1000]) // 80mm ancho x variable altura (en pt, 1mm = 2.83 pt)
        //     ->setOption('margin-top', 5)
        //     ->setOption('margin-bottom', 5)
        //     ->setOption('margin-left', 5)
        //     ->setOption('margin-right', 5)
        //     ->stream('recibo.pdf'); // o ->download('recibo.pdf')
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
