<?php
include('koneksi.php');
session_start();
if($_SESSION['username'] != 'administrator'){
    header("Location:login.html");
}
$query = mysqli_query($conn, "SELECT * FROM kamar");
$query1 = mysqli_query($conn, "SELECT * FROM tipe_kamar");
$query2 = mysqli_query($conn, "SELECT * FROM fasilitas_hotel");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.css">
    <title>Administrator</title>
</head>
<body>
    <div class="content pb-2 pt-3">
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Data Kamar dan Pemetaan
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nomor</th>
                                    <th>ID Kamar</th>
                                    <th>Nomor Kamar</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                                <?php
                                $no = 1;
                                while($fer=mysqli_fetch_array($query)){
                                    $id = $fer['id'];
                                    $nomor = $fer['nomor'];
                                ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo "#".$nomor; ?></td>
                                    <td class="text-end"><a href="edit.php?action=1&id=<?= $id?>" class="btn-primary btn">Edit</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <a href="add.php?action=1" class="btn btn-primary">Tambah +</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Tipe Kamar dan Fasilitas
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>ID Kamar</th>
                                    <th>Fasilitas Kamar</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                                <?php
                                while($fer=mysqli_fetch_array($query1)){
                                    $id = $fer['id'];
                                    $fasilitas = $fer['fasilitas'];
                                    $harga = $fer['harga'];
                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $fasilitas; ?></td>
                                    <td class="text-end"><?php echo $harga; ?></td>
                                    <td class="text-end"><a href="edit.php?action=2&id=<?= $id?>" class="btn-primary btn">Edit</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <a href="add.php?action=2" class="btn btn-primary">Tambah +</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Fasilitas Hotel dan Umum
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Fasilitas Hotel</th>
                                    <th>Fasilitas Umum</th>
                                    <th>Fasilitas Terdekat</th>
                                </tr>
                                <?php
                                while($fer=mysqli_fetch_array($query2)){
                                    $d1 = $fer['hotel'];
                                    $d2 = $fer['umum'];
                                    $d3 = $fer['terdekat'];
                                ?>
                                <tr>
                                    <td><?php echo $d1; ?></td>
                                    <td><?php echo $d2; ?></td>
                                    <td><?php echo $d3; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <a href="add.php?action=3" class="btn btn-primary">Ubah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="bootstrap-5.2.2-dist/js/bootstrap.js"></script>
</html>