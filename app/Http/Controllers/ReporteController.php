<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\VentasFechaExport;
use App\Exports\ProductosVentasExport;
use App\Exports\ProductosCaducadosExport;
use App\Exports\ProductosPorCaducarExport;
use App\Exports\ComprasFechaExport;
use App\Exports\ProductosMasCompradosExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

       
        return view(
            'reportes.index',
            compact(
                'session_auth',
                'session_name',
                
            )
        );
    }

    
    public function reporteVentasFecha($fecha_inicio, $fecha_fin, $formato_ventas_fecha, $tipo_movimiento) 
{
    $ventas = DB::table('ventas as v')
        ->join('venta_detalles as vd', 'v.id', '=', 'vd.venta_id')
        ->join('productos as p', 'vd.producto_id', '=', 'p.id')
        ->join('concentraciones as c', 'p.concentracion_id', '=', 'c.id')
        ->join('marcas as m', 'p.marca_id', '=', 'm.id')
        ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
        ->select(
            'v.venta_fecha',
            'v.numero_venta',
            'v.cliente',
            'v.observacion',
            'p.codigo',
            'p.tipo_producto',
            'p.producto',
            'c.concentracion',
            'm.marca',
            'pr.presentacion',
            'vd.cantidad',
            'vd.subtotal',
            'vd.precio_unitario'
        )
        ->whereBetween('v.venta_fecha', [$fecha_inicio, $fecha_fin])
        ->whereNull('vd.deleted_at')
        ->whereNull('v.deleted_at')
        ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
            
            $query->where('v.tipo', $tipo_movimiento);
        })
        ->orderBy('v.venta_fecha', 'desc')
        ->get();

        $total = $ventas->sum('subtotal');
        
        if ($formato_ventas_fecha == 'Excel') {
          
        return Excel::download(new VentasFechaExport($ventas, $fecha_inicio, $fecha_fin, $tipo_movimiento,$total), 'reporte-ventas-de-fecha '.$fecha_inicio.' a '.$fecha_fin.'.xlsx');
         // dd($ventas);
    }
    
    return \PDF::loadView(
        'pdf.reporteVentasFecha',
        compact('ventas',
        'fecha_inicio',
        'fecha_fin',
        'tipo_movimiento',
        'total'
        )
    )
    ->setOption('page-size', 'Letter')   
    ->setOption('orientation', 'Landscape') 
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-ventas.pdf');
}

   public function reporteProductosVendidos($fecha_inicio, $fecha_fin,$formato,$tipo_movimiento ,$cantidad) 
{
    
   $ventas_productos = DB::table('venta_detalles as vd')
    ->join('productos as p', 'vd.producto_id', '=', 'p.id')
    ->join('ventas as v', 'vd.venta_id', '=', 'v.id')
    ->join('concentraciones as c', 'p.concentracion_id', '=', 'c.id')
        ->join('marcas as m', 'p.marca_id', '=', 'm.id')
        ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
    ->select(
        'p.id',
        'p.producto',
        'p.codigo',
        'p.tipo_producto',
        'v.tipo as tipo_movimiento',
        'c.concentracion',
            'm.marca',
            'pr.presentacion',
        DB::raw('SUM(vd.cantidad) as total_vendido')
    )
    ->whereNull('vd.deleted_at')
    ->whereNull('v.deleted_at')
    ->whereBetween('v.venta_fecha', [$fecha_inicio, $fecha_fin]) 
     ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
            
            $query->where('v.tipo', $tipo_movimiento);
        })
    ->groupBy('p.id', 'p.producto', 'p.codigo', 'p.tipo_producto','c.concentracion','m.marca','pr.presentacion','v.tipo')
    ->orderByDesc('total_vendido')
    ->limit($cantidad) 
    ->get();
        if ($formato== 'Excel') {
        return Excel::download(new ProductosVentasExport($ventas_productos, $fecha_inicio, $fecha_fin,$tipo_movimiento), 'reporte-productos-vendidos de fecha '.$fecha_inicio.' a '.$fecha_fin.'.xlsx');
    }
    return \PDF::loadView(
        'pdf.reporteProductosVendidos',
        compact('ventas_productos',
        'fecha_inicio',
        'fecha_fin',
        'tipo_movimiento'
        )
    )
    ->setOption('page-size', 'Letter')    
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-ventas.pdf');
}


  
    
   public function reporteProductosCaducados($tipo_movimiento,$formato) 
{
    
   $productos_vencidos = DB::table('compra_detalles as cd')
    ->join('productos as p', 'cd.producto_id', '=', 'p.id')
    ->join('compras as c', 'cd.compra_id', '=', 'c.id')
    ->join('concentraciones as conc', 'p.concentracion_id', '=', 'conc.id')
    ->join('marcas as m', 'p.marca_id', '=', 'm.id')
    ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
    ->select(
        'p.id',
        'p.producto',
        'p.codigo',
        'cd.cantidad_total',
        'c.tipo as tipo_movimiento',
        'c.compra_fecha',
        'conc.concentracion',
        'm.marca',
        'pr.presentacion',
        'cd.vencimiento',
        'p.clasificacion'
    )
    ->where('cd.vencimiento', '<', now()) 
    ->where('cd.cantidad_total', '>', 0)  
    ->where('p.clasificacion', '=', 0)   
    ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
            
            $query->where('c.tipo', $tipo_movimiento);
        })
    ->whereNull('cd.deleted_at')
    ->whereNull('p.deleted_at')
    ->whereNull('c.deleted_at')
    ->get();
        if ($formato== 'Excel') {
        return Excel::download(new ProductosCaducadosExport($productos_vencidos, $tipo_movimiento), 'reporte-caducados a fecha '.date('d-m-Y').'.xlsx');
    }
    return \PDF::loadView(
        'pdf.reporteProductosCaducos',
        compact('productos_vencidos',        
        'tipo_movimiento'
        )
    )->setOption('page-size', 'Letter')
    ->setOption('orientation', 'Landscape')  
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-ventas.pdf');
}
 public function reporteProductosPorCaducar($fecha_limite,$tipo_movimiento,$formato) 
{
    
   
$productos_por_caducar = DB::table('compra_detalles as cd')
    ->join('productos as p', 'cd.producto_id', '=', 'p.id')
    ->join('compras as c', 'cd.compra_id', '=', 'c.id')
    ->join('concentraciones as conc', 'p.concentracion_id', '=', 'conc.id')
    ->join('marcas as m', 'p.marca_id', '=', 'm.id')
    ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
    ->select(
        'p.id',
        'p.producto',
        'p.codigo',
        'c.tipo as tipo_movimiento',
        'cd.cantidad_total as cantidad_total',
        'c.compra_fecha',
        'cd.vencimiento',
        'conc.concentracion',
        'm.marca',
        'pr.presentacion'
    )
    ->whereBetween('cd.vencimiento', [now(), $fecha_limite]) 
    ->where('cd.cantidad_total', '>', 0)  
    ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
            
            $query->where('c.tipo', $tipo_movimiento);
        })
    ->whereNull('cd.deleted_at')
    ->whereNull('p.deleted_at')
    ->whereNull('c.deleted_at')
    ->orderBy('cd.vencimiento', 'asc') 
    ->get();
    if ($formato== 'Excel') {
        return Excel::download(new ProductosPorCaducarExport($productos_por_caducar, $fecha_limite,$tipo_movimiento), 'reporte-productos-por-caducar-hasta-fecha '.$fecha_limite.'.xlsx');
    }
    return \PDF::loadView(
        'pdf.reporteProductosPorCaducar',
        compact('productos_por_caducar',
        'fecha_limite',
        'tipo_movimiento'
        )
    )
    ->setOption('page-size', 'Letter')    
    ->setOption('orientation', 'Landscape')  
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-ventas.pdf');
}


 public function reporteComprasFecha($fecha_inicio, $fecha_fin, $formato, $tipo_movimiento) 
{
    
   
 $compras = DB::table('compra_detalles as cd')
    ->join('compras as c', 'cd.compra_id', '=', 'c.id')
    ->join('productos as p', 'cd.producto_id', '=', 'p.id')
    ->join('marcas as m', 'p.marca_id', '=', 'm.id')
    ->join('concentraciones as conc', 'p.concentracion_id', '=', 'conc.id')
    ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
    ->select(
        'p.producto',
        'p.tipo_producto as tipo',
        'c.proveedor',
        'c.numero_compra',
        'c.compra_fecha',
        'p.codigo',
        'p.tipo_producto',
        'cd.cantidad',
        'cd.precio_unitario',
        'cd.subtotal',
        'cd.vencimiento',
        'c.tipo as tipo_movimiento',
        'm.marca',
        'conc.concentracion',
        'pr.presentacion'
    )
    ->whereBetween('c.compra_fecha', [$fecha_inicio, $fecha_fin])
    ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
        $query->where('c.tipo', $tipo_movimiento);
    })
    ->whereNull('cd.deleted_at')
    ->whereNull('p.deleted_at')
    ->whereNull('c.deleted_at')
    ->orderBy('c.compra_fecha', 'asc')
    ->get();
      $total = $compras->sum('subtotal');
        if ($formato== 'Excel') {
        return Excel::download(new ComprasFechaExport($compras, $fecha_inicio, $fecha_fin,$tipo_movimiento,$total), 'reporte-compras-de-fecha '.$fecha_inicio.' a '.$fecha_fin.'.xlsx');
        
  
    }
  
    return \PDF::loadView(
        'pdf.reporteComprasFecha',
        compact('compras', 
        'fecha_inicio',
        'fecha_fin',       
        'tipo_movimiento',
        'total'
        )
    )->setOption('page-size', 'Letter')
    ->setOption('orientation', 'Landscape')  
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-compras.pdf');
   
   
}
 public function reporteProductosMasComprados($fecha_inicio, $fecha_fin,$formato,$tipo_movimiento ,$cantidad) 
{
    $productosComprados = DB::table('compra_detalles as cd')
    ->join('compras as co', 'cd.compra_id', '=', 'co.id')
    ->join('productos as p', 'cd.producto_id', '=', 'p.id')
    ->join('concentraciones as c', 'p.concentracion_id', '=', 'c.id')
    ->join('marcas as m', 'p.marca_id', '=', 'm.id')
    ->join('presentaciones as pr', 'p.presentacion_id', '=', 'pr.id')
    ->select(
        'p.producto',
        'p.codigo',
        'c.concentracion',
        'm.marca',
        'pr.presentacion',
        'co.tipo as tipo_movimiento',
        'co.proveedor',
        DB::raw('SUM(cd.cantidad) as cantidad_total')
    )
    ->whereBetween('co.compra_fecha', [$fecha_inicio, $fecha_fin])
    ->when($tipo_movimiento != 'Todos', function($query) use ($tipo_movimiento) {
        $query->where('co.tipo', $tipo_movimiento);
    })
    ->groupBy('p.id', 'p.producto', 'p.codigo', 'c.concentracion', 'm.marca', 'pr.presentacion', 'co.tipo', 'co.proveedor')
    ->orderByDesc('cantidad_total')
    ->limit($cantidad)
    ->get();
        if ($formato== 'Excel') {
        return Excel::download(new ProductosMasCompradosExport($productosComprados, $fecha_inicio, $fecha_fin,$tipo_movimiento), 'reporte-productos-mas-comprados-de-fecha '.$fecha_inicio.' a '.$fecha_fin.'.xlsx');
    
    }
    
    return \PDF::loadView(
        'pdf.reporteProductosMasComprados',
        compact('productosComprados', 
        'fecha_inicio',
        'fecha_fin',       
        'tipo_movimiento'
        
        )
    )->setOption('page-size', 'Letter')
    ->setOption('orientation', 'Landscape')  
    ->setOption('disable-smart-shrinking', true)
    ->setOption('encoding', 'utf-8')
    ->setOption('no-stop-slow-scripts', true)
    ->stream('reporte-compras.pdf');
   
   
}

}
