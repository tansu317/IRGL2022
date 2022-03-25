<?php

require_once "./includes/connection.php";

$err = isset($_GET['err']) ? $_GET['err'] : '';
$title = ($err == 403) ? '403 Forbidden' : '404 Not Found';

if ($err == 403)
    $content = 'You don\'t have permission to access the document or program that you requested. ';
else
    $content = 'The page you are looking for '.htmlspecialchars($_SERVER['REQUEST_URI']).' cannot be found. ';

$content .= 'Return to the <a href="javascript:void(0);" onclick="window.history.back();">previous page</a>.';

$code = ($err == 403) ? 403 : 404;
http_response_code($code);

?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <title><?=$title.' - IRGL 2022'?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <!-- Style -->
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/styles.css" />

        <!-- Favicon-->
        <link rel="icon" href="<?=$pathURL?>assets/images/favicon.ico" />
    </head>
    <body class="error-page">

        <!-- Error page -->
        <div class="box-error-page">
            <h1 class="title"><?=$title?></h1>
            <p><?=$content?></p>
        </div>
        <!-- End error page -->

    </body>
</html>