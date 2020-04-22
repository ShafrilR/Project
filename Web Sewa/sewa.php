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
        document.getElementById("lama_sewa").max = item.stok;

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
          <a class="nav-link" href="tampilan.php"  style="color : #000000">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.instagram.com/shafrilrzqn/?hl=id" target="blank" style="color : #000000">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color : #000000">
            Penyewaan
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="d_sewa.php">Dalam Penyewaan (<?php echo count($_SESSION["d_sewa"]); ?>)</a>
            <a class="dropdown-item" href="#">Selesai </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" style="color : #000000"><?php echo $_SESSION["nama"] ?></a>
        </li>
        <li class="nav-item">
          <a href="proses_login_penyewa.php?logout=true" class="nav-link" style="color : #000000"><i class="fa fa-sign-out-alt"></i></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-md my-2 my-sm-0 text-white" type="submit" style="background-color : #242424">Search</button>
      </form>
    </div>
  </nav>
  <br>
  <div class="container">
    <div class="card mt-3">
      <div class="card-header" style="background-color : #242424">
        <h4 class="text-white">Riwayat Penyewaan</h4>
      </div>
      <div class="card-body border-dark">
        <?php
        $sql = "select * from sewa s inner join penyewa p
        on s.id_penyewa = p.id_penyewa
        where s.id_penyewa = '".$_SESSION["id_penyewa"]."' order by s.tgl desc";
        // echo $sql;
        $query = mysqli_query($connect, $sql);
         ?>
         <ul class="list-group">
           <?php foreach ($query as $sewa): ?>
             <li class="list-group-item mb-4">
             <h6>ID Penyewaan: <?php echo $sewa["id_sewa"]; ?></h6>
             <h6>Nama Penyewa: <?php echo $sewa["nama"]; ?></h6>
             <h6>Tgl. Pengembalian: <?php echo $sewa["tgl"]; ?></h6>
             <h6>List Penyewaan: </h6>

             <?php
             $sql2 = "select * from detail_sewa d inner join kostum k
             on d.kode_kostum = k.kode_kostum
             where d.id_sewa = '".$sewa["id_sewa"]."'";
             $query2 = mysqli_query($connect, $sql2);
              ?>

              <table class="table table-borderless table hover">
                <thead>
                  <tr>
                    <th>Nama Kostum</th>
                    <th>Lama Sewa</th>
                    <th>Harga Sewa</th>
                    <th>Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $total = 0; foreach ($query2 as $detail): ?>
                    <tr>
                      <td><?php echo $detail["nama_kostum"] ?></td>
                      <td><?php echo $detail["lama_sewa"] ?> Hari</td>
                      <td>Rp <?php echo number_format($detail["totharga_sewa"]); ?></td>
                      <td>
                        Rp <?php echo number_format($detail["totharga_sewa"]*$detail["lama_sewa"]); ?>
                      </td>
                    </tr>
                  <?php $total += ($detail['totharga_sewa']*$detail["lama_sewa"]); endforeach; ?>
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
      <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">"BOBOHO"</a>
 </div>
 <br>
</body>
</html>
