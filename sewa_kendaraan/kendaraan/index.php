<?php
include '../config/koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM kendaraan ORDER BY id_kendaraan DESC");
$no = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Kendaraan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Data Kendaraan</h2>

<a href="tambah.php" class="btn btn-primary">+ Tambah Kendaraan</a>
<a href="../dashboard.php" class="btn btn-secondary">← Dashboard</a>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Jenis</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Status</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>

<?php while ($k = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $k['nama_kendaraan'] ?></td>
    <td><?= $k['jenis'] ?></td>
    <td>Rp <?= number_format($k['harga_sewa']) ?></td>
    <td><?= $k['stok'] ?></td>
    <td>
        <span class="badge <?= $k['status']=='Tersedia' ? 'badge-success' : 'badge-warning' ?>">
            <?= $k['status'] ?>
        </span>
    </td>
    <td>
        <?php if ($k['foto_kendaraan']) { ?>
            <img src="../uploads/kendaraan/<?= $k['foto_kendaraan'] ?>" width="150">
        <?php } else { echo "-"; } ?>
    </td>
    <td>
        <a href="edit.php?id=<?= $k['id_kendaraan'] ?>" class="btn btn-warning">Edit</a>
        <a href="hapus.php?id=<?= $k['id_kendaraan'] ?>" class="btn btn-danger"
           onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
