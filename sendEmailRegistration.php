<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHP/vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
$mail->isSMTP(); // Send using SMTP
$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'efiphpblog@gmail.com'; // SMTP username // Configuro Email
$mail->Password = 'sargiottophp2019'; // SMTP password // Configuro Contraseña
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port = 587; // TCP port to connect to

//Recipients
$mail->setFrom('efiphpblog@gmail.com', 'EFI PHP BLOG');
$mail->addAddress($useremail, 'New User'); // Add a recipient // Agrego email del recptor

// Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = '';
$mail->Body = '<html><p>Bienvenido! Estos son los datos de tu usuario creado recientemente. !</p></br>'. // Creo cuerpo del Email
 '<p>Nombre: '.$userfirstname.'</p>'.
 '<p>Apellido: '.$userlastname .'</p>'.
 '<p>Email: '.$useremail.'</p>'.
 '<p>Contraseña: '.$userpassword.'</p>'.
 '</html> ';

ob_start();
$mail->send();
ob_get_clean();
echo 'Message has been sent';
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>