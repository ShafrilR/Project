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
       document.getElementById('id_penyewa').value = "";
       document.getElementById('nama').value = "";
       document.getElementById('alamat').value = "";
       document.getElementById('kontak').value = "";
       document.getElementById('username').value = "";
       document.getElementById('password').value = "";
     }
     Edit = (item) =>{
       document.getElementById('action').value = "update";
       document.getElementById('id_penyewa').value = item.id_penyewa;
       document.getElementById('nama').value = item.nama;
       document.getElementById('alamat').value = item.alamat;
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
         color: white;
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
                 <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
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
     <div class="col-sm-12"  id="home">
        <h1 class="judulin" align="center">"BOBOHO Merchandise"</h1>
     </div>
     <div class="col-sm-12"  id="home">
       <h1 class="judul2" align="center">- Admin -</h1>
     </div>
     <?php
     // membuat perintah sql untuk menampilkan data siswa
     if (isset($_POST["cari"])) {
       // query jika pencarian
       $cari = $_POST["cari"];
       $sql = "select * from penyewa where id_penyewa like '%$cari%' or nama like '%$cari%' or alamat like '%$cari%' or
       kontak like '%$cari%' or username like '%$cari%' or password like '%$cari%'";
     }else {
       // query jika tidak mencari
       $sql = "select * from penyewa";
     }

     // eksekusi sqlnya
     $query = mysqli_query($connect, $sql);
      ?>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <br id="home">
      <div class="container" id="penyewa">
        <div class="card">
          <div class="card-header text-white" style="background-color : #242424">
            <h4 align="center">Customer</h4>
          </div>
          <div class="card-body">
            <form action="penyewa.php" method="post">
              <input type="text" name="cari" class="form-control my-2" placeholder="Search..">
            </form>
            <table class="table table-bordered table-striped" border="1">
              <thead>
                <tr>
                  <th>ID Customer</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query as $penyewa): ?>
                  <tr>
                    <td><?php echo $penyewa["id_penyewa"]; ?></td>
                    <td><?php echo $penyewa["nama"]; ?></td>
                    <td><?php echo $penyewa["alamat"]; ?></td>
                    <td><?php echo $penyewa["kontak"]; ?></td>
                    <td><?php echo $penyewa["username"]; ?></td>
                    <td><?php echo $penyewa["password"]; ?></td>
                    <td>
                      <button data-toggle="modal" data-target="#modal_penyewa" type="button" class="btn btn-sm btn-info"
                      onclick='Edit(<?php echo json_encode($penyewa); ?>)'>
                        Edit
                      </button>
                      <a href="proses_crud_penyewa.php?hapus=true&id_penyewa=<?php echo $penyewa["id_penyewa"];?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_penyewa"
                        onclick="Hapus(<?php  ?>);">
                          Hapus
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <button type="button" class="btn btn-sm text-white" data-toggle="modal" data-target="#modal_penyewa" onclick="Add();" style="background-color : #242424">
              Tambah Data
            </button>
          </div>
          <div class="card-footer text-white" style="background-color : #242424">
            <h5 align="center">&copy; 1997</h5>
          </div>
        </div>
        <div class="modal fade" id="modal_penyewa">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="proses_crud_penyewa.php" method="post" enctype="multipart/form-data">
                <div class="modal-header text-white" style="background-color : #242424">
                  <h4>Form Customer</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="action" id="action">
                  ID Customer
                  <input type="number" name="id_penyewa" id="id_penyewa" class="form-control" required/>
                  Nama
                  <input type="text" name="nama" id="nama" class="form-control" required/>
                  Alamat
                  <input type="text" name="alamat" id="alamat" class="form-control" required/>
                  Kontak
                  <input type="text" name="kontak" id="kontak" class="form-control" required/>
                  Username
                  <input type="text" name="username" id="username" class="form-control" required/>
                  Password
                  <input type="text" name="password" id="password" class="form-control" required/>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn text-white" data-dismiss="modal" style="background-color : #242424">
                    Tutup
                  </button>
                  <button type="submit" name="save_penyewa" class="btn text-white" style="background-color : #242424">
                    Simpan
                  </button>
                </div>
              </form>
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