<!DOCTYPE html>
<html lang="id">
    <head>
        <title><?=$title?></title>
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
        <nav class="navbar navbar-expand-lg navbar-custom">
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
                            <a class="dropdown-item" href="#">Data Peserta</a>
                            <a class="dropdown-item" href="#">Menu 2</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Menu 3</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> Akun saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Pengaturan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$pathURL?>keluar.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->


        <!-- Clear header -->
        <div class="clear-header"></div>