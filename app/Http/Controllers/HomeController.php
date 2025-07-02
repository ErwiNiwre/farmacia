<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Models\CompraDetalle;
use Carbon\Carbon;

class HomeController extends Controller
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
                'compra_detalles.cantidad',
                'compra_detalles.precio_unitario',
                'precio_venta',
                'vencimiento',
                'compra_detalles.created_at as fecha_compra'
            )
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('accion_terapeuticas', 'accion_terapeuticas.id', '=', 'productos.accion_terapeutica_id')
            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id')
            ->join('compra_detalles', 'compra_detalles.producto_id', '=', 'productos.id')
            ->where('tipo_producto', 'M')
            //->whereDate('compra_detalles.vencimiento', Carbon::now()->addDays(40)->toDateString())
            ->whereBetween('compra_detalles.vencimiento', [
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(40)->toDateString()
            ])
            // ->whereDate('compra_detalles.vencimiento', '=', Carbon::now()->addDays(60)->toDateString())
            ->whereNull('compra_detalles.deleted_at')
            ->whereNull('productos.deleted_at')
            ->get();
// print_r($medicamentos);
// exit;
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
                'compra_detalles.cantidad',
                'compra_detalles.precio_unitario',
                'precio_venta',
                'vencimiento',
                'compra_detalles.created_at as fecha_compra'
            )
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('accion_terapeuticas', 'accion_terapeuticas.id', '=', 'productos.accion_terapeutica_id')
            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id')
            ->join('compra_detalles', 'compra_detalles.producto_id', '=', 'productos.id')           
            ->where('tipo_producto', 'I')
            ->whereBetween('compra_detalles.vencimiento', [
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(40)->toDateString()
            ])
            
            ->whereNull('compra_detalles.deleted_at')
            ->whereNull('productos.deleted_at')
            ->get();

        return view(
            'home.index',
            compact(
                'session_auth',
                'session_name',
                'medicamentos',
                'insumos'
            )
        );
    }

         public function farmacia()
    {
      
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
                'precio_venta',
                'vencimiento',
                'created_at as fecha_compra'
            )
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('accion_terapeuticas', 'accion_terapeuticas.id', '=', 'productos.accion_terapeutica_id')
            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id')
            ->where('tipo_producto', 'M')
            ->whereNull('productos.deleted_at')
            ->get();
print_r($medicamentos);
exit;
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
            ->join('compra_detalles', 'compra_detalles.producto_id', '=', 'productos.id')
            ->where('tipo_producto', 'I')
            ->whereDate('compra_detalles.fecha_vencimiento', Carbon::now()->addDays(40)->toDateString())
            ->whereNull('productos.deleted_at')
            ->get();

        return view(
            'Homer.index',
            compact(
                'medicamentos',
                'insumos'
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
