<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../php/connection.php';

//Load Composer's autoloader
  $email    = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $code = md5($email.date("Y-m-d H:i:s"));
  $date = date("Y-m-d H:i:s");

// require('../../../vendor/phpmailer/phpmailer/src/PHPMailer.php');
// require('../../../vendor/phpmailer/phpmailer/src/SMTP.php');
// require('../../../vendor/phpmailer/phpmailer/src/Exception.php');

require '../../../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nathantjendra67@gmail.com';                     //SMTP username
    $mail->Password   = 'gsysxdsvcdwjxveh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Verifikasi');
    $mail->addAddress($email, $username);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Akun';
    $mail->Body    = 'Hi! '.$username.' Verifikasi Akun anda dengan klik link dibawah ini <br> <a href="http://localhost/totopet/totopet_main/content/register/verif.php?code='.$code.'">klik disini</a>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail -> send()) {
      $conn -> query("INSERT INTO user VALUES ('$email','$username','$password','','user','$date','$code','N')");

      echo "<script> alert(\"Registrasi  Berhasil, silahkan cek email untuk verifikasi akun!\")";
     }
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>