<?php

require_once "./includes/connection.php";
isUserLogin();

$title = 'Selamat datang di halaman Admin IRGL 2022';
require_once './includes/header.php'; ?>

<!-- Index IRGL -->
<div class="index-irgl">
    <div class="title">
        Selamat datang!
    </div>
    <div class="content">
        <img src="<?=$pathURL?>assets/images/logo-irgl.png" alt="IRGL 2022" /><br/><br/>
        <h2>THE LOST KINGDOM</h2>
        <p class="sub">Odyssey of the Sacred Excalibur</p>
        <br/>

        <p>
            Halo! <b><?php echo $nama_admin;?></b>,<br/>
            Selamat datang di halaman admin IRGL 2022.
        </p>
    </div>
</div>
<!-- End Index IRGL -->

<?php require_once './includes/footer.php' ?>