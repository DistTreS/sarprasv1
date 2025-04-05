<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>
<style>
    /* Warna dan variabel */
    :root {
        --primary-color: #2C3E50;
        --secondary-color: #3498DB;
        --accent-color: #F39C12;
        --light-bg: #f8f9fa;
        --text-color: #333;
        --border-radius: 10px;
        --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Container utama */
    .profil-container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
    }

    /* Heading */
    .profil-container h1 {
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary-color);
        font-weight: 700;
    }

    .profil-container h2 {
        color: var(--primary-color);
        margin: 25px 0 15px 0;
        padding-left: 10px;
        border-left: 4px solid var(--secondary-color);
    }

    .profil-container h3 {
        color: var(--primary-color);
        margin: 20px 0 15px 0;
        text-align: center;
        position: relative;
    }

    .profil-container h3:after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--secondary-color);
        margin: 10px auto;
    }

    /* Paragraf */
    .profil-container p {
        text-align: justify;
        font-size: 15px;
        line-height: 1.7;
        color: var(--text-color);
        margin-bottom: 15px;
    }

    /* List */
    .profil-container ul {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .profil-container ul li {
        margin-bottom: 10px;
        line-height: 1.6;
        position: relative;
        padding-left: 15px;
        text-decoration: none;
    }

    .profil-container ul li:before {
        color: var(--secondary-color);
        font-weight: bold;
        display: inline-block;
        width: 15px;
        margin-left: -15px;
        position: absolute;
        left: 15px;
    }

    /* Visi Misi */
    .visi-misi {
        margin-top: 30px;
        padding: 20px;
        background: var(--light-bg);
        border-radius: var(--border-radius);
        border-left: 4px solid var(--accent-color);
    }

    /* Struktur Organisasi */
    .struktur-container {
        margin: 40px 0;
        text-align: center;
        padding: 20px;
        background: var(--light-bg);
        border-radius: var(--border-radius);
    }

    .struktur-container img {
        max-width: 100%;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        transition: transform 0.3s ease;
    }

    .struktur-container img:hover {
        transform: scale(1.02);
    }



    /* Kontak */
    .kontak-container {
        margin-top: 40px;
        padding: 25px;
        background: var(--light-bg);
        border-radius: var(--border-radius);
        text-align: center;
        border-bottom: 4px solid var(--secondary-color);
    }

    .kontak-container p {
        text-align: center;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .kontak-container i {
        color: var(--secondary-color);
        margin-right: 10px;
    }

    /* Dashboard container */
    .dashboard-container {
        margin: 20px 0;
        padding: 20px;
        background: white;
        border-radius: var(--border-radius);
    }

    /* Responsif */
    @media (max-width: 768px) {
        .profil-container {
            padding: 15px;
            margin: 15px;
        }
    }
</style>

<div class="profil-container">
    <h1>Profil PPSDM Kemendagri Regional Bukittinggi</h1>
    <p>
        Pusat Pengembangan Sumber Daya Manusia (PPSDM) Kemendagri Regional Bukittinggi adalah lembaga pelatihan yang berfokus
        pada pengembangan kompetensi aparatur sipil negara di lingkungan Kementerian Dalam Negeri dan Pemerintah Daerah.
        PPSDM bertujuan untuk meningkatkan kapasitas dan kualitas sumber daya manusia dalam pemerintahan melalui berbagai program
        pelatihan dan pendidikan.
    </p>

    <div class="dashboard-container">
        <h2>Dasar Pendirian</h2>
        <p>Berdasarkan Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 84 Tahun 2017 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis di Lingkungan Badan Pengembangan Sumber Daya Manusia Kementerian Dalam Negeri.</p>

        <h2>Kedudukan</h2>
        <p>Pusat Pengembangan Sumber Daya Manusia Regional merupakan Unit Pelaksana Teknis di bidang pengembangan sumber daya manusia, yang berada di bawah dan bertanggung jawab kepada Kepala Badan Pengembangan Sumber Daya Manusia Kementerian Dalam Negeri. Pusat Pengembangan Sumber Daya Manusia Regional dipimpin oleh seorang Kepala Pusat.</p>

        <h2>Tugas Pokok</h2>
        <p>Pusat Pengembangan Sumber Daya Manusia Regional mempunyai tugas melaksanakan pengembangan kompetensi dan uji kompetensi aparatur pemerintahan dalam negeri, sesuai dengan peraturan perundang-undangan.</p>

        <h2>Fungsi</h2>
        <ul>
            <li>Penyusunan program dan anggaran pengembangan kompetensi dan uji kompetensi aparatur pemerintahan dalam negeri.</li>
            <li>Pelaksanaan fasilitasi penyelenggaraan uji kompetensi aparatur Kementerian Dalam Negeri dan Pemerintah Daerah.</li>
            <li>Pelaksanaan pengembangan kompetensi aparatur pemerintahan dalam negeri.</li>
            <li>Pelaksanaan koordinasi dan fasilitasi penyelenggaraan pengembangan sumber daya manusia regional, provinsi, dan kabupaten/kota.</li>
            <li>Pelaksanaan urusan tata usaha, keuangan, administrasi umum, sistem dan prosedur, kepegawaian, perlengkapan, rumah tangga, keamanan dalam, sarana prasarana, layanan kesehatan, dan perpustakaan.</li>
            <li>Pemantauan, evaluasi, dan pelaporan penyelenggaraan pengembangan sumber daya manusia regional, provinsi, dan kabupaten/kota.</li>
            <li>Pelaksanaan fungsi lain yang diberikan Menteri Dalam Negeri dan/atau Kepala Badan Pengembangan Sumber Daya Manusia Kementerian Dalam Negeri.</li>
        </ul>
    </div>

    <div class="struktur-container">
        <h3>Struktur Organisasi</h3>
        <img src="/assets/images/strukturorganisasi.png" alt="Struktur Organisasi">
    </div>


    <div class="kontak-container">
        <h3>Kontak & Lokasi</h3>
        <p>📍 Alamat: Jl. Sudirman No.17, Bukittinggi</p>
        <p>📞 Telepon: (0752) 123456</p>
        <p>📧 Email: ppsdm@kemendagri.go.id</p>
    </div>
</div>

<?= $this->endSection(); ?>