<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ComprasFechaExport implements FromView, WithEvents
{

    protected $compras;
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $tipo_movimiento;
    protected $total;



     public function __construct($compras, $fecha_inicio, $fecha_fin, $tipo_movimiento,$total)
    {
        $this->compras = $compras;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->tipo_movimiento = $tipo_movimiento;
        $this->total = $total;
    }

    public function view(): View
    {
        return view('excel.reporteComprasFecha', [
            'compras' => $this->compras,
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
                foreach (range('A', 'N') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
