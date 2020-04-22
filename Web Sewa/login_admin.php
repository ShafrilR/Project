<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"BOBOHO" | Login Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <style media="screen">
      body{
          background-image: url(content/bgg.jpg);
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed;
      }
      .padding{
        padding-top: 4%;
      }
      .judulin{
          color: white;
          font-size: 65px;
          font-family:Arial;
          font-style:inherit;
          padding-top: 100px;
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
          <h4>"Login Admin"</h4>
        </div>
        <div class="card-body">
          <form action="proses_login_admin.php" method="post">
            <h6>Username</h6>
            <input type="text" name="username" class="form-control my-3" required/>
            <h6>Password</h6>
            <input type="password" name="password" class="form-control my-3" required/>
            <button type="submit" name="login_admin" class="btn btn-block btn-outline-dark">
              Login
            </button>
          </form>
        </div>
      </div>
      <br>
      <a class="btn btn-outline-light" href="login.php">Back</a>
    </div>
    <br><br>
   <div class="footer" align="center">
       &copy; Copyright by
        <a href="https://www.instagram.com/shafrilrzqn_/?hl=id" target="blank" class="footer">"BOBOHO"</a>
   </div>
   <br>
  </body>
</html>
