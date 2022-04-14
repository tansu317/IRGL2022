<?php

require_once "../includes/connection.php";
isUserLogin();


$title = 'Data Peserta - IRGL 2022';
require_once '../includes/header.php'; ?>

<!-- Container -->
<div class="container" style="max-width: 1400px">
    <div class="box-content">
        <div class="title">
            Data Peserta IRGL 2022
        </div>
        <div class="content">
            <?php

            $data_part = 
            "SELECT mp.id, mp.name, mt.name team_name, 
                date_of_birth, city_of_birth, 
                school_grade, address, line_id, 
                email, phone_number, 
                studentid_filepath, 
                mp.date_of_registration 
            FROM `2022_main_participants` mp
                INNER JOIN `2022_main_teams` mt
                    ON mp.team_id = mt.id";
            $data_part_stmt = $pdo->prepare($data_part);
            $data_part_stmt->execute();

            if ($data_part_stmt->rowCount() > 0): ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablePeserta">
                        <thead>
                            <tr>
                                <th style="max-width:120px;">ID</th>
                                <th style="min-width:200px">Name</th>
                                <th style="min-width:140px">Student Card</th>
                                <th style="min-width:145px">Team Name</th>
                                <th style="min-width:145px">Date of Birth</th>
                                <th style="min-width:145px">City of Birth</th>
                                <th style="min-width:145px">School Grade</th>
                                <th style="min-width:200px">Address</th>
                                <th style="min-width:100px">Line</th>
                                <th style="min-width:160px">Email</th>
                                <th style="min-width:160px">Phone Number</th>
                                <th style="min-width:200px">Date of Registration</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($data = $data_part_stmt->fetch()):
                                $card_path   = '/backend/uploads/card_member/'.htmlspecialchars($data['studentid_filepath']);
                                $file_card   = '../../'.$card_path; ?>

                                <tr>
                                    <td><?=$data['id']?></td>
                                    <td><?=htmlspecialchars($data['name'])?></td>
                                    <td><?=(file_exists($file_card) && !empty($data['studentid_filepath']) ? '<a href="'.$card_path.'" target="_blank" class="btn btn-primary btn-sm">Lihat Berkas</a>' : 'Tidak dapat menemukan file')?></td>
                                    <td><?=htmlspecialchars($data['team_name'])?></td>
                                    <td><?=htmlspecialchars(date('Y-m-d', strtotime($data['date_of_birth'])))?></td>
                                    <td><?=htmlspecialchars($data['city_of_birth'])?></td>
                                    <td><?=htmlspecialchars($data['school_grade'])?></td>
                                    <td><?=htmlspecialchars($data['address'])?></td>
                                    <td><?=htmlspecialchars($data['line_id'])?></td>
                                    <td><?=htmlspecialchars($data['email'])?></td>
                                    <td><?=htmlspecialchars($data['phone_number'])?></td>
                                    <td><?=htmlspecialchars($data['date_of_registration'])?></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>

                Tidak ada data peserta yang tersimpan.

            <?php endif ?>
        </div><br/><br/>
    </div>
</div>
<!-- End Container -->

<?php require_once "../includes/footer.php"; ?>