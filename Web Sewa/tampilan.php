<?php
session_start();
if (!isset($_SESSION["id_penyewa"])) {
  header("location:login_penyewa.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("configsewa.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>"BOBOHO" | Sewa Kaos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <script type="text/javascript">
      Detail = (item) => {
        document.getElementById('kode_kostum').value = item.kode_kostum;
        document.getElementById("nama_kostum").innerHTML = item.nama_kostum;
        document.getElementById("harga_sewa").innerHTML = "Harga : Rp " + item.harga_sewa + " per Hari.";
        document.getElementById("stok").innerHTML = "Stok : " + item.stok + " Tersedia.";
        document.getElementById("lama_sewa").vaue = "1";

        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
    <style media="screen">
        *{
            box-sizing:border-box;
        }
        .footer{
            color:white;
            font-size: 15px;
            text-decoration: none;
        }
        .footer:hover{
            color: white;
            text-decoration: none;
        }
        body{
            background-image: url(content/css.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .judulin{
            color: white;
            font-size: 85px;
            font-family:Arial;
            font-style:inherit;
            padding-top: 265px;
            text-shadow: 3px 3px 3px black;
        }
        .judul2{
            color: white;
            font-size: 25px;
            font-family:Arial;
            font-style:inherit;
            text-shadow: 2px 2px 2px black;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <a class="navbar-brand" href="#">"BOBOHO"</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#home"  style="color : #000000">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.instagram.com/shafrilrzqn/?hl=id" target="blank"  style="color : #000000">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color : #000000">
            Penyewaan
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="d_sewa.php">Dalam Penyewaan (<?php echo count($_SESSION["d_sewa"]); ?>)</a>
            <a class="dropdown-item" href="sewa.php">Selesai </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" style="color : #000000"><?php echo $_SESSION["nama"] ?></a>
        </li>
        <li class="nav-item">
          <a href="proses_login_penyewa.php?logout=true" class="nav-link" style="color : #000000"><i class="fa fa-sign-out-alt"></i></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="tampilan.php">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-md my-2 my-sm-0 text-white" type="submit" style="background-color : #242424">Search</button>
      </form>
    </div>
  </nav>
  <div class="col-sm-12"  id="home">
     <h1 class="judulin" align="center">"BOBOHO Merchandise"</h1>
  </div>
  <div class="col-sm-12"  id="home">
    <h1 class="judul2" align="center">- Sewa Kaos Distro -</h1>
  </div>
  <?php
  // membuat perintah sql untuk menampilkan data siswa
  if (isset($_POST["cari"])) {
    // query jika pencarian
    $cari = $_POST["cari"];
    $sql = "select * from kostum where nama_kostum like '%$cari%'";
  }else {
    // query jika tidak mencari
    $sql = "select * from kostum";
  }

  // eksekusi sqlnya
  $query = mysqli_query($connect, $sql);
   ?>
   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container" id="home">
      <div class="row">
        <div class="col-md-12" align="center">
          <form action="tampilan.php" method="post">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search..." name="cari">
              <div class="input-group-append">
                <button class="btn btn-block bg-dark text-white" type="submit">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
          <?php foreach ($query as $kostum): ?>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3">
              <div class="card border-dark m-0.5 mt-4">
                <img src="<?php echo 'image/'.$kostum['image']; ?>" alt="Foto Cover" width="100%" height="255" />
                <div class="card-header text-white" style="background-color : #242424" align="center"><?php echo $kostum["nama_kostum"]; ?></div>
                <div class="card-body border-dark" align="center"><?php echo "Rp " .$kostum["harga_sewa"]; ?></div>
                <div class="card-footer bg-light border-dark">
                  <center><button type="button" name="info" class="btn btn-sm btn-outline-dark text-center" onclick='Detail(<?php echo json_encode($kostum); ?>)'
                    data-toggle="modal" data-target="#modal_detail">Lihat</button></center>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
      <div class="modal fade" id="modal_detail">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color : #242424" >
              <h4 class="text-white">Detail Kaos</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <!-- gambar -->
                  <img style="width:100%; height: auto;" id="image">
                </div>
                <div class="col-6">
                  <!-- deskripsi -->
                  <h3 id="nama_kostum"></h3>
                  <h3></h3>
                  <h6 id="harga_sewa"></h6>
                  <h6 id="stok"></h6>
                  <h3>-------------------</h3>

                  <form action="proses_sewa.php" method="post">
                    <input type="hidden" name="kode_kostum" id="kode_kostum">
                    <h6>Lama Sewa : </h6>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" name="lama_sewa" id="lama_sewa" min="1"  aria-label="Lama Sewa" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Hari</span>
                      </div>
                    </div>
                    <!-- <input type="number" name="lama_sewa" id="lama_sewa" class="form-control" min="1"> -->
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">
                      Tutup
                    </button>
                    <button type="submit" name="sewa" class="btn btn-outline-dark my-2">
                      Sewa
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
   <div class="footer" align="center">
       &copy; Copyright by
        <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">"BOBOHO"</a>
   </div>
   <br><br>
  </body>
</html>
