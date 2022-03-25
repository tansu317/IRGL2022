<?php

<<<<<<< HEAD:_admin_irgl2022/includes/connection.php
date_default_timezone_set('Asia/Jakarta');
=======
error_reporting(0);
session_start();
>>>>>>> 13b4020 (IRGL 3D + Backend):irgl_backend/backend/includes/connection.php

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

<<<<<<< HEAD:_admin_irgl2022/includes/connection.php
session_start();

// Default reCaptcha -> buat test
// $reCaptcha = [
//     'site_key' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
//     'secret_key' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'
// ];

$reCaptcha = [
    'site_key' => '6Lc8CiIeAAAAAE89OkUKBhj9HBLcSGmVVpsk4Ou8',
    'secret_key' => '6Lc8CiIeAAAAAJH6UeuU8FUUU2_oU-jnTig-pXFz'
];


$pathURL = '/_admin_irgl2022/';
$cookie_login = isset($_COOKIE['login']) ? $_COOKIE['login'] : '';
=======
>>>>>>> 13b4020 (IRGL 3D + Backend):irgl_backend/backend/includes/connection.php


?>
