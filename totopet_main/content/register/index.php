<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../phpmailer/vendor/autoload.php';

// Process registration form submission
if (isset($_POST['register'])) {
  // Handle form submission here
  // ...
  function sendOTP($email, $otp) {
    require('../../../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php');
    require('../../../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php');    
    require('../../../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php');
    $link = "localhost/totopet/totopet_main/content/register/aktifkan.php?otp=$otp";

    $link = base64_encode($link);

    $link = "<a href='$link' >link anda</a>";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 2;
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Timeout = 60;
    $mail->SMTPKeepAlive = true; 
    $mail->Username = "totopet.indo@gmail.com";
    $mail->Password = "tugasweb2";
    $mail->SetFrom("totopet.indo@gmail.com","Totopet Indo");
    $mail->Subject = "Verification Code";
    $mail->AddAddress("{$email}","noreply");
    $mail->MsgHTML("untuk mengaktikan akun anda klik link berikut {$link}");
    $mail->IsHTML(true);	
    $result = $mail->Send();

        if($mail->Send()) {
            echo "Kode verifikasi telah dikirim";
            $mailSent = true;
        }
        else {
            echo "Gagal mengirimkan kode verifikasi";
            $mailSent = false;
        }
    }

  function generateOTP() {
    $otp_length = 6; // Length of the OTP
    $otp = "";

    for ($i = 0; $i < $otp_length; $i++) {
        $otp .= rand(0, 9);
    }

    return $otp;
  }

  include '../../php/connection.php';
  date_default_timezone_set("Asia/Jakarta");
  $date = date("Y-m-d H:i:s");
  $email    = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $otp = generateOTP();

  $check_email = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email' OR username = '$username'");
  if(mysqli_num_rows($check_email) > 0){
    $error = true;
  }
  else{
    $query = "INSERT INTO user VALUES ('$email','$username','$password','','user','$date','$otp','N')";

    $insert = mysqli_query($conn,$query);
    if($insert){
      //sendOTP($email,$otp);
    
      echo "<script>alert('Akun Berhasil Didaftarkan, Harap Segera Aktifkan Akun Melalui Email');</script>";
    }
    else{
      $error = true;
    }
  }
}
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="register.css">
    <title>Registrasi</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm rounded">
            <form action="./register.php" method="POST">
              <div class="text-center">
                <!-- alert untuk success -->
                <?php if(isset($success)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Registrasi Berhasil</strong> Silahkan Aktifkan Akun Melalui Email
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                </div>
                <?php endif; ?>
                <!-- alert untuk error -->
                <?php if(isset($error)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Gunakan Email atau Username Lain </strong><a href="/totopet/totopet/totopet_main/content/login/index.php">Login</a>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                </div>
                <?php endif; ?>
                <h1>Registrasi</h1>
                <p>Silahkan Daftar dengan Email Anda!</p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-info" name="register">Register</button>
            </form>
            <div class="text-center mt-4">
              <p>Sudah Punya Akun?</p>
              <a href="../login"><button class="btn btn-danger">Login</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
