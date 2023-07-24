<?php
function pembayaran(){
    include '../../php/connection.php';
    $sql_pembayaran = mysqli_query($conn,"SELECT rekening FROM tb_rekening ORDER by id DESC LIMIT 1");
    $result_pembayaran = mysqli_fetch_assoc($sql_pembayaran);

    return $result_pembayaran["rekening"];
  }
  
function jumlahKeranjang($userId){
        
  include '../../php/connection.php';
  $sql_cek = mysqli_query($conn,"SELECT COUNT(*) AS jumlah FROM tb_keranjang WHERE user_id = '$userId'");
  if(mysqli_num_rows($sql_cek) > 0){
      $result = mysqli_fetch_assoc($sql_cek);
      return $result["jumlah"];
  }
  else{
      return 0;
  }
}
function cekKeranjang($produkId,$userId){
  include '../../php/connection.php';

  $sql_cek = mysqli_query($conn,"SELECT * FROM tb_keranjang WHERE produk_id = '$produkId' AND user_id = '$userId'");
  if(mysqli_num_rows($sql_cek) > 0){
      return  true;
  }
  else{
      return false;
  }
}
?>