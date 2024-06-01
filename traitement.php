<?php

header('Content-Type: text/html; charset=UTF-8');

$nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
$telephone = htmlspecialchars($_POST['telephone'], ENT_QUOTES, 'UTF-8');
$services = htmlspecialchars($_POST['services'], ENT_QUOTES, 'UTF-8');
$commentaires = htmlspecialchars($_POST['commentaires'], ENT_QUOTES, 'UTF-8');

$message = "NOM : $nom \n";
$message .= "/ TELEPHONE : $telephone \n";
$message .= "/ PRESTATION : $services \n";
$message .= "/ COMMENTAIRES : $commentaires \n";

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

    $mail->setFrom('contact@webprime.fr', 'Assainissement 77');
    $mail->addAddress('contact.aquaserv@gmail.com');
    $mail->addAddress('contact@webprime.fr');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);     
    $mail->Subject = 'Formulaire 77';
    $mail->Body    = nl2br($message);
    $mail->AltBody = $message;

    $mail->send();

    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>
