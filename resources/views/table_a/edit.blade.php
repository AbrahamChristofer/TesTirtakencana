@extends('layouts.app')
@section('title', 'Edit History Kode Toko')
@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <form action="{{ route('table-a.update', $item) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Kode Toko Baru</label>
            <input type="number" value="{{ $item->kode_toko_baru }}" disabled class="w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm text-slate-500">
            <p class="text-xs text-slate-400 mt-1">Kode Toko Baru adalah primary key dan tidak bisa diubah.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Kode Toko Lama <span class="text-slate-400 font-normal">(opsional)</span></label>
            <input type="number" name="kode_toko_lama" value="{{ old('kode_toko_lama', $item->kode_toko_lama) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button class="rounded-lg bg-sky-600 text-white text-sm px-5 py-2.5 hover:bg-sky-500">Update Data</button>
            <a href="{{ route('table-a.index') }}" class="text-sm text-slate-500 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
