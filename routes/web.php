<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PermintaanRawatInapPrintController;
use App\Models\PermintaanRawatInap;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\SuratPulangController;

Route::get('/surat-pulang/{id}', [App\Http\Controllers\SuratPulangController::class, 'cetak'])->name('surat.pulang.cetak');
Route::get('/surat-pulang/{id}/print', [SuratPulangController::class, 'print'])->name('surat.pulang.print');
Route::get('/print-permintaan-rawat-inap/{id}', [PermintaanRawatInapPrintController::class, 'print'])
    ->name('print.permintaan-rawat-inap');

Route::get('/pasien/export-pdf', [ExportController::class, 'exportPasien'])->name('pasien.export.pdf');


Route::get('/', function () {
    return redirect('/admin/login');
});
