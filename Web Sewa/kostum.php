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
       document.getElementById('kode_kostum').value = "";
       document.getElementById('nama_kostum').value = "";
       document.getElementById('harga_sewa').value = "";
       document.getElementById('stok').value = "";
     }
     Edit = (item) =>{
       document.getElementById('action').value = "update";
       document.getElementById('kode_kostum').value = item.kode_kostum;
       document.getElementById('nama_kostum').value = item.nama_kostum;
       document.getElementById('harga_sewa').value = item.harga_sewa;
       document.getElementById('stok').value = item.stok;
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
                 <li class="nav-item"><a href="kostum.php" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                 <li class="nav-item"><a href="penyewa.php" class="nav-link">Customer</a></li>
                 <li class="nav-item"><a href="#kostum" class="nav-link">Kaos</a></li>
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
       $sql = "select * from kostum where kode_kostum like '%$cari%' or nama_kostum like '%$cari%' or
       harga_sewa like '%$cari%' or stok like '%$cari%'";
     }else {
       // query jika tidak mencari
       $sql = "select * from kostum";
     }

     // eksekusi sqlnya
     $query = mysqli_query($connect, $sql);
      ?>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <div class="container" id="kostum">
        <div class="card">
          <div class="card-header text-white" style="background-color : #242424">
            <h4 align="center">Data Kaos</h4>
          </div>
          <div class="card-body">
            <form action="kostum.php" method="post">
              <input type="text" name="cari" class="form-control my-2" placeholder="Search..">
            </form>
            <table class="table table-bordered table-striped" border="1">
              <thead>
                <tr>
                  <th>Kode Kaos</th>
                  <th>Nama Kaos</th>
                  <th>Harga Sewa</th>
                  <th>Stok</th>
                  <th>Image</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query as $kostum): ?>
                  <tr>
                    <td><?php echo $kostum["kode_kostum"]; ?></td>
                    <td><?php echo $kostum["nama_kostum"]; ?></td>
                    <td><?php echo $kostum["harga_sewa"]; ?></td>
                    <td><?php echo $kostum["stok"]; ?></td>
                    <td>
                      <img src="<?php echo 'image/'.$kostum['image']; ?>" alt="Foto kaos" width="200" height="auto" />
                    </td>
                    <td>
                      <button data-toggle="modal" data-target="#modal_kostum" type="button" class="btn btn-sm btn-info"
                      onclick='Edit(<?php echo json_encode($kostum); ?>)'>
                        Edit
                      </button>
                      <a href="proses_crud_kostum.php?hapus=true&kode_kostum=<?php echo $kostum["kode_kostum"];?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_kostum"
                        onclick="Hapus(<?php  ?>);">
                          Hapus
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <button type="button" class="btn btn-sm text-white" data-toggle="modal" data-target="#modal_kostum" onclick="Add();" style="background-color : #242424">
              Tambah Data
            </button>
          </div>
          <div class="card-footer text-white" style="background-color : #242424">
            <h5 align="center">&copy; 1997</h5>
          </div>
        </div>
        <div class="modal fade" id="modal_kostum">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="proses_crud_kostum.php" method="post" enctype="multipart/form-data">
                <div class="modal-header text-white" style="background-color : #242424">
                  <h4>Form Kostum</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="action" id="action">
                  Kode Kaos
                  <input type="number" name="kode_kostum" id="kode_kostum" class="form-control" required/>
                  Nama Kaos
                  <input type="text" name="nama_kostum" id="nama_kostum" class="form-control" required/>
                  Harga Sewa
                  <input type="text" name="harga_sewa" id="harga_sewa" class="form-control" required/>
                  Stok
                  <input type="text" name="stok" id="stok" class="form-control" required/>
                  Foto
                  <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn text-white" style="background-color : #242424" data-dismiss="modal">
                    Tutup
                  </button>
                  <button type="submit" name="save_kostum" class="btn text-white" style="background-color : #242424">
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
