<?php

namespace App\Exports;

use App\Models\TableB;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableBExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): Enumerable
    {
        return TableB::orderBy('kode_toko')->get();
    }

    public function headings(): array
    {
        return ['Kode Toko', 'Nominal Transaksi'];
    }

    public function map($row): array
    {
        return [
            $row->kode_toko,
            $row->nominal_transaksi,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
