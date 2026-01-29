<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$role = strtolower($_SESSION['role']);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Dashboard <?= ucfirst($_SESSION['role']) ?></h2>
    </div>

    <ul class="menu">
        <li><a href="kendaraan/index.php">Data Kendaraan</a></li>
        <li><a href="pelanggan/index.php">Data Pelanggan</a></li>
        <li><a href="transaksi/index.php">Transaksi</a></li>

        <?php if ($_SESSION['role'] == 'Admin') { ?>
            <li><a href="laporan/laporan_transaksi.php">Laporan Transaksi</a></li>
            <li><a href="user/index.php">Manajemen User</a></li>
        <?php } ?>

        <li><a href="auth/logout.php" class="logout">Logout</a></li>
    </ul>
</div>

</body>
</html>
