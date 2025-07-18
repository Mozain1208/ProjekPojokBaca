<?php
// File: tentang.php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Perpustakaan - Katalog Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
    <div class="container">
        <h1>Tentang Perpustakaan Desa Songgom</h1>
        <p>Perpustakaan Desa Songgom adalah pusat pengetahuan dan inovasi yang menyediakan berbagai koleksi buku untuk masyarakat. Kami berkomitmen untuk mendigitalisasi katalog kami agar lebih mudah diakses melalui QR code.</p>
        <p>Misi kami adalah meningkatkan literasi dan mendukung inovasi desa melalui akses buku yang ramah anak, buku pelajaran, non pelajaran, dan buku inovasi desa.</p>
    </div>
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>