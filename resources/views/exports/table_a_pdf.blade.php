<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #1e293b; }
        h2 { margin-bottom: 4px; }
        p.sub { color: #64748b; margin-top: 0; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 6px 10px; text-align: left; }
        th { background: #f1f5f9; }
    </style>
</head>
<body>
    <h2>Laporan History Kode Toko</h2>
    <p class="sub">Dicetak pada {{ now()->format('d M Y H:i') }}</p>
    <table>
        <thead><tr><th>#</th><th>Kode Toko Baru</th><th>Kode Toko Lama</th></tr></thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr><td>{{ $i + 1 }}</td><td>{{ $row->kode_toko_baru }}</td><td>{{ $row->kode_toko_lama ?? '-' }}</td></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
