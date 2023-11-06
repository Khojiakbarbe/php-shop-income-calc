<?php
include "../admin/connect.php";



if (empty($_SESSION['id'])) {
    header('location: ../login.php');
}
/////////

$pdoMenuGet = $pdo->prepare("
SELECT * FROM `xodim`
");
$pdoMenuGet->execute();
$pdoMenuGetOption = $pdo->prepare("
SELECT * FROM `xodim`
");
$pdoMenuGetOption->execute();

///////////


$pdoStatementQarz = $pdo->prepare("
SELECT * FROM `xodimlar` 
");

$pdoStatementQarz->execute();

$pdoStatementberildi = $pdo->prepare("
SELECT * FROM `xodimlar` 
");

$pdoStatementberildi->execute();

$pdoStatementqoldi = $pdo->prepare("
SELECT * FROM `xodimlar` 
");
$pdoStatementqoldi->execute();


///////

// $pdo

if (isset($_POST['xodim_qoshish'])) {
    $name = $_POST['name'];

    $pdoMenuPost = $pdo->prepare("
    INSERT INTO `xodim`(`name`) VALUES (:name)
    ");
    $pdoMenuPost->bindParam("name", $name);
    if ($pdoMenuPost->execute())
        header("location:xodimlar.php");
}

if (isset($_POST['qarz_qoshish'])) {
    $date = $_POST['date'];
    $user_id = $_POST['user_id'];
    $olingan = $_POST['olingan'];
    $berilgan = $_POST['berilgan'];
    $comment = $_POST['comment'];

    $pdoQarzPost = $pdo->prepare("
    INSERT INTO `xodimlar`( `date`, `olingan_qarz`, `berilgan_qarz`,  `comment`, `user_id`) VALUES (:date,:olingan_qarz,:berilgan_qarz,:comment,:user_id)
    ");
    $pdoQarzPost->bindParam("date", $date);
    $pdoQarzPost->bindParam("olingan_qarz", $olingan);
    $pdoQarzPost->bindParam("berilgan_qarz", $berilgan);
    $pdoQarzPost->bindParam("user_id", $user_id);
    $pdoQarzPost->bindParam("comment", $comment);
    if ($pdoQarzPost->execute())
        header("location:xodimlar.php");
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
    <link rel="stylesheet" href="../main.css">
    <title>Xodimlar</title>
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
                                <img width="100" height="80" src="../image/logo.png" alt="logo of website">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="../index.php">Savdo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../qarzlar.php">Qarzlar</a>
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

    <!-- section start -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <tr>
                                <th>Umumiy qarz</th>
                                <th>Umumiy Berildi</comment>
                                <th>Umumiy qoldi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="qarz">0</td>
                                <td id="berildi">0</td>
                                <td id="qoldi">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-outline-warning mb-3 " data-bs-toggle="modal" data-bs-target="#menumodal"><i
                            class="bi bi-plus-circle"> </i>Xodim qoshish</button>

                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-outline-warning mb-3 " data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><i class="bi bi-plus-circle"> </i>Ish haqi qoshish</button>

                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <!-- Main start -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="list-group mylistgroup">

                        <?php while ($pdoMenu = $pdoMenuGet->fetch()) { ?>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="xodim.php?id=<?= $pdoMenu['id'] ?>">
                                    <?= $pdoMenu['name'] ?>
                                </a>
                                <a href="xodimDelete.php?id=<?= $pdoMenu['id'] ?>">
                                    <i class="bi d-none bi-trash-fill btn btn-outline-danger btn-sm"></i>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main end -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-9 " id="staticBackdropLabel">Ish haqqi qo'shish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action='xodimlar.php' method="post">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="col-form-label">Sana:</label>

                                <input type="date" name="date" class="form-control " placeholder="Sana">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Kimga yozamiz:</label>
                                <select name="user_id" id="names" class="form-select form-control">
                                    <?php while ($pdoMenuOption = $pdoMenuGetOption->fetch()) {
                                        ?>
                                        <option value="<?= $pdoMenuOption['id'] ?>">
                                            <?= $pdoMenuOption['name'] ?>
                                        </option>
                                    <?php }
                                    ; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Olingan Qarz:</label>
                                <input type="number" name="olingan" class="form-control" placeholder="Naqd Savdo">
                            </div>

                            <div class="col-6">
                                <label for="name" class="col-form-label">Berilgan Qarz:</label>
                                <input type="number" name="berilgan" class="form-control" placeholder="Berilgan Qarz">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Izoh:</label>
                            <textarea class="form-control" name="comment" id="message-text"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="qarz_qoshish" class="btn btn-success">Sumbit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="menumodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action='xodimlar.php' method='post'>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Xodim ismini kiriting:</label>
                            <input type="text" class="form-control" name="name" placeholder="menu nomini yozing">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="xodim_qoshish" class="btn btn-success">Qo'shish</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <?php while ($qarzCalc = $pdoStatementQarz->fetch()) { ?>
        <p class="qarzCalc" style="display: none;">
            <?= $qarzCalc['olingan_qarz'] ?>
        </p>
    <?php }
    ; ?>
    <?php while ($berildiCalc = $pdoStatementberildi->fetch()) { ?>
        <p class="berildiCalc" style="display: none;">
            <?= $berildiCalc['berilgan_qarz'] ?>
        </p>
    <?php }
    ; ?>
    <?php while ($qoldiCalc = $pdoStatementqoldi->fetch()) { ?>
        <p class="qoldiCalc" style="display: none;">
            <?= $qoldiCalc['olingan_qarz'] - $qoldiCalc['berilgan_qarz'] ?>
        </p>
    <?php }
    ; ?>


    <script>



        const qarzCalc = document.querySelectorAll('.qarzCalc')
        const berildiCalc = document.querySelectorAll('.berildiCalc')
        const qoldiCalc = document.querySelectorAll('.qoldiCalc')


        const qarzEl = document.getElementById('qarz');
        const berildiEl = document.getElementById('berildi');
        const qoldiEl = document.getElementById('qoldi');

        console.log(qoldiCalc[0].innerText);


        let qarzCount = 0;
        for (let i = 0; i < qarzCalc.length; i++) {
            qarzCount += +qarzCalc[i].innerText
        }
        qarzEl.innerText = qarzCount;

        let berildiOCunt = 0;
        for (let i = 0; i < berildiCalc.length; i++) {
            berildiOCunt += +berildiCalc[i].innerText
        }
        berildiEl.innerText = berildiOCunt;

        let qoldiCount = 0;
        for (let i = 0; i < qoldiCalc.length; i++) {
            qoldiCount += +qoldiCalc[i].innerText
        }

        qoldiEl.innerText = qoldiCount;
    </script>


    <script>
        let getAction = document.querySelectorAll(".list-group-item-action");

        for (let i = 0; i < getAction.length; i++) {
            getAction[i].addEventListener('click', () => {
                let getBtn = getAction[i].querySelectorAll(".bi-trash-fill");

                for (let j = 0; j < getBtn.length; j++) {
                    getBtn[j].classList.toggle('d-none');
                }
            });
        }
    </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>