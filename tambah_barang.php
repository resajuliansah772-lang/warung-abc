<?php include 'includes/cek_session.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Warung ABC</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f1f8e9;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:450px;
            background:#ffffff;
            padding:30px;
            border-radius:12px;
            box-shadow:0 8px 20px rgba(0,0,0,0.15);
        }

        h1{
            text-align:center;
            color:#2e7d32;
            margin-bottom:25px;
        }

        table{
            width:100%;
        }

        td{
            padding:8px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"]{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:14px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus{
            outline:none;
            border-color:#4caf50;
            box-shadow:0 0 5px rgba(76,175,80,0.4);
        }

        input[type="submit"]{
            width:100%;
            padding:12px;
            margin-top:10px;
            background:#4caf50;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }

        input[type="submit"]:hover{
            background:#388e3c;
        }

        .kembali{
            display:block;
            text-align:center;
            margin-top:20px;
            color:#2e7d32;
            text-decoration:none;
            font-weight:bold;
        }

        .kembali:hover{
            text-decoration:underline;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>Tambah Barang</h1>

    <form action="proses_tambah_barang.php" method="POST">
        <table>

            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="kode_barang" required>
                </td>
            </tr>

            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama_barang" required>
                </td>
            </tr>

            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td>
                    <input type="number" name="harga_satuan" step="0.01" required>
                </td>
            </tr>

            <tr>
                <td>Stok</td>
                <td>:</td>
                <td>
                    <input type="number" name="stok" required>
                </td>
            </tr>

            <tr>
                <td>Tanggal Kadaluarsa</td>
                <td>:</td>
                <td>
                    <input type="date" name="tanggal_kadaluarsa" required>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <input type="submit" value="Simpan">
                </td>
            </tr>

        </table>
    </form>

    <a href="data_barang.php" class="kembali">← Kembali</a>

</div>

</body>
</html>