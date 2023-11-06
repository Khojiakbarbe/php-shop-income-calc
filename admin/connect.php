<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'napabackend';
$dsn = "mysql:host=$host; dbname=$dbname";
$pdo = new PDO($dsn, $user, $password);

session_start();

if (empty($_SESSION['id'])) {
    header('location: ../login.php');
}
