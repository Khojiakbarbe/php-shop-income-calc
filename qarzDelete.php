<?php

include "admin/connect.php";
$id = $_GET['id'];
$pdoDelete = $pdo->prepare("
DELETE FROM `dokon_qarzlar` WHERE id=$id
");

if ($pdoDelete->execute()) header('location: qarzlar.php');