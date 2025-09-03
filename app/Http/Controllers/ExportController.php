<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use PDF;

class ExportController extends Controller
{
    public function exportPasien()
    {
        $data = Pasien::all();

        $pdf = PDF::loadView('exports.pasien', compact('data'));
        return $pdf->download('data-pasien.pdf');
    }
}
