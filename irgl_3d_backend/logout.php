<?php

require_once "./backend/includes/connection.php";


session_destroy();
unset($_SESSION['login_team']);

header('location: ./index.php');


?>