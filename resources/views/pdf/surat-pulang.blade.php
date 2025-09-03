<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Pemulangan Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .line {
            border-top: 2px solid #000;
            margin: 10px 0 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td {
            vertical-align: top;
            padding: 4px 8px;
        }
        .ttd-table {
            margin-top: 60px;
            text-align: center;
            width: 100%;
        }
        .signature-space {
            height: 80px;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 40px;
        }
    </style>
</head>
<body>

    
<img src="{{ public_path('logo.png') }}" alt="Logo" height="40" style="position: absolute; top: 30px; left: 40px;">

    <div class="header">
        <h2>RUMAH SAKIT MM INDRAMAYU</h2>
        <p>Jl. Letjend Soeprapto No. 292 Kepandean Indramayu, Jawa Barat 45214</p>
        <p>Telp (0234) 277632 / 33 / 34 | Email: rumahsakit.mm@gmail.com</p>
        <p>Website: www.rsmm-indramayu.com</p>
        <div class="line"></div>
        <h3><u>SURAT PERINTAH PEMULANGAN PASIEN</u></h3>
    </div>

    <table>
        <tr>
            <td style="width: 25%;">No. Rekam Medis</td>
            <td style="width: 25%;">: {{ $record->penempatanKamar->permintaanRawatInap->pendaftaranIgd->pasien->no_rekam_medis ?? '-' }}</td>
            <td style="width: 25%;">No. Surat</td>
            <td style="width: 25%;">: {{ $record->no_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Surat</td>
            <td>: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
            <td>Jenis Kamar</td>
            <td>: {{ $record->penempatanKamar->kamar->nama ?? '-' }} / {{ $record->penempatanKamar->kamar->kelas ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Surat</td>
            <td>: Surat Pulang</td>
            <td>Status</td>
            <td>: {{ $record->status ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Layanan</td>
            <td>: {{ $record->penempatanKamar->permintaanRawatInap->pendaftaranIgd->pasien->jenis_pembayaran ?? '-' }}</td>
            <td>Dokter Penanggung Jawab</td>
            <td>: {{ $record->dpjp ?? '......................' }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td style="width: 25%;">Nama Pasien</td>
            <td style="width: 25%;">: {{ $record->penempatanKamar->permintaanRawatInap->pendaftaranIgd->pasien->nama ?? '-' }}</td>
            <td style="width: 25%;">Ruang / Kelas</td>
            <td style="width: 25%;">: {{ $record->penempatanKamar->kamar->nama ?? '-' }} / {{ $record->penempatanKamar->kamar->kelas ?? '-' }}</td>
        </tr>
        <tr>
            <td>Diagnosa</td>
            <td colspan="3">: {{ $record->diagnosa ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Masuk</td>
            <td>: {{ \Carbon\Carbon::parse($record->penempatanKamar->tanggal_masuk)->format('d-m-Y') ?? '-' }}</td>
            <td>Tanggal Pulang</td>
            <td>: {{ \Carbon\Carbon::parse($record->tanggal_pulang)->format('d-m-Y') ?? '-' }}</td>
        </tr>
    </table>

    <p>
        Dengan ini pasien tersebut dinyatakan selesai menjalani perawatan dan diperbolehkan pulang atas seizin dokter yang menangani.
    </p>

    <table class="ttd-table">
        <tr>
            <td>
                Pasien<br><br>
                <div class="signature-space"></div>
                <u>{{ $record->penempatanKamar->permintaanRawatInap->pendaftaranIgd->pasien->nama ?? '-' }}</u>
            </td>
            <td>
                Petugas Rawat<br><br>
                <div class="signature-space"></div>
                <u>{{ $record->nama_petugas ?? '-' }}</u>
            </td>
        </tr>
    </table>

</body>
</html>
