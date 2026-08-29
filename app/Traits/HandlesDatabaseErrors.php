<?php

namespace App\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;
use Throwable;

trait HandlesDatabaseErrors
{
    /**
     * Ubah exception teknis jadi pesan yang mudah dipahami user awam.
     * Selalu log detail aslinya untuk keperluan debugging developer.
     */
    protected function friendlyErrorMessage(Throwable $e): string
    {
        Log::error('DB/Import Error: ' . $e->getMessage());

        // Error validasi per-baris saat import Excel (misal kolom wajib kosong di baris ke-3)
        if ($e instanceof ExcelValidationException) {
            $failures = $e->failures();
            $pesan = [];

            foreach ($failures as $failure) {
                $pesan[] = "Baris {$failure->row()}, kolom '{$failure->attribute()}': " . implode(' ', $failure->errors());
            }

            return 'Import gagal karena data tidak valid: ' . implode(' | ', array_slice($pesan, 0, 3))
                . (count($pesan) > 3 ? ' (dan ' . (count($pesan) - 3) . ' error lainnya)' : '');
        }

        if ($e instanceof QueryException) {
            $errorCode = $e->errorInfo[1] ?? null;
            $message   = $e->getMessage();

            return match (true) {
                $errorCode === 1264 || str_contains($message, 'Out of range')
                    => 'Nilai yang kamu masukkan terlalu besar untuk kolom ini. Coba masukkan angka yang lebih kecil.',

                $errorCode === 1062 || str_contains($message, 'Duplicate entry')
                    => 'Data dengan kode ini sudah ada sebelumnya. Gunakan kode yang berbeda.',

                $errorCode === 1406 || str_contains($message, 'Data too long')
                    => 'Teks yang kamu masukkan terlalu panjang untuk kolom ini.',

                $errorCode === 1048 || str_contains($message, "cannot be null")
                    => 'Ada kolom wajib yang belum diisi.',

                $errorCode === 1451 || $errorCode === 1452
                    => 'Data ini masih terhubung dengan data lain, sehingga tidak bisa diproses.',

                default
                    => 'Terjadi kesalahan saat menyimpan data ke database. Silakan cek kembali data yang kamu masukkan.',
            };
        }

        // Error dari proses import Excel (format file salah, kolom tidak sesuai, dll)
        return 'Terjadi kesalahan saat memproses data. Pastikan format dan isi data sudah benar.';
    }
}
