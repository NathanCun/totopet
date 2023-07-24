<?php
require '../../php/connection.php';
if(isset($_GET["otp"])){

	$data = $_GET["otp"];
	$verifikasi = base64_decode($data);
	$verifikasi = explode("|",$verifikasi);
	
	$email = $verifikasi[0];
	$otp  = $verifikasi[1];

}
else{
	header("location:../login.php");
	exit;
}

if(isset($_POST["update"])){
	$password = $_POST["password"];
	echo"$email , $otp";
	$query  = "SELECT * FROM user WHERE email='$email' AND kode_otp = '$otp' AND verifikasi='N'";
	$login  = mysqli_query($conn, $query);
	$ketemu = mysqli_num_rows($login);
	$r      = mysqli_fetch_array($login);

	 
	if ($ketemu > 0){
		$update = mysqli_query($conn,"UPDATE user SET verifikasi = 'Y',password = '$password' WHERE id = '$r[id]'");
		echo"<script>window.alert('Kata Sandi berhasil diubah'); window.location.href='../login/'</script>";
	}
	else {
		header('location:forgot.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Forgot Password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/totopet/totopet/totopet_main/asset/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
					<img src="../../src/d.png" alt="logo" width="100" height="100">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Reset Password</h4>
							<form method="POST" action="" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">Your New Password</label>
									<input id="email" type="password" class="form-control" name="password" value="" required autofocus>
									
								</div>

								<div class="form-group m-0">
									<button type="submit" name="update" class="btn btn-primary btn-block">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>