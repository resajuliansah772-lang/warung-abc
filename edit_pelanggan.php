<?php
// edit_pelanggan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id $_GET['id'];
$sql = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$hasil = mysqli_query($kobeksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html>
<head><title>Edit Pelanggan - Warung ABC</title></head>
<body>
    <h1>Edit Pelanggan</h1>
    <form action="hidden" name="id_pelanggan" 
</body>
</html>