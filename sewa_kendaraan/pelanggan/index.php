<?php
include '../config/koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
$no = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Data Pelanggan</h2>

<a href="tambah.php" class="btn btn-primary">+ Tambah Pelanggan</a>
<a href="../dashboard.php" class="btn btn-secondary">← Dashboard</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>No KTP</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

<?php while ($p = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['nama_pelanggan'] ?></td>
    <td><?= $p['no_hp'] ?></td>
    <td><?= $p['no_ktp'] ?></td>
    <td><?= $p['alamat'] ?></td>
    <td>
        <a href="edit.php?id=<?= $p['id_pelanggan'] ?>" class="btn btn-warning">Edit</a>
        <a href="hapus.php?id=<?= $p['id_pelanggan'] ?>" class="btn btn-danger"
           onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
