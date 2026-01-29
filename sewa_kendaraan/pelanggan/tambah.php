<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO pelanggan
        (nama_pelanggan, no_hp, alamat, no_ktp)
        VALUES (
            '$_POST[nama_pelanggan]',
            '$_POST[no_hp]',
            '$_POST[alamat]',
            '$_POST[no_ktp]'
        )");

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Tambah Pelanggan</h2>

<form method="post">
    <label>Nama Pelanggan</label>
    <input type="text" name="nama_pelanggan" required>

    <label>No HP</label>
    <input type="text" name="no_hp" required>

    <label>No KTP</label>
    <input type="text" name="no_ktp">

    <label>Alamat</label>
    <textarea name="alamat"></textarea>

    <div class="form-actions">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</form>

</body>
</html>
