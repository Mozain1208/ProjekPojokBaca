<?php
// File: admin/tambah_buku.php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $keywords = mysqli_real_escape_string($conn, $_POST['keywords']);
    $sinopsis = mysqli_real_escape_string($conn, $_POST['sinopsis']);
    $target_pembaca = mysqli_real_escape_string($conn, $_POST['target_pembaca']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = $_POST['tahun_terbit'];
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $jumlah_halaman = $_POST['jumlah_halaman'];
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
    $status = $_POST['status'];

    // Handle file upload
    $cover = $_FILES['cover']['name'];
    $target_dir = "../Uploads/";
    $target_file = $target_dir . basename($cover);
    move_uploaded_file($_FILES['cover']['tmp_name'], $target_file);

    $query = "INSERT INTO books (title, author, kategori, genre, cover, status, keywords, sinopsis, target_pembaca, penerbit, tahun_terbit, isbn, jumlah_halaman, kelas, mata_pelajaran) 
              VALUES ('$title', '$author', '$kategori', '$genre', '$cover', '$status', '$keywords', '$sinopsis', '$target_pembaca', '$penerbit', '$tahun_terbit', '$isbn', '$jumlah_halaman', '$kelas', '$mata_pelajaran')";
    
    if (mysqli_query($conn, $query)) {
        $book_id = mysqli_insert_id($conn);
        $qr_path = generateQRCode($book_id);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Gagal menambah buku: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Katalog Digital</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Tambah Buku</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="tambah_buku.php" method="POST" enctype="multipart/form-data" class="book-form">
            <input type="text" name="title" placeholder="Judul" required>
            <input type="text" name="author" placeholder="Penulis" required>
            <select name="kategori" required>
                <option value="Buku Pelajaran">Buku Pelajaran</option>
                <option value="Buku Non Pelajaran">Buku Non Pelajaran</option>
                <option value="Buku Ramah Anak">Buku Ramah Anak</option>
                <option value="Buku Inovasi Desa">Buku Inovasi Desa</option>
            </select>
            <input type="text" name="genre" placeholder="Genre">
            <input type="file" name="cover" accept="image/*" required>
            <select name="status" required>
                <option value="1">Tersedia</option>
                <option value="0">Dipinjam</option>
            </select>
            <textarea name="keywords" placeholder="Kata Kunci"></textarea>
            <textarea name="sinopsis" placeholder="Sinopsis"></textarea>
            <input type="text" name="target_pembaca" placeholder="Target Pembaca">
            <input type="text" name="penerbit" placeholder="Penerbit">
            <input type="number" name="tahun_terbit" placeholder="Tahun Terbit">
            <input type="text" name="isbn" placeholder="ISBN">
            <input type="number" name="jumlah_halaman" placeholder="Jumlah Halaman">
            <input type="text" name="kelas" placeholder="Kelas">
            <input type="text" name="mata_pelajaran" placeholder="Mata Pelajaran">
            <button type="submit">Tambah</button>
        </form>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</body>
</html>