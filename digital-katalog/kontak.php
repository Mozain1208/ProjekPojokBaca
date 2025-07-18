<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Katalog Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
    <div class="container">
        <h1>Kontak Kami</h1>
        <p>Email: perpustakaan@songgom.desa.id</p>
        <p>Telepon: (021) 123-4567</p>
        <p>Alamat: Jl. Raya Songgom No. 123, Desa Songgom</p>
    </div>
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
