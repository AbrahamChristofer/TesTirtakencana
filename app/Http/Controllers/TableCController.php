<?php

namespace App\Http\Controllers;

use App\Exports\TableCExport;
use App\Imports\TableCImport;
use App\Models\TableC;
use App\Traits\HandlesDatabaseErrors;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class TableCController extends Controller
{
    use HandlesDatabaseErrors;

    public function index(Request $request)
    {
        $query = TableC::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_toko', 'like', "%{$search}%")
                  ->orWhere('area_sales', 'like', "%{$search}%");
            });
        }

        $data = $query
            ->orderBy('kode_toko')
            ->paginate(10)
            ->withQueryString();

        return view('table_c.index', compact('data'));
    }

    public function create()
    {
        return view('table_c.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_toko'  => 'required|integer|min:0|unique:table_c,kode_toko',
            'area_sales' => 'required|string|max:10',
        ]);

        try {
            TableC::create($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-c.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            Excel::import(
                new TableCImport,
                $request->file('file')
            );
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-c.index')
            ->with('success', 'Import Excel berhasil.');
    }

    public function edit(TableC $tableC)
    {
        return view('table_c.edit', [
            'item' => $tableC,
        ]);
    }

    public function update(Request $request, TableC $tableC)
    {
        $validated = $request->validate([
            'kode_toko'  => 'required|integer|min:0',
            'area_sales' => 'required|string|max:10',
        ]);

        try {
            $tableC->update($validated);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-c.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(TableC $tableC)
    {
        try {
            $tableC->delete();
        } catch (Throwable $e) {
            return back()
                ->with('error', $this->friendlyErrorMessage($e));
        }

        return redirect()
            ->route('table-c.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new TableCExport,
            'table_c.xlsx'
        );
    }

    public function exportPdf()
    {
        $data = TableC::orderBy('kode_toko')->get();

        return Pdf::loadView(
            'exports.table_c_pdf',
            compact('data')
        )
        ->setPaper('a4', 'portrait')
        ->download('table_c.pdf');
    }
}
