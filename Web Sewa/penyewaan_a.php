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

     </script>
     <style media="screen">
     body{
            background-image: url(content/bgg.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
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
                 <li class="nav-item"><a href="penyewaan_a.php" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                 <li class="nav-item"><a href="penyewa.php" class="nav-link">Customer</a></li>
                 <li class="nav-item"><a href="kostum.php" class="nav-link">Kaos</a></li>
                 <li class="nav-item"><a href="#penyewaan" class="nav-link">Penyewaan</a></li>
                 <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link">
                   <?php echo $_SESSION["nama"] ?> | Logout
                 </a>
             </ul>
         </div>
     </nav>
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
      <!-- <div class="container" id="transaksi">
        <div class="card mt-3">
          <div class="card-header bg-dark">
            <h4 class="text-white">Penyewaan</h4>
          </div>
          <div class="card-body">
             <ul class="list-group">
               <?php foreach ($query as $sewa): ?>
                 <li class="list-group-item mb-4">
                 <h6>ID Transaksi: <?php echo $sewa["id_sewa"]; ?></h6>
                 <h6>Nama Pembeli: <?php echo $sewa["nama"]; ?></h6>
                 <h6>Tgl. Transaksi: <?php echo $sewa["tgl"]; ?></h6>
                 <h6>List Barang: </h6>

                 <?php
                 $sql2 = "select * from detail_sewa d inner join kostum k
                 on d.kode_kostum = k.kode_kostum
                 where d.id_sewa = '".$sewa["id_sewa"]."'";
                 $query2 = mysqli_query($connect, $sql2);
                  ?>

                  <table class="table table-borderless table-hover">
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
      </div> -->
   </body>
 </html>
