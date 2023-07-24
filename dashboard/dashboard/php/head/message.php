<?php
session_start();
$username = $_SESSION['username'];
  include '../../php/connection.php'; 
  
  include '../../php/function/validasi_user.php'; 

  if(isset($_GET["sudahbaca"])){
    $update = mysqli_query($conn,"UPDATE tb_kontak SET status = 'sudah_baca' WHERE id = '$_GET[sudahbaca]'");
  }
  
?>