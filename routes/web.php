<?php

use App\Http\Controllers\TableAController;
use App\Http\Controllers\TableBController;
use App\Http\Controllers\TableCController;
use App\Http\Controllers\TableDController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('table-b.index');
});

// ==== table_a (History Kode Toko) ====
Route::prefix('table-a')->name('table-a.')->group(function () {
    Route::get('/', [TableAController::class, 'index'])->name('index');
    Route::get('/create', [TableAController::class, 'create'])->name('create');
    Route::post('/', [TableAController::class, 'store'])->name('store');
    Route::post('/import', [TableAController::class, 'importExcel'])->name('import');
    Route::get('/{tableA}/edit', [TableAController::class, 'edit'])->name('edit');
    Route::put('/{tableA}', [TableAController::class, 'update'])->name('update');
    Route::delete('/{tableA}', [TableAController::class, 'destroy'])->name('destroy');
    Route::get('/export/excel', [TableAController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [TableAController::class, 'exportPdf'])->name('export.pdf');
});

// ==== table_b (Penjualan) ====
Route::prefix('table-b')->name('table-b.')->group(function () {
    Route::get('/', [TableBController::class, 'index'])->name('index');
    Route::get('/create', [TableBController::class, 'create'])->name('create');
    Route::post('/', [TableBController::class, 'store'])->name('store');
    Route::post('/import', [TableBController::class, 'importExcel'])->name('import');
    Route::get('/{tableB}/edit', [TableBController::class, 'edit'])->name('edit');
    Route::put('/{tableB}', [TableBController::class, 'update'])->name('update');
    Route::delete('/{tableB}', [TableBController::class, 'destroy'])->name('destroy');
    Route::get('/export/excel', [TableBController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [TableBController::class, 'exportPdf'])->name('export.pdf');
});

// ==== table_c (Area Sales) ====
Route::prefix('table-c')->name('table-c.')->group(function () {
    Route::get('/', [TableCController::class, 'index'])->name('index');
    Route::get('/create', [TableCController::class, 'create'])->name('create');
    Route::post('/', [TableCController::class, 'store'])->name('store');
    Route::post('/import', [TableCController::class, 'importExcel'])->name('import');
    Route::get('/{tableC}/edit', [TableCController::class, 'edit'])->name('edit');
    Route::put('/{tableC}', [TableCController::class, 'update'])->name('update');
    Route::delete('/{tableC}', [TableCController::class, 'destroy'])->name('destroy');
    Route::get('/export/excel', [TableCController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [TableCController::class, 'exportPdf'])->name('export.pdf');
});

// ==== table_d (Master Sales) ====
Route::prefix('table-d')->name('table-d.')->group(function () {
    Route::get('/', [TableDController::class, 'index'])->name('index');
    Route::get('/create', [TableDController::class, 'create'])->name('create');
    Route::post('/', [TableDController::class, 'store'])->name('store');
    Route::post('/import', [TableDController::class, 'importExcel'])->name('import');
    Route::get('/{tableD}/edit', [TableDController::class, 'edit'])->name('edit');
    Route::put('/{tableD}', [TableDController::class, 'update'])->name('update');
    Route::delete('/{tableD}', [TableDController::class, 'destroy'])->name('destroy');
    Route::get('/export/excel', [TableDController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [TableDController::class, 'exportPdf'])->name('export.pdf');
});
