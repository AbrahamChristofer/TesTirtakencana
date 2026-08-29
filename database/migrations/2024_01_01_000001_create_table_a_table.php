<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_a', function (Blueprint $table) {
            // kode_toko_baru sebagai primary key (sesuai struktur asli: bigint unsigned, not null)
            $table->unsignedBigInteger('kode_toko_baru')->primary();
            $table->integer('kode_toko_lama')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_a');
    }
};
