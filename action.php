<?php
if(isset($_POST['n'])){
    $_SESSION['n'] = $_POST['n'];
    header("Location:book.php");
}
?>