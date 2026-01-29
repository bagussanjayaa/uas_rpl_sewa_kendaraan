<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$p = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE pelanggan SET
        nama_pelanggan='$_POST[nama_pelanggan]',
        no_hp='$_POST[no_hp]',
        no_ktp='$_POST[no_ktp]',
        alamat='$_POST[alamat]'
        WHERE id_pelanggan='$id'
    ");

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Edit Pelanggan</h2>

<form method="post">
    <label>Nama Pelanggan</label>
    <input type="text" name="nama_pelanggan" value="<?= $p['nama_pelanggan'] ?>" required>

    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= $p['no_hp'] ?>" required>

    <label>No KTP</label>
    <input type="text" name="no_ktp" value="<?= $p['no_ktp'] ?>">

    <label>Alamat</label>
    <textarea name="alamat"><?= $p['alamat'] ?></textarea>

    <div class="form-actions">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</form>

</body>
</html>
