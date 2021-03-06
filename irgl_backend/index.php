<?php

require_once "./backend/includes/connection.php";

if (isset($_SESSION['login_team']))
    header('location: ./coming_soon.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IRGL Petra 2022 - Informatics Rally Games and Logic</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/sweet-alert/sweetalert2.min.css" />
    <link rel="stylesheet" href="./assets/styles.css" />
    <link rel="stylesheet" href="./assets/styles-darkmode.css" />
    <link rel="stylesheet" href="./assets/responsive.css" />
</head>

<body style="width: 100vw; height: 100vh; overflow: hidden">

    <div id="irgl-section">
        <canvas class="webgl" data-engine="three.js r136" width="1920" height="893"
            style="touch-action: none; user-select: none;"></canvas>
        <div class="dimmer"></div>

        <div class="index-section">
            <div class="title-description">
                ODYSSEY OF THE SACRED EXCALIBUR
            </div>

            <div class="menu-cont-wrapper">
                <div class="menu-container">
                    <div class="login">
                        <a data-toggle="modal" data-hide=".index-section" data-target="#loginModal" id="login">LOGIN</a>
                    </div>
                    <div class="register">
                        <a data-toggle="modal" data-hide=".index-section" data-target="#registrationModal">REGISTER</a>
                    </div>
                    <div class="settings">
                        <a data-toggle="modal" data-target="#settingsModal" data-hide=".index-section">SETTINGS</a>
                    </div>
                    <div class="about">
                        <a id="about">ABOUT US</a>
                    </div>
                    <div class="timeline">
                        <a id="timeline">TIMELINE</a>
                    </div>
                    <div class="contact">
                        <a data-toggle="modal" data-target="#contactUsModal" data-hide=".index-section">CONTACT US</a>
                    </div>
                </div>
            </div>

            <div class="footer">
                IRGL 2022 Web Team
            </div>
        </div>
    </div>



    <div class="modal" data-display="loader">
        <div class="content">
            Press anywhere to continue
        </div>
    </div>



    <div class="modal" id="loginModal">
        <form method="post" class="form-login">
            <div class="login-form">
                <div class="title">
                    LOGIN
                </div>

                <div class="content-section">
                    <label for="team_email"><b>E-mail or Team Name</b></label>
                    <input type="text" id="team_email" placeholder="Your Email or Team Name" name="email"><br>

                    <label for="password"><b>Team Password</b></label>
                    <input type="password" id="password" placeholder="Password" name="team_password"><br>

                    
                    <div class="captcha" id="reCaptchaLogin" data-sitekey="<?=$recaptcha_stk?>"></div><br/>

                    <a href="<?=$pathURL?>/forgot.php" target="_blank">Forgot Password?</a><br/><br/>

                    <button>Login Now</button>

                    <a data-toggle="modal" data-target=".index-section" data-hide="#loginModal" class="back"><i class="fa fa-arrow-left"></i> Back To Main Menu</a> 
                </div>
            </div>

            
        </form>
    </div>

    

    <div class="modal" id="registrationModal">
        <div class="registration-page" id="registration">

            <canvas class="webgl2"></canvas>

            <form method="post" class="form-regist" enctype="multipart/form-data"> 
                <div class="form-container">
                    <div class="register-form" id="team_regist">

                        <div class="top-form">
                            <div class="curr-form-info">
                                TEAM
                            </div>
    
                            <div class="next-button" onclick="registerNext('#team_regist', '#leader')">
                                <div class="next-inner">
                                    NEXT
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
    
                        <div class="rows">
                            <label for="team-name">Team Name</label>
                            <input type="text" id="team-name" name="teamName" placeholder="Team Name">
    
                            <label for="team_pass">Team Password</label>
                            <input type="password" placeholder="Enter password" id="team_pass" name="pwd">
                        </div>

                        <div class="rows">
                            <label for="team-school">School Name</label>
                            <input type="text" id="team-school" name="schoolName" placeholder="School Name">

                            <label for="">Bukti Transfer<br/>(.jpg/jpeg, .png, .pdf)</label>
                            <input type="file" name="buktiTrf" id="buktiTrf"><br/>
                        </div>

                        <div class="rows"></div>
                        <div class="rows"></div>
                        <div class="rows"></div>
                        <div class="rows"></div>
                    </div>



                    <div class="register-form" id="leader" style="display: none;">
                        <div class="top-form">
                            <div class="curr-form-info">
                                LEADER
                            </div>
                            <div class="back-button-mem" onclick="registerNext('#leader', '#team_regist')">
                                <div class="next-inner">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK
                                </div>
                            </div>
                            <div class="next-button" onclick="registerNext('#leader', '#member-1')">
                                <div class="next-inner">
                                    NEXT
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>

                        <div class="rows"> <label for="leader-name">Full Name</label>
                            <input type="text" id="regis-leader-name" name="leaderName" placeholder="Full Name">
                            <label for="leader-dob">Date of Birth</label>
                            <input type="text" id="regis-leader-dob" placeholder="yyyy-mm-dd" name="leaderBD">
                        </div>
                        <div class="rows"><label for="leader-cob">City of Birth</label>
                            <input type="text" id="regis-leader-cob" name="leaderCB" placeholder="City of Birth">
                            <label for="leader-grade">School Grade</label>

                            <select class="select-custom" name="leaderSG">
                                <option value="">School Grade:</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="rows"><label for="leader-address">Address</label>
                            <input type="text" id="regis-leader-address" name="leaderAdd" placeholder="Address">
                            <label for="leader-line">LINE ID</label>
                            <input type="text" id="regis-leader-line" name="leaderLine" placeholder="LINE ID">
                        </div>
                        <div class="rows"><label for="leader-phone">Phone Number</label>
                            <input type="text" id="regis-leader-phone" name="leaderWA" placeholder="Phone Number">
                            <label for="leader-studid">Student ID - Card<br/>(.jpg/jpeg, .png, .pdf)</label>
                            <input type="file" id="regis-leader-studid" name="leaderSC">
                        </div>
                        <div class="rows">
                            <label for="leader-email">E-mail</label>
                            <input type="text" id="regis-leader-email" name="leaderEmail" placeholder="E-mail">
                        </div>

                    </div>


                    <div class="register-form" id="member-1" style="display: none;">
                        <div class="top-form">
                            <div class="curr-form-info">
                                FIRST MEMBER
                            </div>

                            <div class="back-button-mem" onclick="registerNext('#member-1', '#leader')">
                                <div class="next-inner">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK
                                </div>
                            </div>
                            <div class="next-button" onclick="registerNext('#member-1', '#member-2')">
                                <div class="next-inner">
                                    NEXT
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>

                        <div class="rows">
                            <label for="mem1-name">Full Name</label>
                            <input type="text" id="regis-mem1-name" name="member1" placeholder="Full Name">
                            <label for="mem1-dob">Date of Birth</label>
                            <input type="text" id="regis-mem1-dob" placeholder="yyyy-mm-dd" name="m1BD">
                        </div>
                        <div class="rows">
                            <label for="mem1-cob">City of Birth</label>
                            <input type="text" id="regis-mem1-cob" name="m1CB" placeholder="City of Birth">
                            <label for="mem1-grade">School Grade</label>
                            <select class="select-custom" name="m1SG">
                                <option value="">School Grade:</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="rows">
                            <label for="mem1-address">Address</label>
                            <input type="text" id="regis-mem1-address" name="m1Add" placeholder="Address">
                            <label for="mem1-line">LINE ID</label>
                            <input type="text" id="regis-mem1-line" name="m1Line" placeholder="LINE ID">
                        </div>
                        <div class="rows">
                            <label for="mem1-phone">Phone Number</label>
                            <input type="text" id="regis-mem1-phone" name="m1WA" placeholder="Phone Number">
                            <label for="mem1-studid">Student ID - Card<br/>(.jpg/jpeg, .png, .pdf)</label>
                            <input type="file" id="regis-mem1-studid" name="m1SC">
                        </div>
                        <div class="rows">
                            <label for="mem2-phone">E-mail</label>
                            <input type="text" id="regis-mem1-email" name="m1Email" placeholder="Email Address">
                        </div>
                    </div>



                    <div class="register-form" id="member-2" style="display: none;">

                        <div class="top-form">
                            <div class="curr-form-info">
                                SECOND MEMBER
                            </div>
                            <div class="back-button-mem" onclick="registerNext('#member-2', '#member-1')">
                                <div class="next-inner">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK
                                </div>
                            </div>
                            <div class="next-button" onclick="registerNext('#member-2', '#verifCaptcha')">
                                <div class="next-inner">
                                    NEXT
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>

                        <div class="rows">
                            <label for="mem1-name">Full Name</label>
                            <input type="text" id="regis-mem2-name" name="member2" placeholder="Full Name">
                            <label for="mem1-dob">Date of Birth</label>
                            <input type="text" id="regis-mem2-dob" placeholder="yyyy-mm-dd" name="m2BD">
                        </div>
                        <div class="rows">
                            <label for="mem1-cob">City of Birth</label>
                            <input type="text" id="regis-mem2-cob" name="m2CB" placeholder="City of Birth">
                            <label for="mem1-grade">School Grade</label>
                            <select class="select-custom" name="m2SG">
                                <option value="">School Grade:</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="rows">
                            <label for="mem1-address">Address</label>
                            <input type="text" id="regis-mem2-address" name="m2Add" placeholder="Address">
                            <label for="mem1-line">LINE ID</label>
                            <input type="text" id="regis-mem2-line" name="m2Line" placeholder="LINE ID">
                        </div>
                        <div class="rows">
                            <label for="mem1-phone">Phone Number</label>
                            <input type="text" id="regis-mem2-phone" name="m2WA" placeholder="Phone Number">
                            <label for="mem1-studid">Student ID - Card<br/>(.jpg/jpeg, .png, .pdf)</label>
                            <input type="file" id="regis-mem2-studid" name="m2SC">
                        </div>
                        <div class="rows">
                            <label for="mem2-phone">E-mail</label>
                            <input type="text" id="regis-mem2-email" name="m2Email" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="register-form" id="verifCaptcha" style="display: none;">

                        <div class="top-form">
                            <div class="curr-form-info">
                                VERIFICATION
                            </div>
                            <div class="back-button-mem" onclick="registerNext('#verifCaptcha', '#member-2')">
                                <div class="next-inner">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK
                                </div>
                            </div>
                            <div class="submit-button-container">
                                <button class="submit-form">
                                    SUBMIT
                                </button>
                            </div>
                        </div>

                        <div class="rows">
                            <label for="mem2-captcha">Captcha Verification</label>
                            <div class="captcha" id="reCaptchaRegister" data-sitekey="<?=$recaptcha_stk?>"></div><br/>
                        </div>
                        <div class="rows"></div>
                        <div class="rows"></div>
                        <div class="rows"></div>
                        <div class="rows"></div>
                    </div>
            </form>
        </div>

            <div class="back-button" id="back" data-toggle="modal" data-target=".index-section"
                data-hide="#registrationModal">
                <i class=" fa fa-arrow-left"></i>
                &nbsp; Back to Main Menu
            </div>

        </div>
    </div>



    <div class="modal" id="settingsModal">
        <div class="box-center">
            <div class="centered">
                <div class="box-left">
                    <img src="./assets/excalibur.png" alt="excalibur" class="object1" />
                    <img src="./assets/excalibur.png" alt="excalibur" class="object2" />
                </div>
                <div class="box-right settings">
                    <div class="title">
                        <h2>Settings</h2>
                    </div>

                    <div class="content">
                        <div class="box-layout">
                            <div class="icon rotateFull">
                                <i class="faicon fas fa-sun" id="darkModeClick"></i>
                            </div>
                            <div class="set">
                                Dark Mode<br />
                                <div class="status">
                                    <select class="select-custom" id="darkModeSelect">
                                        <option selected>OFF</option>
                                        <option>ON</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-layout">
                            <div class="icon rotateV">
                                <i class="faicon fas fa-volume" id="volumeClick"></i>
                            </div>
                            <div class="set">
                                Volume<br />
                                <div class="status">
                                    <select class="select-custom" id="volumeSelect">
                                        <option value="0">Low</option>
                                        <option value="1" selected>Default</option>
                                        <option value="2">High</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-layout">
                            <div class="icon rotateC">
                                <i class="faicon fas fa-music" id="musicSoundClick"></i>
                            </div>
                            <div class="set">
                                Music & Sound<br />
                                <div class="status">
                                    <select id="musicSoundSelect" class="select-custom">
                                        <option>OFF</option>
                                        <option selected>ON</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="save-section">
                        <button data-toggle="modal" data-target=".index-section" data-hide="#settingsModal">&laquo; Back
                            to main menu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal" id="contactUsModal">
        <div class="box-center">
            <div class="centered">
                <div class="box-left">

                    <div class="contact_us">
                        <img src="./assets/castle.png" alt="Castle" width="380" />
                    </div>
                </div>

                <div class="box-right settings">
                    <div class="title">
                        <h2>Contact Us</h2>
                    </div>

                    <div class="content">
                        <div class="box-layout">
                            <div class="icon rotate">
                                <i class="faicon fab fa-instagram" id="darkModeClick"></i>
                            </div>
                            <div class="set">
                                Instagram
                                <a href="//www.instagram.com/irglpetra2022" target="_blank"
                                    class="status">irglpetra2022</a>
                            </div>
                        </div>

                        <div class="box-layout">
                            <div class="icon rotate">
                                <i class="faicon fab fa-line"></i>
                            </div>
                            <div class="set">
                                Line
                                <a href="https://line.me/R/ti/p/@462mqnpg" target="_blank" class="status">@462mqnpg</a>
                            </div>
                        </div>
                    </div>

                    <div class="save-section">
                        <button data-toggle="modal" data-target=".index-section" data-hide="#contactUsModal">&laquo;
                            Back to main menu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <script src="./assets/sweet-alert/sweetalert2.min.js"></script>

    <script type="module" src="./js/index.js"></script>
    <script type="module" src="./js/registration.js"></script>
    
    <script src="./js/main.js"></script>
    <script type="text/javascript">
        $(function () 
        {
            let sword;
            let moveMouse = true;

            window.init3D();
            window.animate3D();
            changeStyleWebGl();
        });
    </script>
</body>
</html>
