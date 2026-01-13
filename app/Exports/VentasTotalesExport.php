<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class VentasTotalesExport implements FromView, WithEvents
{
   protected $ventas;
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $tipo_movimiento;

    public function __construct($ventas, $fecha_inicio, $fecha_fin, $tipo_movimiento,$total)
    {
        $this->ventas = $ventas;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->tipo_movimiento = $tipo_movimiento;
        $this->total = $total;
    }

    public function view(): View
    {
       
        return view('excel.reporteVentasTotales', [
            'ventas' => $this->ventas,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'tipo_movimiento' => $this->tipo_movimiento,
            'total' => $this->total,
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'J') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
