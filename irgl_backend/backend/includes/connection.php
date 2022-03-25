<?php

error_reporting(0);
session_start();

$host = '127.0.0.1';
$db = 'irgl_2022';
$charset = 'utf8mb4';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Sukses";
} catch (\PDOException $e) {
    throw \PDOException($e->getMessage(), $e->getCode());
}


?>
