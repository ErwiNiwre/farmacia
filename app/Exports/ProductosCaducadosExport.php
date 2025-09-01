<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ProductosCaducadosExport implements FromView, WithEvents
{
    public function __construct($productos_vencidos, $tipo_movimiento)
    {
        $this->productos_vencidos = $productos_vencidos;        
        $this->tipo_movimiento = $tipo_movimiento;
    }

    public function view(): View
    {
        return view('excel.reporteProductosCaducos', [
            'productos_vencidos' => $this->productos_vencidos,
            'tipo_movimiento' => $this->tipo_movimiento,
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
