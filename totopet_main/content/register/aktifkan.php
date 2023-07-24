<?php
if(isset($_GET["otp"])){
    $data = $_GET["otp"];
    $verifikasi = base64_decode($data);
	$verifikasi = explode("|",$verifikasi);

	$email = $verifikasi[0];
	$otp  = $verifikasi[1];

	$query  = "SELECT * FROM user WHERE email='$email' AND kode_otp = '$otp' AND verifikasi='N'";
	$login  = mysqli_query($conn, $query);
	$ketemu = mysqli_num_rows($login);
	$r      = mysqli_fetch_array($login);

	 
	if ($ketemu > 0){
		$update = mysqli_query($conn,"UPDATE user SET verifikasi = 'Y' WHERE id = '$r[id]'");
		echo"<script>window.alert('Akun berhasil didaftarkan'); window.location.href='../login/'</script>";
	}
	else {
		header('location:../register/index.php?msg=gagal');
	}
}
?>