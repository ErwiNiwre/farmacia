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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductosRangeExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithEvents
{
    protected $desde;
    protected $hasta;
    protected $excluir;

    public function __construct($desde, $hasta, $excluir = [])
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->excluir = $excluir;
    }

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
                'codigos_sin.codigo as codigo_sin',
            ])
            ->join('concentraciones', 'concentraciones.id', '=', 'productos.concentracion_id')
            ->join('marcas', 'marcas.id', '=', 'productos.marca_id')
            ->join('presentaciones', 'presentaciones.id', '=', 'productos.presentacion_id')
            ->join('codigos_sin', 'codigos_sin.id', '=', 'productos.codigo_sin_id')
            ->whereNull('productos.deleted_at')
            ->whereBetween('productos.id', [$this->desde, $this->hasta])
            ->whereNotIn('productos.id', $this->excluir)
            ->orderBy('productos.id', 'asc')
            ->get()
            ->map(function ($producto) {
                return [
                    'fac_tipo'            => 'PRODUCTO',
                    'fac_estado'          => 1,
                    'fac_codigo'          => $producto->codigo,
                    'fac_serie'           => '0',
                    'fac_imei'            => '0',
                    'fac_descripcion'     => $producto->producto . ' - ' . $producto->concentracion . ' - ' . $producto->presentacion . ' - ' . $producto->marca,
                    'fac_precio_unitario' => $producto->precio_venta,
                    'fac_categoria'       => $producto->tipo_producto == 'M' ? 'MEDICAMENTOS' : 'INSUMOS',
                    'fac_cod_prod_sin'    => $producto->codigo_sin,
                    'fac_cod_uni_med_sin' => 57,
                    'fac_uni_sin_des'     => 'UNIDAD (BIENES)-57',
                    'fac_cod_act_sin'     => 4772100,
                ];
            });
    }

    public function headings(): array
    {
        return [
            '*TIPO',
            '*ESTADO',
            '*COD. PRODUCTO',
            'SERIE',
            'IMEI',
            '*DESCRIPCION',
            '*PRECIO UNITARIO',
            '*CATEGORIA',
            '*COD. PRODUCTO SIN',
            '*COD.UNIDAD MEDIDA SIN',
            'UNIDAD SIN DESCRIPCION',
            'COD. ACTIVIDAD SIN'
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

                // Estilo para encabezados A1:H1
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'], // Texto blanco
                        'bold' => true, // opcional: en negrita
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '333F4F'],
                    ],
                    // 'borders' => [
                    //     'allBorders' => [
                    //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    //         'color' => ['rgb' => '000000'],
                    //     ],
                    // ],
                ]);

                // Estilo para encabezados I1:L1
                $event->sheet->getStyle('I1:L1')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'], // Texto blanco
                        'bold' => true, // opcional: en negrita
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2F75B5'],
                    ],
                    // 'borders' => [
                    //     'allBorders' => [
                    //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    //         'color' => ['rgb' => '000000'],
                    //     ],
                    // ],
                ]);

                $event->sheet->getRowDimension(1)->setRowHeight(33);

                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle("G2:G{$highestRow}")
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
            },
        ];
    }
}
