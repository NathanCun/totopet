<?php
function pembayaran(){
    include '../../php/connection.php';
    $sql_pembayaran = mysqli_query($conn,"SELECT rekening FROM tb_rekening ORDER by id DESC LIMIT 1");
    $result_pembayaran = mysqli_fetch_assoc($sql_pembayaran);

    return $result_pembayaran["rekening"];
  }
?>