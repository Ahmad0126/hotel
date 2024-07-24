<?php
include("koneksi.php");
session_start();
if($_SESSION['username'] != 'tamu'){
    header("Location:login.html");
}
$no = intval($_GET['n']);
$query = mysqli_query($conn, "select * from kamar where nomor = $no");
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
    <style>
        .msg{
            margin-top: 35px;
        }
    </style>
    <title>Booking</title>
</head>
<body>
    <div class="content pb-2 pt-3">
        <div class="card forum position-absolute top-50 start-50 translate-middle w-50">
            <div class="row">
                <div class="col">
                    <div class="card-body">
                        <h1 class="card-title text-center">Booking</h1>
                        <br>
                        <form action="" method="post">
                            <label for="">Tanggal Check In</label>
                            <br>
                            <input type="date" name="in" class="form-control" required>
                            <br>
                            <label for="">Tanggal Check Out</label>
                            <br>
                            <input type="date" name="out" class="form-control" required>
                            <br>
                            <input type="submit" name="send" value="Pesan" class="form-control btn btn-success">
                        </form>
                    </div>
                </div>
                <div class="col text-center">
                    <?php
                    if($fer=mysqli_fetch_array($query)){
                        $id = intval($fer['id']);
                        $query1 = mysqli_query($conn, "select * from tipe_kamar where id = $id");
                    }
                    if($fsr=mysqli_fetch_array($query1)){
                        $n1 = $fsr['fasilitas'];
                        $n2 = $fsr['harga'];
                    }
                    
                    ?>
                    <h3 class="pb-4 pt-4">Nomor Kamar: <?= $no?></h3>

                    <table class="table table-striped msg">
                        <tr>
                            <th>Fasilitas</th>
                        </tr>
                        <tr>
                            <td><?= $n1?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                        </tr>
                        <tr>
                            <td><?= $n2?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['send'])){
    $checkin = $_POST['in'];
    $checkout = $_POST['out'];
    $insert = mysqli_query($conn, "INSERT INTO pemesanan (nomor, user_id, tanggal_checkin, tanggal_checkout, harga, status) VALUES ($no, '$_SESSION[userid]', '$checkin', '$checkout', DATEDIFF (DATE('$checkout'), DATE('$checkin'))*$fsr[harga], 'diproses')");
    if($insert){
        echo "<script>alert('data anda berhasil disimpan')</script>";
        header("Location: index.php");
    }
    }
?>