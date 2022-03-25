<!DOCTYPE html>
<html lang="id">
    <head>
        <title><?=!empty($title) ? $title : 'IRGL 2022'?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <!-- Style -->
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?=$pathURL?>assets/css/styles.css" />

        <!-- Favicon-->
        <link rel="icon" href="<?=$pathURL?>assets/images/favicon.ico" />
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-custom">
            <a class="navbar-brand" href="<?=$pathURL?>">
                <img src="<?=$pathURL?>assets/images/logo-irgl.png" alt="IRGL Petra 2022"> <span class="title">IRGL 2022</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$pathURL?>"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menu-admin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-search" aria-hidden="true"></i> Menu admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menu-admin">
                            <a class="dropdown-item" href="<?=$pathURL?>irgl/data-peserta.php">Data Peserta</a>
                            <a class="dropdown-item" href="#">Menu 2</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Menu 3</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modalLogout"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->


        <!-- Modal Logout -->
        <div class="modal fade" id="modalLogout" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLogoutLabel">Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin keluar dari halaman Admin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <a href="<?=$pathURL?>keluar.php" class="btn btn-primary">Ya</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Logout -->

        
        <!-- Clear header -->
        <div class="clear-header"></div>

        <?php

        $sql = 'SELECT nama, nrp, division, last_time_login FROM `2022_admin` WHERE login_cookie = :hash';
        $fetch_admin = $pdo->prepare($sql);
        $fetch_admin->bindParam(':hash', $cookie_login);
        $fetch_admin->execute();
        $fetch_admin = $fetch_admin->fetch(PDO::FETCH_OBJ);
        $nama_admin = empty($fetch_admin->nama) ? $fetch_admin->nrp : $fetch_admin->nama;
        $nama_admin = htmlspecialchars($nama_admin);

        ?>
        
        <div class="info-login-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <b>Admin</b>: <?=htmlspecialchars(strtoupper($fetch_admin->nrp))?> - <?=$nama_admin?>
                    </div>

                    <div class="col-md-4">
                        <b>Divisi</b>: <?=htmlspecialchars(strtoupper(empty($fetch_admin->division) ? '-' : $fetch_admin->division))?>
                    </div>

                    <div class="col-md-4">
                        <b>Login terakhir</b>: <?=$fetch_admin->last_time_login == '0000-00-00 00:00:00' ? '-' : $fetch_admin->last_time_login?>
                    </div>
                </div>
            </div>
        </div>