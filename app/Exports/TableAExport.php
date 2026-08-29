<?php

namespace App\Exports;

use App\Models\TableA;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableAExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): Enumerable
    {
        return TableA::orderBy('kode_toko_baru')->get();
    }

    public function headings(): array
    {
        return ['Kode Toko Baru', 'Kode Toko Lama'];
    }

    public function map($row): array
    {
        return [
            $row->kode_toko_baru,
            $row->kode_toko_lama,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true
                ]
            ]
        ];
    }
}
