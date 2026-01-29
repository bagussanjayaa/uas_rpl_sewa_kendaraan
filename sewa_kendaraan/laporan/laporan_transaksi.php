<?php
include '../config/koneksi.php';

$data = mysqli_query($conn, "
    SELECT t.*, p.nama_pelanggan, k.nama_kendaraan
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    JOIN kendaraan k ON t.id_kendaraan = k.id_kendaraan
    ORDER BY t.id_transaksi DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Laporan Transaksi</h2>

<a href="../dashboard.php" class="btn btn-secondary">← Dashboard</a>

<table>
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Kendaraan</th>
        <th>Tgl Sewa</th>
        <th>Tgl Kembali</th>
        <th>Tgl Kembali Real</th>
        <th>Total Biaya</th>
        <th>Denda</th>
        <th>Status</th>
    </tr>

<?php
$no = 1;
while ($d = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama_pelanggan'] ?></td>
    <td><?= $d['nama_kendaraan'] ?></td>
    <td><?= $d['tanggal_sewa'] ?></td>
    <td><?= $d['tanggal_kembali'] ?></td>
    <td><?= $d['tanggal_kembali_real'] ?? '-' ?></td>
    <td>Rp <?= number_format($d['total_biaya']) ?></td>
    <td>Rp <?= number_format($d['denda']) ?></td>
    <td>
        <span class="badge <?= $d['status'] == 'Disewa' ? 'badge-warning' : 'badge-success' ?>">
            <?= $d['status'] ?>
        </span>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
