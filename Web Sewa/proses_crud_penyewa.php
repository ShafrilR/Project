<?php
  if (isset($_POST["save_penyewa"])) {
    // isset digunakan untuk mengecek
    // apakah kita mengakses file ini. dikirimkan
    // data dengan nama "save_siswa" dg method $_POST

    // kita tampung  data yang dikirimkan
    $action = $_POST["action"];
    $id_penyewa = $_POST["id_penyewa"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // load file config.?php
    include("configsewa.php");

    // cek aksi
    if ($action == "insert") {
      // insert
      $sql = "insert into penyewa values ('$id_penyewa','$nama', '$alamat','$kontak','$user','$pass')";

      // eksekusi perintah
      mysqli_query($connect, $sql);
    }else if ($action == "update") {
      $sql = "update penyewa set nama = '$nama', alamat = '$alamat', kontak = '$kontak', username = '$usere', password = '$pass' where id_penyewa = '$id_penyewa'";

      // eksekusi perintah
      mysqli_query($connect,$sql);
    }

    //redirect ke halaman siswa.php
    header("location:penyewa.php");
  }

  if (isset($_GET["hapus"])) {
    include("configsewa.php");
    $id_penyewa = $_GET["id_penyewa"];

    $sql = "delete from penyewa where id_penyewa='$id_penyewa'";

    mysqli_query($connect, $sql);
    // direct ke halaman data siswa
    header("location:penyewa.php");
  }
 ?>
