<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ProductosVentasExport implements FromView, WithEvents
{
   
    public function __construct($ventas, $fecha_inicio, $fecha_fin, $tipo_movimiento)
    {
        $this->ventas = $ventas;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->tipo_movimiento = $tipo_movimiento;
    }

    public function view(): View
    {
        return view('excel.reporteProductosVentas', [
            'ventas_productos' => $this->ventas,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'tipo_movimiento' => $this->tipo_movimiento,
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'H') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
