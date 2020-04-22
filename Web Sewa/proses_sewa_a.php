<?php
  session_start();
  include("configsewa.php");

// menambah barang ke cart
  if (isset($_POST["sewa"])) {
    // tampung kode_buku dan jumlah Beli
    $kode_kostum = $_POST["kode_kostum"];
    $lama_sewa = $_POST["lama_sewa"];

    // ambil data buku dari database sesuai dengan kode buku yanng dipilih
    $sql = "select * from kostum where kode_kostum='$kode_kostum'";
    $query = mysqli_query($connect, $sql); // eksekusi sintak sql sqlnya
    $kostum = mysqli_fetch_array($query); // menampung data dari database ke array

    $item = [
      "kode_kostum" => $kostum["kode_kostum"],
      "nama_kostum" => $kostum["nama_kostum"],
      "image" => $kostum["image"],
      "harga_sewa" => $kostum["harga_sewa"],
      "lama_sewa" => $lama_sewa
    ];

    // masukkan item ke keranjang (cart)
    array_push($_SESSION["d_sewa"], $item);
    $sql2 = "update kostum set stok = stok - 1 where kode_kostum = '$kode_kostum'";
    mysqli_query($connect, $sql2);

    header("location:tampilan.php");
  }

  // untuk mengapus item pada cart
  // if (isset($_GET["hapus"])) {
  //   // tampung data kode_buku yang dihapus
  //   $kode_kostum = $_GET["kode_kostum"];
  //
  //   // cari index cart sesuai dengan kode_buku yang diahpus
  //   $index = array_search(
  //     $kode_kostum, array_column(
  //       $_SESSION["d_sewa"],"kode_kostum"
  //       )
  //   );
  //
  //   // hapus item pada Cart
  //   array_splice($_SESSION["d_sewa"],$index, 1);
  //   header("location:d_sewa.php");
  // }

  // Checkout
  if (isset($_GET["selesai"])) {
    // memasukkan data pada cart ke database (tabel transaksi dan detail)
    // transaksi -> id transaksi, tgl, id customer
    // detail -> id transaksi, kode buku, jumlah, harga beli

    $id_sewa = "ID".rand(1,10000);
    $tgl = date("Y-m-d H:i:s"); // current time
    // year, month, day, hour, minute, second
    $id_penyewa = $_SESSION["id_penyewa"];

    // buat $query insert ke tabel transaksi
    $sql = "insert into sewa values ('$id_sewa','$tgl','$id_penyewa')";
    mysqli_query($connect, $sql); // eksekusi query

    foreach ($_SESSION["d_sewa"] as $d_sewa) {
      $kode_kostum = $d_sewa["kode_kostum"];
      $lama_sewa = $d_sewa["lama_sewa"];
      $harga_sewa = $d_sewa["harga_sewa"];

      // buat query insert tabel detail
      $sql = "insert into detail_sewa values ('$id_sewa','$kode_kostum','$lama_sewa','$harga_sewa')";
      mysqli_query($connect,$sql);

      $sql2 = "update kostum set stok = stok + 1 where kode_kostum = '$kode_kostum'";
      mysqli_query($connect, $sql2);

    }
    // kosongkan cartnya
    $_SESSION["d_sewa"] = array();
    header("location:sewa_a.php");
  }
 ?>
