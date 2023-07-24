<?php
session_start();
  include '../../php/connection.php';
  include '../../php/function/validasi_user.php'; 
  include '../../php/function/transaksi.php'; 

  
  
  if(isset($_GET['approve_pembayaran'])){
    $id = $_GET["approve_pembayaran"];
    $update = mysqli_query($conn,"UPDATE tb_transaksi SET status_pengiriman = 'diproses-penjual' WHERE id = '$id'");
    
    if($update){
      header("Location:index.php");
      exit;
    }
  }
  if(isset($_GET['batal'])){
    $id = $_GET["batal"];
    $update = mysqli_query($conn,"UPDATE tb_transaksi SET status_pengiriman = 'dibatalkan-penjual' WHERE id = '$id'");
    
    if($update){
      header("Location:index.php");
      exit;
    }
  }
  if(isset($_GET['kirim'])){
    $id = $_GET["kirim"];
    $update = mysqli_query($conn,"UPDATE tb_transaksi SET status_pengiriman = 'sedang-dikirim' WHERE id = '$id'");
    
    if($update){
      header("Location:index.php");
      exit;
    }
  }
  
?>