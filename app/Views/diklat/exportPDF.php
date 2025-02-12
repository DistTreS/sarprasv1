<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Peserta Diklat</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .kop-header {
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 18px;
            font-weight: bold;

        }

        .kop-logo {
            float: left;
            width: 80px;
            height: auto;
            margin-right: 20px;
            width: auto;
            max-width: 100px;
            display: block;
        }

        .kop-info {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        hr {
            border: 1px solid black;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="kop-header">
        <img src="<?= $imageBase64 ?>" alt="Logo PPSDM" style="width: 100px; height: auto;">
        PPSDM KEMENDAGRI Regional Bukittinggi<br>
        <div class="kop-info">

            Jl. Raya Bukittinggi - Payakumbuh Jl. Sungai Sariak No.Km. 14, Tabek Panjang, Kec. Baso, Kabupaten Agam, Sumatera Barat 26192<br>
            Telp (0752) 28241 | Website: ppsdmbukittinggi.kemendagri.go.id
        </div>
    </div>
    <hr>
    <h2>Data Peserta Diklat</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Golruang</th>
                <th>Tempat & Tanggal Lahir</th>
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
                    <td><?= esc($peserta['nama']) ?></td>
                    <td><?= esc($peserta['nip']) ?></td>
                    <td><?= esc($peserta['golruang']) ?></td>
                    <td><?= esc($peserta['tempat_tgl_lahir']) ?></td>
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