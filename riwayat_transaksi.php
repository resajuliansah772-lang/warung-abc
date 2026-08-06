<?php
// riwayat_transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir
        FROM tbl_transaksi t 
        JOIN tbl_user u ON t.id_kasir = u.id_user 
        ORDER BY t.tanggal DESC";

$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Warung ABC</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
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
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }

        h1{
            text-align:center;
            color:#2e7d32;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
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

        .total{
            text-align:right;
            font-weight:bold;
        }

        .kembali{
            display:inline-block;
            margin-top:20px;
            background:#4caf50;
            color:white;
            text-decoration:none;
            padding:10px 18px;
            border-radius:6px;
        }

        .kembali:hover{
            background:#388e3c;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>Riwayat Transaksi</h1>

    <table>
        <tr>
            <th>No Transaksi</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>

        <tr>
            <td>
                <?php echo $row['no_transaksi']; ?>
            </td>

            <td>
                <?php echo $row['tanggal']; ?>
            </td>

            <td>
                <?php echo $row['nama_kasir']; ?>
            </td>

            <td>
                Rp <?php echo number_format($row['total_bayar'],0,',','.'); ?>
            </td>
        </tr>

        <?php } ?>

    </table>

    <a href="dashboard.php" class="kembali">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>