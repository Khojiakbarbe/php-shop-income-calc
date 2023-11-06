<?php
include "admin/connect.php";
$id = $_GET['id'];


if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$pdoStatementGet = $pdo->prepare("SELECT * FROM `dokon` WHERE id=$id");

$pdoStatementGet->execute();

$data = $pdoStatementGet->fetch();

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $name = $_POST['name'];
    $naqd_savdo = $_POST['naqd_savdo'];
    $terminal_savdo = $_POST['terminal_savdo'];
    $kelgan_tovar = $_POST['kelgan_tovar'];
    $kunlik_rasxod = $_POST['kunlik_rasxod'];
    $comment = $_POST['comment'];

    $pdoPost = $pdo->prepare("
    UPDATE `dokon` SET 
    `date`=:date,`name`=:name,`naqd_savdo`=:naqd_savdo,`terminal_savdo`=:terminal_savdo,`kelgan_tovar`=:kelgan_tovar,`kunlik_rasxod`=:kunlik_rasxod,`comment`=:comment WHERE id=$id
    ");

    $pdoPost->bindParam("date", $date);
    $pdoPost->bindParam("name", $name);
    $pdoPost->bindParam("naqd_savdo", $naqd_savdo);
    $pdoPost->bindParam("terminal_savdo", $terminal_savdo);
    $pdoPost->bindParam("kelgan_tovar", $kelgan_tovar);
    $pdoPost->bindParam("kunlik_rasxod", $kunlik_rasxod);
    $pdoPost->bindParam("comment", $comment);

    if ($pdoPost->execute()) {
        header("location: ../index.php");
    }
    ;
}

?>


<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>Edit</title>
</head>

<body>

    <!-- hader start -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">
                                <img width="100" height="80" src="image/logo.png" alt="logo of website">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Savdo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="qarzlar.php">Qarzlar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="xodimlar/xodimlar.php">Xodimlar</a>
                                    </li>
                                </ul>
                                <button class="btn btn-outline-danger">Chiqish</button>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- hader end -->


    <div class="container mt-5">
        <form action="edit.php?id=<?= $data['id'] ?>" method="post">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h2 class="font-monospace">Edit Post</h2>
                </div>
                <div class="col-6 mb-2">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" value="<?= substr($data['date'],0,10) ?>" class="form-control"
                        required="">
                </div>
                <div class="col-6 mb-2">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required="" id="name" value="<?= $data['name'] ?>"
                        class="form-control" placeholder="Name">
                </div>
                <div class="col-6 mb-2">
                    <label for="price">Cash sale:</label>
                    <input type="number" required="" name="naqd_savdo" id="price" value="<?= $data['naqd_savdo'] ?>"
                        class="form-control" placeholder="Cash sales">
                </div>
                <div class="col-6 mb-2">
                    <label for="terminal">Terminal trade:</label>
                    <input type="number" required="" name="terminal_savdo" id="terminal"
                        value="<?= $data['terminal_savdo'] ?>" class="form-control" placeholder="Terminal trades">
                </div>
                <div class="col-6 mb-2">
                    <label for="product">Total sales:</label>
                    <input type="number" required="" name="kelgan_tovar" value="<?= $data['kelgan_tovar'] ?>"
                        id="product" value="30000" class="form-control" placeholder="Total sales">
                </div>
                <div class="col-6 mb-2">
                    <label for="buy">Daily Cost:</label>
                    <input type="number" required="" name="kunlik_rasxod" id="buy" value="<?= $data['kunlik_rasxod'] ?>"
                        class="form-control" placeholder="Enter Daily Cost">
                </div>
                <div class="col-12 mb-2">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <textarea name="comment" required="" value="<?= $data['comment'] ?>" class="form-control"
                        id="exampleFormControlTextarea1" rows="3"><?= $data['comment'] ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <a href="index.php" class="btn btn-warning">Close</a>
                </div>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>

</body>

</php>