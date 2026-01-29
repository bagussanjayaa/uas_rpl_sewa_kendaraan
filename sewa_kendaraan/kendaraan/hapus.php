<?php
include '../config/database.php';
mysqli_query($conn, "DELETE FROM kendaraan WHERE id_kendaraan=$_GET[id]");
header("Location: index.php");
