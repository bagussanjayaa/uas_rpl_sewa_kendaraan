<link rel="stylesheet" href="../assets/style.css">

<div class="container" style="max-width:400px;margin:auto;">
    <div class="header">
        <h2>Login Sistem</h2>
    </div>

    <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
    ?>

    <form method="POST" action="proses_login.php">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <br><br>
        <button class="btn">Login</button>
    </form>
</div>