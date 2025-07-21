<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductosExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Producto::query()
            ->select([
                'productos.*',
                'concentraciones.concentracion as concentracion',
                'marcas.marca as marca',
                'presentaciones.presentacion as presentacion',
            ])
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->whereNull('productos.deleted_at')
            ->orderBy('productos.id', 'asc')
            ->get()
            ->map(function ($producto) {
                return [
                    'id'              => $producto->id,
                    'producto'        => $producto->producto,
                    'generico'        => $producto->generico,
                    'concentracion'   => $producto->concentracion,
                    'marca'           => $producto->marca,
                    'presentacion'    => $producto->presentacion,
                    'precio_unitario' => $producto->precio_unitario,
                    'porcentaje'      => number_format($producto->porcentaje, 0),
                    'precio_venta'    => $producto->precio_venta,
                    'stock'           => $producto->stock_minimo,
                    'cantidad'        => $producto->cantidad,
                    'estado'          => $producto->estado,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nombre Comercial',
            'Nombre Generico',
            'Concentracion',
            'Marca',
            'Presentacion',
            'P. Compra',
            'Porcentaje',
            'P. Venta',
            'Stock',
            'Cantidad',
            'Estado'
        ];
    }

    public function title(): string
    {
        return 'Listado de Productos';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Ajuste automático de columnas (A a L = 12 columnas)
                foreach (range('A', 'L') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }

                // Aplicar color de fondo y bordes a los encabezados (fila 1)
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'BDD7EE'], // azul claro
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
