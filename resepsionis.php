<?php
include('koneksi.php');
session_start();
if($_SESSION['username'] != 'resepsionis'){
    header("Location:login.html");
}
$query = mysqli_query($conn, "SELECT * FROM user join pemesanan on user.id = pemesanan.user_id where pemesanan.status = 'diproses'");
if(isset($_POST['cari'])){
    $q = $_POST['q'];
    $query = mysqli_query($conn, "SELECT * FROM user join pemesanan on user.id = pemesanan.user_id where pemesanan.status = 'diproses' and user.username LIKE '%$q%'");
}
if(isset($_POST['look'])){
    $q = $_POST['p'];
    $query = mysqli_query($conn, "SELECT * FROM user join pemesanan on user.id = pemesanan.user_id where pemesanan.status = 'diproses' and pemesanan.tanggal_checkin = '$q'");
}
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
    <title>Resepsionis</title>
</head>
<body>
    <div class="content">
        <div class="container">
            <h1 class="text-center">Halaman Resepsionis</h1>
            <form class="row pb-3" action="" method="post">
                <div class="col input-group">
                    <input type="text" name="q" id="" placeholder="Cari Nama Pemesan" class="form-control">
                    <button type="submit" name="cari" class="btn btn-success input-group-text">Cari</button>
                </div>
                <div class="col">
                </div>
                <div class="col input-group">
                    <button type="submit" name="look" class="btn btn-success input-group-text">Cari Tanggal</button>
                    <input type="date" name="p" id="" placeholder="Cari Berdasarkan Tanggal" class="form-control">
                </div>
            </form>
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>No Kamar</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Checkin</th>
                    <th>Tanggal Checkout</th>
                    <th>Total Harga</th>
                </tr>
                <?php
                if(mysqli_num_rows($query)==false){
                    echo "<p class='text-center'>Data tidak ditemukan</p>";
                }
                $no = 1;
                while($fer=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $fer['nomor']?></td>
                    <td><?= $fer['username']?></td>
                    <td><?= $fer['tanggal_checkin']?></td>
                    <td><?= $fer['tanggal_checkout']?></td>
                    <td>Rp <?= $fer['harga']?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>