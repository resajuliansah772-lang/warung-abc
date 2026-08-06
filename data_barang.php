<?php
//data_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM tbl_barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Warung ABC</title>

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
            max-width:1100px;
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

        .menu{
            margin-bottom:20px;
        }

        .menu a{
            text-decoration:none;
            background:#4caf50;
            color:white;
            padding:10px 15px;
            border-radius:5px;
            margin-right:5px;
            display:inline-block;
        }

        .menu a:hover{
            background:#388e3c;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th{
            background:#2e7d32;
            color:white;
            padding:12px;
        }

        table td{
            padding:10px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        table tr:hover{
            background:#f1f8e9;
        }

        .edit{
            color:#1565c0;
            text-decoration:none;
            font-weight:bold;
        }

        .hapus{
            color:#d32f2f;
            text-decoration:none;
            font-weight:bold;
        }

        .edit:hover,
        .hapus:hover{
            text-decoration:underline;
        }

        .rupiah{
            text-align:right;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>Data Barang</h1>

    <div class="menu">
        <a href="dashboard.php">← Kembali ke Dashboard</a>
        <a href="tambah_barang.php">+ Tambah Barang</a>
    </div>


    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Stok</th>
            <th>Kadaluarsa</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>

        <tr>
            <td><?php echo $row['kode_barang']; ?></td>

            <td><?php echo $row['nama_barang']; ?></td>

            <td class="rupiah">
                Rp <?php echo number_format($row['harga_satuan'],0,',','.'); ?>
            </td>

            <td><?php echo $row['stok']; ?></td>

            <td><?php echo $row['tanggal_kadaluarsa']; ?></td>

            <td>
                <a class="edit" href="edit_barang.php?id=<?php echo $row['id_barang']; ?>">
                    Edit
                </a>
                |
                <a class="hapus" 
                   href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>"
                   onclick="return confirm('Yakin hapus barang ini?');">
                    Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>