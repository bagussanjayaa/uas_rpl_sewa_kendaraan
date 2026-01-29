<?php
include '../config/database.php';
mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan=$_GET[id]");
header("Location: index.php");
