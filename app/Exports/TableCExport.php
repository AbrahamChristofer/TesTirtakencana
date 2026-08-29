<?php

namespace App\Exports;

use App\Models\TableC;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableCExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): Enumerable
    {
        return TableC::orderBy('kode_toko')->get();
    }

    public function headings(): array
    {
        return ['Kode Toko', 'Area Sales'];
    }

    public function map($row): array
    {
        return [
            $row->kode_toko,
            $row->area_sales,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}
