<?php
session_start();
include '../config/koneksi.php';

/* ===== BATASI AKSES ===== */
if (!isset($_SESSION['id_user']) || strtolower($_SESSION['role']) != 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

/* ===== AMBIL DATA USER ===== */
$data = mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC");
$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Manajemen User</h2>
    </div>

    <a href="tambah.php" class="btn">+ Tambah User</a>
    <a href="../dashboard.php" class="btn btn-warning">← Dashboard</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Username</th>
            <th>Role</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>

        <?php while ($u = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $u['nama_user'] ?></td>
            <td><?= $u['username'] ?></td>
            <td>
                <span class="<?= strtolower($u['role']) == 'admin' ? 'status-kembali' : 'status-disewa' ?>">
                    <?= $u['role'] ?>
                </span>
            </td>
            <td><?= date('d-m-Y', strtotime($u['created_at'])) ?></td>
            <td>
                <a href="edit.php?id=<?= $u['id_user'] ?>" class="btn btn-warning">Edit</a>

                <?php if ($u['id_user'] != $_SESSION['id_user']) { ?>
                    <a href="hapus.php?id=<?= $u['id_user'] ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Yakin hapus user ini?')">
                       Hapus
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

    <p class="info">
        * Admin tidak dapat menghapus akunnya sendiri.
    </p>
</div>

</body>
</html>
