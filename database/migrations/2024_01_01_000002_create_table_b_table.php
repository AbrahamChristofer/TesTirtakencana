<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_b', function (Blueprint $table) {
            // Catatan: struktur asli table_b TIDAK punya primary key.
            // Kolom id ditambahkan agar setiap baris transaksi bisa di-edit/hapus secara unik.
            $table->id();
            $table->unsignedBigInteger('kode_toko');
            $table->decimal('nominal_transaksi', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_b');
    }
};
