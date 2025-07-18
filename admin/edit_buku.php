<?php
// File: admin/edit_buku.php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header("Location: ../login.php");
    exit;
}

$books_query = "SELECT * FROM books";
$books_result = mysqli_query($conn, $books_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Katalog Digital</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Edit/Kelola Buku</h1>
        <table class="book-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['kategori']); ?></td>
                        <td><?php echo $book['status'] == 1 ? 'Tersedia' : 'Dipinjam'; ?></td>
                        <td>
                            <a href="edit_buku.php?id=<?php echo $book['id']; ?>">Edit</a>
                            <a href="delete_buku.php?id=<?php echo $book['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</body>
</html>
