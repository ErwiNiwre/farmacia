<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductosMasCompradosExport implements FromView, WithEvents
{
    public function __construct($compras, $fecha_inicio, $fecha_fin, $tipo_movimiento)
    {
        $this->compras = $compras;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->tipo_movimiento = $tipo_movimiento;
    }

    public function view(): View
    {
        return view('excel.reporteProductosMasComprados', [
            'productosComprados' => $this->compras,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'tipo_movimiento' => $this->tipo_movimiento,
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'I') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
