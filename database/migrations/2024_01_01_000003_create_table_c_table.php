<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_c', function (Blueprint $table) {
            // Catatan: struktur asli table_c TIDAK punya primary key.
            // Kolom id ditambahkan agar setiap baris bisa di-edit/hapus secara unik.
            $table->id();
            $table->unsignedBigInteger('kode_toko');
            $table->string('area_sales', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_c');
    }
};
