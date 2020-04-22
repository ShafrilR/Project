<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"BOBOHO" | Daftar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    Add = () =>{
      document.getElementById('id_penyewa').value = "";
      document.getElementById('nama').value = "";
      document.getElementById('alamat').value = "";
      document.getElementById('kontak').value = "";
      document.getElementById('username').value = "";
      document.getElementById('password').value = "";
    }
    </script>
    <style media="screen">
    body{
        background-image: url(content/css.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
    .padding{
      padding-top: 2%;
    }
    .judulin{
        color: white;
        font-size: 65px;
        font-family:Arial;
        font-style:inherit;
        padding-top: 30px;
        text-shadow: 5px 5px 5px black;
    }
    .footer:hover{
      color: white;
      text-decoration: none;
    }
    .footer{
        color:white;
        font-size: 15px;
        text-decoration: none;
    }
    .back{
      color:white;
      font-size: 25px;
      font-family: Arial;
      text-decoration: none;
      text-shadow: 5px 5px 5px black;
    }
    .back:hover{
      color: white;
      text-decoration: none;
    }
    </style>
  </head>
  <body>
      <div class="col-sm-12"  id="home">
         <h1 class="judulin" align="center">"BOBOHO Merchandise"</h1>
     </div>
    <div class="container padding">
      <center>
      <div class="card border-dark col-sm-5">
        <div class="card-header border-dark">
          <h4>"Form Pendaftaran Customer"</h4>
        </div>
        <div class="card-body">
          <form action="proses_daftar.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4 my-2">
                  <h6>ID  :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="number" name="id_penyewa" id="id_penyewa" class="form-control" required/>
                </div>
                <div class="col-sm-4 my-2">
                  <h6>Nama :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="text" name="nama" id="nama" class="form-control" required/>
                </div>
                <div class="col-sm-4 my-2">
                  <h6>Alamat :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="text" name="alamat" id="alamat" class="form-control" required/>
                </div>
                <div class="col-sm-4 my-2">
                  <h6>Kontak :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="text" name="kontak" id="kontak" class="form-control" required/>
                </div>
                <div class="col-sm-4 my-2">
                  <h6>Username :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="text" name="username" id="username" class="form-control" required/>
                </div>
                <div class="col-sm-4 my-2">
                  <h6>Password :</h6>
                </div>
                <div class="col-sm-8 my-2">
                  <input type="text" name="password" id="password" class="form-control" required/>
                </div>
              </div>
            </div>
            <div class="card-footer border-dark">
              <button type="submit" name="save_daftar" class="btn text-white" style="background-color : #242424">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
      <br>
      <a class="btn btn-sm btn-outline-light" href="login.php">Back</a>
    </div>
    <br><br>
   <div class="footer" align="center">
       &copy; Copyright by
        <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">"BOBOHO"</a>
   </div>
   <br>
  </body>
</html>
