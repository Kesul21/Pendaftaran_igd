<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Perintah Rawat Inap IGD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 50px;
            color: #000;
        }

        .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop img {
            position: absolute;
            top: 40px;
            left: 50px;
            height: 60px;
        }

        .kop h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .kop p {
            margin: 0;
            font-size: 11pt;
        }

        .line {
            border-top: 2px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-info {
            width: 100%;
        }

        .table-info td {
            padding: 6px;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .footer td {
            vertical-align: top;
            padding: 5px;
        }

        .ttd {
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <!-- {{-- Logo (optional) --}}
    {{-- <img src="{{ public_path('logo.png') }}" alt="Logo RS" class="logo"> --}} -->
    <img src="{{ public_path('logo.png') }}" alt="Logo" height="50" style="position: absolute; top: 30px; left: 40px;">

    <div class="kop">
        <h2>RUMAH SAKIT MM INDRAMAYU</h2>
        <p>Jl. Letjend Soeprapto No. 292 Kepandean Indramayu, Jawa Barat 45214</p>
        <p>Telp (0234) 277632 / 33 / 34 | Email: rumahsakit.mm@gmail.com</p>
        <p>Website: www.rsmm-indramayu.com</p>
    </div>

    <div class="line"></div>

    <div class="title">SURAT PERINTAH RAWAT INAP IGD</div>

    <div class="nomor">
        No. SPRI : 006....... {{ \Carbon\Carbon::parse($record->created_at)->format('Y') }}.........
    </div>

    <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

    <table class="table-info">
        <tr>
            <td width="30%">Nama</td>
            <td width="5%">:</td>
            <td>{{ $record->pasien->nama }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($record->pasien->tanggal_lahir)->age }} tahun</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td>{{ $record->pasien->no_rekam_medis }}</td>
        </tr>
        <tr>
            <td>Diagnosa</td>
            <td>:</td>
            <td>{{ $record->pendaftaranIgd->diagnosa }}</td>
        </tr>
        <tr>
            <td>DPJP</td>
            <td>:</td>
            <td>{{ $record->dpjp ?? '......................' }}</td>
        </tr>
        <tr>
            <td>Ruang / Kelas</td>
            <td>:</td>
            <td>
                {{ $record->kamar->nama ?? '-' }} / {{ $record->kamar->kelas ?? '-' }}
</td>

        </tr>
    </table>

    <p>
        Harus menjalani perawatan rawat inap di <strong>Rumah Sakit MM Indramayu</strong>.
        <br>
        Demikian surat ini dibuat untuk semestinya.
    </p>

    <table class="footer">
        <tr>
            <td width="50%"></td>
            <td width="50%" style="text-align: center;">
                Indramayu, {{ \Carbon\Carbon::parse($record->created_at)->translatedFormat('d F Y') }}<br>
                Dokter yang memerintahkan
                <br><br><br><br>
                ( _______________________ )
            </td>
        </tr>
    </table>

</body>
</html>
