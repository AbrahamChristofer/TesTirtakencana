<?php

namespace App\Imports;

use App\Models\TableC;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TableCImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
     * Format kolom Excel:
     * kode_toko | area_sales
     */
    public function model(array $row): Model|array|null
    {
        return new TableC([
            'kode_toko'  => $row['kode_toko'],
            'area_sales' => $row['area_sales'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_toko'  => 'required|integer|min:0',
            'area_sales' => 'required|string|max:10',
        ];
    }
}
