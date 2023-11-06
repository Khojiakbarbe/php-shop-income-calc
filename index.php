<?php
include "admin/connect.php";

$pdoStatementGet = $pdo->prepare("
SELECT * FROM `dokon`
");

if (empty($_SESSION['id'])) {
    header('location: login.php');
}


$pdoStatementGet->execute();

//////////////////


$pdoStatementNaqd = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementNaqd->execute();

$pdoStatementTerminal = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementTerminal->execute();

$pdoStatementJami = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementJami->execute();

$pdoStatementTovar = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementTovar->execute();

$pdoStatementRasxod = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementRasxod->execute();

$pdoStatementKassa = $pdo->prepare("
SELECT * FROM `dokon`
");

$pdoStatementKassa->execute();
///////////////////

if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $name = $_POST['name'];
    $naqd_savdo = $_POST['naqd_savdo'];
    $terminal_savdo = $_POST['terminal_savdo'];
    $kelgan_tovar = $_POST['kelgan_tovar'];
    $kunlik_rasxod = $_POST['kunlik_rasxod'];
    $comment = $_POST['comment'];

    $pdoPost = $pdo->prepare("
    INSERT INTO `dokon`(`date`, `name`, `naqd_savdo`, `terminal_savdo`, `kelgan_tovar`, `kunlik_rasxod`, `comment`) VALUES
     (:date,:name,:naqd_savdo,:terminal_savdo,:kelgan_tovar,:kunlik_rasxod,:comment)
    ");

    $pdoPost->bindParam("date", $date);
    $pdoPost->bindParam("name", $name);
    $pdoPost->bindParam("naqd_savdo", $naqd_savdo);
    $pdoPost->bindParam("terminal_savdo", $terminal_savdo);
    $pdoPost->bindParam("kelgan_tovar", $kelgan_tovar);
    $pdoPost->bindParam("kunlik_rasxod", $kunlik_rasxod);
    $pdoPost->bindParam("comment", $comment);

    if ($pdoPost->execute()) {
        header("location: index.php");
    }
    ;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>57-dars</title>
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

    <!-- section start -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <tr>
                                <th>Naqd</th>
                                <th>Terminal</th>
                                <th>Jami</th>
                                <th>Tovar</th>
                                <th>Rasxod</th>
                                <th>Kassa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="naqd">0</td>
                                <td id="terminal">0</td>
                                <td id="jami">0</td>
                                <td id='tovar'>0</td>
                                <td id='rasxod'>0</td>
                                <td id="kassa">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-warning mb-3 " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                            class="bi bi-plus-circle"> </i>Savdo qoshish</button>

                </div>
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sanasi</th>
                                    <th>Naqd Savdo</th>
                                    <th>Terminal Savdo</th>
                                    <th>Kunlik savdo</th>
                                    <th>Kelgan Tovar</th>
                                    <th>Kunlik rasxod</th>
                                    <th>Kassa</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                        </thead>
                        <tbody>

                            <?php $i = 1;
                            while ($data = $pdoStatementGet->fetch()) { ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>

                                        <?= substr($data['date'], 0, 11) ?>
                                    </td>
                                    <td class="cash">
                                        <?= $data['naqd_savdo'] ?>
                                    </td>
                                    <td class="terminal">
                                        <?= $data['terminal_savdo'] ?>
                                    </td>
                                    <td>
                                        <?= intval($data['naqd_savdo'] + $data['terminal_savdo']) ?>
                                    </td>
                                    <td class="product">
                                        <?= $data['kelgan_tovar'] ?>
                                    </td>
                                    <td class="cost">
                                        <?= $data['kunlik_rasxod'] ?>
                                    </td>
                                    <td class="cashier">
                                        <?= intval($data['naqd_savdo'] + $data['terminal_savdo'] - $data['kunlik_rasxod']) ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle show" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu" data-popper-placement="top-end">
                                                <li><a href="show.php?id=<?= $data['id'] ?>">
                                                        <button class="dropdown-item" type="button"><i
                                                                class="bi col-12 btn btn-success bi-eye-fill">show</i>
                                                        </button></a></li>
                                                <li><a href="edit.php?id=<?= $data['id'] ?>"><button class="dropdown-item"
                                                            type="button"><i
                                                                class="bi col-12 btn btn-warning bi-pencil-square"> edit
                                                            </i></button></a>
                                                </li>
                                                <li>
                                                    <form action="admin/delete.php?id=<?= $data['id'] ?>" method="Post">
                                                        <button onclick="return confirm('Delete ?')" type="submit"
                                                            class="dropdown-item"><i
                                                                class="bi col-12 btn btn-danger bi-trash">delete</i></button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                            }
                            ; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-9 " id="staticBackdropLabel">Savdo qo'shish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="col-form-label">Data:</label>
                                <input type="date" class="form-control " name="date" placeholder="Data">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Cash sale:</label>
                                <input type="number" class="form-control" name="naqd_savdo" placeholder="Cash sales">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Terminal trade:</label>
                                <input type="number" class="form-control" name="terminal_savdo"
                                    placeholder="Terminal trades">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Total sales:</label>
                                <input type="number" class="form-control" name="kelgan_tovar" placeholder="Total sales">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Dealy costs:</label>
                                <input type="number" class="form-control" name="kunlik_rasxod"
                                    placeholder="Enter Dealy costs">
                            </div>

                        </div>


                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Comment:</label>
                            <textarea class="form-control" name="comment" id="message-text"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Sumbit</button>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>
        <!-- calculates start -->

        <?php while ($naqdCalc = $pdoStatementNaqd->fetch()) { ?>
            <p class="naqdSavdo" style="display: none;">
                <?= $naqdCalc['naqd_savdo'] ?>
            </p>
        <?php }
        ; ?>
        <?php while ($TerminalCalc = $pdoStatementTerminal->fetch()) { ?>
            <p class="terminalSavdo" style="display: none;">
                <?= $TerminalCalc['terminal_savdo'] ?>
            </p>
        <?php }
        ; ?>
        <?php while ($jamiCalc = $pdoStatementJami->fetch()) { ?>
            <p class="jamiCalc" style="display: none;">
                <?= intval($jamiCalc['terminal_savdo'] + $jamiCalc['naqd_savdo']) ?>
            </p>
        <?php }
        ; ?>
        <?php while ($tovarCalc = $pdoStatementTovar->fetch()) { ?>
            <p class="tovarCalc" style="display: none;">
                <?= $tovarCalc['kelgan_tovar'] ?>
            </p>
        <?php }
        ; ?>
        <?php while ($rasxodCalc = $pdoStatementRasxod->fetch()) { ?>
            <p class="rasxod" style="display: none;">
                <?= $rasxodCalc['kunlik_rasxod'] ?>
            </p>
        <?php }
        ; ?>
        <?php while ($kassaCalc = $pdoStatementKassa->fetch()) { ?>
            <p class="kassaCalc" style="display: none;">
                <?= $kassaCalc['naqd_savdo'] +$kassaCalc['terminal_savdo'] - $kassaCalc['kunlik_rasxod'] ?>
            </p>
        <?php }
        ; ?>

        <!-- calculates  over-->

    </div>

    <script>
        const naqd = document.querySelectorAll('.naqdSavdo')
        const terminalSavdo = document.querySelectorAll('.terminalSavdo')
        const tovarCalc = document.querySelectorAll('.tovarCalc')
        const jamiCalc = document.querySelectorAll('.jamiCalc')
        const rasxod = document.querySelectorAll('.rasxod')
        const kassaCalc = document.querySelectorAll('.kassaCalc')


        //id elements

        const naqdEl = document.getElementById('naqd');
        const terminalEl = document.getElementById('terminal');
        const jamiEl = document.getElementById('jami');
        const tovarEl = document.getElementById('tovar');
        const rasxodEl = document.getElementById('rasxod');
        const kassaEl = document.getElementById('kassa');

        let naqdCount = 0;
        for (let i = 0; i < naqd.length; i++) {
            naqdCount += +naqd[i].innerText
        }
        naqdEl.innerText =naqdCount;
        
        
        let terminalCount = 0;
        for (let i = 0; i < terminalSavdo.length; i++) {
            terminalCount += +terminalSavdo[i].innerText
        }
        terminalEl.innerText =terminalCount;
        
        let jamiCount = 0;
        for (let i = 0; i < jamiCalc.length; i++) {
            jamiCount += +jamiCalc[i].innerText
        }
        jamiEl.innerText =jamiCount;
        

        let tovarCount = 0;
        for (let i = 0; i < tovarCalc.length; i++) {
            tovarCount += +tovarCalc[i].innerText
        }
        tovarEl.innerText =tovarCount;
        
        
        let rasxodCount = 0;
        for (let i = 0; i < rasxod.length; i++) {
            rasxodCount += +rasxod[i].innerText
        }
        rasxodEl.innerText =rasxodCount;
        
        
        let kassaCount = 0;
        for (let i = 0; i < kassaCalc.length; i++) {
            kassaCount += +kassaCalc[i].innerText
        }
        kassaEl.innerText =kassaCount;


    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>