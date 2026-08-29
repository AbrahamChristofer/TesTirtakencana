<?php

namespace App\Http\Controllers;

use App\Exports\TableBExport;
use App\Imports\TableBImport;
use App\Models\TableB;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class TableBController extends Controller
{
    use HandlesDatabaseErrors;

    public function index(Request $request)
    {
        $query = TableB::query();

        if ($search = $request->get('q')) {
            $query->where('kode_toko', 'like', "%{$search}%");
        }

        $data = $query->orderBy('kode_toko')->paginate(10)->withQueryString();

        return view('table_b.index', compact('data'));
    }

    public function create()
    {
        return view('table_b.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko'         => 'required|integer|min:0',
            'nominal_transaksi' => 'required|numeric|min:0',
        ]);

        try {
            TableB::create($validated);
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()->route('table-b.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv|max:5120']);

        try {
            Excel::import(new TableBImport, $request->file('file'));
        } catch (Throwable $e) {
            return back()->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()->route('table-b.index')->with('success', 'Import Excel berhasil.');
    }

    public function edit(TableB $tableB)
    {
        return view('table_b.edit', ['item' => $tableB]);
    }

    public function update(Request $request, TableB $tableB)
    {
        $validated = $request->validate([
            'kode_toko'         => 'required|integer|min:0',
            'nominal_transaksi' => 'required|numeric|min:0',
        ]);

        try {
            $tableB->update($validated);
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()->route('table-b.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(TableB $tableB)
    {
        try {
            $tableB->delete();
        } catch (Throwable $e) {
            return back()->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()->route('table-b.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new TableBExport, 'table_b.xlsx');
    }

    public function exportPdf()
    {
        $data = TableB::orderBy('kode_toko')->get();
        return Pdf::loadView('exports.table_b_pdf', compact('data'))->setPaper('a4', 'portrait')->download('table_b.pdf');
    }
}
