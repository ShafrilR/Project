<?php
  include("configsewa.php");
  if (isset($_POST["save_kostum"])) {
    // isset digunakan untuk mengecek
    // apakah kita mengakses file ini. dikirimkan
    // data dengan nama "save_siswa" dg method $_POST

    // kita tampung  data yang dikirimkan
    $action = $_POST["action"];
    $kode_kostum = $_POST["kode_kostum"];
    $nama_kostum = $_POST["nama_kostum"];
    $harga_sewa = $_POST["harga_sewa"];
    $stok = $_POST["stok"];

    //menampung file image
    // if (isset($_FILES["image"])) {
    if (!empty($_FILES["image"]["name"])) {
      // empty digunakan untuk mengecek Apakah
      // seuah variable itu menyimpan nilai atau tidak
      /*contoh
      $angka;
      echo empty($angka); -->hasilnya true, karena angka tidak punya nilai
      atau variable tsb kosong
      */
      $path = pathinfo($_FILES["image"]["name"]);
      // mengambil extensi gambar
      $extension = $path["extension"];

      // rangkai file name
      $filename = $kode_kostum."-".rand(1,1000).".".$extension;
      // generate nama file
      // exp : 111-804.JPG
      // rand() random nilai 1 - 1000
    }

    // load file config.?php


    // cek aksi
    if ($action == "insert") {
      // insert
      $sql = "insert into kostum values ('$kode_kostum','$nama_kostum','$harga_sewa','$stok','$filename')";

      // proses upload file
      move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
      // eksekusi perintah
      mysqli_query($connect, $sql);
    }else if ($action == "update") {
      // if (isset($_FILES["image"])) {
      if(!empty($_FILES["image"]["name"])){
        $path = pathinfo($_FILES["image"]["name"]);
        // mengambil extensi gambar
        $extension = $path["extension"];

        // rangkai file name
        $filename = $kode_kostum."-".rand(1,1000).".".$extension;
        // generate nama file
        // exp : 111-804.JPG
        // rand() random nilai 1 - 1000

        // ambil data yang akan di edit
        $sql = "select * from kostum where kode_kostum = '$kode_kostum'";
        $query = mysqli_query($connect,$sql);
        $hasil = mysqli_fetch_array($query);

        if (file_exists("image/".$hasil["image"])) {
          unlink("image/".$hasil["image"]);
          // mengahpus gambar yang terdahulu
        }

        // upload gambarnya
        move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
        // sintak untuk update
        $sql = "update kostum set nama_kostum = '$nama_kostum', harga_sewa = '$harga_sewa', stok = '$stok', image='$filename' where kode_kostum = '$kode_kostum'";
      }
      else{
        // sintak untuk update
        $sql = "update kostum set nama_kostum = '$nama_kostum', harga_sewa = '$harga_sewa', stok = '$stok', image='$filename' where kode_kostum = '$kode_kostum'";
      }

      // eksekusi perintah
      mysqli_query($connect,$sql);
    }

    //redirect ke halaman siswa.php
    header("location:kostum.php");
  }

  if (isset($_GET["hapus"])) {
    include("configsewa.php");
    $kode_kostum = $_GET["kode_kostum"];
    // if (file_exists("image/".$hasil["image"])) {
    //   unlink("image/".$hasil["image"]);
    // }
    $sql = "delete from kostum where kode_kostum='$kode_kostum'";

    mysqli_query($connect, $sql);
    // direct ke halaman data siswa
    header("location:kostum.php");
  }
 ?>
