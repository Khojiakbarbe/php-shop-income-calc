<?php
include 'admin/connect.php';

if (!empty($_SESSION['id'])) {
    header('location: index.php');
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $pdoStatementCheck = $pdo->prepare("
    SELECT * FROM `dokon_login` WHERE email='$email'
  ");

    if (!$pdoStatementCheck->execute()) {
        echo "Xatolik bor";
    }
    $data = $pdoStatementCheck->fetch();

    if ($data) {
        echo "<script defer> alert('Bunday email mavjud') </script>";
    } else {
        if ($password == $confirmpassword) {
            $pdoStatement = $pdo->prepare("
      INSERT INTO `dokon_login`( `email`, `password`)
      VALUES
      ( :email, :password)
      ");

            $pdoStatement->bindParam('email', $email);
            $pdoStatement->bindParam('password', $password);

            if ($pdoStatement->execute()) {
                header('location: login.php');
            }
        } else {
            echo "<script> alert('Parollar mos emas') </script>";
        }
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
    <title>Ro'yxatdan o'tish</title>
</head>

<body>



    <!-- login start -->

    <div class="container mt-3 mb-5">
        <form action="registr.php" method="POST" autocomplete="off">
            <div class="row mt-3 form">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Parol">
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Parolni tekshiring">
                </div>
                <div
                    class="col-12  col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-2 submitfrom mt-lg-0 mt-sm-0 mt-md-0 mt-xl-0 ">
                    <input type="submit" name="submit" class="form-control" value="Tizimga kirish">
                </div>
            </div>
        </form>
    </div>
    <!-- login end -->






    <script src="script.js"></script>
</body>

</html>