<?php
//dashboard.php
include 'includes/cek_session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Warung ABC</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg,#e8f5e9,#f5f5f5);
}


/* NAVBAR */

.navbar{
    background:linear-gradient(135deg,#1b5e20,#4caf50);
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
    box-shadow:0 5px 15px rgba(0,0,0,.2);
}


.navbar h2{
    font-size:28px;
    letter-spacing:1px;
}


.logout{
    text-decoration:none;
    background:#c62828;
    color:white;
    padding:12px 25px;
    border-radius:30px;
    font-weight:bold;
    transition:.3s;
}


.logout:hover{
    background:#8e0000;
    transform:scale(1.05);
}



/* CONTAINER */

.container{
    width:90%;
    max-width:1100px;
    margin:40px auto;
}



/* WELCOME CARD */

.welcome{

    background:white;
    padding:35px;
    border-radius:20px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.12);

    border-left:8px solid #4caf50;

    animation:slide .5s ease;
}


@keyframes slide{

    from{
        opacity:0;
        transform:translateY(-20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}



.welcome h1{

    color:#1b5e20;
    font-size:30px;
    margin-bottom:15px;

}



.welcome p{

    color:#555;
    font-size:18px;

}



.welcome strong{

    color:#4caf50;

}



/* MENU */

.menu{

    margin-top:30px;

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:25px;

}



/* CARD */

.card{

    background:white;

    padding:35px 20px;

    text-align:center;

    border-radius:20px;

    box-shadow:
    0 8px 20px rgba(0,0,0,.12);

    transition:.4s;

    position:relative;

    overflow:hidden;

    height:185px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

}


.card::before{

    content:"";

    position:absolute;

    width:100%;

    height:5px;

    top:0;

    left:0;

    background:#4caf50;

}



.card:hover{

    transform:translateY(-10px);

    box-shadow:
    0 15px 30px rgba(0,0,0,.2);

}



.card a{

    text-decoration:none;

    color:#1b5e20;

    font-size:22px;

    font-weight:bold;

    display:block;

}



.card p{

    margin-top:15px;

    color:#777;

    font-size:15px;

    line-height:1.5;

}



/* ============================= */
/* LAPORAN HARIAN */
/* ============================= */

.card.laporan-harian{

    grid-column:1;

    grid-row:2;

}



/* ============================= */
/* LAPORAN BULANAN */
/* ============================= */

.card.laporan-bulanan{

    grid-column:2;

    grid-row:2;

}



/* ============================= */
/* ICON LAPORAN */
/* ============================= */

.laporan-icon{

    width:50px;

    height:50px;

    margin-bottom:10px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:25px;

    background:#e8f5e9;

}



/* FOOTER */

footer{

    text-align:center;

    margin-top:50px;

    padding:20px;

    color:#777;

    font-size:14px;

}



/* RESPONSIVE */

@media(max-width:900px){

    .menu{

        grid-template-columns:
        repeat(2,1fr);

    }


    .card.laporan-harian{

        grid-column:1;

        grid-row:3;

    }


    .card.laporan-bulanan{

        grid-column:2;

        grid-row:3;

    }

}



@media(max-width:600px){

    .navbar{

        padding:20px;

    }


    .navbar h2{

        font-size:20px;

    }


    .logout{

        padding:8px 15px;

    }


    .welcome h1{

        font-size:22px;

    }


    .menu{

        grid-template-columns:1fr;

    }


    .card{

        height:185px;

    }


    .card.laporan-harian,
    .card.laporan-bulanan{

        grid-column:auto;

        grid-row:auto;

    }

}

</style>

</head>


<body>


<div class="navbar">

    <h2>🏪 Warung ABC</h2>

    <a href="logout.php" class="logout">
        Logout
    </a>

</div>



<div class="container">


    <div class="welcome">

        <h1>
            Selamat Datang,
            <?php echo $_SESSION['nama_lengkap']; ?> 👋
        </h1>

        <p>
            Anda login sebagai :
            <strong>
            <?php echo ucfirst($_SESSION['role']); ?>
            </strong>
        </p>

    </div>


    <div class="menu">


        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>

        <div class="card">

            <a href="data_barang.php">
                📦 Data Barang
            </a>

            <p>
                Kelola stok dan informasi barang.
            </p>

        </div>
    
        <?php } ?>


        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>


        <div class="card">

            <a href="transaksi.php">
                🛒 Transaksi Kasir
            </a>

            <p>
                Melakukan transaksi penjualan.
            </p>

        </div>


        <div class="card">

            <a href="riwayat_transaksi.php">
                📋 Riwayat Transaksi
            </a>

            <p>
                Melihat laporan transaksi.
            </p>

        </div>


        <!-- LAPORAN HARIAN -->

        <div class="card laporan-harian">

            <div class="laporan-icon">
                📊
            </div>

            <a href="laporan_harian.php">
                Laporan Harian
            </a>

            <p>
                Lihat seluruh laporan transaksi harian.
            </p>

        </div>


        <!-- LAPORAN BULANAN -->

        <div class="card laporan-bulanan">

            <div class="laporan-icon">
                📈
            </div>

            <a href="laporan_bulanan.php">
                Laporan Bulanan
            </a>

            <p>
                Lihat seluruh laporan transaksi bulanan.
            </p>

        </div>


        <?php } ?>

    </div>

</div>

<footer>

    © <?php echo date("Y"); ?> Sistem Kasir Warung ABC

</footer>
</body>
</html>