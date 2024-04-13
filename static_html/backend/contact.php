<?php
// Require Composer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $userMessage = $_POST["message"]; // Renamed to avoid overwriting $message

    // Prepare email message
    $emailMessage = "Name: $name\n";
    $emailMessage .= "Phone: $phone\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Message: $userMessage\n";

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Set up SMTP configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'mail.edenestatesmw.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'admin@edenestatesmw.com';
    $mail->Password = '@dM1n.E3l//p';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Set up email content
    $mail->setFrom($email);
    $mail->addAddress('info@edenestatesmw.com');
    $mail->addCC($email); // CC the sender
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = $emailMessage;

    // Send email and handle errors
    if ($mail->send()) {
        echo "success";
        exit;
    } else {
        echo "Failed to send message. Error: " . $mail->ErrorInfo;
    }
} else {
    // Redirect to the contact form page if form was not submitted
    header("Location: /contact-form.html");
    exit;
}
