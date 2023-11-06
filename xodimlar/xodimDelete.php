<?php

include "../admin/connect.php";
$id = $_GET['id'];
$pdoDelete = $pdo->prepare("
DELETE FROM `xodim` WHERE id=$id
");
$pdoQarzDelete = $pdo->prepare("
DELETE FROM `xodimlar` WHERE `user_id`=$id
");

if ($pdoQarzDelete->execute() && $pdoDelete->execute()) header('location: xodimlar.php');