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
        <img src="<?= base_url('images/ut_logo.png') ?>" alt="Logo Universitas Terbuka" class="logo">
        <div class="welcome-text">
            <h1>Selamat Datang Di File Manager Materi Pengayaan Universitas Terbuka</h1>
            <p>- Silahkan Memilih Materi Pengayaan berdasarkan fakultas atau gunakan Fitur Pencarian...</p>
        </div>

        <h1>File untuk Fakultas <?= esc($faculty) ?></h1>

        <?php if (!empty($files)): ?>
        <ul>
            <?php foreach ($files as $file): ?>
            <li>
                <a href="<?= base_url($file['file_path']) ?>"><?= esc($file['filename']) ?></a>
                - <a href="<?= base_url($file['file_path']) ?>" download>Unduh ZIP</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>Tidak ada file ditemukan untuk fakultas ini.</p>
        <?php endif; ?>

        <a href="<?= site_url('/filemanager') ?>" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>

</html>