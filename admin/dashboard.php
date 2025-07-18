<?php
// File: admin/dashboard.php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Katalog Digital</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <ul>
            <li><a href="tambah_buku.php">Tambah Buku</a></li>
            <li><a href="edit_buku.php">Edit/Kelola Buku</a></li>
            <li><a href="data_user.php">Kelola Data Pengguna</a></li>
        </ul>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</body>
</html>