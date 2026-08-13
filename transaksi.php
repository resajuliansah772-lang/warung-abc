<?php
// transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");

$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
    $sql_pelanggan = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
    $hasil_pelanggan = mysqli_query($koneksi, $sql_pelanggan);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi - Warung ABC</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:1000px;
            margin:auto;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }

        h1{
            text-align:center;
            color:#2e7d32;
            margin-bottom:20px;
        }

        h3{
            color:#333;
            margin:20px 0 10px;
        }

        .error{
            background:#ffdddd;
            color:#c62828;
            padding:10px;
            border-radius:5px;
            margin-bottom:15px;
            text-align:center;
        }

        select,
        input[type="number"]{
            padding:10px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        input[type="submit"]{
            padding:10px 15px;
            background:#4caf50;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        input[type="submit"]:hover{
            background:#388e3c;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        th{
            background:#2e7d32;
            color:white;
            padding:12px;
        }

        td{
            padding:10px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        tr:hover{
            background:#f1f8e9;
        }

        .hapus{
            color:#d32f2f;
            text-decoration:none;
            font-weight:bold;
        }

        .kembali{
            display:inline-block;
            margin-top:20px;
            color:#2e7d32;
            text-decoration:none;
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="container">

<h1>Transaksi Penjualan</h1>


<?php
if (isset($_SESSION['pesan_error'])) {
    echo '<p class="error">'.$_SESSION['pesan_error'].'</p>';
    unset($_SESSION['pesan_error']);
}
?>


<h3>Pilih Barang</h3>

<form action="proses_tambah_keranjang.php" method="POST">

    <select name="id_barang" required>
        <?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>
        <option value="<?php echo $b['id_barang']; ?>">
            <?php echo $b['nama_barang'].' (Stok: '.$b['stok'].')'; ?>
        </option>
        <?php } ?>
    </select>

    Jumlah:
    <input type="number" name="jumlah" min="1" required>
    <input type="submit" value="Tambah ke Keranjang">
</form>
<form action="proses_simpan_transaksi.php" method="POST">
    Pelanggan:
    <select name="id_pelanggan">
        <option value="">--Pelanggan Umum --</option>
        <?php while ($p = mysqli_fetch_assoc($hasil_pelanggan)) { ?>
        <option value="<?php echo $p['id_pelanggan']; ?>">
            <?php echo $p['nama_pelanggan']; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Simpan Transaksi">
</form>


<h3>Keranjang</h3>

<table>

<tr>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>


<?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>

<tr>

<td>
    <?php echo $item['nama_barang']; ?>
</td>

<td>
    Rp <?php echo number_format($item['harga'],0,',','.'); ?>
</td>

<td>
    <?php echo $item['jumlah']; ?>
</td>

<td>
    Rp <?php echo number_format($item['subtotal'],0,',','.'); ?>
</td>

<td>
    <a class="hapus" 
       href="hapus_keranjang.php?id=<?php echo $id_barang; ?>"
       onclick="return confirm('Hapus barang dari keranjang?');">
       Hapus
    </a>
</td>

</tr>

<?php } ?>


<tr>
    <td colspan="3"><b>Total</b></td>
    <td colspan="2">
        <b>Rp <?php echo number_format($total,0,',','.'); ?></b>
    </td>
</tr>


</table>


<br>

<form action="proses_simpan_transaksi.php" method="POST">
    <input type="submit" value="Simpan Transaksi">
</form>


<a class="kembali" href="dashboard.php">
    ← Kembali ke Dashboard
</a>


</div>

</body>
</html>