<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    /* Gaya Umum */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    header {
        text-align: center;
        margin-bottom: 30px;
    }

    header h1 {
        font-size: 24px;
        color: #333;
    }

    nav {
        background: #4a90e2;
        padding: 10px 0;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    nav ul {
        list-style: none;
        padding: 0;
        text-align: center;
    }

    nav ul li {
        display: inline-block;
        margin: 0 15px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        padding: 8px 12px;
        font-weight: 500;
        border-radius: 5px;
        transition: background 0.3s ease;
    }

    nav ul li a:hover {
        background: #357ABD;
    }

    .notification {
        background-color: #d4edda;
        color: #155724;
        padding: 12px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    /* Form Upload */
    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        color: #555;
    }

    input[type="file"] {
        display: block;
        margin-bottom: 10px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
    }

    button {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #357ABD;
    }

    /* Table Style */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        color: #555;
    }

    th {
        background-color: #4a90e2;
        color: white;
        font-weight: 600;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #eaf3fd;
    }

    .action-buttons a {
        color: #4a90e2;
        text-decoration: none;
        font-weight: 500;
        margin-right: 10px;
        transition: color 0.3s ease;
    }

    .action-buttons a:hover {
        color: #357ABD;
    }

    footer {
        text-align: center;
        margin-top: 30px;
        color: #777;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <p>Selamat datang, <?= session()->get('username'); ?>!</p>
        </header>

        <nav>
            <ul>
                <li><a href="#">Manage Files</a></li>
                <li><a href="#">View Logs</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="<?= site_url('admin/logout'); ?>">Logout</a></li>
            </ul>
        </nav>

        <main>
            <h2>Manage Files</h2>

            <!-- Pesan Notifikasi -->
            <?php if (session()->getFlashdata('message')): ?>
            <div class="notification">
                <?= session()->getFlashdata('message'); ?>
            </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/upload'); ?>" method="post" enctype="multipart/form-data">
                <label for="zip_file">Upload File:</label>
                <input type="file" name="file" id="zip_file" required>
                <button type="submit">Upload</button>
            </form>
            <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>


            <h3>Uploaded Files</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>Uploaded At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($uploadedFiles as $index => $file): ?>
                    <tr>
                        <td><?= $index + 1 ?></td> <!-- Menampilkan ID berurutan -->
                        <td><?= $file['file_name'] ?></td>
                        <td><?= $file['file_type'] ?></td>
                        <td><?= $file['uploaded_at'] ?></td>
                        <td>
                            <a href="<?= site_url('admin/deleteFile/' . $file['id']) ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </main>

        <footer>
            <p>&copy; <?= date('Y'); ?> Your Company. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>