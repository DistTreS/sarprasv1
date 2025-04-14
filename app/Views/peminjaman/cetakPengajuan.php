<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Peminjaman</title>
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
    
    <hr style="border: none; border-top: 3px solid black; border-bottom: 1px solid black; margin-top: 10px;">

    <h4 style="text-align:center; margin-bottom: 10px;">Formulir Peminjaman Aset</h4>

    <table style="margin-top: 10px;">
        <thead style="background-color: #007bff; color: #fff;">
            <tr>
                <th style="text-align: center;">Data</th>
                <th style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tr>
            <td class="label">Nama Peminjam</td>
            <td><?= $peminjaman['full_name'] ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Peminjaman</td>
            <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_peminjaman'])) ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Rencana Pengembalian</td>
            <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_rencana_pengembalian'])) ?></td>
        </tr>
        <tr>
            <td class="label">Status Layanan</td>
            <td><?= $peminjaman['status_layanan'] ?></td>
        </tr>
        <tr>
            <td class="label">Status Peminjaman</td>
            <td><?= $peminjaman['status_peminjaman'] ?></td>
        </tr>
        <tr>
            <td class="label">CC</td>
            <td><?= $peminjaman['CC'] ?></td>
        </tr>
        <tr>
            <td class="label">Keterangan</td>
            <td><?= $peminjaman['keterangan'] ?></td>
        </tr>
        <tr>
            <td class="label">Disetujui Oleh</td>
            <td><?= $peminjaman['acc_by'] ?></td>
        </tr>
    </table>

    <h4 style="margin-top: 30px; margin-bottom: 10px; text-align:center;">Daftar Aset yang Dipinjam</h4>

    <table class="table">
        <thead style="background-color: #007bff; color: #fff; text-align:center;">
            <tr>
                <th style="text-align: center;">NUP</th>
                <th style="text-align: center;">Nama Aset</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail_aset as $item): ?>
                <tr>
                    <td style="text-align: center;"><?= $item['nup'] ?></td>
                    <td style="text-align: center;"><?= $item['nama_aset'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
    </table>

    <br><br><br>
    <div style="position: absolute; bottom: 100px; right: 100px;">
        <div style="margin-right: 80px;">
            <p style="text-align:center; margin-bottom: 80px; line-height: 1.5;">
                Mengetahui,<br>
                Kasubbag Rumah Tangga dan Sarana Prasarana
            </p>
            <p style="text-align: center; text-decoration: underline; font-weight: bold; margin: 0;">
                RETWANDO S.Komp, M.Si<br>
                NIP. 19880328 201101 1 004
            </p>
        </div>
    </div>



</body>
</html>
