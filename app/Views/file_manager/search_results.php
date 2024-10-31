<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: aqua;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-top: 20px;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background: #fff;
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hasil Pencarian untuk: <?= esc($query) ?></h1>

        <ul>
            <?php if (!empty($files)): ?>
            <?php foreach ($files as $file): ?>
            <li>
                <a href="<?= base_url($file['file_path']) ?>"><?= esc($file['filename']) ?></a>
                - <a href="<?= base_url($file['file_path']) ?>" download>Unduh ZIP</a>
            </li>

            <?php endforeach; ?>
            <?php else: ?>
            <li><?= esc($message ?: 'Tidak ada file ditemukan.') ?></li>
            <?php endif; ?>
        </ul>

        <a href="<?= site_url('/filemanager') ?>" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>

</html>