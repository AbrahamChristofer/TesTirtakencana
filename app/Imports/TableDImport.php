<?php

namespace App\Imports;

use App\Models\TableD;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TableDImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
     * Format kolom Excel:
     * kode_sales | nama_sales
     */
    public function model(array $row): Model|array|null
    {
        return new TableD([
            'kode_sales' => $row['kode_sales'],
            'nama_sales' => $row['nama_sales'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_sales' => 'required|string|max:255|unique:table_d,kode_sales',
            'nama_sales' => 'required|string|max:20',
        ];
    }
}
