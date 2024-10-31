<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File untuk <?= esc($faculty) ?></title>
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
        <?php if (!empty($files)): ?>
        <?php foreach ($files as $file): ?>
        <li>

            <?php if (pathinfo($file['filename'], PATHINFO_EXTENSION) === 'zip'): ?>

            <a href="<?= base_url($file['file_path']) ?>"><?= esc($file['filename']) ?></a>
            - <a href="<?= base_url($file['file_path']) ?>" download>Unduh ZIP</a>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
        <?php else: ?>
        <li><?= esc($message) ?></li>
        <?php endif; ?>
        </ul>
        <a href="<?= site_url('/filemanager') ?>" class="back-link">Kembali ke Halaman Utama</a>

    </div>
</body>

</html>