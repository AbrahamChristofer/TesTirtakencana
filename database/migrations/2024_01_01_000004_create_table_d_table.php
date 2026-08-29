<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_d', function (Blueprint $table) {
            // kode_sales sebagai primary key (sesuai struktur asli, varchar unik secara alami)
            $table->string('kode_sales', 255)->primary();
            $table->string('nama_sales', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_d');
    }
};
