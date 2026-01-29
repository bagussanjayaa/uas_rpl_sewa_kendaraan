<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
}
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="container" style="max-width:600px;margin:auto;">
    <div class="header">
        <h2>Form Penyewaan Kendaraan</h2>
    </div>

    <form method="POST">
        <!-- PILIH PELANGGAN -->
        <label>Pelanggan</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php
            $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
            while ($p = mysqli_fetch_assoc($pelanggan)) {
                echo "<option value='$p[id_pelanggan]'>$p[nama_pelanggan]</option>";
            }
            ?>
        </select>

        <!-- PILIH KENDARAAN -->
        <label>Kendaraan</label>
        <select name="id_kendaraan" required>
            <option value="">-- Pilih Kendaraan --</option>
            <?php
            $kendaraan = mysqli_query($conn, "SELECT * FROM kendaraan WHERE stok > 0");
            while ($k = mysqli_fetch_assoc($kendaraan)) {
                echo "<option value='$k[id_kendaraan]'>$k[nama_kendaraan] - $k[jenis]</option>";
            }
            ?>
        </select>

        <!-- TANGGAL -->
        <label>Tanggal Sewa</label>
        <input type="date" name="tanggal_sewa" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" required>

        <br><br>
        <button type="submit" name="simpan" class="btn">Simpan Transaksi</button>
        <a href='index.php' class='btn btn-warning'>Kembali ke Transaksi</a>
    </form>
</div>

<?php
// =======================
// PROSES SIMPAN TRANSAKSI
// =======================
if (isset($_POST['simpan'])) {

    $id_user = $_SESSION['id_user'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kendaraan = $_POST['id_kendaraan'];
    $tgl_sewa = $_POST['tanggal_sewa'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // Ambil data kendaraan
    $k = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM kendaraan WHERE id_kendaraan=$id_kendaraan")
    );

    // Hitung hari sewa
    $hari = (strtotime($tgl_kembali) - strtotime($tgl_sewa)) / (60*60*24);
    if ($hari < 1) $hari = 1;

    $total = $hari * $k['harga_sewa'];

    // Simpan transaksi
    mysqli_query($conn, "INSERT INTO transaksi
        (id_user, id_pelanggan, id_kendaraan, tanggal_sewa, tanggal_kembali, total_biaya, denda, status)
        VALUES
        ('$id_user','$id_pelanggan','$id_kendaraan',
         '$tgl_sewa','$tgl_kembali','$total',0,'Disewa')
    ");

    // Kurangi stok kendaraan
    mysqli_query($conn, "UPDATE kendaraan
        SET stok = stok - 1
        WHERE id_kendaraan=$id_kendaraan
    ");
}
?>