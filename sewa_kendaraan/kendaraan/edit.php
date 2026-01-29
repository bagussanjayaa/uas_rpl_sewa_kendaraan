<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM kendaraan WHERE id_kendaraan='$id'")
);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama_kendaraan'];
    $jenis  = $_POST['jenis'];
    $harga  = $_POST['harga_sewa'];
    $stok   = $_POST['stok'];
    $status = $_POST['status']; // ✅ TAMBAHAN

    if (!empty($_FILES['foto_kendaraan']['name'])) {
        $foto = $_FILES['foto_kendaraan']['name'];
        $tmp  = $_FILES['foto_kendaraan']['tmp_name'];

        $namaFoto = time() . '_' . $foto;
        move_uploaded_file($tmp, "../uploads/kendaraan/" . $namaFoto);

        mysqli_query($conn, "
            UPDATE kendaraan SET
            nama_kendaraan='$nama',
            foto_kendaraan='$namaFoto',
            jenis='$jenis',
            harga_sewa='$harga',
            stok='$stok',
            status='$status'
            WHERE id_kendaraan='$id'
        ");
    } else {
        mysqli_query($conn, "
            UPDATE kendaraan SET
            nama_kendaraan='$nama',
            jenis='$jenis',
            harga_sewa='$harga',
            stok='$stok',
            status='$status'
            WHERE id_kendaraan='$id'
        ");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>✏️ Edit Kendaraan</h2>
    </div>

    <form method="post" enctype="multipart/form-data">
        <label>Nama Kendaraan</label>
        <input type="text" name="nama_kendaraan" value="<?= $data['nama_kendaraan'] ?>" required>

        <label>Foto Kendaraan</label><br>
        <img src="../uploads/kendaraan/<?= $data['foto_kendaraan'] ?>" width="120"><br><br>
        <input type="file" name="foto_kendaraan">

        <label>Jenis</label>
        <select name="jenis">
            <option value="Bus" <?= $data['jenis']=='Bus'?'selected':'' ?>>Bus</option>
            <option value="Minibus" <?= $data['jenis']=='Minibus'?'selected':'' ?>>Minibus</option>
            <option value="Motor" <?= $data['jenis']=='Motor'?'selected':'' ?>>Motor</option>
        </select>

        <label>Harga Sewa</label>
        <input type="number" name="harga_sewa" value="<?= $data['harga_sewa'] ?>">

        <label>Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>">

        <label>Status Kendaraan</label>
        <select name="status">
            <option value="Tersedia" <?= $data['status']=='Tersedia'?'selected':'' ?>>Tersedia</option>
            <option value="Disewa" <?= $data['status']=='Disewa'?'selected':'' ?>>Disewa</option>
        </select>

        <br><br>
        <button type="submit" name="update" class="btn">Update</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </form>
</div>

</body>
</html>
