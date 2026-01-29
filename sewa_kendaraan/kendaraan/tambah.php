<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama_kendaraan'];
    $jenis  = $_POST['jenis'];
    $harga  = $_POST['harga_sewa'];
    $stok   = $_POST['stok'];

    $foto = $_FILES['foto_kendaraan']['name'];
    $tmp  = $_FILES['foto_kendaraan']['tmp_name'];

    $namaFoto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/kendaraan/" . $namaFoto);

    mysqli_query($conn, "
        INSERT INTO kendaraan
        (nama_kendaraan, foto_kendaraan, jenis, harga_sewa, stok, status)
        VALUES
        ('$nama', '$namaFoto', '$jenis', '$harga', '$stok', 'Tersedia')
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kendaraan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>➕ Tambah Kendaraan</h2>
    </div>

    <form method="post" enctype="multipart/form-data">
        <label>Nama Kendaraan</label>
        <input type="text" name="nama_kendaraan" required>

        <label>Foto Kendaraan</label>
        <input type="file" name="foto_kendaraan" accept="image/*" required>

        <label>Jenis</label>
        <select name="jenis">
            <option value="Bus">Bus</option>
            <option value="Minibus">Minibus</option>
            <option value="Motor">Motor</option>
        </select>

        <label>Harga Sewa</label>
        <input type="number" name="harga_sewa" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <br><br>
        <button type="submit" name="simpan" class="btn">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </form>
</div>

</body>
</html>
