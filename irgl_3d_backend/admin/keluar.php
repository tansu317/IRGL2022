<?php

require_once "./includes/connection.php";

// Hapus token login
$sql = "UPDATE `2022_admin` SET login_cookie = :delete WHERE login_cookie = :hash";
$update_login = $pdo->prepare($sql);
$update_login->bindValue(':delete', trim(' '));
$update_login->bindParam(':hash', $cookie_login);
$update_login->execute();

setcookie('login', null, time()-3600, '/');
header('location: '.$pathURL.'login.php');

?>