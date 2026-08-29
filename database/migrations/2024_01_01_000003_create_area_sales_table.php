<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kode_toko');
            $table->string('area_sales', 5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_sales');
    }
};
