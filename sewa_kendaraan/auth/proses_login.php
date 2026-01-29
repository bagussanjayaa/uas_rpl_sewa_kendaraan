<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE username='$username' AND password='$password'
");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['id_user']   = $data['id_user'];
    $_SESSION['username']  = $data['username'];
    $_SESSION['role']      = $data['role'];

    header("Location: ../dashboard.php");
    exit;
} else {
    header("Location: ../auth/login.php?error=1");
    exit;
}