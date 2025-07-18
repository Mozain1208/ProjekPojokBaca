<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'digital_katalog';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Buat tabel jika belum ada
$tables = "
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    genre VARCHAR(100),
    cover VARCHAR(255),
    status TINYINT(1) DEFAULT 1,
    keywords TEXT,
    sinopsis TEXT,
    target_pembaca VARCHAR(100),
    penerbit VARCHAR(100),
    tahun_terbit YEAR,
    isbn VARCHAR(20),
    jumlah_halaman INT,
    kelas VARCHAR(20),
    mata_pelajaran VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengguna VARCHAR(50) NOT NULL UNIQUE,
    kata_sandi VARCHAR(255) NOT NULL,
    peran ENUM('pengguna','admin') DEFAULT 'pengguna',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rating (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buku_id INT NOT NULL,
    pengguna_id INT NOT NULL,
    rating INT NOT NULL,
    ulasan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buku_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// Jalankan perintah SQL
if (mysqli_multi_query($conn, $tables)) {
    while (mysqli_next_result($conn)) {;}
} else {
    die("Gagal membuat tabel: " . mysqli_error($conn));
}
?>
