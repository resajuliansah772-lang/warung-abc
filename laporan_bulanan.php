<?php

// laporan_harian.php

include 'includes/cek_session.php';

include 'config/koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');

$bulan = mysqli_real_escape_string($koneksi, $bulan);

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama";

$sql .= " FROM tbl_transaksi t JOIN tbl_user u ON t.id_kasir = u.id_user";

$sql .= " WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC";

$hasil = mysqli_query($koneksi, $sql);

$total_bulanan = 0;

$jumlah_transaksi = 0;

?>

<!DOCTYPE html>

<html>

<head>

    <title>Laporan Bulanan - Warung ABC</title>

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

        form{
            margin-bottom:20px;
            padding:15px;
            background:#f1f8e9;
            border-radius:8px;
        }

        form input[type="month"]{
            padding:9px 12px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:14px;
            margin-left:5px;
        }

        form input[type="submit"]{
            background:#4caf50;
            color:white;
            border:none;
            padding:9px 18px;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;
            margin-left:5px;
        }

        form input[type="submit"]:hover{
            background:#388e3c;
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

        p{
            margin-top:12px;
            padding:10px;
            background:#f1f8e9;
            border-radius:6px;
            font-size:15px;
        }

        p:last-of-type{
            font-weight:bold;
        }

        p:last-child{
            background:transparent;
            padding:0;
        }

        p a{
            display:inline-block;
            margin-top:20px;
            background:#4caf50;
            color:white;
            text-decoration:none;
            padding:10px 18px;
            border-radius:6px;
        }

        p a:hover{
            background:#388e3c;
        }

        @media(max-width:768px){

            body{
                padding:15px;
            }

            .container{
                padding:15px;
            }

            table{
                display:block;
                overflow-x:auto;
                white-space:nowrap;
            }

            form{
                line-height:40px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <h1>Laporan Transaksi Bulanan</h1>

    <form method="GET">

        Bulan: <input type="month" name="bulan" value="<?php echo $bulan; ?>">

        <input type="submit" value="Tampilkan">

    </form>

    <table border="1" cellpadding="6">

        <tr>
            <th>No. Transaksi</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total Bayar</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($hasil)) {

            $total_bulanan += $row['total_bayar'];

            $jumlah_transaksi++;

        ?>

        <tr>

            <td><?php echo $row['no_transaksi']; ?></td>

            <td><?php echo $row['tanggal']; ?></td>

            <td><?php echo $row['nama']; ?></td>

            <td>
                <strong>
                    Rp<?php echo number_format($row['total_bayar'], 0, ',', '.'); ?>
                </strong>
            </td>

        </tr>

        <?php } ?>

    </table>

    <p>
        Jumlah Transaksi: <?php echo $jumlah_transaksi; ?>
    </p>

    <p>
        Total Pendapatan Bulan Ini: Rp
        <?php echo number_format($total_bulanan, 0, ',', '.'); ?>
    </p>

    <p>
        <a href="dashboard.php">
            ← Kembali ke Dashboard
        </a>
    </p>

</div>

</body>

</html>