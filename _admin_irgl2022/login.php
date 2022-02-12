<?php 

require_once "./includes/connection.php";

isAlreadyLogin();

if (isset($_POST['masuk'])) 
{
    $nrp = strtolower($_POST["nrp"]);
    $pass = $_POST["pass"];
    $tetapMasuk = isset($_POST['tetap_masuk']) ? $_POST['tetap_masuk'] : '';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaGet = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$reCaptcha['secret_key'].'&response='.$recaptchaResponse);
    $recaptchaJSON = json_decode($recaptchaGet);

    if (!$recaptchaJSON->success) 
    {
        $error = 'Pastikan Google reCAPTCHA telah tercentang!';
    }
    else
    {
        // Login ke john.petra.ac.id
        $imap       = false;
        $host       = 'john.petra.ac.id';
        $port       = 110;
        $timeout    = 30;
        $fp         = fsockopen($host, $port, $errno, $errstr, $timeout);
        $errstr     = fgets($fp);

        if (substr($errstr, 0, 1) == '+') 
        {
            fputs($fp, "USER ".$nrp."\n");
            $errstr = fgets($fp);

            if (substr($errstr, 0, 1) == '+') 
            {
                fputs($fp, "PASS ".$pass."\n");
                $errstr = fgets($fp);

                if (substr($errstr, 0, 1) == '+') 
                {
                    $imap = true;
                }
            }
        }


        // Uji Coba login
//         if ($nrp == 'c14210004' && $pass == 'cobapass')
//             $imap = true;

        if ($imap)
        {
            $chadmin_sql = "SELECT nrp FROM `2022_admin` WHERE nrp = :nrp";
            $check_admin = $pdo->prepare($chadmin_sql);
            $check_admin->bindParam(':nrp', $nrp);
            $check_admin->execute();

            if ($check_admin->rowCount() == 0) 
            {
                $error = 'Login Gagal! NRP Anda tidak terdaftar sebagai admin IRGL 2022.';
            }
            else 
            {
                $time = date("Y-m-d H:i:s");
                $hash_login = md5($nrp.$pass.time().rand(0, 9999));
        
                $timesql = "UPDATE `2022_admin` SET last_time_login = '$time', login_cookie = '$hash_login' WHERE nrp = :nrp";
                $timestmt = $pdo->prepare($timesql);
                $timestmt->bindParam(':nrp', $nrp);
                $timestmt->execute();

                 // kalau yes -> 1 hari, kalau engga 1 jam loginnya
                $time_login = $tetapMasuk == 'yes' ? time() + 86400 : time() + 3600;
                setcookie('login', $hash_login, $time_login, '/');
        
                header('location: '.$pathURL);
            }
        }
        else 
        {
            $error = 'Login Gagal! NRP atau Katasandi tidak terdaftar.';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Login Admin - IRGL 2022</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <!-- Style -->
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/styles.css" />

        <!-- Favicon-->
        <link rel="icon" href="<?=$pathURL?>assets/images/favicon.ico" />
    </head>
    <body>

        <div class="login-form">
            <div class="logo-irgl">
                <img src="<?=$pathURL?>assets/images/logo-irgl.png" alt="IRGL 2022" />
            </div>
            
            <div class="box-login">
                <div class="title">Login Admin</div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif ?>

                <form method="post">
                    <input type="text" name="nrp" placeholder="NRP" id="nrp" value="<?=isset($nrp) ? htmlspecialchars($nrp) : ''?>" class="form-control" maxlength="9" required /><br/>

                    <input type="password" name="pass" placeholder="Katasandi" id="pass" class="form-control" required/><br/>

                    <div class="g-recaptcha" data-sitekey="<?=$reCaptcha['site_key']?>"></div><br/>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="tetap-masuk" value="yes" name="tetap_masuk">
                        <label class="custom-control-label" for="tetap-masuk">Tetap masuk di browser ini</label>
                    </div><br/>
    
                    <button class="btn btn-primary btn-block btn-lg" name="masuk">Masuk</button>
                </form>
            </div>
        </div>

        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="<?=$pathURL?>assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?=$pathURL?>assets/js/popper.min.js"></script>
        <script src="<?=$pathURL?>assets/js/bootstrap.min.js"></script>

        <!-- reCaptcha Responsive -->
        <script type="text/javascript">
            $(function() 
            {
                const width = $('.g-recaptcha').parent().width();
                if (width < 400) 
                {
                    const scale = width / 300;
                    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                    $('.g-recaptcha').css('transform-origin', '0 0');
                    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
                }
            });
        </script>
        <!-- End Responsive reCaptcha -->
    </body>
</html>
