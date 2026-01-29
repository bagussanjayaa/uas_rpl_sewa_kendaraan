<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_SESSION['role'])) {
    die("ROLE TIDAK TERDETEKSI. SILAKAN LOGIN ULANG.");
}

function hanyaAdmin() {
    if ($_SESSION['role'] !== 'admin') {
        die("Akses ditolak. Khusus Admin.");
    }
}

function adminPetugas() {
    if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'petugas') {
        die("Akses ditolak.");
    }
}
