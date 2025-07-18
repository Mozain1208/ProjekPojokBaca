<?php
function generateQRCode($book_id) {
    $url = "http://yourdomain.com/user/katalog.php?book_id=$book_id";
    $qr_path = "qr_codes/book_$book_id.png";
    // Note: You'll need a QR code library like phpqrcode
    // require_once 'path/to/phpqrcode/qrlib.php';
    // QRcode::png($url, $qr_path);
    return $qr_path;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}
?>