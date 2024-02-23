<?php

// Procesar email con PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Creo objeto clase PHPMailer
$mail = new PHPMailer(true);

// En caso de error lanza Exception
try { 

    // Configuración juego caracteres
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "quoted-printable";

    // Credenciales SMPT gmail
    $mail->Username = 'analopezatero@gmail.com';
    $mail->Password = 'nuih reze lgfy znmu';

    // Configuración SMPT gmail
    $mail->SMTPDebug = 2;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // tls Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Cabecera del emial
    $destinatario = 'ana.atero@hotmail.com';
    $remitente    = 'analopezatero@gmail.com';
    $asunto       = "Email con PHPMailer";
    $mensaje      = file_get_contents('email/email.html');

    $mail->setFrom($remitente, 'Ana');
    $mail->addAddress($destinatario, 'Ana López');
    $mail->addReplyTo($remitente, 'Ana Atero');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments imagen embebida
     $mail->addEmbeddedImage('email/img/cadiz.jpg', 'Cadiz');        //Add attachments
                                                                 //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->msgHTML($mensaje);
    
    // Enviamos el mensaje
    $mail->send();

    echo 'Message has been sent';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}