<?php

namespace App\Imports;

use App\Models\TableA;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TableAImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
     * Format kolom Excel:
     * kode_toko_baru | kode_toko_lama
     *
     * kode_toko_lama boleh dikosongkan.
     */
    public function model(array $row): Model|array|null
    {
        return new TableA([
            'kode_toko_baru' => $row['kode_toko_baru'],
            'kode_toko_lama' => $row['kode_toko_lama'] !== ''
                ? $row['kode_toko_lama']
                : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_toko_baru' => 'required|integer|unique:table_a,kode_toko_baru',
            'kode_toko_lama' => 'nullable|integer',
        ];
    }
}
