<?php

namespace App\Http\Controllers;

use App\Exports\TableDExport;
use App\Imports\TableDImport;
use App\Models\TableD;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class TableDController extends Controller
{
    use HandlesDatabaseErrors;

    public function index(Request $request)
    {
        $query = TableD::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_sales', 'like', "%{$search}%")
                  ->orWhere('nama_sales', 'like', "%{$search}%");
            });
        }

        $data = $query
            ->orderBy('kode_sales')
            ->paginate(10)
            ->withQueryString();

        return view('table_d.index', compact('data'));
    }

    public function create()
    {
        return view('table_d.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_sales' => 'required|string|max:255|unique:table_d,kode_sales',
            'nama_sales' => 'required|string|max:20',
        ]);

        try {
            TableD::create($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-d.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            Excel::import(
                new TableDImport,
                $request->file('file')
            );
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-d.index')
            ->with('success', 'Import Excel berhasil.');
    }

    public function edit(TableD $tableD)
    {
        return view('table_d.edit', [
            'item' => $tableD,
        ]);
    }

    public function update(Request $request, TableD $tableD)
    {
        $validated = $request->validate([
            'nama_sales' => 'required|string|max:20',
        ]);

        try {
            $tableD->update($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-d.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(TableD $tableD)
    {
        try {
            $tableD->delete();
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-d.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new TableDExport,
            'table_d.xlsx'
        );
    }

    public function exportPdf()
    {
        $data = TableD::orderBy('kode_sales')->get();

        return Pdf::loadView(
            'exports.table_d_pdf',
            compact('data')
        )
        ->setPaper('a4', 'portrait')
        ->download('table_d.pdf');
    }
}
