<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export Data Pasien</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .kop {
            text-align: center;
            margin-bottom: 10px;
        }

        .kop h1 {
            margin: 0;
            font-size: 18px;
        }

        .kop h2 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
        }

        .line {
            border-top: 2px solid black;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .tanggal {
            text-align: right;
            font-size: 11px;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="kop">
        <h1>RUMAH SAKIT MM INDRAMAYU</h1>
        <h2>Jl. Kesehatan No. 123, Indramayu, Jawa Barat</h2>
    </div>

    <div class="line"></div>

    <div class="tanggal">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
    </div>

    <h3 style="text-align: center; margin-bottom: 10px;">Data Pasien</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Jenis Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $pasien)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pasien->nik }}</td>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->jenis_kelamin }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>{{ $pasien->jenis_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
