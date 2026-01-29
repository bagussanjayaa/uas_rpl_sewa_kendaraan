<?php
session_start();
include '../config/koneksi.php';

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    mysqli_query($conn, "
        INSERT INTO users (nama_user, username, password, role)
        VALUES ('$nama','$username','$password','$role')
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Tambah User</h2>
    </div>

    <form method="POST">
        <label>Nama User</label>
        <input type="text" name="nama_user" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="Admin">Admin</option>
            <option value="Petugas">Petugas</option>
        </select>

        <br><br>
        <button name="simpan" class="btn">Simpan</button>
        <a href="index.php" class="btn btn-warning">Kembali</a>
    </form>
</div>

</body>
</html>
