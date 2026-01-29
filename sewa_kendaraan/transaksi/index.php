<?php
session_start();
include '../config/koneksi.php';

$data = mysqli_query($conn,"
SELECT t.*, p.nama_pelanggan, k.nama_kendaraan
FROM transaksi t
JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan
JOIN kendaraan k ON t.id_kendaraan=k.id_kendaraan
ORDER BY t.id_transaksi DESC
");
$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Data Transaksi</h2>

<a href="sewa.php" class="btn btn-primary">+ Transaksi Sewa</a>
<a href="../dashboard.php" class="btn btn-secondary">← Dashboard</a>

<table>
<tr>
    <th>No</th>
    <th>Pelanggan</th>
    <th>Kendaraan</th>
    <th>Tgl Sewa</th>
    <th>Tgl Kembali</th>
    <th>Status</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php while ($t = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $t['nama_pelanggan'] ?></td>
    <td><?= $t['nama_kendaraan'] ?></td>
    <td><?= $t['tanggal_sewa'] ?></td>
    <td><?= $t['tanggal_kembali'] ?></td>
    <td><?= $t['status'] ?></td>
    <td>Rp <?= number_format($t['denda']) ?></td>
    <td>
        <?php if ($t['status']=='Disewa') { ?>
            <a href="kembali.php?id=<?= $t['id_transaksi'] ?>" class="btn btn-warning">
                Kembalikan
            </a>
        <?php } else echo "-"; ?>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
