<?php
include("koneksi.php");
session_start();
if($_SESSION['username'] != 'tamu'){
    header("Location:login.html");
}
$query = mysqli_query($conn, "select * from kamar join tipe_kamar join fasilitas_hotel on kamar.id = tipe_kamar.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.css">
    <style>
        .con{
            height: auto;
            background-image: linear-gradient(0deg, #dbafc0, #7becf2);
        }
    </style>
    <title>Hotel</title>
</head>
<body>
    <div class="con pt-3 pb-3">
        <div class="container">
            <h1 class="text-center">Menu Pemesanan Kamar</h1>
            <?php
            while($fer=mysqli_fetch_array($query)){
            ?>
            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nomor Kamar</th>
                            <th>Fasilitas Kamar</th>
                            <th>Fasilitas Hotel</th>
                            <th>Fasilitas Umum</th>
                            <th>Fasilitas Terdekat</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <p><?= $fer['nomor']?></p>
                            </td>
                            <td>
                                <p><?= $fer['fasilitas']?></p>
                            </td>
                            <td>
                                <p><?= $fer['hotel']?></p>
                            </td>
                            <td>
                                <p><?= $fer['umum']?></p>
                            </td>
                            <td>
                                <p><?= $fer['terdekat']?></p>
                            </td>
                            <td>
                                <p><?= $fer['harga']?></p>
                            </td>
                            <td class="text-end">
                                <form action="book.php" method="get">
                                    <button type="submit" class="btn btn-primary" name="n" value="<?= $fer['nomor']?>">Pesan Kamar</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>