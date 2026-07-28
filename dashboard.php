<?php
//dashboard.php
include 'include/cek_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Warung ABC</title>
</head>
<body>
    <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?></h1>
    <p? Anda login sebagai: <?php echo $_SESSION['role']; ?></p>
    <a herf="logout.php">Logout</a>
</body>
</html>