<?php
$conn = mysqli_connect("localhost", "root", "", "db_sewa_kendaraan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
