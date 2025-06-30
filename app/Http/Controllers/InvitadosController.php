<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
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
        $ventas = new Venta();

        $ventas->id = 1;
        $ventas->user_id = 1;
        $ventas->venta_fecha = Carbon::now();
        $ventas->numero_venta = 1;
        $ventas->cliente = "Pedro Luna Cortez";
        $ventas->metodo_pago = "E";
        $ventas->total = "301.00";
        $ventas->efectivo = null;
        $ventas->qr = "250.50";

        $ventas->venta_fecha = Carbon::parse($ventas->venta_fecha)->format('d-m-Y H:i:s');
        $ventas->user_id = str_pad($ventas->user_id, 4, '0', STR_PAD_LEFT);
        $ventas->numero_venta = str_pad($ventas->numero_venta, 6, '0', STR_PAD_LEFT);

        $ventas->metodo_pago = match ($ventas->metodo_pago) {
            'E' => 'EFECTIVO',
            'Q' => 'QR',
            'M' => 'MIXTO',
            default => 'NINGUNO',
        };

        $venta_detalles = [];
        for ($i = 1; $i <= 5; $i++) {
            $venta_detalle = new VentaDetalle();
            $venta_detalle->id = $i;
            $venta_detalle->venta_id = 1;
            $venta_detalle->producto_id = "AGUA PARA INYECCION 5ML - " . $i;
            $venta_detalle->cantidad = 2;
            $venta_detalle->precio_unitario = "500,60";
            $venta_detalle->subtotal = "500,60";
            $venta_detalles[] = $venta_detalle;
        }
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
