<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($conn, $_GET['kategori']) : '';
$genre = isset($_GET['genre']) ? mysqli_real_escape_string($conn, $_GET['genre']) : '';
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
    $rating = (int)$_POST['rating'];
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan']);
    $book_id = (int)$_POST['book_id'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO rating (buku_id, pengguna_id, rating, ulasan) VALUES ($book_id, $user_id, $rating, '$ulasan')";
    mysqli_query($conn, $query);
}

if ($book_id) {
    $query = "SELECT b.*, AVG(r.rating) as avg_rating 
              FROM books b 
              LEFT JOIN rating r ON b.id = r.buku_id 
              WHERE b.id = $book_id 
              GROUP BY b.id";
    $book_result = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($book_result);
} else {
    $query = "SELECT b.*, AVG(r.rating) as avg_rating 
              FROM books b 
              LEFT JOIN rating r ON b.id = r.buku_id 
              WHERE 1=1";
    if ($search) {
        $query .= " AND (b.title LIKE '%$search%' OR b.author LIKE '%$search%' OR b.keywords LIKE '%$search%')";
    }
    if ($kategori) {
        $query .= " AND b.kategori = '$kategori'";
    }
    if ($genre) {
        $query .= " AND b.genre = '$genre'";
    }
    $query .= " GROUP BY b.id ORDER BY avg_rating DESC";
    $books_result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Katalog Digital</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <div class="container">
        <?php if ($book_id && $book) { ?>
            <h1><?php echo htmlspecialchars($book['title']); ?></h1>
            <img src="../Uploads/<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover">
            <p>Penulis: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>Kategori: <?php echo htmlspecialchars($book['kategori']); ?></p>
            <p>Genre: <?php echo htmlspecialchars($book['genre']); ?></p>
            <p>Status: <?php echo $book['status'] == 1 ? 'Tersedia' : 'Dipinjam'; ?></p>
            <p>Rating: <?php echo number_format($book['avg_rating'], 1); ?>/5</p>
            <p>Sinopsis: <?php echo htmlspecialchars($book['sinopsis']); ?></p>
            <img src="../qr_codes/book_<?php echo $book['id']; ?>.png" alt="QR Code">

            <?php if (isLoggedIn()) { ?>
                <form action="katalog.php" method="POST" class="rating-form">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <select name="rating" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <textarea name="ulasan" placeholder="Tulis ulasan"></textarea>
                    <button type="submit">Kirim Rating</button>
                </form>
            <?php } else { ?>
                <p><a href="../login.php">Login</a> untuk memberikan rating dan ulasan</p>
            <?php } ?>
        <?php } else { ?>
            <h1>Katalog Buku</h1>
            <form action="katalog.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari buku..." value="<?php echo htmlspecialchars($search); ?>">
                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    <option value="Buku Pelajaran" <?php if ($kategori == 'Buku Pelajaran') echo 'selected'; ?>>Buku Pelajaran</option>
                    <option value="Buku Non Pelajaran" <?php if ($kategori == 'Buku Non Pelajaran') echo 'selected'; ?>>Buku Non Pelajaran</option>
                    <option value="Buku Ramah Anak" <?php if ($kategori == 'Buku Ramah Anak') echo 'selected'; ?>>Buku Ramah Anak</option>
                    <option value="Buku Inovasi Desa" <?php if ($kategori == 'Buku Inovasi Desa') echo 'selected'; ?>>Buku Inovasi Desa</option>
                </select>
                <input type="text" name="genre" placeholder="Genre" value="<?php echo htmlspecialchars($genre); ?>">
                <button type="submit">Cari</button>
            </form>
            <div class="book-list">
                <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                    <div class="book">
                        <img src="../Uploads/<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover">
                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p>Penulis: <?php echo htmlspecialchars($book['author']); ?></p>
                        <p>Rating: <?php echo number_format($book['avg_rating'], 1); ?>/5</p>
                        <p>Status: <?php echo $book['status'] == 1 ? 'Tersedia' : 'Dipinjam'; ?></p>
                        <a href="katalog.php?book_id=<?php echo $book['id']; ?>">Lihat Detail</a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</body>
</html>
