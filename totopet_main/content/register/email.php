<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../../vendor/autoload.php';

// Load the PHPMailer classes

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    
    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'totopet.indo@gmail.com'; // Your Gmail address
        $mail->Password   = 'tugasweb2'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587; // TCP port to connect to; use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('totopet.indo@gmail.com', 'Your Name'); // Your Gmail address and your name
        $mail->addAddress($to); // Recipient's email

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Usage example:
$recipientEmail = 'recipient@example.com'; // Replace with the recipient's email address
$subject = 'Test Email from PHPMailer';
$body = 'This is a test email sent using PHPMailer. It works!';

sendEmail("donovan.jiro@gmail.com", "Sting", "String");
?>

