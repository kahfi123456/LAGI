<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>File Manager Materi Pengayaan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css') ?>">
</head>

<body>
    <div class="container">
        <!-- Logo Universitas Terbuka -->
        <img src="<?= base_url('images/ut_logo.png') ?>" alt="Logo Universitas Terbuka" class="logo">

        <!-- Welcome Text -->
        <div class="welcome-text">
            <h1>Selamat Datang Di File Manager Materi Pengayaan Universitas Terbuka</h1>
            <p>- Silahkan Memilih Materi Pengayaan berdasarkan fakultas atau gunakan Fitur Pencarian pada folder yang
                telah dipilih kemudian cari nama file bahan ajar untuk memudahkan pencarian Materi Pengayaan.</p>
            <h2>Cara Mendownload:</h2>
            <ul>
                <li>Silahkan Anda mendownload salah satu file dengan cara klik dua kali, untuk kemudian diarahkan ke
                    halaman preview agar dapat di download.</li>
            </ul>
        </div>

        <!-- Form Pencarian -->
        <div class="search-bar">
            <form method="GET" action="<?= site_url('/filemanager/search') ?>">
                <input type="text" name="query" placeholder="Cari jurusan atau materi..." required>
                <button type="submit">Cari</button>
            </form>

        </div>

        <!-- Daftar Fakultas -->
        <ul class="faculty-list">
            <li><a href="<?= site_url('/filemanager/faculty/FE') ?>">FE</a></li>
            <li><a href="<?= site_url('/filemanager/faculty/FHISIP') ?>">FHISIP</a></li>
            <li><a href="<?= site_url('/filemanager/faculty/FKIP') ?>">FKIP</a></li>
            <li><a href="<?= site_url('/filemanager/faculty/FST') ?>">FST</a></li>
            <li><a href="<?= site_url('/filemanager/faculty/PPS') ?>">PPS</a></li>
        </ul>
    </div>
</body>

</html>