<?php
session_start();
if (!isset($_SESSION["id_admin"])) {
  header("location:login_admin.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("configtoko.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    </script>
    <style media="screen">
        *{
            box-sizing:border-box;
        }
        [class*="col-"] {float: left; padding: 15px;}
        [class*="col-"] {width: 100%;}
        .cover{
            background: url("content/library.jpg");
            background-size: cover;
            height: 90vh;
        }
        @media only screen and (max-width: 1090px) {
            .judul{
                display: none;
            }
        }
        @media only screen and (min-width: 561px) {
            .judul{
                color: white;
                font-size: 70px;
                font-family:cursive;
                font-variant: initial;
                margin-top: 265px;
                text-shadow: 5px 5px 5px black;
            }
        }

        .logo{
            margin-top: 170px;
            width: 350px;
        }
        .footer:hover{
          color: black;
          text-decoration: none;
        }
        .footer{
            color:black;
            font-size: 15px;
            text-decoration: none;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top" id="Home">
        <a href="" target="blank">
            <img src="content/logo.png" width="80">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>
                <li class="nav-item"><a href="buku.php" class="nav-link">Buku</a></li>
                <li class="nav-item"><a href="#transaksi" class="nav-link">Transaksi</a></li>
                <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link">
                  <?php echo $_SESSION["nama"] ?> | Logout
                </a>
            </ul>
        </div>
    </nav>
    <div class="container-fluid cover">
        <div class="row">
            <div class="col-lg-6 col-sm-12 text-center">
                <img src="content/logo.png" class="logo">
            </div>
            <div class="col-lg-6 col-sm-12">
                <h1 class="judul text-left">Toko Buku</h1>
            </div>
        </div>
    </div>
    <?php
    // membuat perintah sql untuk menampilkan data siswa
    $sql = "select * from transaksi t inner join customer c
    on t.id_customer = c.id_customer";

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
     <br>
     <br>
     <br>
     <div class="container" id="transaksi">
       <div class="card mt-3">
         <div class="card-header bg-dark">
           <h4 class="text-white">Transaksi Customer</h4>
         </div>
         <div class="card-body">
            <ul class="list-group">
              <?php foreach ($query as $transaksi): ?>
                <li class="list-group-item mb-4">
                <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
                <h6>List Barang: </h6>

                <?php
                $sql2 = "select * from detail_transaksi d inner join buku b
                on d.kode_buku = b.kode_buku
                where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                $query2 = mysqli_query($connect, $sql2);
                 ?>

                 <table class="table table-borderless table-hover">
                   <thead>
                     <tr>
                       <th>Judul</th>
                       <th>Jumlah</th>
                       <th>Harga</th>
                       <th>Total</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php $total = 0; foreach ($query2 as $detail): ?>
                       <tr>
                         <td><?php echo $detail["judul"] ?></td>
                         <td><?php echo $detail["jumlah"] ?></td>
                         <td>Rp <?php echo number_format($detail["harga_beli"]); ?></td>
                         <td>
                           Rp <?php echo number_format($detail["harga_beli"]*$detail["jumlah"]); ?>
                         </td>
                       </tr>
                     <?php $total += ($detail['harga_beli']*$detail["jumlah"]); endforeach; ?>
                   </tbody>
                 </table>
                 <h6 class="text-danger">Rp <?php echo number_format($total); ?></h6>
               </li>
              <?php endforeach; ?>
            </ul>
         </div>
       </div>
     </div>
     <br>
    <div class="footer" align="center">
        &copy; Copyright by
         <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">Shafril</a>
    </div>
    <br>
  </body>
</html>
