<?php
include('koneksi.php');
session_start();
if($_SESSION['username'] != 'administrator'){
    header("Location:login.html");
}
if(isset($_GET['action']) && isset($_GET['id'])){
    $aksi = $_GET['action'];
    $id = intval($_GET['id']);
}else{$aksi = ""; $id = "";}
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
                $query = mysqli_query($conn, "SELECT * FROM kamar WHERE id=$id");
                $fer = mysqli_fetch_array($query);
            ?>
                <h1 class="card-title text-center">Tambahkan Kamar</h1>
                <br>
                <form method="post">
                    <input type="number" name="id" class="form-control" value="<?= $fer['id'] ?>" placeholder="Nomor Kamar">
                    <br>
                    <input type="number" name="nomor" class="form-control" value="<?= $fer['nomor'] ?>" placeholder="ID Kamar">
                    <br>
                    <input type="submit" name="tambah" value="Simpan" class="form-control btn btn-success">
                </form>
            <?php
            }
            else if($aksi=='2'){
                $query = mysqli_query($conn, "SELECT * FROM tipe_kamar WHERE id=$id");
                $fer = mysqli_fetch_array($query);
            ?>
                <h1 class="card-title text-center">Tambahkan Menu Kamar</h1>
                <br>
                <form method="post">
                    <input type="number" name="nama" class="form-control" value="<?= $fer['id'] ?>" placeholder="ID Kamar">
                    <br>
                    <textarea name="fasilitas" rows="5" class="form-control" placeholder="Fasilitas"><?= $fer['fasilitas'] ?></textarea>
                    <br>
                    <input type="number" name="harga" class="form-control" value="<?= $fer['harga'] ?>" placeholder="Harga">
                    <br>
                    <input type="submit" name="add" value="Simpan" class="form-control btn btn-success">
                </form>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.2.2-dist/js/bootstrap.js"></script>
</body>
</html>
<?php
if(isset($_POST['tambah'])){
    $d1 = intval($_POST['id']);
    $no = intval($_POST['nomor']);
    $query1 = mysqli_query($conn, "UPDATE kamar set id=$d1, nomor=$no WHERE id=$id");
    if($query1){
        header("Location: administrator.php");
    }
}
if(isset($_POST['add'])){
    $d2 = intval($_POST['nama']);
    $fasilitas = $_POST['fasilitas'];
    $harga = intval($_POST['harga']);
    $query2 = mysqli_query($conn, "UPDATE tipe_kamar set id=$d2, fasilitas='$fasilitas', harga=$harga WHERE id=$id");
    if($query2){
        header("Location: administrator.php");
    }
}
?>