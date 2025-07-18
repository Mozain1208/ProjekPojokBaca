<?php
// File: admin/data_user.php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header("Location: ../login.php");
    exit;
}

$users_query = "SELECT * FROM pengguna";
$users_result = mysqli_query($conn, $users_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Pengguna - Katalog Digital</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <div class="container">
        <h1>Kelola Data Pengguna</h1>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['nama_pengguna']); ?></td>
                        <td><?php echo htmlspecialchars($user['peran']); ?></td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</body>
</html>
