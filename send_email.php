<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoload

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'friska.fikianti@gmail.com'; // Gmail kamu
        $mail->Password   = 'hqklfuwppnykyjlk'; // Password Aplikasi Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Pengirim & penerima
        $mail->setFrom($email, $name);
        $mail->addAddress('friska.fikianti@gmail.com');

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Pesan dari Portfolio - $name";
        $mail->Body    = nl2br("Nama: $name\nEmail: $email\nPesan:\n$message");

        $mail->send();
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
    }
}
