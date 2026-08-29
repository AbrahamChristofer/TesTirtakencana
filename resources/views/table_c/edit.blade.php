@extends('layouts.app')
@section('title', 'Edit Area Sales')
@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <form action="{{ route('table-c.update', $item) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Kode Toko</label>
            <input type="number" name="kode_toko" value="{{ old('kode_toko', $item->kode_toko) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Area Sales</label>
            <input type="text" name="area_sales" maxlength="10" value="{{ old('area_sales', $item->area_sales) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button class="rounded-lg bg-sky-600 text-white text-sm px-5 py-2.5 hover:bg-sky-500">Update Data</button>
            <a href="{{ route('table-c.index') }}" class="text-sm text-slate-500 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
