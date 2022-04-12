<?php

function errorAccessIP($error = '', $page = '')
{
    $pdo = $GLOBALS['pdo'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $token = '4098c8c7ca55e9';
    $get_json = 'http://ipinfo.io/'.$ip.'?token='.$token;
    $get_json = trim(@file_get_contents($get_json));
    $timestamp = date("Y-m-d H:i:s");

    if (mb_strlen($page) > 150) 
        $page = '';

    $insert_ip = $pdo->prepare("INSERT INTO `2022_error_input` SET ip = '$ip', ua = '$ua', json = :json, time = '$timestamp', page = :page, error = :error");
    $insert_ip->bindValue(':json', $get_json);
    $insert_ip->bindValue(':page', $page);
    $insert_ip->bindValue(':error', $error);
    $insert_ip->execute();
}

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
    else 
    {
        $redir = $pathURL.'login.php';
    }

    if (!empty($redir))
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
