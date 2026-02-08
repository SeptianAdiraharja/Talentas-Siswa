<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Normalisasi</title>
    <style>
        /* ==== Layout dan Font ==== */
        @page { margin: 30px 40px 50px 40px; }
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        /* ==== KOP SURAT ==== */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border: none !important;
            margin-bottom: 0;
        }
        .kop-table td {
            border: none !important;
            padding: 0;
        }
        .kop-logo-col {
            width: 100px;
            vertical-align: middle;
        }
        .kop-logo-img {
            width: 90px;
            height: auto;
        }
        .kop-text-col {
            text-align: center;
            vertical-align: middle;
        }
        .kop-instansi {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
        .kop-unit {
            font-size: 18pt;
            font-weight: 900;
            text-transform: uppercase;
            margin: 2px 0;
        }
        .kop-detail {
            font-size: 10pt;
            margin-top: 5px;
        }
        .kop-detail span {
            color: #0070C0;
            text-decoration: underline;
        }

        /* Garis Pembatas Kop */
        .divider {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 3px;
            margin: 5px 0 15px 0;
        }

        /* ==== Info Laporan ==== */
        .report-title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .info-section {
            margin-bottom: 10px;
        }
        .info-title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: inline-block;
        }

        /* ==== Tabel Data ==== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 5px 3px;
            text-align: center;
            font-size: 10px;
        }
        .data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* ==== Footer/Tanda Tangan ==== */
        .footer-container {
            margin-top: 30px;
        }
        .signature {
            float: right;
            text-align: center;
            width: 200px;
        }
        .sig-space {
            height: 60px;
        }
        .clearfix { clear: both; }
    </style>
</head>
<body>

    <table class="kop-table">
        <tr>
            <td class="kop-logo-col">
                @php
                    // Menggunakan logo2.jpeg sesuai permintaan lokasi public/images/logo2.jpeg
                    $logoPath = public_path('images/logo2.jpeg');
                    $logoBase64 = '';
                    if (file_exists($logoPath)) {
                        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                        $data = file_get_contents($logoPath);
                        $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                @endphp
                <img src="{{ $logoBase64 }}" class="kop-logo-img">
            </td>
            <td class="kop-text-col">
                <div class="kop-instansi">LAPORAN HASIL NORMALISASI</div>
                <div class="kop-instansi">SPK PENENTUAN SISWA BERPRESTASI</div>
                <div class="kop-unit">SMKS PGRI SELAAWI</div>
                <div class="kop-detail">
                    Jalan Raya Selaawi No. 38, RT 01 RW 01, Desa Selaawi, Kecamatan Selaawi, Kabupaten Garut <br>
                    Email: <span>smkspgriselaawi@gmail.com</span> | Website: <span>www.smkspgriselaawi.sch.id</span>
                </div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="info-section">
        <div class="info-title">Hasil Normalisasi</div><br>
        {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y | HH:mm:ss') }}
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="25">No</th>
                <th width="70">NISN</th>
                <th>Nama Siswa</th>
                @foreach($criteria as $c)
                    <th>{{ $c->name }}</th>
                @endforeach
                <th width="60">Nilai (V)</th>
                <th width="40">Rank</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row['student']->nis }}</td>
                <td style="text-align: left; padding-left: 8px;">{{ $row['student']->user->name }}</td>
                @foreach($criteria as $c)
                    <td>{{ $row['normalized_scores'][$c->id] ?? 0 }}</td>
                @endforeach
                <td style="font-weight: bold;">{{ number_format($row['value'], 4) }}</td>
                <td>{{ $index + 1 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-container">
        <div class="signature">
            Selaawi-Garut, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}<br>
            Admin
            <div class="sig-space"></div>
            <strong>......................................................</strong>
        </div>
        <div class="clearfix"></div>
    </div>

</body>
</html>