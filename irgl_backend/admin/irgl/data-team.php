<?php

require_once "../includes/connection.php";
isUserLogin();

if (isset($_POST['verifikasi']) && 
    $_POST['verifikasi'] && isset($_POST['id']))
{
    $id = strip_tags($_POST['id']);

    $cek_id = "SELECT `status` FROM `2022_main_teams` WHERE id = :id";
    $cek_id = $pdo->prepare($cek_id);
    $cek_id->bindParam(':id', $id);
    $cek_id->execute();

    $status = ['status' => 0];
    if ($cek_id->rowCount() > 0)
    {
        $fetch_id = $cek_id->fetch();

        if ($fetch_id['status'] == 0)
        {
            $sql = 'SELECT nama FROM `2022_admin` WHERE login_cookie = :hash';
            $fetch_admin = $pdo->prepare($sql);
            $fetch_admin->bindParam(':hash', $cookie_login);
            $fetch_admin->execute();

            $fetch_admin = $fetch_admin->fetch(PDO::FETCH_OBJ);
            $nama_admin = empty($fetch_admin->nama) ? $fetch_admin->nrp : $fetch_admin->nama;
            $nama_admin = htmlspecialchars($nama_admin);

            $time_verify = date('Y-m-d H:i:s');
            
            $update_status = "UPDATE `2022_main_teams` SET status = 1, verificator = :vc, date_of_verification = :dof WHERE id = :id";
            $update_status = $pdo->prepare($update_status);
            $update_status->bindParam(':id', $id);
            $update_status->bindParam(':vc', $nama_admin);
            $update_status->bindValue(':dof', $time_verify);
            $update_status->execute();

            if ($update_status)
            {
                $json = [
                    'status' => 1,
                    'verificator' => $nama_admin,
                    'time'  => $time_verify
                ];
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json);
}
else 
{
    $title = 'Data Peserta - IRGL 2022';
    require_once '../includes/header.php';

?>

<!-- Container -->
<div class="container" style="max-width: 1300px">
    <div class="box-content">
        <div class="title">
            Data Peserta IRGL 2022
        </div>
        <div class="content">
            <?php

            $data_tim = 
                "SELECT `id`, `name`, `participant_count`, `school`, 
                        `payment_filepath`, `date_of_registration`, `status`, `verificator`, `date_of_verification` 
                    FROM `2022_main_teams`";
            $data_tim_stmt = $pdo->prepare($data_tim);
            $data_tim_stmt->execute();
            
            if ($data_tim_stmt->rowCount() > 0): ?>
            
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tablePeserta">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Team Name</th>
                                <th scope="col">Participant</th>
                                <th scope="col">School</th>
                                <th scope="col">Payment Filepath</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Verification</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $data_tim_stmt->fetch())
                                {
                                    $verificator    = '-'.(!empty($data['verificator']) ? ' '.htmlspecialchars($data['verificator']) : '');
                                    $dateVerify     = '-'.(strtotime($data['date_of_verification']) > 0 ? ' '.$data['date_of_verification'] : '');
                                    $payment_path   = '/backend/uploads/bukti_transfer/'.htmlspecialchars($data['payment_filepath']);
                                    $file_payment   = $_SERVER['DOCUMENT_ROOT'].$payment_path;

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($data['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['participant_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['school']) . "</td>";
                                    echo '
                                        <td>
                                            '.(file_exists($file_payment) && !empty($data['payment_filepath']) ? '<a href="'.$payment_path.'" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti</a>' : 'Tidak dapat menemukan file').'
                                        </td>';
                                    
                                    echo "<td>" . (strtotime($data['date_of_registration']) > 0 ? htmlspecialchars($data['date_of_registration']) : '-') . "</td>";
                                    
                                    echo '
                                        <td style="text-align: center">
                                            <div id="status-id-'.$data['id'].'">
                                                '.(strip_tags($data['status']) == 1 ? '<span class="badge badge-success"><i class="fa fa-check-square-o"></i></span>' : '<button data-toggle="verifikasi_peserta" data-id="'.$data['id'].'" class="btn btn-danger btn-sm">Verifikasi</button>').'</i>
                                            </div>
                                        </td>';

                                    echo '
                                        <td>
                                            <div id="verification-id-'.$data['id'].'">
                                                '.($verificator == '-' || $dateVerify == '-' ? '-' : $verificator.'<br/>'.$dateVerify).'
                                            </div>
                                        </td>';
                                    echo "</tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div><?php

require_once "../includes/connection.php";
isUserLogin();

if (isset($_POST['verifikasi']) && 
    $_POST['verifikasi'] && isset($_POST['id']))
{
    $id = strip_tags($_POST['id']);

    $cek_id = "SELECT `status` FROM `2022_main_teams` WHERE id = :id";
    $cek_id = $pdo->prepare($cek_id);
    $cek_id->bindParam(':id', $id);
    $cek_id->execute();

    $status = ['status' => 0];
    if ($cek_id->rowCount() > 0)
    {
        $fetch_id = $cek_id->fetch();

        if ($fetch_id['status'] == 0)
        {
            $sql = 'SELECT nama FROM `2022_admin` WHERE login_cookie = :hash';
            $fetch_admin = $pdo->prepare($sql);
            $fetch_admin->bindParam(':hash', $cookie_login);
            $fetch_admin->execute();

            $fetch_admin = $fetch_admin->fetch(PDO::FETCH_OBJ);
            $nama_admin = empty($fetch_admin->nama) ? $fetch_admin->nrp : $fetch_admin->nama;
            $nama_admin = htmlspecialchars($nama_admin);

            $time_verify = date('Y-m-d H:i:s');
            
            $update_status = "UPDATE `2022_main_teams` SET status = 1, verificator = :vc, date_of_verification = :dof WHERE id = :id";
            $update_status = $pdo->prepare($update_status);
            $update_status->bindParam(':id', $id);
            $update_status->bindParam(':vc', $nama_admin);
            $update_status->bindValue(':dof', $time_verify);
            $update_status->execute();

            if ($update_status)
            {
                $json = [
                    'status' => 1,
                    'verificator' => $nama_admin,
                    'time'  => $time_verify
                ];
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json);
}
else 
{
    $title = 'Data Peserta - IRGL 2022';
    require_once '../includes/header.php';

?>

<!-- Container -->
<div class="container" style="max-width: 1300px">
    <div class="box-content">
        <div class="title">
            Data Peserta IRGL 2022
        </div>
        <div class="content">
            <?php

            $data_tim = 
                "SELECT `id`, `name`, `participant_count`, `school`, 
                        `payment_filepath`, `date_of_registration`, `status`, `verificator`, `date_of_verification` 
                    FROM `2022_main_teams`";
            $data_tim_stmt = $pdo->prepare($data_tim);
            $data_tim_stmt->execute();
            
            if ($data_tim_stmt->rowCount() > 0): ?>
            
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tablePeserta">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Team Name</th>
                                <th scope="col">Participant</th>
                                <th scope="col">School</th>
                                <th scope="col">Payment Filepath</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Verification</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $data_tim_stmt->fetch())
                                {
                                    $verificator    = '-'.(!empty($data['verificator']) ? ' '.htmlspecialchars($data['verificator']) : '');
                                    $dateVerify     = '-'.(strtotime($data['date_of_verification']) > 0 ? ' '.$data['date_of_verification'] : '');
                                    $payment_path   = '/backend/uploads/bukti_transfer/'.htmlspecialchars($data['payment_filepath']);
                                    $file_payment   = $_SERVER['DOCUMENT_ROOT'].$payment_path;

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($data['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['participant_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['school']) . "</td>";
                                    echo '
                                        <td>
                                            '.(file_exists($file_payment) && !empty($data['payment_filepath']) ? '<a href="'.$payment_path.'" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti</a>' : 'Tidak dapat menemukan file').'
                                        </td>';
                                    
                                    echo "<td>" . (strtotime($data['date_of_registration']) > 0 ? htmlspecialchars($data['date_of_registration']) : '-') . "</td>";
                                    
                                    echo '
                                        <td style="text-align: center">
                                            <div id="status-id-'.$data['id'].'">
                                                '.(strip_tags($data['status']) == 1 ? '<span class="badge badge-success"><i class="fa fa-check-square-o"></i></span>' : '<button data-toggle="verifikasi_peserta" data-id="'.$data['id'].'" class="btn btn-danger btn-sm">Verifikasi</button>').'</i>
                                            </div>
                                        </td>';

                                    echo '
                                        <td>
                                            <div id="verification-id-'.$data['id'].'">
                                                '.($verificator == '-' || $dateVerify == '-' ? '-' : $verificator.'<br/>'.$dateVerify).'
                                            </div>
                                        </td>';
                                    echo "</tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br/><br/>

            <?php else: ?>

                Tidak dapat menemukan data peserta.

            <?php endif ?>
        </div>
    </div>
</div>
<!-- End Container -->

<?php require_once "../includes/footer.php"; } ?>

            <?php else: ?>

                Tidak dapat menemukan data peserta.

            <?php endif ?>
        </div>
    </div>
</div>
<!-- End Container -->

<?php require_once "../includes/footer.php"; } ?>
