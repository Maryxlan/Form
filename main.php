<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["name"];
    $nachricht = $_POST["nachricht"];

    // Empfänger-E-Mail-Adresse festlegen
    $toEmail = "maria.lani96@gmail.com";

    // Absender-E-Mail-Adresse festlegen
    $fromEmail = $_POST["email"]; 

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'maria.lani96@gmail.com'; 
        $mail->Password   = '***'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
       // $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

   
        $mail->setFrom($fromEmail, $name); // Absender aus dem Formular verwenden
        $mail->addAddress($toEmail);
     
        $mail->isHTML(true);
        $mail->Subject = 'Betreff';
        $mail->Body    = $nachricht;

        // E-Mail senden
        if ($mail->send()) {
            // Erfolg: Weiterleitung zur Erfolgsseite
            header("Location: erfolg.html");
            exit();
        } else {
            // Fehler beim Senden der E-Mail
            echo "E-Mail konnte nicht gesendet werden: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Ein Fehler ist aufgetreten: {$e->getMessage()}";
    }
} else {
   
    echo "Das Skript wurde nicht korrekt aufgerufen.";
}
?>
