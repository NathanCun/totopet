<?php
if(isset($_POST['send-email'])) {
    require '../../php/connection.php';

    date_default_timezone_set("Asia/Jakarta");

    $username = $_POST["user_name"];
    $telepon = $_POST["user_telp"];
    $message = $_POST["user_text"];
    $tanggal = date("Y-m-d H:i:s");

    $insert = mysqli_query($conn,"INSERT INTO tb_kontak VALUES ('','$username','$telepon','$message','belum_baca','$tanggal')");
    if($insert){
       echo "<script>window.alert('data berhasil dikirim')</script>";
    }
}
?>
