<?php

namespace App\Imports;

use App\Models\TableB;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TableBImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row): Model|array|null
    {
        return new TableB([
            'kode_toko' => $row['kode_toko'],
            'nominal_transaksi' => $row['nominal_transaksi'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_toko' => 'required|integer',
            'nominal_transaksi' => 'required|numeric',
        ];
    }
}
