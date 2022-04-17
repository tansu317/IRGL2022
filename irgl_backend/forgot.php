<?php

require_once "./backend/includes/connection.php";
require_once "./backend/includes/phpmailer/classes/class.phpmailer.php";

if (isset($_SESSION['login_team']))
    header('location: ./coming_soon.php');


$act = isset($_GET['act']) ? $_GET['act'] : '';


// Cadangan kalau engga pakai SMTP
function kirimEmail($to, $subject, $message, $from)
{
    $header = "From: $from\r\n";
    $header .= "Cc: $to\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    return mail($to, $subject, $message, $header);
}

?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <title><?=($act == 'reset_password' ? 'Reset Password': 'Forgot Password')?> - IRGL 2022</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <!-- Style -->
        <link rel="stylesheet" href="./assets/bootstrap.min.css" />
        <link rel="stylesheet" href="./assets/forgot.css" />

        <!-- Favicon-->
        <link rel="icon" href="./assets/favicon.ico" />
    </head>
    <body>
        <div class="login-form">
            <div class="logo-irgl">
                <a href="/irgl2022/"><img src="./assets/logo-irgl.png" alt="IRGL 2022" /></a>
            </div>

            <div class="box-login">
                <form method="post" id="request_pass">

                <?php

                switch($act):

                    default:

                        if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            $forgot = trim($_POST['forgot']);
                            $cek_captcha = verifikasiCaptcha($_POST['g-recaptcha-response'], $recaptcha_sck);

                            if (!$cek_captcha)
                                $msg = '<div class="alert alert-danger">Please verify the captcha first!</div>';
                            else
                            {
                                // Output emailnya nanti berupa array
                                $sql_tim = 
                                'SELECT 
                                    mt.id team_id, 
                                    mt.name,
                                    CONCAT(\'["\', GROUP_CONCAT(DISTINCT mp.email SEPARATOR \'","\'), \'"]\') email
                                FROM `2022_main_teams` mt
                                    INNER JOIN `2022_main_participants` mp
                                        ON mt.id = mp.team_id
                                    WHERE mt.name = :name
                                GROUP BY email AND mt.name';

                                $check_tim = $pdo->prepare($sql_tim);
                                $check_tim->bindParam(':name', $forgot);
                                $check_tim->execute();

                                if ($check_tim->rowCount() > 0)
                                {
                                    $generate_token = md5($forgot.time());
                                    $fetch_tim      = $check_tim->fetch();
                                    $arr_email      = json_decode($fetch_tim['email']);
                                    $url_reset      = 'https://irgl.petra.ac.id/irgl2022/forgot.php?act=reset_password&token='.$generate_token;

                                    
                                    // Detail Email
                                    $ua             = $_SERVER['HTTP_USER_AGENT'];
                                    $tanggal_kirim  = date('Y-m-d H:i:s');
                                    $tanggal_ex     = date('Y-m-d H:i:s', strtotime($tanggal_kirim) + 1800); // Setengah jam dari waktu kirim email


                                    // Konten Email Yang Mau Dikirim
                                    $title_email = 'IRGL 2022 - Petra';
                                    $from_email  = 'irglukpetra@andsp.id';
                                    $subject     = 'Someone requests to reset your team password.';
                                    $message     = 
                                    '
                                    Hello Team! "'.$fetch_tim['name'].'"<br/>
                                    Someone just requested to reset a new password.<br/><br/>

                                    <b>Date</b>: '.$tanggal_kirim.'<br/>
                                    <b>From</b>: '.$_SERVER['REMOTE_ADDR'].' - '.$ua.'<br/><br/>

                                    If this request is from your members, please click on the link below to create a new password:<br/><br/>

                                    <a href="'.$url_reset.'">'.$url_reset.'</a><br/><br/>

                                    <b>The link will end at</b>: '.$tanggal_ex.'<br/><br/>

                                    <span style="color: red">*</span> Ignore this email, if a member of your team doesn\'t request to create a new password.<br/><br/>

                                    Regards,<br/>
                                    Web IT Division<br/>
                                    IRGL Petra 2022 - Informatics Rally Games and Logic<br/><br/>

                                    Thank you
                                    ';

                                    // Pengaturan SMTP
                                    $mail = new PHPMailer;
                                    $mail->isSMTP();
                                    $mail->SMTPDebug    = 0;
                                    $mail->Debugoutput  = 'html';
                                    $mail->Host         = 'andsp.id';
                                    $mail->Port         = 465;
                                    $mail->SMTPSecure   = 'ssl';
                                    $mail->SMTPAuth     = true;
                                    $mail->Username     = $from_email;
                                    $mail->Password     = "SacredExcalibur";

                                    $mail->setFrom($from_email, $title_email);
                                    $mail->addReplyTo($from_email, $title_email);

                                    // Kirim ke semua email anggota dari tim
                                    foreach ($arr_email as $email)
                                        $mail->AddCC($email);
                                    
                                    $mail->Subject = $subject;
                                    $mail->msgHTML($message);

                                    if (!$mail->send())
                                        $msg = '<div class="alert alert-danger">An error occurred while sending the link. Please try again later or contact the Administrator.</div>';
                                    else
                                    {
                                        $team_id    = $fetch_tim['team_id'];
                                        $update_req = "UPDATE `2022_main_teams` SET reset_password_code = :rpc, date_of_reset_request = :df WHERE id = :id";
                                        $update_req = $pdo->prepare($update_req);
                                        $update_req->bindParam(':rpc', $generate_token);
                                        $update_req->bindParam(':df', $tanggal_kirim);
                                        $update_req->bindParam(':id', $team_id);
                                        $update_req->execute();

                                        if ($update_req)
                                        {
                                            setcookie('berhasil_terkirim', 'oke', time() + 3600, '/');
                                            header('location: ?');
                                        }
                                        else
                                            $msg = '<div class="alert alert-danger">An error occurred while updating the data. Please try again later or contact the Administrator.</div>';
                                    }
                                }
                                else
                                    $msg = '<div class="alert alert-danger">The team is not registered.</div>';
                            }
                        }
                ?>
            
                <div class="title">Forgot Password</div>
                
                <?php 
                
                if (isset($_COOKIE['berhasil_terkirim']))
                {
                    setcookie('berhasil_terkirim', null, time() - 3600, '/');
                    echo '<div class="alert alert-success">Successfully sent a link to each team\'s email. Please check inbox or spam box.</div>';
                }
                else if (isset($_COOKIE['berhasil_tersimpan']))
                {
                    setcookie('berhasil_tersimpan', null, time() - 3600, '/');
                    echo '<div class="alert alert-success">Successfully saved new password, please login with new password.</div>';
                }
                else 
                {
                    if (isset($msg))
                        echo $msg;
                } ?>

                <input type="text" name="forgot" placeholder="Team Name" value="<?=isset($forgot) ? htmlspecialchars($forgot) : ''?>" class="form-control" required /><br/>

                <?php break; 

                    case 'reset_password':
                        $get_token = isset($_GET['token']) ? $_GET['token'] : '';
                         
                        if (empty($get_token))
                            header('Location: ?');
                        else
                        {
                            $check_token = "SELECT id, date_of_reset_request FROM `2022_main_teams` WHERE reset_password_code = :rpc";
                            $check_token = $pdo->prepare($check_token);
                            $check_token->bindParam(':rpc', $get_token);
                            $check_token->execute();

                            if ($check_token->rowCount() == 0)
                                header('Location: ?');
                            else
                            {
                                $fetch_token = $check_token->fetch();
                                $cek_waktu_reset = strtotime($fetch_token['date_of_reset_request']);

                                // Cek apakah melebihi setengah jam dari waktu request pass
                                if (time() > ($cek_waktu_reset + 1800))
                                    header('Location: ?');
                                else
                                {
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                    {
                                        $cek_captcha = verifikasiCaptcha($_POST['g-recaptcha-response'], $recaptcha_sck);

                                        if (!$cek_captcha)
                                            $msg = '<div class="alert-danger">Please verify the captcha first!</div>';
                                        else
                                        {
                                            $new_pass = $_POST['new_pass'];
                                            $confirm_pass = $_POST['confirm_pass'];

                                            if (mb_strlen($new_pass) < 8 || mb_strlen($new_pass) > 16)
                                            {
                                                $msg  = '<div class="alert alert-danger">Password minimum 8 and maximum 16 characters.</div>';
                                            }
                                            else if ($confirm_pass != $new_pass)
                                            {
                                                $msg = '<div class="alert alert-danger">Confirm password is wrong.</div>';
                                            }
                                            else
                                            {
                                                $pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);

                                                $update_pass = "UPDATE `2022_main_teams` SET password = :pass, reset_password_code = '', 
                                                date_of_reset_request = '' WHERE id = :id";
                                                $update_pass = $pdo->prepare($update_pass);
                                                $update_pass->bindParam(':pass', $pass_hash);
                                                $update_pass->bindParam(':id', $fetch_token['id']);
                                                $update_pass->execute();

                                                if ($update_pass)
                                                {
                                                    setcookie('berhasil_tersimpan', 'oke', time() + 3600, '/');
                                                    header('location: ?');
                                                }
                                                else
                                                    $msg = '<div class="alert alert-danger">An error occurred while saving the new password.</div>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                ?>
                    
                <div class="title">Reset Password</div>

                <?php 
                
                if (isset($msg))
                    echo $msg

                ?>

                <input type="password" name="new_pass" placeholder="New Password" class="form-control" required /><br/>
                <input type="password" name="confirm_pass" placeholder="Confirm Password" class="form-control" required /><br/>

                <?php endswitch ?>

                    <div class="g-recaptcha" data-sitekey="<?=$recaptcha_stk?>"></div><br/>
                    <button class="btn btn-primary btn-block btn-lg" name="reset">Reset Password</button>

                </form>
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="./js/jquery-3.6.0.min.js"></script>

        <?php if ($act != 'reset_password'): ?>
            <script>
                $('#request_pass').submit(function(e)
                {
                    $('button[name=reset]').attr('disabled', 'disabled');
                    $('button[name=reset]').text('Please wait ...');
                })
            </script>
        <?php endif ?>
    </body>
</html>