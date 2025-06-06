<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
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
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .kop-info {
            font-size: 8px;
            font-weight: normal;
            text-align: center;
            margin-top: 3px;
        }

        .kop-info2 {
            font-size: 14px;
            font-weight: normal;
            text-align: center;
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
                <img src="<?= $imageBase64 ?>" alt="logoppsdm" class="kop-logo">
            </td>
            <td class="kop-text">
                <div class="kop-info2">
                    KEMENTERIAN DALAM NEGERI
                </div>
                <div class="kop-info2">
                    REPUBLIK INDONESIA
                </div>
                <div class="kop-info2">
                    BADAN PENGEMBANGAN SUMBER DAYA INDONESIA
                </div>
                PUSAT PENGAMBANGAN SUMBER DAYA MANUSIA REGIONAL BUKITTINGGI
                <div class="kop-info">
                    Jl. Raya Bukittinggi - Payakumbuh Jl. Sungai Sariak No.Km. 14, Tabek Panjang, Kec. Baso, Kabupaten Agam, Sumatera Barat 26192<br>
                    Telp (0752) 28241 | Website: ppsdmbukittinggi.kemendagri.go.id
                </div>
            </td>
            <td style="width: 100px;"></td> <!-- Kolom kosong untuk menyeimbangkan layout -->
        </tr>
    </table>

<h2>Laporan Transaksi</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Nama User</th>
            <th>Tipe Transaksi</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $i => $t): ?>
        <tr>
            <td><?= $i + 1; ?></td>
            <td><?= $t['nama_barang']; ?></td>
            <td><?= $t['full_name']; ?></td>
            <td><?= $t['tipe_transaksi']; ?></td>
            <td><?= $t['jumlah']; ?></td>
            <td><?= $t['tanggal_transaksi']; ?></td>
            <td><?= $t['keterangan']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
