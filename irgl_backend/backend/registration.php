<?php

require_once "./includes/connection.php";

$return         = false;
$msg            = '';
$successRegist  = false;
if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isset($_SESSION['login_team']))
{
    $return = true;

    // Regex
    $regexWa        = "/^(\()?(\+62|62|0)(\d{2,3})?\)?[ .-]?\d{2,4}[ .-]?\d{2,4}[ .-]?\d{2,4}$/";
    $regexBd        = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    $regexnama      = "/^[A-Za-z0-9_\.\-\ ]+$/";
    $regexEmail     = "/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i";

    // Card Member Types
    $CmAllowTypes   = ['jpg', 'jpeg', 'png'];
    $bktfAllowTypes = ['pdf'];

    // Size Maxmimum
    $sizeFileUp = 3145728; // 3 MB

    // section1;
    $namaTim         = trim($_POST['teamName']);
    $pass            = $_POST['pwd'];
    $pass_hash       = password_hash($pass, PASSWORD_DEFAULT);
    $sekolah         = trim($_POST['schoolName']);

    $sql_cek_namaTim = "SELECT `name` FROM `2022_main_teams` WHERE `name` = :namatim";
    $stmt            = $pdo->prepare($sql_cek_namaTim);
    $stmt->bindParam(':namatim', $namaTim);
    $stmt->execute();


    // section2;
    $ketua          = trim($_POST['leaderName']);
    $dbLeader       = trim($_POST['leaderBD']);
    $cbLeader       = trim($_POST['leaderCB']);
    $sgLeader       = trim($_POST['leaderSG']);
    $addLeader      = trim($_POST['leaderAdd']);
    $lineLeader     = trim($_POST['leaderLine']); 
    $emailLeader    = trim(strtolower($_POST['leaderEmail']));
    $waLeader       = trim($_POST['leaderWA']);

    $sql_cekem      = "SELECT `email` FROM `2022_main_participants` WHERE email = :email";
    $check_emailLD  = $pdo->prepare($sql_cekem);
    $check_emailLD->bindParam(':email', $emailLeader);
    $check_emailLD->execute();

    $fileNameLD     = $_FILES['leaderSC']['name'];
    $fileSizeLD     = $_FILES['leaderSC']['size'];
    $fileTempNameLD = $_FILES['leaderSC']['tmp_name'];
    $fileExtLD      = explode('.', $fileNameLD);
    $fileExtensionLD= strtolower(end($fileExtLD));


    //section3
    $p1             = trim($_POST['member1']);
    $dbp1           = trim($_POST['m1BD']);
    $cbp1           = trim($_POST['m1CB']);
    $sgp1           = trim($_POST['m1SG']);
    $addp1          = trim($_POST['m1Add']);
    $linep1         = trim($_POST['m1Line']);
    $emailp1        = trim(strtolower($_POST['m1Email']));
    $wap1           = trim($_POST['m1WA']);

    $check_emailFM  = $pdo->prepare($sql_cekem);
    $check_emailFM->bindParam(':email', $emailp1);
    $check_emailFM->execute();

    $fileNameFM     = $_FILES['m1SC']['name'];
    $fileSizeFM     = $_FILES['m1SC']['size'];
    $fileTempNameFM = $_FILES['m1SC']['tmp_name'];
    $fileExtFM      = explode('.', $fileNameFM);
    $fileExtensionFM= strtolower(end($fileExtFM));


    //section4
    $p2             = trim($_POST['member2']);
    $dbp2           = trim($_POST['m2BD']);
    $cbp2           = trim($_POST['m2CB']);
    $sgp2           = trim($_POST['m2SG']);
    $addp2          = trim($_POST['m2Add']);
    $linep2         = trim($_POST['m2Line']);
    $emailp2        = trim(strtolower($_POST['m2Email']));
    $wap2           = trim($_POST['m2WA']);

    $check_emailSM  = $pdo->prepare($sql_cekem);
    $check_emailSM->bindParam(':email', $emailp2);
    $check_emailSM->execute();

    $fileNameSM     = $_FILES['m2SC']['name'];
    $fileSizeSM     = $_FILES['m2SC']['size'];
    $fileTempNameSM = $_FILES['m2SC']['tmp_name'];
    $fileExtSM      = explode('.', $fileNameSM);
    $fileExtensionSM= strtolower(end($fileExtSM));
    $smIsRegis      = (!empty($p2) || !empty($emailp2) || !empty($dbp2) || !empty($cbp2) ||
                    !empty($sgp2) || !empty($addp2) || !empty($linep2) ||!empty($wap2) || 
                    !empty($fileTempNameSM)) ? true : false;


    // Section 5
    $fileNameTF     = $_FILES['buktiTrf']['name'];
    $fileSizeTF     = $_FILES['buktiTrf']['size'];
    $fileTempNameTF = $_FILES['buktiTrf']['tmp_name'];
    $fileExtTF      = explode('.', $fileNameTF);
    $fileExtensionTF= strtolower(end($fileExtTF));


    // Section 1
    if (mb_strlen($namaTim) < 3 || mb_strlen($namaTim) > 50)
    {
        $msg = 'Minimum team name 3 and maximum 50 characters.';
    }
    else if (!preg_match($regexnama, $namaTim)) 
    {
        $msg = 'Characters in team names are only allowed a-z, A-Z, 0-9, _-. and space';
    }
    else if ($stmt->rowCount() > 0)
    {
        $msg = 'The team name has been used, please use another team name.';
    }
    else if (mb_strlen($pass) < 8 || mb_strlen($pass) > 16)
    {
        $msg  = 'Password minimum 8 and maximum 16.';
    }
    else if (mb_strlen($sekolah) < 8 || mb_strlen($sekolah) > 80)
    {
        $msg  = 'Minimum school name 8 and maximum 80 characters.';
    }


    // Section 2
    else if (mb_strlen($ketua) < 5 || mb_strlen($ketua) > 50)
    {
        $msg = 'Leader name is at least 5 and a maximum of 50 characters.';
    }
    else if (!preg_match($regexEmail, $emailLeader))
    {
        $msg = 'The leader\'s email format doesn\'t match.';
    }
    else if ($check_emailLD->rowCount() > 0)
    {
        $msg = 'The leader\'s email has been registered, please use another email.';
    }
    else if (!preg_match($regexBd, $dbLeader))
    {
        $msg = 'The leader\'s birthday date format doesn\'t match.';
    }
    else if (mb_strlen($cbLeader) < 5 || mb_strlen($cbLeader) > 30)
    {
        $msg = 'City of birth leader minimum 5 and maximum 30 characters.';
    }
    else if (mb_strlen($sgLeader) < 3 || mb_strlen($sgLeader) > 30)
    {
        $msg = 'Leader school grade minimum 3 and maximum 30 characters.';
    }
    else if (mb_strlen($addLeader) < 12 || mb_strlen($addLeader) > 200)
    {
        $msg = 'The leader\'s address is at least 12 and a maximum of 200 characters.';
    }
    else if (mb_strlen($lineLeader) < 4 || mb_strlen($lineLeader) > 25)
    {
        $msg = 'ID line leader minimum 4 and maximum 25 characters.';
    }
    else if (!preg_match($regexWa, $waLeader))
    {
        $msg = 'Please enter the WhatsApp number leader correctly.';
    }
    else if (!in_array($fileExtensionLD, $CmAllowTypes))
    {
        $msg = 'The student card leader format is not supported. Only allowed: .jpg/jpeg, .png';
    }
    else if ($fileSizeLD > $sizeFileUp)
    {
        $msg = 'The student card leader maximum 3MB.';
    }
    // End Validation Section 2



    // Section 3
    else if (mb_strlen($p1) < 5 || mb_strlen($p1) > 50)
    {
        $msg = 'First member name is at least 5 and a maximum of 50 characters.';
    }
    else if (!preg_match($regexEmail, $emailp1))
    {
        $msg = 'The first member email format doesn\'t match.';
    }
    else if ($check_emailFM->rowCount() > 0)
    {
        $msg = 'The first member email has been registered, please use another email.';
    }
    else if (!preg_match($regexBd, $dbp1))
    {
        $msg = 'The first member birthday date format doesn\'t match.';
    }
    else if (mb_strlen($cbp1) < 5 || mb_strlen($cbp1) > 30)
    {
        $msg = 'City of Birth first member minimum 5 and maximum 30 characters.';
    }
    else if (mb_strlen($sgp1) < 3 || mb_strlen($sgp2) > 30)
    {
        $msg = 'First member school grade minimum 3 and maximum 30 characters.';
    }
    else if (mb_strlen($addp1) < 12 || mb_strlen($addp1) > 200)
    {
        $msg = 'The first member address is at least 12 and a maximum of 200 characters.';
    }
    else if (mb_strlen($linep1) < 4 || mb_strlen($linep1) > 25)
    {
        $msg = 'ID line first member minimum 4 and maximum 25 characters.';
    }
    else if (!preg_match($regexWa, $wap1))
    {
        $msg = 'Please enter the WhatsApp number first member correctly.';
    }
    else if (!in_array($fileExtensionFM, $CmAllowTypes))
    {
        $msg = 'The student card first member format is not supported. Only allowed: .jpg/jpeg, .png';
    }
    else if ($fileSizeFM > $sizeFileUp)
    {
        $msg = 'The student card first member maximum 3MB.';
    }
    // End Validation Section 3



    // Section 4
    else if ($smIsRegis && (mb_strlen($p2) < 5 || mb_strlen($p2) > 50))
    {
        $msg = 'Second member name is at least 5 and a maximum of 50 characters.';
    }
    else if ($smIsRegis && !preg_match($regexEmail, $emailp2))
    {
        $msg = 'The second member email format doesn\'t match.';
    }
    else if ($smIsRegis && ($check_emailSM->rowCount() > 0))
    {
        $msg = 'The second member email has been registered, please use another email.';
    }
    else if ($smIsRegis && !preg_match($regexBd, $dbp2))
    {
        $msg = 'The second member birthday date format doesn\'t match.';
    }
    else if ($smIsRegis && (mb_strlen($cbp2) < 5 || mb_strlen($cbp2) > 30))
    {
        $msg = 'City of Birth second member minimum 5 and maximum 30 characters.';
    }
    else if ($smIsRegis && (mb_strlen($sgp2) < 3 || mb_strlen($sgp2) > 30))
    {
        $msg = 'Second member school grade minimum 3 and maximum 30 characters.';
    }
    else if ($smIsRegis && (mb_strlen($addp2) < 12 || mb_strlen($addp2) > 200))
    {
        $msg = 'The second member address is at least 12 and a maximum of 200 characters.';
    }
    else if ($smIsRegis && (mb_strlen($linep2) < 4 || mb_strlen($linep2) > 25))
    {
        $msg = 'ID line second member minimum 4 and maximum 25 characters.';
    }
    else if ($smIsRegis && !preg_match($regexWa, $wap2))
    {
        $msg = 'Please enter the WhatsApp number second member correctly.';
    }
    else if ($smIsRegis && !in_array($fileExtensionSM, $CmAllowTypes))
    {
        $msg = 'The student card second member format is not supported. Only allowed: .jpg/jpeg, .png';
    }
    else if ($smIsRegis && ($fileSizeSM > $sizeFileUp))
    {
        $msg = 'The student card second member maximum 3MB.';
    }
    // End Validation Section 4



    // Section 5
    else if (!in_array($fileExtensionTF, $bktfAllowTypes))
    {
        $msg = 'Format bukti transfer tidak didukung. Bukti transfer hanya mendukung format: .pdf';
    }
    else if ($fileSizeTF > $sizeFileUp)
    {
        $msg = 'Maksimal ukuran file bukti transfer adalah 3MB.';
    }
    else
    {
        //  Total Partisipan
        $count  = $smIsRegis ? 3 : 2;
        $time   = date("Y-m-d H:i:s");
        $timefile = date("Y-m-d-H-i-s");


        // Upload Bukti TF ke Server
        $destinationTF = "./uploads/bukti_transfer/";
        $fileNewNameTF = $namaTim.'_buktitrf_'.$timefile.'.'.$fileExtensionTF;
        $targetDirTF   = $destinationTF . $fileNewNameTF;
        $moveTF        = move_uploaded_file($fileTempNameTF, $targetDirTF);
        $moveTF        = $moveTF ? $fileNewNameTF : '';


        // Insert Main Teams
        $sql_insert_main_team = "INSERT INTO `2022_main_teams`(`name`, `password`, `leader_name`,
        `participant_count`, `school`, `payment_filepath`, `date_of_registration`)
        VALUES (:namaTim, :pass, :ketua, $count, :sekolah, :bkt, '$time')";

        $stmt1 = $pdo->prepare($sql_insert_main_team);
        $stmt1->bindValue(':namaTim', $namaTim);
        $stmt1->bindValue(':pass', $pass_hash);
        $stmt1->bindValue(':ketua', $ketua);
        $stmt1->bindValue(':sekolah', $sekolah);
        $stmt1->bindValue(':bkt', $moveTF);
        $stmt1->execute();


        // Card Member
        $destinationCM = "./uploads/card_member/";
        $fileNewNameLD = $ketua.'_'.$namaTim.'_cardmember_'.$timefile.'.'.$fileExtensionLD;
        $targetDirLD   = $destinationCM . $fileNewNameLD;
        $moveLD        = move_uploaded_file($fileTempNameLD, $targetDirLD);
        $moveLD        = $moveLD ? $fileNewNameLD : '';

        $fileNewNameFM = $p1.'_'.$namaTim.'_cardmember_'.$timefile.'.'.$fileExtensionFM;
        $targetDirFM   = $destinationCM . $fileNewNameFM;
        $moveFM        = move_uploaded_file($fileTempNameFM, $targetDirFM);
        $moveFM        = $moveFM ? $fileNewNameFM : '';

        $moveSM = '';
        if ($smIsRegis)
        {
            $fileNewNameSM = $p2.'_'.$namaTim.'_cardmember_'.$timefile.'.'.$fileExtensionSM;
            $targetDirSM   = $destinationCM . $fileNewNameSM;
            $moveSM        = move_uploaded_file($fileTempNameSM, $targetDirSM);
            $moveSM        = $moveSM ? $fileNewNameSM : '';
        }
        // End Card Member

    
        function insertMainParticipants($team_id, $name, $datebirth, $citybirth, $sg, 
                                        $address, $line_id, $email, $phone_number, $std_path)
        {
            $time = $GLOBALS['time'];
            $sql = "INSERT INTO `2022_main_participants` (`team_id`,`name`, `date_of_birth`,
            `city_of_birth`, `school_grade`, `address`, `line_id`, `email`, `phone_number`, `studentid_filepath`, 
            `date_of_registration`) VALUES (:teamid, :name, :db, :cb, :sg, :addr, :line, :email, :wa, :sc, '$time')";
        
            $insert_main = $GLOBALS['pdo']->prepare($sql);
            $insert_main->bindParam(':teamid', $team_id);
            $insert_main->bindParam(':name', $name);
            $insert_main->bindParam(':db', $datebirth);
            $insert_main->bindParam(':cb', $citybirth);
            $insert_main->bindParam(':sg', $sg);
            $insert_main->bindParam(':addr', $address);
            $insert_main->bindParam(':line', $line_id);
            $insert_main->bindParam(':email', $email);
            $insert_main->bindParam(':wa', $phone_number);
            $insert_main->bindParam(':sc', $std_path);
            $insert_main->execute();
        }

        // Insert Main Participant
        $team_id = $pdo->lastInsertId(); // Buat dapatin ID "Main Teams" Yang Habis Diinsert
        
        // Leader
        insertMainParticipants($team_id, $ketua, $dbLeader, $cbLeader, $sgLeader, $addLeader, $lineLeader, $emailLeader, $waLeader, $moveLD);

        // First Member
        insertMainParticipants($team_id, $p1, $dbp1, $cbp1, $sgp1, $addp1, $linep1, $emailp1, $wap1, $moveFM);

        // Second Member
        if ($smIsRegis)
            insertMainParticipants($team_id, $p2, $dbp2, $cbp2, $sgp2, $addp2, $linep2, $emailp2, $wap2, $moveSM);

        $msg = 'Successfully registered, please login to get started';
        $successRegist = true;
    }
}

header('Content-Type: application/json');

echo json_encode([
    'return'         => $return,
    'success_regist' => $successRegist,
    'message'        => $msg
]);

?>