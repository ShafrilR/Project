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
                     <a class="dropdown-item" href="#">Dalam Penyewaan</a>
                     <a class="dropdown-item" href="sewa_a.php">Selesai </a>
                 </li>
                 <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link">Logout
                 </a>
             </ul>
         </div>
     </nav>
     <?php
     // membuat perintah sql untuk menampilkan data siswa
     $sql = "select * from kostum";

     // eksekusi sqlnya
     $query = mysqli_query($connect, $sql);
      ?>
        <br>
        <div class="container">
          <div class="card border-dark">
            <div class="card-header bg-dark border-dark">
              <h4 class="text-white">Dalam Penyewaan</h4>
            </div>
            <div class="card-body border-dark">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kaos</th>
                    <th>Harga Sewa</th>
                    <th>Lama Sewa</th>
                    <th>Total Harga</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($_SESSION["d_sewa"] as $d_sewa): ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $d_sewa["nama_kostum"]; ?></td>
                      <td>Rp <?php echo $d_sewa["harga_sewa"]; ?></td>
                      <td><?php echo $d_sewa["lama_sewa"]; ?> Hari</td>
                      <td>Rp <?php echo $d_sewa["lama_sewa"]*$d_sewa["harga_sewa"]; ?></td>
                      <td>
                        <a href="proses_sewa_a.php?selesai=true">
                          <button type="button" class="btn btn-sm btn-success">Selesai</button>
                        </a>
                      </td>
                    </tr>
                  <?php $no++; endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-right border-dark">
              <h5 align="center">&copy; 2020</h5>
            </div>
          </div>
        </div>
        <br>
       <!-- <div class="footer" align="center">
           &copy; Copyright by
            <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">Shafril</a>
       </div> -->
       <br>
   </body>
   </html>
