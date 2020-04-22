<?php
session_start();
if (!isset($_SESSION["id_customer"])) {
  header("location:login_customer.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("configtoko.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Buku</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <script type="text/javascript">
      Detail = (item) => {
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById("judul").innerHTML = item.judul;
        document.getElementById("penulis").innerHTML = "Penulis : " + item.penulis;
        document.getElementById("harga").innerHTML = "Harga : Rp " + item.harga;
        document.getElementById("stok").innerHTML = "Stok : " + item.stok;
        document.getElementById("jumlah_beli").vaue = "1";
        document.getElementById("jumlah_beli").max = item.stok;

        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
    <style media="screen">
        *{
            box-sizing:border-box;
        }
        [class*="col-"] {float: left; padding: 15px;}
        [class*="col-"] {width: 100%;}
        .cover{
            background: url("content/tokonya.jpg");
            background-size: cover;
            height: 88vh;
        }
        @media only screen and (max-width: 1090px) {
            .judul{
                display: none;
            }
        }
        @media only screen and (min-width: 561px) {
            .judul{
                color: #f7dd45;
                font-size: 70px;
                font-family:cursive;
                font-variant: initial;
                margin-top: 228px;
                text-shadow: 5px 5px 5px black;
            }
        }
        .logo{
            margin-top: 117px;
            width: 300px;
        }
        .footer{
            color:black;
            font-size: 15px;
            text-decoration: none;
        }
        .user{
          color: #f7dd45;
        }
        .footer:hover{
          color: black;
          text-decoration: none;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top" id="home">
        <a href=""target="blank">
            <img src="content/1.png" width="70">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ">
              <li class="nav-item"><a href="" class="nav-link"></i></a></li>
              <li class="nav-item"><a href="" class="nav-link"></a></li>
              <li class="nav-item"><a href="tampilan_customer.php" class="nav-link"><i class="fa fa-home"></i></a></li>
              <li class="nav-item"><a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="nav-link"><i class="fa fa-phone-alt"></i></a></li>
              <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> (<?php echo count($_SESSION["cart"]); ?>)</a></li>
              <li class="nav-item"><a href="" class="nav-link link-disabled text-warning"><i class="fa fa-user"></i></a></li>
              <li class="nav-item"><a href="" class="nav-link text-warning"><?php echo $_SESSION["nama"] ?></a></li>
              <li class="nav-item"><a href="proses_login_customer.php?logout=true" class="nav-link text-danger"><i class="fa fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>
    <?php
    // membuat perintah sql untuk menampilkan data siswa
    if (isset($_POST["cari"])) {
      // query jika pencarian
      $cari = $_POST["cari"];
      $sql = "select * from buku where judul like '%$cari%' or penulis like '%$cari%'";
    }else {
      // query jika tidak mencari
      $sql = "select * from buku";
    }

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
    <div class="container-fluid cover">
        <div class="row">
            <div class="col-lg-6 col-sm-12 text-center">
                <img src="content/2.png" class="logo">
            </div>
            <div class="col-lg-6 col-sm-12">
                <h1 class="judul text-left">Toko Buku</h1>
            </div>
        </div>
    </div>
     <br>
     <br>
     <br>
     <div class="container">
       <div class="row">
         <div class="card col-md-12" align="center">
           <form action="tampilan_customer.php" method="post">
             <div class="input-group">
               <input type="text" class="form-control" placeholder="Search..." name="cari">
               <div class="input-group-append">
                 <button class="btn btn-block bg-dark text-white" type="submit">Search</button>
               </div>
             </div>
           </form>
         </div>
       </div>
       <br>
       <div class="row">
           <?php foreach ($query as $buku): ?>
             <div class="card col-md-3">
               <img src="<?php echo 'image/'.$buku['image']; ?>" alt="Foto Cover" width="253" height="253" />
               <div class="card-header bg-dark text-white" align="center"><?php echo $buku["judul"]; ?></div>
               <div class="card-body" align="center"><?php echo "Rp " .$buku["harga"]; ?></div>
               <div class="card-footer bg-light">
                 <center><button type="button" name="info" class="btn btn-sm btn-dark text-center" onclick='Detail(<?php echo json_encode($buku); ?>)'
                   data-toggle="modal" data-target="#modal_detail">Beli</button></center>
               </div>
             </div>
           <?php endforeach; ?>
       </div>
       <div class="modal fade" id="modal_detail">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-dark">
               <h4 class="text-white">Detail Buku</h4>
             </div>
             <div class="modal-body">
               <div class="row">
                 <div class="col-6">
                   <!-- gambar -->
                   <img style="width:100%; height: auto;" id="image">
                 </div>
                 <div class="col-6">
                   <!-- deskripsi -->
                   <h3 id="judul"></h3>
                  <h3></h3>
                   <h6 id="penulis"></h6>
                   <h6 id="harga"></h6>
                   <h6 id="stok"></h6>
                   <h3>-------------------</h3>

                   <form action="proses_cart.php" method="post">
                     <input type="hidden" name="kode_buku" id="kode_buku">
                     <h6>Jumlah Beli : </h6>
                     <input type="number" name="jumlah_beli" id="jumlah_beli" class="form-control" min="1">
                     <button type="button" class="btn btn-dark" data-dismiss="modal">
                       Tutup
                     </button>
                     <button type="submit" name="add_to_cart" class="btn btn-dark my-2">
                       Add to Cart
                     </button>
                   </form>
                 </div>
               </div>
             </div>
           </div>
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
