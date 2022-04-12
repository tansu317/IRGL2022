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

    $status = 0;
    if ($cek_id->rowCount() > 0)
    {
        $fetch_id = $cek_id->fetch();

        if ($fetch_id['status'] == 0)
        {
            $update_status = "UPDATE `2022_main_teams` SET status = 1 WHERE id = :id";
            $update_status = $pdo->prepare($update_status);
            $update_status->bindParam(':id', $id);
            $update_status->execute();

            if ($update_status)
                $status = 1;
        }
    }

    echo $status;
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

            $data_tim = "SELECT `id`, `name`, `participant_count`, `school`, `payment_filepath`, `date_of_registration`, `status` FROM
            `2022_main_teams`";
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($data = $data_tim_stmt->fetch())
                                {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($data['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['participant_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['school']) . "</td>";
                                    echo '<td><a href="/backend/uploads/bukti_transfer/'.htmlspecialchars($data['payment_filepath']).'" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti</td>';
                                    echo "<td>" . htmlspecialchars($data['date_of_registration']) . "</td>";
                                    echo '
                                        <td style="text-align: center">
                                            <div id="status-id-'.$data['id'].'">
                                                '.(strip_tags($data['status']) == 1 ? '<span class="badge badge-success"><i class="fa fa-check-square-o"></i></span>' : '<button data-toggle="verifikasi_peserta" data-id="'.$data['id'].'" class="btn btn-danger btn-sm">Verifikasi</button>').'</i>
                                            </div>
                                        </td>';
                                    echo "</tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>

                Tidak dapat menemukan data peserta.

            <?php endif ?>
        </div>
    </div>
</div>
<!-- End Container -->

<?php require_once "../includes/footer.php"; } ?>