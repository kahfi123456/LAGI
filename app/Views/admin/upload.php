<!-- di views/admin/upload.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?= base_url('css/admin.css'); ?>"> <!-- Panggil CSS admin -->
    <title>Upload File</title>
</head>

<body>
    <h2>Upload File</h2>
    <?php if (session()->getFlashdata('message')): ?>
    <p><?= session()->getFlashdata('message'); ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <p><?= session()->getFlashdata('error'); ?></p>
    <?php endif; ?>

    <form action="<?= base_url('admin/upload'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Unggah</button>
    </form>
</body>

</html>