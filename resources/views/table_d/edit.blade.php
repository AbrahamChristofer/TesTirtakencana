@extends('layouts.app')
@section('title', 'Edit Master Sales')
@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <form action="{{ route('table-d.update', $item) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Kode Sales</label>
            <input type="text" value="{{ $item->kode_sales }}" disabled class="w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm text-slate-500">
            <p class="text-xs text-slate-400 mt-1">Kode Sales adalah primary key dan tidak bisa diubah.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Sales</label>
            <input type="text" name="nama_sales" maxlength="20" value="{{ old('nama_sales', $item->nama_sales) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button class="rounded-lg bg-sky-600 text-white text-sm px-5 py-2.5 hover:bg-sky-500">Update Data</button>
            <a href="{{ route('table-d.index') }}" class="text-sm text-slate-500 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
