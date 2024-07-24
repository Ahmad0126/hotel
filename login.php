<?php
include('koneksi.php');
if(isset($_POST['send'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query =  mysqli_query($conn, "SELECT * FROM user where username='$user' and password='$pass'");
    $cek1 = mysqli_num_rows($query);
    if($cek1 == true){
        while($cek = mysqli_fetch_array($query)){
            $id = $cek['type'];
            session_start();
            $_SESSION['username'] = $id;
            $_SESSION['userid'] = $cek['id'];
            if($id == 'administrator'){
                header("Location:administrator.php");
            }else if($id == 'resepsionis'){
                header("Location:resepsionis.php");
            }else if($id == 'tamu'){
                header("Location:index.php");
            }
        }
    }else{echo "cek kembali password dan username anda";}
}else{header("Location:login.html");}
?>