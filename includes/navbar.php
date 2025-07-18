<?php
// File: includes/navbar.php
session_start();
require_once 'functions.php';
?>

<nav class="navbar">
    <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="../tentang.php">Tentang Perpustakaan</a></li>
        <li><a href="../kontak.php">Kontak</a></li>
    </ul>
    <ul class="nav-auth">
        <?php if (isLoggedIn()) { ?>
            <li><a href="../logout.php">Logout</a></li>
            <?php if (isAdmin()) { ?>
                <li><a href="../admin/dashboard.php">Dashboard Admin</a></li>
            <?php } ?>
        <?php } else { ?>
            <li><a href="../login.php">Login</a></li>
        <?php } ?>
    </ul>
</nav>