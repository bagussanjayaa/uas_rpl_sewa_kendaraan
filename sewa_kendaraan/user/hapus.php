<?php
session_start();
include '../config/koneksi.php';

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$id = $_GET['id'];

/* Admin tidak bisa hapus dirinya sendiri */
if ($id == $_SESSION['id_user']) {
    header("Location: index.php");
    exit;
}

mysqli_query($conn, "DELETE FROM users WHERE id_user='$id'");
header("Location: index.php");
