<?php

$nom = htmlspecialchars($_POST['nom']);
$telephone = htmlspecialchars($_POST['telephone']);
$services = htmlspecialchars($_POST['services']);

$message = "Nom: $nom \n";
$message .= "Telephone: $telephone \n";
$message .= "Prestations: $services \n";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                  
    $mail->Host       = 'smtp.ionos.fr';       
    $mail->SMTPAuth   = true;             
    $mail->Username   = 'contact@webprime.fr'; 
    $mail->Password   = 'Allamalyjass912!';   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Port       = 465;                      

    $mail->setFrom('contact@webprime.fr', 'Assainissement 75');
    $mail->addAddress('contact.aquaserv@gmail.com');
    $mail->addAddress('contact@webprime.fr');

    $mail->isHTML(true);     
    $mail->Subject = 'Formulaire de contact';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>

