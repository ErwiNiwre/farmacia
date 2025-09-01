<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductosPorCaducarExport implements FromView, WithEvents
{
   public function __construct($productos_por_caducar,$fecha_limite, $tipo_movimiento)
    {
        $this->productos_por_caducar = $productos_por_caducar;
         $this->fecha_limite = $fecha_limite;        
        $this->tipo_movimiento = $tipo_movimiento;
    }

    public function view(): View
    {
        return view('excel.reporteProductosPorCaducar', [
            'productos_por_caducar' => $this->productos_por_caducar,
            'fecha_limite' => $this->fecha_limite,
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
