<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $userMessage = htmlspecialchars($_POST["message"]); // Renamed to avoid overwriting $message

    // Prepare email message
    $emailMessage = "Name: $name\n";
    $emailMessage .= "Phone: $phone\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Message: $userMessage\n";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true); // Enable exceptions for error handling

    try {
        // Set up SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'edenestatesmw.com'; // Use correct SMTP host for your domain
        $mail->SMTPAuth = true;
        $mail->Username = 'admin@edenestatesmw.com'; // SMTP username
        $mail->Password = '@dM1n.E3l//p'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL encryption
        $mail->Port = 465;

        // Set up email content
        $mail->setFrom('admin@edenestatesmw.com', 'Eden Estates Contact Form'); // Use your domain's verified email
        $mail->addAddress('info@edenestatesmw.com'); // Recipient address
        $mail->addReplyTo($email, $name); // Sender's email for replies
        $mail->addCC($email); // Optionally CC the sender

        // Email subject and body
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = $emailMessage;

        // Send email
        if ($mail->send()) {
            echo "success";
            exit;
        } else {
            echo "Failed to send message. Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect to the contact form page if form was not submitted
    header("Location: /contact-form.html");
    exit;
}
?>