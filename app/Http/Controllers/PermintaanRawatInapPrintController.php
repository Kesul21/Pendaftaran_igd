<?php

namespace App\Http\Controllers;

use App\Models\PermintaanRawatInap;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PermintaanRawatInapPrintController extends Controller
{
    public function print($id)
    {
        $permintaan = PermintaanRawatInap::with('pasien')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.surat-permintaan', [
            'record' => $permintaan,
        ]);

        return $pdf->stream('Surat Permintaan Rawat Inap.pdf');
    }
}
