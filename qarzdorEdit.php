<?php
include "admin/connect.php";
$id = $_GET['id'];


if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$pdoStatementGet = $pdo->prepare("SELECT * FROM `dokon_qarzlar` WHERE `user_id`=$id");

$pdoStatementGet->execute();

$data = $pdoStatementGet->fetch();

if (isset($_POST['submit'])) {
    $olindi = $_POST['olindi'];
    $berildi = $_POST['berildi'];
    $comment = $_POST['comment'];
    $pdoPost = $pdo->prepare("
        UPDATE `dokon_qarzlar` SET 
        `olindi`=:olindi,`berildi`=:berildi,`comment`=:comment WHERE id=$id
    ");

    $pdoPost->bindParam("olindi", $olindi);
    $pdoPost->bindParam("berildi", $berildi);
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
    <title>Qarzdor Edit </title>
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
                                        <a class="nav-link" href="#">Savdo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Qarzlar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Xodimlar</a>
                                    </li>
                                </ul>
                                <a href="logOut.php">
                                    <button class="btn btn-outline-danger">Chiqish</button>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- hader end -->


    <div class="container mt-5">
        <form action="qarzdorEdit.php?id=<?= $data['id'] ?>" method="post">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h2 class="font-monospace">Edit</h2>
                </div>
                <div class="col-6 mb-2">
                    <label for="price">Olindi:</label>
                    <input type="number" required="" name="olindi" id="price" value="<?= $data['olindi'] ?>"
                        class="form-control" placeholder="Olindi">
                </div>
                <div class="col-6 mb-2">
                    <label for="terminal">Berildi:</label>
                    <input type="number" required="" name="berildi" id="terminal" value="<?= $data['berildi'] ?>"
                        class="form-control" placeholder="Berildi">
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