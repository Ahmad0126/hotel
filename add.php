<?php
include('koneksi.php');
session_start();
if($_SESSION['username'] != 'administrator'){
    header("Location:login.html");
}
if(isset($_GET['action'])){
    $aksi = $_GET['action'];
}else{$aksi = "";}
$query1 = "SELECT * FROM fasilitas_hotel";
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
        <div class="card forum position-absolute top-50 start-50 translate-middle w-50">
            <div class="card-body">
            <?php
            if($aksi=='1'){
            ?>
                <h1 class="card-title text-center">Tambahkan Kamar</h1>
                <br>
                <form method="post">
                    <input type="number" name="nomor" class="form-control" placeholder="Nomor Kamar" required>
                    <br>
                    <input type="number" name="id" class="form-control" placeholder="ID Kamar" required>
                    <br>
                    <input type="submit" name="tambah" value="Simpan" class="form-control btn btn-success">
                </form>
            <?php
            }
            else if($aksi=='2'){
            ?>
                <h1 class="card-title text-center">Tambahkan Menu Kamar</h1>
                <br>
                <form method="post">
                    <input type="number" name="nama" class="form-control" placeholder="ID Kamar">
                    <br>
                    <textarea name="fasilitas" rows="5" class="form-control" placeholder="Fasilitas"></textarea>
                    <br>
                    <input type="number" name="harga" class="form-control" placeholder="Harga">
                    <br>
                    <input type="submit" name="add" value="Simpan" class="form-control btn btn-success">
                </form>
            <?php
            }else if($aksi=='3'){
                $fer = mysqli_fetch_array(mysqli_query($conn, $query1));
            ?>
                <h1 class="card-title text-center">Fasilitas Hotel</h1>
                <br>
                <form method="post">
                    <textarea name="hotel" rows="3" class="form-control" placeholder="Fasilitas Hotel"><?= $fer['hotel']?></textarea>
                    <br>
                    <textarea name="umum" rows="3" class="form-control" placeholder="Fasilitas Umum"><?= $fer['umum']?></textarea>
                    <br>
                    <textarea name="terdekat" rows="3" class="form-control" placeholder="Fasilitas Terdekat"><?= $fer['terdekat']?></textarea>
                    <br>
                    <input type="submit" name="add3" value="Simpan" class="form-control btn btn-success">
                </form>
            <?php
            }
            if(isset($_POST['tambah'])){
                $nomor = intval($_POST['nomor']);
                $id = intval($_POST['id']);
                $query = "INSERT INTO kamar (id, nomor) VALUES ($id, $nomor)";
                $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kamar WHERE nomor=$nomor or id=$id"));
                if($cek==false){
                    mysqli_query($conn, $query);
                    header("Location: administrator.php");
                }else{echo "Jangan memasukkan data yang sudah ada";}
            }
            if(isset($_POST['add'])){
                $fasilitas = $_POST['fasilitas'];
                $id = intval($_POST['nama']);
                $harga = intval($_POST['harga']);
                $query = "INSERT INTO tipe_kamar (id, fasilitas, harga) VALUES ($id, '$fasilitas', $harga)";
                $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tipe_kamar WHERE id=$id"));
                if($cek==false){
                    mysqli_query($conn, $query);
                    header("Location: administrator.php");
                }else{echo "Jangan memasukkan data yang sudah ada";}
            }
            if(isset($_POST['add3'])){
                $d1 = $_POST['hotel'];
                $d2 = $_POST['umum'];
                $d3 = $_POST['terdekat'];
                $query = "UPDATE fasilitas_hotel SET hotel='$d1', umum='$d2', terdekat='$d3'";
                mysqli_query($conn, $query);
                header("Location: administrator.php");
            }
            ?>
            </div>
        </div>
    </div>
</body>
<script src="bootstrap-5.2.2-dist/js/bootstrap.js"></script>
</html>