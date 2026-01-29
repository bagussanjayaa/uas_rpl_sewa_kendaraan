<?php
session_start();
include '../config/koneksi.php';

if (strtolower($_SESSION['role']) != 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM users WHERE id_user='$id'
"));

if (isset($_POST['update'])) {
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $role     = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        mysqli_query($conn,"
            UPDATE users SET 
            nama_user='$nama',
            username='$username',
            password='$password',
            role='$role'
            WHERE id_user='$id'
        ");
    } else {
        mysqli_query($conn,"
            UPDATE users SET 
            nama_user='$nama',
            username='$username',
            role='$role'
            WHERE id_user='$id'
        ");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Edit User</h2>
    </div>

    <form method="POST">
        <label>Nama User</label>
        <input type="text" name="nama_user" value="<?= $data['nama_user'] ?>" required>

        <label>Username</label>
        <input type="text" name="username" value="<?= $data['username'] ?>" required>

        <label>Password (Kosongkan jika tidak diubah)</label>
        <input type="password" name="password">

        <label>Role</label>
        <select name="role">
            <option value="Admin" <?= $data['role']=='Admin'?'selected':'' ?>>Admin</option>
            <option value="Petugas" <?= $data['role']=='Petugas'?'selected':'' ?>>Petugas</option>
        </select>

        <br><br>
        <button name="update" class="btn">Update</button>
        <a href="index.php" class="btn btn-warning">Kembali</a>
    </form>
</div>

</body>
</html>
