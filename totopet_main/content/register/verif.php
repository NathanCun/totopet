<?php
include '../../php/connection.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    echo $code;

    $qry = $conn->query("SELECT * FROM user WHERE kode_otp='$code'");

    if ($qry->num_rows > 0) {
        $result = $qry->fetch_assoc();
        if ($result !== null && isset($result['id'])) {
            $conn->query("UPDATE user SET verifikasi='Y' WHERE id='{$result['id']}'");
            header("location:../login/index.php");
        } else {
            echo "Data tidak valid.";
        }
    } else {
        echo "Kode OTP tidak valid.";
    }
}
?>