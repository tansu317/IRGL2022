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

        if (empty($email) || empty($pass))
            $msg = 'The login form is still empty, please fill it first.';
        else
        {
            // Cek email user
            $sql_ceu = 
            "SELECT team_id, 
                    mt.status, 
                    password 
            FROM `2022_main_participants` mp
                INNER JOIN `2022_main_teams` mt
                    ON mp.team_id = mt.id
            WHERE email = :email OR mt.name = :name
                LIMIT 1";
            $check_ceu = $pdo->prepare($sql_ceu);
            $check_ceu->bindParam(':email', $email);
            $check_ceu->bindParam(':name', $email);
            $check_ceu->execute();

            if ($check_ceu->rowCount() > 0)
            {
                $fetch_cmt = $check_ceu->fetch(PDO::FETCH_OBJ);

                if (!password_verify($pass, $fetch_cmt->password))
                {
                    $msg = 'The team password you entered is wrong.';
                }
                else if ($fetch_cmt->status == 0)
                {
                    $msg = 'Your team is still not approved.';
                }
                else 
                {
                    $login_token = md5($email.$pass.time().rand(0, 99999));
                    $time_login = date('Y-m-d H:i:s');

                    // Update Main Teams
                    $sql_update_main = "UPDATE `2022_main_teams` SET login_token = :token, date_of_last_login = :tl WHERE id = :id";
                    $update_main = $pdo->prepare($sql_update_main);
                    $update_main->bindParam(':token', $login_token);
                    $update_main->bindParam(':tl', $time_login);
                    $update_main->bindParam(':id', $fetch_cmt->team_id);
                    $update_main->execute();

                    if ($update_main)
                    {
                        $_SESSION['login_team'] = $login_token;
                        $successLogin   = true;
                        $redirect       = './index.php';
                        $msg            = 'Successfully logged in, you will be redirected to a new page.';
                    }
                    else
                        $msg = 'Login failed! please contact the administrator.';
                }
            }
            else
                $msg = 'Your email or team name is not registered.';
        }
    }
    else 
        $msg = 'Please verify the captcha first!';
}

header('Content-Type: application/json');

echo json_encode([
    'return'         => $return,
    'success_login'  => $successLogin,
    'message'        => $msg,
    'redirect_page'  => $redirect
]);


?>
