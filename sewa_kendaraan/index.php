<?php
include 'config/koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM kendaraan ORDER BY id_kendaraan DESC");
$no = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sewa Kendaraan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header" style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Selamat Datang di Sistem Sewa Kendaraan</h2>
        <div>
            <a href="index.php" class="btn">Beranda</a>
            <a href="auth/login.php" class="btn btn-warning">Login</a>
        </div>
    </div>

    <!-- INFO -->
    <p class="info">
        Berikut adalah daftar kendaraan yang tersedia.
        Silakan datang ke tempat penyewaan untuk melakukan penyewaan.
    </p>

    <!-- TABLE -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Kendaraan</th>
            <th>Jenis</th>
            <th>Harga Sewa</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Foto</th>
        </tr>

        <?php while ($k = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $k['nama_kendaraan'] ?></td>
            <td><?= $k['jenis'] ?></td>
            <td>Rp <?= number_format($k['harga_sewa']) ?></td>
            <td><?= $k['stok'] ?></td>
            <td>
                <span class="<?= $k['status']=='Tersedia' ? 'status-kembali' : 'status-disewa' ?>">
                    <?= $k['status'] ?>
                </span>
            </td>
            <td>
                <?php if ($k['foto_kendaraan']) { ?>
                    <img src="uploads/kendaraan/<?= $k['foto_kendaraan'] ?>"
                         style="width:150px; border-radius:10px;">
                <?php } else { echo "-"; } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
