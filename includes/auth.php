<?php
// File: includes/auth.php
session_start();
require_once 'db.php';
require_once 'functions.php';

if (!isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}
?>