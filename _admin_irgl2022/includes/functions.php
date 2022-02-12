<?php

function isUserLogin() 
{
    $redir = '';
    $pathURL = $GLOBALS['pathURL']; // ambil variabel $pathURL di connection.php
    $pdo = $GLOBALS['pdo']; // ambil variabel $pdo di connection.php

    if (!empty($GLOBALS['cookie_login'])) 
    {
        $stmt = 'SELECT login_cookie FROM `2022_admin` WHERE login_cookie = :hash';
        $check_login = $pdo->prepare($stmt);
        $check_login->bindParam(':hash', $GLOBALS['cookie_login']);
        $check_login->execute();

        if ($check_login->rowCount() == 0)
        {
            $redir = $pathURL.'login.php';
        }
    }
    else {
        $redir = $pathURL.'login.php';
    }

    header('Location: '.$redir);
}


function isAlreadyLogin() 
{
    $pathURL = $GLOBALS['pathURL']; // ambil variabel $pathURL di connection.php
    $pdo = $GLOBALS['pdo']; // ambil variabel $pdo di connection.php

    if (!empty($GLOBALS['cookie_login'])) 
    {
        $stmt = 'SELECT login_cookie FROM `2022_admin` WHERE login_cookie = :hash';
        $check_login = $pdo->prepare($stmt);
        $check_login->bindParam(':hash', $GLOBALS['cookie_login']);
        $check_login->execute();

        if ($check_login->rowCount() > 0)
        {
            header('Location: '.$pathURL);
        }
    }
}
