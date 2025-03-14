<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Peserta Diklat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            /* Tambahkan margin untuk ruang di sekitar halaman */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        /* Styling tabel kop */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Hilangkan border hanya pada tabel kop */
        .kop-table td {
            border: none;
        }

        .kop-logo {
            width: 100px;
            height: auto;
        }

        .kop-text {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .kop-info {
            font-size: 13px;
            font-weight: normal;
            text-align: center;
            margin-top: 3px;
        }

        /* Styling tabel peserta */
        .peserta-table {
            width: 100%;
            /* Pastikan tabel menggunakan lebar penuh */
            border-collapse: collapse;
            table-layout: auto;
            /* Tabel menyesuaikan dengan konten */
        }

        /* Border pada tabel peserta */
        .peserta-table td,
        .peserta-table th {
            border: 1px solid black;
            padding: 8px;
            /* Tambahkan padding agar konten tidak terlalu mepet */
            text-align: left;
            /* Teks rata kiri untuk keterbacaan */
            word-wrap: break-word;
            /* Bungkus kata jika terlalu panjang */
        }

        .peserta-table th {
            font-weight: bold;
            background-color: #f2f2f2;
            /* Warna latar belakang header untuk kontras */
        }
    </style>
</head>

<body>

    <!-- Kop Surat -->
    <table class="kop-table">
        <tr>
            <td style="width: 100px;">
                <img src="<?= $imageBase64 ?>" alt="Logo PPSDM" class="kop-logo">
            </td>
            <td class="kop-text">
                PPSDM KEMENDAGRI Regional Bukittinggi
                <div class="kop-info">
                    Jl. Raya Bukittinggi - Payakumbuh Jl. Sungai Sariak No.Km. 14, Tabek Panjang, Kec. Baso, Kabupaten Agam, Sumatera Barat 26192<br>
                    Telp (0752) 28241 | Website: ppsdmbukittinggi.kemendagri.go.id
                </div>
            </td>
            <td style="width: 100px;"></td> <!-- Kolom kosong untuk menyeimbangkan layout -->
        </tr>
    </table>

    <hr>

    <!-- Judul dan Tabel -->
    <h2>Data Peserta Diklat</h2>
    <table class="peserta-table">
        <thead>
            <tr>
                <th>Nama/NIP/Tempat,Tgl Lahir</th>
                <th>Golruang</th>
                <th>Nama Jabatan</th>
                <th>Instansi</th>
                <th>Angkatan</th>
                <th>Tahun</th>
                <th>Judul Tugas Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peserta_diklat as $peserta): ?>
                <tr>
                    <td><?= esc($peserta['nama_dan_nip']) ?></td>
                    <td><?= esc($peserta['golruang']) ?></td>
                    <td><?= esc($peserta['nama_jabatan']) ?></td>
                    <td><?= esc($peserta['instansi']) ?></td>
                    <td><?= esc($peserta['angkatan']) ?></td>
                    <td><?= esc($peserta['tahun']) ?></td>
                    <td><?= esc($peserta['judul_tugas_akhir']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>