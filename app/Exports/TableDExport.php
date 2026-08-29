<?php

namespace App\Exports;

use App\Models\TableD;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableDExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): Enumerable
    {
        return TableD::orderBy('kode_sales')->get();
    }

    public function headings(): array
    {
        return ['Kode Sales', 'Nama Sales'];
    }

    public function map($row): array
    {
        return [
            $row->kode_sales,
            $row->nama_sales,
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
