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
    $regexnama      = "/^[A-Za-z ]+$/";
    $regexnamaTim   = "/^[A-Za-z0-9_\.\-\ ]+$/";
    $regexLineId    = "/^[A-Za-z0-9_\.\-]+$/";
    $regexAddr      = "/^[A-Za-z0-9-\,\.\ ]+$/";
    $regexEmail     = "/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i";
    $regexSekolah   = "/^[A-Za-z0-9\,\.\ ]+$/";

    $pilihanKelas   = ['10', '11', '12'];

    // Card Member Types
    $CmAllowTypes   = ['jpg', 'jpeg', 'png', 'pdf'];

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
    $fileErrorLD    = $_FILES['leaderSC']['error'];
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
    $fileErrorFM    = $_FILES['m1SC']['error'];
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
    $fileErrorSM    = $_FILES['m2SC']['error'];
    $fileExtSM      = explode('.', $fileNameSM);
    $fileExtensionSM= strtolower(end($fileExtSM));

    $smIsRegis      = (!empty($p2) || !empty($emailp2) || !empty($dbp2) || !empty($cbp2) ||
                    !empty($sgp2) || !empty($addp2) || 
                    !empty($linep2) ||!empty($wap2) || !empty($fileNameSM)) ? true : false;


    // Section 5
    $fileNameTF     = $_FILES['buktiTrf']['name'];
    $fileSizeTF     = $_FILES['buktiTrf']['size'];
    $fileTempNameTF = $_FILES['buktiTrf']['tmp_name'];
    $fileErrorTF    = $_FILES['buktiTrf']['error'];
    $fileExtTF      = explode('.', $fileNameTF);
    $fileExtensionTF= strtolower(end($fileExtTF));


    $cek_captcha = verifikasiCaptcha($_POST['g-recaptcha-response'], $recaptcha_sck);

    if (!$cek_captcha)
    {
        $msg = 'Verification - Captcha Verification. Error: "Please verify the captcha first!"';
    }
    else 

    // Section 1
    if (mb_strlen($namaTim) < 3 || mb_strlen($namaTim) > 40)
    {
        $msg = 'Team - Name. Error: "Minimum name 3 and maximum 40 characters."';
    }
    else if (!preg_match($regexnamaTim, $namaTim)) 
    {
        $msg = 'Team - Name. Error: "Characters only allowed a-z, A-Z, 0-9, _-. and space."';
    }
    else if ($stmt->rowCount() > 0)
    {
        $msg = 'Team - Name. Error: "The team name has been used, please use another team name."';
    }
    else if (mb_strlen($pass) < 8 || mb_strlen($pass) > 16)
    {
        $msg  = 'Team - Password. Error: "Minimum 8 and maximum 16 characters."';
    }
    else if (mb_strlen($sekolah) < 3 || mb_strlen($sekolah) > 80)
    {
        $msg  = 'Team - School Name. Error: "Minimum 3 and maximum 80 characters."';
    }
    else if (!preg_match($regexSekolah, $sekolah))
    {
        $msg  = 'Team - School Name. Error: "The only characters allowed are a-z, A-Z, 0-9, . , and space"';
    }
    else if ($fileErrorTF == 4 || $fileSizeTF == 0)
    {
        $msg = 'Team - Bukti Transfer. Error: "Tidak ada file yang diupload. Silahkan pilih file untuk diupload."';
    }
    else if (!in_array($fileExtensionTF, $CmAllowTypes))
    {
        $msg = 'Team - Bukti Transfer. Error: "Format tidak didukung. Bukti transfer hanya mendukung format: .jpg/jpeg, .png, .pdf"';
    }
    else if ($fileSizeTF > $sizeFileUp)
    {
        $msg = 'Team - Bukti Transfer. Error: "Maksimal ukuran file bukti transfer adalah 3MB."';
    }


    // Section 2
    else if (mb_strlen($ketua) < 3 || mb_strlen($ketua) > 80)
    {
        $msg = 'Leader - Name. Error: "Name is at least 3 and a maximum of 80 characters."';
    }
    else if (!preg_match($regexnama, $ketua))
    {
        $msg = 'Leader - Name. Error: "Characters in full names are not supported."';
    }
    else if (!preg_match($regexBd, $dbLeader))
    {
        $msg = 'Leader - Date of Birth. Error: "Format doesn\'t match."';
    }
    else if (calculateAge(date('m/d/Y', strtotime($dbLeader))) < 10)
    {
        $msg = 'Leader - Date of Birth. Error: "Participants must be at least 10 years old."';
    }
    else if (mb_strlen($cbLeader) < 3 || mb_strlen($cbLeader) > 30)
    {
        $msg = 'Leader - City of Birth. Error: "Minimum 3 and maximum 30 characters."';
    }
    else if (!preg_match($regexnama, $cbLeader))
    {
        $msg = 'Leader - City of Birth. Error: "Characters allowed only a-z and A-Z."';
    }
    else if (!in_array($sgLeader, $pilihanKelas))
    {
        $msg = 'Leader - School Grade. Error: "Please select an available School Grade (10, 11 or 12)."';
    }
    else if (mb_strlen($addLeader) < 3 || mb_strlen($addLeader) > 200)
    {
        $msg = 'Leader - Address. Error: "Address is at least 3 and a maximum of 200 characters."';
    }
    else if (!preg_match($regexAddr, $addLeader))
    {
        $msg = 'Leader - Address. Error: "Only address formats are allowed , . - and spaces."';
    }
    else if (mb_strlen($lineLeader) < 3 || mb_strlen($lineLeader) > 20)
    {
        $msg = 'Leader - ID Line. Error: "Minimum 3 and maximum 20 characters."';
    }
    else if (!preg_match($regexLineId, $lineLeader))
    {
        $msg = 'Leader - ID Line. Error: "Line ID characters are only allowed a-z, A-Z, 0-9, _, -, and ."';
    }
    else if (!preg_match($regexWa, $waLeader))
    {
        $msg = 'Leader - Phone Number. Error: "The phone number format does not match."';
    }
    else if ($fileErrorLD == 4 || $fileSizeLD == 0)
    {
        $msg = 'Leader - Student ID (Card). Error: "No files uploaded, please select a file to upload."';
    }
    else if (!in_array($fileExtensionLD, $CmAllowTypes))
    {
        $msg = 'Leader - Student ID (Card). Error: "Format is not supported. Only allowed: .jpg/jpeg, .png, .pdf"';
    }
    else if ($fileSizeLD > $sizeFileUp)
    {
        $msg = 'Leader - Student ID (Card). Error: "Maximum 3MB."';
    }
    else if (!preg_match($regexEmail, $emailLeader))
    {
        $msg = 'Leader - Email. Error: "Email format doesn\'t match."';
    }
    else if ($check_emailLD->rowCount() > 0)
    {
        $msg = 'Leader - Email. Error: "Email has been registered, please use another email."';
    }
    // End Validation Section 2



    // Section 3
    else if (mb_strlen($p1) < 3 || mb_strlen($p1) > 80)
    {
        $msg = 'First Member - Name. Error: "Name is at least 3 and a maximum of 80 characters."';
    }
    else if (!preg_match($regexnama, $p1))
    {
        $msg = 'First Member - Name. Error: "Characters in full names are not supported."';
    }
    else if (!preg_match($regexBd, $dbp1))
    {
        $msg = 'First Member - Date of Birth. Error: "Format doesn\'t match."';
    }
    else if (calculateAge(date('m/d/Y', strtotime($dbp1))) < 10)
    {
        $msg = 'First Member - Date of Birth. Error: "Participants must be at least 10 years old."';
    }
    else if (mb_strlen($cbp1) < 3 || mb_strlen($cbp1) > 30)
    {
        $msg = 'First Member - City of Birth. Error: "Minimum 3 and maximum 30 characters."';
    }
    else if (!preg_match($regexnama, $cbp1))
    {
        $msg = 'First Member - City of Birth. Error: "Characters allowed only a-z and A-Z."';
    }
    else if (!in_array($sgp1, $pilihanKelas))
    {
        $msg = 'First Member - School Grade. Error: "Please select an available School Grade (10, 11 or 12)."';
    }
    else if (mb_strlen($addp1) < 3 || mb_strlen($addp1) > 200)
    {
        $msg = 'First Member - Address. Error: "Address is at least 3 and a maximum of 200 characters."';
    }
    else if (!preg_match($regexAddr, $addp1))
    {
        $msg = 'First Member - Address. Error: "Only address formats are allowed , . - and spaces."';
    }
    else if (mb_strlen($linep1) < 3 || mb_strlen($linep1) > 20)
    {
        $msg = 'First Member - ID Line. Error: "Minimum 3 and maximum 20 characters."';
    }
    else if (!preg_match($regexLineId, $linep1))
    {
        $msg = 'First Member - ID Line. Error: "Line ID characters are only allowed a-z, A-Z, 0-9, _, -, and ."';
    }
    else if (!preg_match($regexWa, $wap1))
    {
        $msg = 'First Member - Phone Number. Error: "The phone number format does not match."';
    }
    else if ($fileErrorFM == 4 || $fileSizeFM == 0)
    {
        $msg = 'First Member - Student ID (Card). Error: "No files uploaded, please select a file to upload."';
    }
    else if (!in_array($fileExtensionFM, $CmAllowTypes))
    {
        $msg = 'First Member - Student ID (Card). Error: "Format is not supported. Only allowed: .jpg/jpeg, .png, .pdf"';
    }
    else if ($fileSizeFM > $sizeFileUp)
    {
        $msg = 'First Member - Student ID (Card). Error: "Maximum 3MB."';
    }
    else if (!preg_match($regexEmail, $emailp1))
    {
        $msg = 'First Member - Email. Error: "Email format doesn\'t match."';
    }
    else if ($check_emailFM->rowCount() > 0)
    {
        $msg = 'First Member - Email. Error: "Email has been registered, please use another email."';
    }
    // End Validation Section 3



    // Section 4
    else if ($smIsRegis && (mb_strlen($p2) < 3 || mb_strlen($p2) > 80))
    {
        $msg = 'Second Member - Name. Error: "Name is at least 3 and a maximum of 80 characters."';
    }
    else if ($smIsRegis && !preg_match($regexnama, $p2))
    {
        $msg = 'Second Member - Name. Error: "Characters in full names are not supported."';
    }
    else if ($smIsRegis && !preg_match($regexBd, $dbp2))
    {
        $msg = 'Second Member - Date of Birth. Error: "Format doesn\'t match."';
    }
    else if ($smIsRegis && calculateAge(date('m/d/Y', strtotime($dbp2))) < 10)
    {
        $msg = 'Second Member - Date of Birth. Error: "Participants must be at least 10 years old."';
    }
    else if ($smIsRegis && (mb_strlen($cbp2) < 3 || mb_strlen($cbp2) > 30))
    {
        $msg = 'Second Member - City of Birth. Error: "Minimum 3 and maximum 30 characters."';
    }
    else if ($smIsRegis && !preg_match($regexnama, $cbp2))
    {
        $msg = 'Second Member - City of Birth. Error: "Characters allowed only a-z and A-Z."';
    }
    else if ($smIsRegis && !in_array($sgp2, $pilihanKelas))
    {
        $msg = 'Second Member - School Grade. Error: "Please select an available School Grade (10, 11 or 12)."';
    }
    else if ($smIsRegis && (mb_strlen($addp2) < 3 || mb_strlen($addp2) > 200))
    {
        $msg = 'Second Member - Address. Error: "Address is at least 3 and a maximum of 200 characters."';
    }
    else if ($smIsRegis && !preg_match($regexAddr, $addp2))
    {
        $msg = 'Second Member - Address. Error: "Only address formats are allowed , . - and spaces."';
    }
    else if ($smIsRegis && (mb_strlen($linep2) < 3 || mb_strlen($linep2) > 20))
    {
        $msg = 'Second Member - ID Line. Error: "Minimum 3 and maximum 20 characters."';
    }
    else if ($smIsRegis && !preg_match($regexLineId, $linep2))
    {
        $msg = 'Second Member - ID Line. Error: "Line ID characters are only allowed a-z, A-Z, 0-9, _, -, and ."';
    }
    else if ($smIsRegis && !preg_match($regexWa, $wap2))
    {
        $msg = 'Second Member - Phone Number. Error: "The phone number format does not match."';
    }
    else if ($smIsRegis && ($fileErrorSM == 4 || $fileSizeSM == 0))
    {
        $msg = 'Second Member - Student ID (Card). Error: "No files uploaded, please select a file to upload."';
    }
    else if ($smIsRegis && !in_array($fileExtensionSM, $CmAllowTypes))
    {
        $msg = 'Second Member - Student ID (Card). Error: "Format is not supported. Only allowed: .jpg/jpeg, .png, .pdf"';
    }
    else if ($smIsRegis && ($fileSizeSM > $sizeFileUp))
    {
        $msg = 'Second Member - Student ID (Card). Error: "Maximum 3MB."';
    }
    else if ($smIsRegis && !preg_match($regexEmail, $emailp2))
    {
        $msg = 'Second Member - Email. Error: "Email format doesn\'t match."';
    }
    else if ($smIsRegis && ($check_emailSM->rowCount() > 0))
    {
        $msg = 'Second Member - Email. Error: "Email has been registered, please use another email."';
    }
    // End Validation Section 4

    else
    {
        //  Total Partisipan
        $count  = $smIsRegis ? 3 : 2;
        $time   = date("Y-m-d H:i:s");
        $timefile = date("Y-m-d-H-i-s");

        // Upload Bukti TF ke Server
        $destinationTF = "./uploads/bukti_transfer/";
        $fileNewNameTF = substr(md5($namaTim.$timefile), 0, 20).'.'.$fileExtensionTF;
        $targetDirTF   = $destinationTF . $fileNewNameTF;
        $moveTF        = move_uploaded_file($fileTempNameTF, $targetDirTF);

        if (!$moveTF)
            $msg = 'An error occurred while uploading "Bukti Transfer".';
        
        // Card Member
        $destinationCM = "./uploads/card_member/";
        $fileNewNameLD = substr(md5($ketua.$namaTim.$timefile), 0, 20).'.'.$fileExtensionLD;
        $targetDirLD   = $destinationCM . $fileNewNameLD;
        $moveLD        = move_uploaded_file($fileTempNameLD, $targetDirLD);

        if (!$moveLD)
            $msg = 'An error occurred while uploading "Leader - Student ID (card)".';

        $fileNewNameFM = substr(md5($p1.$namaTim.$timefile), 0, 20).'.'.$fileExtensionFM;
        $targetDirFM   = $destinationCM . $fileNewNameFM;
        $moveFM        = move_uploaded_file($fileTempNameFM, $targetDirFM);

        if (!$moveFM)
            $msg = 'An error occurred while uploading "First Member - Student ID (card)".';

        if ($smIsRegis)
        {
            $fileNewNameSM = substr(md5($p2.$namaTim.$timefile), 0, 20).'.'.$fileExtensionSM;
            $targetDirSM   = $destinationCM . $fileNewNameSM;
            $moveSM        = move_uploaded_file($fileTempNameSM, $targetDirSM);

            if (!$moveSM)
                $msg = 'An error occurred while uploading "Second Member - Student ID (card)".';
        }
        // End Card Member



        // Kalau unggahan berhasil semua, insert data ke db
        if (empty($msg))
        {
            // Insert Main Teams
            $sql_insert_main_team = "INSERT INTO `2022_main_teams`(`name`, `password`, `leader_name`,
            `participant_count`, `school`, `payment_filepath`, `date_of_registration`)
            VALUES (:namaTim, :pass, :ketua, $count, :sekolah, :bkt, '$time')";

            $stmt1 = $pdo->prepare($sql_insert_main_team);
            $stmt1->bindValue(':namaTim', $namaTim);
            $stmt1->bindValue(':pass', $pass_hash);
            $stmt1->bindValue(':ketua', $ketua);
            $stmt1->bindValue(':sekolah', $sekolah);
            $stmt1->bindValue(':bkt', $fileNewNameTF);
            $stmt1->execute();

            // Insert Main Participant
            $team_id = $pdo->lastInsertId(); // Buat dapatin ID "Main Teams" Yang Habis Diinsert


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

            // Leader
            insertMainParticipants($team_id, $ketua, $dbLeader, $cbLeader, $sgLeader, $addLeader, $lineLeader, $emailLeader, $waLeader, $fileNewNameLD);

            $leader_id = $pdo->lastInsertId();
            $update_leader = "UPDATE `2022_main_teams` SET leader_id = '$leader_id' WHERE id = '$team_id'";
            $update_leader = $pdo->prepare($update_leader);
            $update_leader->execute();


            // First Member
            insertMainParticipants($team_id, $p1, $dbp1, $cbp1, $sgp1, $addp1, $linep1, $emailp1, $wap1, $fileNewNameFM);


            // Second Member
            if ($smIsRegis)
                insertMainParticipants($team_id, $p2, $dbp2, $cbp2, $sgp2, $addp2, $linep2, $emailp2, $wap2, $fileNewNameSM);

            $msg = 'Successfully registered, please login to get started';
            $successRegist = true;
        }
    }
}

header('Content-Type: application/json');

echo json_encode([
    'return'         => $return,
    'success_regist' => $successRegist,
    'message'        => $msg
]);

?>
