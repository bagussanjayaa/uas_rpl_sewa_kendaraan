<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$tgl_real = date('Y-m-d');

$t = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM transaksi WHERE id_transaksi='$id'"
));

$terlambat = (strtotime($tgl_real) - strtotime($t['tanggal_kembali'])) / 86400;
$denda = ($terlambat > 0) ? $terlambat * 50000 : 0;

mysqli_query($conn, "UPDATE transaksi SET
    tanggal_kembali_real='$tgl_real',
    denda='$denda',
    status='Dikembalikan'
    WHERE id_transaksi='$id'
");

mysqli_query($conn, "UPDATE kendaraan SET stok = stok + 1
    WHERE id_kendaraan='{$t['id_kendaraan']}'
");

header("Location: index.php");
