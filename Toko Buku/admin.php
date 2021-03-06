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
        *{
            box-sizing:border-box;
        }
        [class*="col-"] {float: left; padding: 15px;}
        [class*="col-"] {width: 100%;}
        .cover{
            background: url("content/library.jpg");
            background-size: cover;
            height: 91vh;
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
                <li class="nav-item"><a href="#admin" class="nav-link">Admin</a></li>
                <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>
                <li class="nav-item"><a href="buku.php" class="nav-link">Buku</a></li>
                <li class="nav-item"><a href="transaksi_a.php" class="nav-link">Transaksi</a></li>
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
    if (isset($_POST["cari"])) {
      // query jika pencarian
      $cari = $_POST["cari"];
      $sql = "select * from admin where id_admin like '%$cari%' or nama like '%$cari%' or
      kontak like '%$cari%' or username like '%$cari%' or password like '%$cari%'";
    }else {
      // query jika tidak mencari
      $sql = "select * from admin";
    }

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
     <br>
     <br>
     <br>
     <div class="container" id="admin">
       <div class="card">
         <div class="card-header bg-dark text-white">
           <h4 align="center">User Admin</h4>
         </div>
         <div class="card-body">
           <form action="admin.php" method="post">
             <input type="text" name="cari" class="form-control my-2" placeholder="Search..">
           </form>
           <table class="table table-bordered table-hover" border="1">
             <thead>
               <tr>
                 <th>ID Admin</th>
                 <th>Nama</th>
                 <th>Kontak</th>
                 <th>Username</th>
                 <th>Password</th>
                 <th>Option</th>
               </tr>
             </thead>
             <tbody>
               <?php foreach ($query as $admin): ?>
                 <tr>
                   <td><?php echo $admin["id_admin"]; ?></td>
                   <td><?php echo $admin["nama"]; ?></td>
                   <td><?php echo $admin["kontak"]; ?></td>
                   <td><?php echo $admin["username"]; ?></td>
                   <td><?php echo $admin["password"]; ?></td>
                   <td>
                     <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-info"
                     onclick='Edit(<?php echo json_encode($admin); ?>)'>
                       Edit
                     </button>
                     <a href="proses_crud_admin.php?hapus=true&id_admin=<?php echo $admin["id_admin"];?>"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                       <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_admin"
                       onclick="Hapus(<?php  ?>);">
                         Hapus
                       </button>
                     </a>
                   </td>
                 </tr>
               <?php endforeach; ?>
             </tbody>
           </table>
           <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_admin" onclick="Add();">
             Tambah Data
           </button>
         </div>
         <div class="card-footer bg-dark text-white">
           <h5 align="center">&copy; 1997</h5>
         </div>
       </div>
       <div class="modal fade" id="modal_admin">
         <div class="modal-dialog">
           <div class="modal-content">
             <form action="proses_crud_admin.php" method="post" enctype="multipart/form-data">
               <div class="modal-header bg-primary text-white">
                 <h4>Form Admin</h4>
               </div>
               <div class="modal-body">
                 <input type="hidden" name="action" id="action">
                 id_admin
                 <input type="number" name="id_admin" id="id_admin" class="form-control" required/>
                 Nama
                 <input type="text" name="nama" id="nama" class="form-control" required/>
                 Kontak
                 <input type="text" name="kontak" id="kontak" class="form-control" required/>
                 Username
                 <input type="text" name="username" id="username" class="form-control" required/>
                 Password
                 <input type="text" name="password" id="password" class="form-control" required/>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-dismiss="modal">
                   Tutup
                 </button>
                 <button type="submit" name="save_admin" class="btn btn-primary">
                   Simpan
                 </button>
               </div>
             </form>
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
