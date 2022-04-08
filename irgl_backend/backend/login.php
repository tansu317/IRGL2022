<?php

require_once "./includes/connection.php";

$return         = false;
$msg            = '';
$successLogin   = false;
$redirect       = '';
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    $return = true;
    $cek_captcha = verifikasiCaptcha($_POST['g-recaptcha-response'], $recaptcha_sck);

    if ($cek_captcha)
    {
        $email  = trim(strtolower($_POST['email']));
        $pass   = $_POST['team_password'];

        // Cek email user
        $sql_ceu = "SELECT team_id FROM `2022_main_participants` WHERE email = :email";
        $check_ceu = $pdo->prepare($sql_ceu);
        $check_ceu->bindParam(':email', $email);
        $check_ceu->execute();

        if ($check_ceu->rowCount() > 0)
        {
            $fetch_ceu = $check_ceu->fetch(PDO::FETCH_OBJ);

            // Cek Main Teams
            $sql_cmt = "SELECT status, password FROM `2022_main_teams` WHERE id = :id";
            $check_cmt = $pdo->prepare($sql_cmt);
            $check_cmt->bindParam(':id', $fetch_ceu->team_id);
            $check_cmt->execute();

            if ($check_ceu->rowCount() > 0)
            {
                $fetch_cmt = $check_cmt->fetch(PDO::FETCH_OBJ);

                if (!password_verify($pass, $fetch_cmt->password))
                {
                    $msg = 'The team password you entered is wrong.';
                }
                else if ($fetch_cmt->status == 0)
                {
                    $msg = 'Your team is still not approved, please contact the Administrator.';
                }
                else 
                {
                    $login_token = md5($email.$pass.time().rand(0, 99999));
                    $time_login = date('Y-m-d H:i:s');

                    // Update Main Teams
                    $_SESSION['login_team'] = $login_token;
                    $sql_update_main = "UPDATE `2022_main_teams` SET `date_of_last_login` = '$time_login' WHERE id = :id";

                    $update_main = $pdo->prepare($sql_update_main);
                    $update_main->bindParam(':id', $fetch_ceu->team_id);
                    $update_main->execute();

                    // // redirect
                    // header('location: ./coming_soon.php');

                    $successLogin   = true;
                    $redirect       = './index.php';
                    $msg            = 'Successfully logged in, you will be redirected to a new page.';
                }
            }
            else
                $msg = 'Your team is not registered, please contact the Administrator.';
        }
        else
            $msg = 'Your email is not registered.';
    }
    else 
        $msg = 'Please verify captcha.';
}

header('Content-Type: application/json');

echo json_encode([
    'return'         => $return,
    'success_login'  => $successLogin,
    'message'        => $msg,
    'redirect_page'  => $redirect
]);


?>
