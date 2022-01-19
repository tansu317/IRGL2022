<?php 

require_once "./includes/connection.php";

isAlreadyLogin();

if (isset($_POST['masuk'])) 
{
    $nrp = strtolower($_POST["nrp"]);
    $pass = $_POST["pass"];
    $tetapMasuk = isset($_POST['tetap_masuk']) ? $_POST['tetap_masuk'] : '';

    $sql = "SELECT password FROM `admin` WHERE nrp = :nrp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nrp', $nrp);
    $stmt->execute();
    $fetch = $stmt->fetch(PDO::FETCH_OBJ);

    if ($stmt->rowCount() == 0)
    {
        $error = 'NRP yang Anda masukin tidak terdaftar!';
    }
    else if (!password_verify($pass, $fetch->password)) 
    {
        $error = 'Katasandi yang Anda masukin salah!';
    }
    else
    {
        $time = date("Y-m-d H:i:s");
        $hash_login = md5($nrp.$pass.time().rand(9999));

        $timesql = "UPDATE `admin` SET time_login='$time', hash_login='$hash_login' WHERE nrp=:nrp";
        $timestmt = $pdo->prepare($timesql);
        $timestmt->bindParam(':nrp', $nrp);
        $timestmt->execute();
        
        // $_SESSION['user'] = $nrp;

         // kalau yes -> 1 hari, kalau engga 1 jam loginnya
        $time_login = $tetapMasuk == 'yes' ? time() + 86400 : time() + 3600;
        setcookie('login', $hash_login, $time_login, '/');

        header('location: '.$pathURL);
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
                    <input type="text" name="nrp" placeholder="NRP" id="nrp" class="form-control" maxlength="9" minlength="0" required /><br/>

                    <input type="password" name="pass" placeholder="Katasandi" id="pass" class="form-control" required/><br/>
    
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="tetap-masuk" value="yes" name="tetap_masuk">
                        <label class="custom-control-label" for="tetap-masuk">Tetap masuk di browser ini</label>
                    </div><br/>
    
                    <button class="btn btn-primary btn-block btn-lg" name="masuk">Masuk</button>
                </form>
               
                <div class="footer-login">
                    Tidak dapat masuk? <a href="#">Lupa Katasandi</a>
                </div>
            </div>
        </div>

        <script src="<?=$pathURL?>assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?=$pathURL?>assets/js/popper.min.js"></script>
        <script src="<?=$pathURL?>assets/js/bootstrap.min.js"></script>
    </body>
</html>