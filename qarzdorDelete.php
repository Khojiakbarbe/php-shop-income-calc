<?php

include "admin/connect.php";
$id = $_GET['id'];
$pdoDelete = $pdo->prepare("
DELETE FROM `dokon_menu` WHERE id=$id
");
$pdoQarzDelete = $pdo->prepare("
DELETE FROM `dokon_qarzlar` WHERE `user_id`=$id
");


if ($pdoQarzDelete->execute() && $pdoDelete->execute()) header('location: qarzlar.php');