<?php

include "connect.php";
$id = $_GET['id'];


if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$pdoDelete = $pdo->prepare("
DELETE FROM `dokon` WHERE id=$id
");

if ($pdoDelete->execute()) header('location: ../index.php');