<?php
namespace App\Http\Controllers;

use App\Models\PenempatanKamar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuratPulang;
use App\Http\Controllers\Controller;


class SuratPulangController extends Controller
{
    public function cetak($id)
    {
        $record = SuratPulang::with([
    'penempatanKamar.permintaanRawatInap.pendaftaranIgd.pasien'
])->findOrFail($id);


        return Pdf::loadView('pdf.surat-pulang', compact('record'))->stream('surat-pulang.pdf');
    }
    public function show($id)
{
    $penempatan = PenempatanKamar::with(['pasien', 'kamar', 'kamar.kelas', 'rawatInap'])->findOrFail($id);

    return view('surat-pulang.show', compact('penempatan'));
}
}
