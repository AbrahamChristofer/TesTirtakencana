<?php

namespace Database\Seeders;

use App\Models\TableA;
use App\Models\TableB;
use App\Models\TableC;
use App\Models\TableD;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Data persis sesuai dump SQL database `test` yang diberikan.
     */
    public function run(): void
    {
        TableA::truncate();
        TableA::insert([
            ['kode_toko_baru' => 1, 'kode_toko_lama' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko_baru' => 2, 'kode_toko_lama' => null, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko_baru' => 3, 'kode_toko_lama' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko_baru' => 4, 'kode_toko_lama' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko_baru' => 5, 'kode_toko_lama' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);

        TableB::truncate();
        TableB::insert([
            ['kode_toko' => 1, 'nominal_transaksi' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 2, 'nominal_transaksi' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 4, 'nominal_transaksi' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 6, 'nominal_transaksi' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 7, 'nominal_transaksi' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        TableC::truncate();
        TableC::insert([
            ['kode_toko' => 1, 'area_sales' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 2, 'area_sales' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 3, 'area_sales' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 4, 'area_sales' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['kode_toko' => 5, 'area_sales' => 'B', 'created_at' => now(), 'updated_at' => now()],
        ]);

        TableD::truncate();
        TableD::insert([
            ['kode_sales' => 'A1', 'nama_sales' => 'Alpha', 'created_at' => now(), 'updated_at' => now()],
            ['kode_sales' => 'A2', 'nama_sales' => 'Blue', 'created_at' => now(), 'updated_at' => now()],
            ['kode_sales' => 'A3', 'nama_sales' => 'Charlie', 'created_at' => now(), 'updated_at' => now()],
            ['kode_sales' => 'B1', 'nama_sales' => 'Delta', 'created_at' => now(), 'updated_at' => now()],
            ['kode_sales' => 'B2', 'nama_sales' => 'Echo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
