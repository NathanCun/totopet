<?php
include '../../php/head/head.php';
include "../../php/connection.php";
if(isset($_GET["diterima"])){
    $id = $_GET["diterima"];
    $sql = mysqli_query($conn,"UPDATE tb_transaksi SET status_pengiriman = 'selesai' WHERE id='$id' AND user_id = '$_SESSION[user_id]'");
    header("location:index.php");
    exit;
}
?>