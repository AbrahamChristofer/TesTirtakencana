@extends('layouts.app')
@section('title', 'Tambah History Kode Toko')
@section('content')
<div x-data="{ tab: 'form' }" class="max-w-2xl">
    <div class="flex gap-2 mb-6 bg-white rounded-xl border border-slate-200 p-1 w-fit">
        <button @click="tab = 'form'" :class="tab === 'form' ? 'bg-sky-600 text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-5 py-2 rounded-lg text-sm font-medium transition inline-flex items-center gap-2"><x-feathericon-edit class="w-4 h-4" /> Form Manual</button>
        <button @click="tab = 'excel'" :class="tab === 'excel' ? 'bg-sky-600 text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-5 py-2 rounded-lg text-sm font-medium transition inline-flex items-center gap-2"><x-feathericon-upload class="w-4 h-4" /> Upload Excel</button>
    </div>
    <div x-show="tab === 'form'" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('table-a.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode Toko Baru</label>
                <input type="number" name="kode_toko_baru" value="{{ old('kode_toko_baru') }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode Toko Lama <span class="text-slate-400 font-normal">(opsional)</span></label>
                <input type="number" name="kode_toko_lama" value="{{ old('kode_toko_lama') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button class="rounded-lg bg-sky-600 text-white text-sm px-5 py-2.5 hover:bg-sky-500">Simpan Data</button>
                <a href="{{ route('table-a.index') }}" class="text-sm text-slate-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
    <div x-show="tab === 'excel'" x-cloak class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('table-a.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih File Excel (.xlsx, .xls, .csv)</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-sky-50 file:text-sky-700 file:px-3 file:py-1.5">
            </div>
            <div class="rounded-lg bg-slate-50 border border-slate-200 px-4 py-3 text-xs text-slate-600">
                <p class="font-semibold mb-1">Format kolom Excel (baris pertama = header):</p>
                <code class="bg-white px-2 py-1 rounded border border-slate-200">kode_toko_baru | kode_toko_lama</code>
                <p class="mt-1">kode_toko_lama boleh dikosongkan.</p>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button class="rounded-lg bg-emerald-600 text-white text-sm px-5 py-2.5 hover:bg-emerald-500">Upload &amp; Import</button>
                <a href="{{ route('table-a.index') }}" class="text-sm text-slate-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
