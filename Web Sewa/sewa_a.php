<?php
session_start();
if (!isset($_SESSION["id_admin"])) {
  header("location:login_admin.php");
}
// memamnggil file configsewa.php
// agar tidak perlu membuat koneksi baru
include("configsewa.php");
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>"BOBOHO" | Admin</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
     <script src="../assets/js/jquery.min.js"></script>
     <script src="../assets/js/popper.min.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
     <script type="text/javascript">
     Add = () =>{
       document.getElementById('action').value = "insert";
       document.getElementById('id_admin').value = "";
       document.getElementById('nama').value = "";
       document.getElementById('kontak').value = "";
       document.getElementById('username').value = "";
       document.getElementById('password').value = "";
     }
     Edit = (item) =>{
       document.getElementById('action').value = "update";
       document.getElementById('id_admin').value = item.id_admin;
       document.getElementById('nama').value = item.nama;
       document.getElementById('kontak').value = item.kontak;
       document.getElementById('username').value = item.username;
       document.getElementById('password').value = item.password;
     }
     </script>
     <style media="screen">
     .footer:hover{
       color: white;
       text-decoration: none;
     }
     .footer{
         color:white;
         font-size: 15px;
         text-decoration: none;
     }
     body{
            background-image: url(content/bgg.jpg);
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
     <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background-color : #242424">
         <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
             <span class="navbar navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="menu">
             <ul class="navbar-nav">
                 <li class="nav-item"><a href="admin.php" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="#admin" class="nav-link">Admin</a></li>
                 <li class="nav-item"><a href="penyewa.php" class="nav-link">Customer</a></li>
                 <li class="nav-item"><a href="kostum.php" class="nav-link">Kaos</a></li>
                 <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                     Penyewaan
                   </a>
                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="detail_a.php">Dalam Penyewaan</a>
                     <a class="dropdown-item" href="sewa_a.php">Selesai </a>
                 </li>
                 <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link"> Logout</a></li>
             </ul>
         </div>
     </nav>
     <?php
     // membuat perintah sql untuk menampilkan data siswa
     $sql = "select * from sewa s inner join penyewa p
     on s.id_penyewa = p.id_penyewa";

     // eksekusi sqlnya
     $query = mysqli_query($connect, $sql);
      ?>
     <div class="container">
       <div class="card mt-3">
         <div class="card-header" style="background-color : #242424">
           <h4 class="text-white">Riwayat Penyewaan</h4>
         </div>
         <div class="card-body border-dark">
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
                         <td><?php echo $detail["lama_sewa"] ?></td>
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
