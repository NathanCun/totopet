<?php

require "../../php/connection.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../../vendor/autoload.php';

$date = date("Y-m-d H:i:s");

function sendEmail($email, $otp) {
    $data = "$email|$otp";
    $data = base64_encode($data); 
    $link = "localhost/totopet/totopet_main/content/login/reset.php?otp=$data";

    $mail = new PHPMailer();

    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nathantjendra67@gmail.com';                     //SMTP username
    $mail->Password   = 'gsysxdsvcdwjxveh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('totopet.indo@gmail.com', 'Mailer');
    $mail->addAddress($email, 'Joe User');     //Add a recipient
   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Totopet.com';
    $mail->Body    = "Segera aktifkan akun anda ! </b><a href='$link' >link anda</a>";

    $result = $mail->send();

        if($result) {
            echo "Kode verifikasi telah dikirim";
            $mailSent = true;
        }
        else {
            echo "Gagal mengirimkan kode verifikasi";
            $mailSent = false;
        }
    }

	
if(isset($_POST["forgot_password"])){
	echo "<script>alert('alamat email belum terdaftar harap login terlebih dahulu);window.location.href='../register/'</script>";
	$email = $_POST["email"];
	$code = md5($email.date("Y-m-d H:i:s"));
	$cek_email = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email'");
	if(mysqli_num_rows($cek_email) > 0){
		$sql = mysqli_query($conn,"UPDATE user SET verifikasi = 'N', kode_otp ='$code' WHERE email = '$email'");
		if($sql){
			sendEmail($email,$code);
			echo "sudah dikirim";
			//header("location:../landing_page/");
			exit;
		}
		else{
			echo "<script>alert('gagal mengubah katasandi');window.location.href='forgot.php'</script>";
		}
	}
	else{
		echo "<script>alert('alamat email belum terdaftar harap login terlebih dahulu');window.location.href='../register/'</script>";
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
							<h4 class="card-title">Forgot Password</h4>
							<form method="POST" action="" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="forgot_password" class="btn btn-primary btn-block">
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