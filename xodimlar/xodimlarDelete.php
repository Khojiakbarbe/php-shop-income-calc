<?php

include "../admin/connect.php";
$id = $_GET['id'];
$pdoDelete = $pdo->prepare("
DELETE FROM `xodimlar` WHERE id=$id
");


if ( $pdoDelete->execute()) header('location: xodimlar.php');