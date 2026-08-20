<?php

// struk.php

include 'includes/cek_session.php';
include 'config/koneksi.php';

/* Cek ID transaksi */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: riwayat_transaksi.php");
    exit;
}

$id_transaksi = $_GET['id'];

$sql_header = "SELECT t.*, u.nama_lengkap AS nama_kasir, p.nama_pelanggan";
$sql_header .= " FROM tbl_transaksi t";
$sql_header .= " JOIN tbl_user u ON t.id_kasir = u.id_user";
$sql_header .= " LEFT JOIN tbl_pelanggan p ON t.id_pelanggan = p.id_pelanggan";
$sql_header .= " WHERE t.id_transaksi = '$id_transaksi'";

$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_header));

/* Jika transaksi tidak ditemukan */
if (!$transaksi) {
    header("Location: riwayat_transaksi.php");
    exit;
}

$sql_detail = "SELECT d.jumlah, d.subtotal, b.nama_barang, b.harga_satuan";
$sql_detail .= " FROM tbl_detail_transaksi d";
$sql_detail .= " JOIN tbl_barang b ON d.id_barang = b.id_barang";
$sql_detail .= " WHERE d.id_transaksi = '$id_transaksi'";

$detail = mysqli_query($koneksi, $sql_detail);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk Transaksi - Warung ABC</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6f9;
            padding: 30px 15px;
            color: #333;
        }

        h2 {
            max-width: 750px;
            margin: auto;
            padding: 22px;
            text-align: center;
            background: #2e7d32;
            color: white;
            border-radius: 12px 12px 0 0;
            font-size: 28px;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0,0,0,.15);
        }

        body > p {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 20px;
            line-height: 1.8;
            border-left: 5px solid #4caf50;
            box-shadow: 0 3px 10px rgba(0,0,0,.10);
        }

        table {
            width: 100%;
            max-width: 750px;
            margin: 20px auto 0;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,.10);
        }

        table th {
            background: #2e7d32;
            color: white;
            padding: 13px 10px;
            text-align: center;
            font-size: 14px;
        }

        table td {
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            text-align: center;
        }

        table td:first-child {
            text-align: left;
        }

        table tr:nth-child(even) {
            background: #f8fbf7;
        }

        table tr:hover {
            background: #f1f8e9;
        }

        table tr:last-child {
            background: #2e7d32;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        table tr:last-child:hover {
            background: #388e3c;
        }

        table tr:last-child td {
            padding: 15px 10px;
            border-bottom: none;
        }

        body > p:last-child {
            max-width: 750px;
            margin: 20px auto 0;
            padding: 10px 0;
            text-align: center;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        button,
        a {
            display: inline-block;
            padding: 11px 20px;
            margin: 5px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s ease;
        }

        button {
            border: none;
            background: #4caf50;
            color: white;
        }

        button:hover {
            background: #388e3c;
            transform: translateY(-1px);
        }

        a {
            background: #2e7d32;
            color: white;
        }

        a:hover {
            background: #388e3c;
            transform: translateY(-1px);
        }

        @media print {

            body {
                background: white;
                padding: 0;
            }

            h2 {
                background: white;
                color: #2e7d32;
                border-radius: 0;
                box-shadow: none;
                border-bottom: 2px solid #2e7d32;
            }

            body > p {
                box-shadow: none;
                border-left: none;
            }

            table {
                box-shadow: none;
            }

            table th {
                background: #2e7d32 !important;
                color: white !important;
                border: 1px solid #2e7d32;
            }

            table td {
                border: 1px solid #999;
            }

            table tr:last-child {
                background: white !important;
                color: #000 !important;
            }

            button,
            a {
                display: none;
            }

        }

        @media (max-width: 600px) {

            body {
                padding: 15px 8px;
            }

            h2 {
                font-size: 22px;
                padding: 17px;
            }

            body > p {
                font-size: 14px;
                padding: 15px;
            }

            table {
                font-size: 12px;
            }

            table th,
            table td {
                padding: 9px 6px;
            }

            button,
            a {
                width: 100%;
                margin: 5px 0;
            }

        }

    </style>

</head>

<body>

    <h2>Warung ABC</h2>

    <p>

        No. Transaksi:
        <?php echo $transaksi['no_transaksi']; ?>

        <br>

        Tanggal:
        <?php echo $transaksi['tanggal']; ?>

        <br>

        Kasir:
        <?php echo $transaksi['nama_kasir']; ?>

        <br>

        Pelanggan:
        <?php echo $transaksi['nama_pelanggan'] ? $transaksi['nama_pelanggan'] : 'Umum'; ?>

    </p>

    <table border="1" cellpadding="6">

        <tr>

            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>

        </tr>

        <?php while ($item = mysqli_fetch_assoc($detail)) { ?>

        <tr>

            <td>
                <?php echo $item['nama_barang']; ?>
            </td>

            <td>
                Rp<?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?>
            </td>

            <td>
                <?php echo $item['jumlah']; ?>
            </td>

            <td>
                Rp<?php echo number_format($item['subtotal'], 0, ',', '.'); ?>
            </td>

        </tr>

        <?php } ?>

        <tr>

            <td colspan="3">
                Total Bayar
            </td>

            <td>
                Rp<?php echo number_format($transaksi['total_bayar'], 0, ',', '.'); ?>
            </td>

        </tr>

    </table>

    <p>

        <button onclick="window.print();">
            Cetak Struk
        </button>

        <a href="riwayat_transaksi.php">
            Kembali ke Riwayat Transaksi
        </a>

    </p>

</body>

</html>