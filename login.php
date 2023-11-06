<?php
include 'admin/connect.php';

if (!empty($_SESSION['id'])) {
  header('location: index.php');
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];


  $pdoStatementCheck = $pdo->prepare("
    SELECT * FROM `dokon_login` WHERE email='$email'
  ");

  if (!$pdoStatementCheck->execute()) {
    echo "Xatolik bor";
  }
  $data = $pdoStatementCheck->fetch();

  if ($data) {

    if ($password == $data['password']) {
      $_SESSION['login'] = true;
      $_SESSION['id'] = $data['id'];
      header("location: index.php");
    } else {
      echo "<script defer> alert('parol xato') </script>";
    }
  } else {
    echo "<script> alert('Login va parol tizimida mavjud emas') </script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <title>Kirish</title>
</head>

<body>

  <!-- login start -->

  <div class="container mt-5 mb-5">
    <div class="row pl-3 pr-3">
      <div class="col-12 text-center content">
        <img src="img/white.png" class="mt-5" alt="login img">
      </div>
    </div>
    <form action="login.php" method="post" autocomplete="off">
      <div class="row mt-3 form">
        <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <input type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <input type="password" name="password" class="form-control" placeholder="Parol">
        </div>
        <div class="col-12  col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-2 submitfrom mt-lg-0 mt-sm-0 mt-md-0 mt-xl-0 ">
          <input type="submit" name="submit" class="form-control" value="Tizimga kirish">
        </div>
      </div>
    </form>

    <a href="registr.php">
      <button class="btn mt-5 btn-warning">REGISTR</button>
    </a>

  </div>
  <!-- login end -->




  

  <script src="script.js"></script>
</body>

</html>