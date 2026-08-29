@extends('layouts.app')
@section('title', 'Master Sales')
@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form method="GET" class="flex items-center gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode / nama sales..."
               class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
        <button class="rounded-lg bg-slate-800 text-white text-sm px-4 py-2 hover:bg-slate-700">Cari</button>
    </form>
    <div class="flex items-center gap-2">
        <a href="{{ route('table-d.export.excel') }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 text-white text-sm px-4 py-2 hover:bg-emerald-500"><x-feathericon-download class="w-5 h-5" /> Excel</a>
        <a href="{{ route('table-d.export.pdf') }}" class="inline-flex items-center gap-2 rounded-lg bg-rose-600 text-white text-sm px-4 py-2 hover:bg-rose-500"><x-feathericon-file class="w-5 h-5" /> PDF</a>
        <a href="{{ route('table-d.create') }}" class="rounded-lg bg-sky-600 text-white text-sm px-4 py-2 hover:bg-sky-500">+ Tambah Data</a>
    </div>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-6 py-3 font-semibold">Kode Sales</th>
                <th class="text-left px-6 py-3 font-semibold">Nama Sales</th>
                <th class="text-right px-6 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($data as $row)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-medium">{{ $row->kode_sales }}</td>
                    <td class="px-6 py-3">{{ $row->nama_sales }}</td>
                    <td class="px-6 py-3 text-right space-x-2">
                        <a href="{{ route('table-d.edit', $row) }}" class="text-sky-600 hover:underline">Edit</a>
                        <form action="{{ route('table-d.destroy', $row) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $data->links() }}</div>
@endsection
