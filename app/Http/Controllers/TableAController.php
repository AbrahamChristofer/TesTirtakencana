<?php

namespace App\Http\Controllers;

use App\Exports\TableAExport;
use App\Imports\TableAImport;
use App\Models\TableA;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class TableAController extends Controller
{
    use HandlesDatabaseErrors;

    public function index(Request $request)
    {
        $query = TableA::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_toko_baru', 'like', "%{$search}%")
                  ->orWhere('kode_toko_lama', 'like', "%{$search}%");
            });
        }

        $data = $query
            ->orderBy('kode_toko_baru')
            ->paginate(10)
            ->withQueryString();

        return view('table_a.index', compact('data'));
    }

    public function create()
    {
        return view('table_a.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko_baru' => 'required|integer|min:0|unique:table_a,kode_toko_baru',
            'kode_toko_lama' => 'nullable|integer|min:0',
        ]);

        try {
            TableA::create($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-a.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120'
        ]);

        try {
            Excel::import(
                new TableAImport,
                $request->file('file')
            );
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-a.index')
            ->with('success', 'Import Excel berhasil.');
    }

    public function edit(TableA $tableA)
    {
        return view('table_a.edit', [
            'item' => $tableA
        ]);
    }

    public function update(Request $request, TableA $tableA)
    {
        $validated = $request->validate([
            'kode_toko_lama' => 'nullable|integer|min:0',
        ]);

        try {
            $tableA->update($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-a.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(TableA $tableA)
    {
        try {
            $tableA->delete();
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-a.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new TableAExport,
            'table_a.xlsx'
        );
    }

    public function exportPdf()
    {
        $data = TableA::orderBy('kode_toko_baru')->get();

        return Pdf::loadView(
            'exports.table_a_pdf',
            compact('data')
        )
        ->setPaper('a4', 'portrait')
        ->download('table_a.pdf');
    }
}
