<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Aset</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <style>
        /* Styling Container */
        .container {
            background-color: white;
            padding: 30px;
            margin: 50px auto;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        /* Styling Judul */
        h2 {
            text-align: center;
            font-weight: bold;
            color: #2C3E50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Styling Form */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #34495E;
            font-size: 16px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        /* Styling Tombol */
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            color: white;
            transition: 0.3s ease;
        }

        button[type="submit"] {
            background-color: #28a745;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Styling Tombol Kembali */
        .btn-kembali {
            display: block;
            text-align: center;
            background-color: #6c757d;
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s ease;
            margin-top: 10px;
        }

        .btn-kembali:hover {
            background-color: #545b62;
        }

        /* Responsif */
        @media screen and (max-width: 768px) {
            .container {
                width: 85%;
            }
            
            h2 {
                font-size: 20px;
            }

            button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Kategori Aset</h2>
        <form action="<?= base_url('kategoriAset/store'); ?>" method="POST">
            <label for="kode_kategori">Kode Kategori:</label>
            <input type="text" id="kode_kategori" name="kode_kategori" required>

            <label for="nama_kategori">Nama Kategori:</label>
            <input type="text" id="nama_kategori" name="nama_kategori" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea>

            <button type="submit">Simpan</button>
        </form>
        <a href="<?= base_url('kategoriAset'); ?>" class="btn-kembali">Kembali</a>
    </div>
</body>
</html>
