<?php

require_once "../includes/connection.php";
isUserLogin();

$title = 'Data Peserta - IRGL 2022';
require_once '../includes/header.php';

?>

<!-- Container -->
<div class="container">
    <div class="box-content">
        <div class="title">
            Data Peserta IRGL 2022
        </div>
        <div class="content">

            <form method="get" class="search-form">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari peserta berdasarkan ID atau nama ...">
                    <div class="input-group-append">
                        <button name="cari" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <hr/>

            <div style="margin-bottom: 10px">
                <b>Data Peserta</b>
            </div>
            
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Container -->


<?php require_once "../includes/footer.php" ?>