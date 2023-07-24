<?php
  session_start();
  include '../../php/connection.php'; 

  include '../../php/function/validasi_user.php'; 
  
  if(isset($_POST['input-data'])) {
    $username = $_POST['user-username'];
    $password = $_POST['user-password'];

    $sql = "INSERT INTO user (username, password,role,verifikasi) VALUES ('$username', '$password','admin','Y')";
    $conn->query($sql);
  }

  if(isset($_GET['delete_id'])) {
      $id = $_GET['delete_id'];
      $sql = "DELETE FROM user WHERE id = '$id'";
      mysqli_query($conn, $sql);
    }

  if(isset($_POST["update_pembayaran"])){
    $sql = mysqli_query($conn,"INSERT INTO tb_rekening VALUES ('','$_POST[pembayaran]')");
    header("location:index.php");
    exit;

  }

  function pembayaran(){
    include '../../php/connection.php';
    $sql_pembayaran = mysqli_query($conn,"SELECT rekening FROM tb_rekening ORDER by id DESC LIMIT 1");
    $result_pembayaran = mysqli_fetch_assoc($sql_pembayaran);

    return $result_pembayaran["rekening"];
  }
?>
