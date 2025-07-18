<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Digital Perpustakaan Desa Songgom</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Katalog Digital Desa Songgom</h1>
        
        <!-- Search Form -->
        <form action="user/katalog.php" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Cari buku berdasarkan judul, penulis, atau kata kunci">
            <select name="kategori">
                <option value="">Semua Kategori</option>
                <option value="Buku Pelajaran">Buku Pelajaran</option>
                <option value="Buku Non Pelajaran">Buku Non Pelajaran</option>
                <option value="Buku Ramah Anak">Buku Ramah Anak</option>
                <option value="Buku Inovasi Desa">Buku Inovasi Desa</option>
            </select>
            <button type="submit">Cari</button>
        </form>

        <!-- Recomendasi Buku-->
        <h2>Rekomendasi Buku</h2>
        <div class="book-list">
            <?php
            $query = "SELECT b.*, AVG(r.rating) as avg_rating 
                     FROM books b 
                     LEFT JOIN ratings r ON b.id = r.book_id 
                     GROUP BY b.id 
                     ORDER BY avg_rating DESC 
                     LIMIT 5";
            $result = mysqli_query($conn, $query);
            while ($book = mysqli_fetch_assoc($result)) {
                echo '<div class="book">';
                echo '<img src="uploads/' . htmlspecialchars($book['cover']) . '" alt="Cover">';
                echo '<h3>' . htmlspecialchars($book['title']) . '</h3>';
                echo '<p>Penulis: ' . htmlspecialchars($book['author']) . '</p>';
                echo '<p>Rating: ' . number_format($book['avg_rating'], 1) . '/5</p>';
                echo '<p>Status: ' . ($book['status'] == 1 ? 'Tersedia' : 'Dipinjam') . '</p>';
                echo '<a href="user/katalog.php?book_id=' . $book['id'] . '">Lihat Detail</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>