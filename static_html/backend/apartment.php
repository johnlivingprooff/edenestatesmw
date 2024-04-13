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
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $adults = $_POST['adults'];
    $kids = $_POST['kids'];
    $rooms = $_POST['rooms'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $guestNames = $_POST['guestNames'];
    $vitalInfo = $_POST['vitalInfo'];

    // Calculate price
    $pricePerNight = ($adults == 1) ? 100 : 110; // Adjusted price for 1 adult guest
    $numNights = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
    $price = $numNights * $rooms * $pricePerNight;

    // Prepare email message
    $message = "Number of Rooms: $rooms Apartment(s)\n";
    $message .= "Guest Names: $guestNames\n";
    $message .= "First Name: $firstName\n";
    $message .= "Last Name: $lastName\n";
    $message .= "Price: $$price\n";
    $message .= "Check-in: $checkin\n";
    $message .= "Check-out: $checkout\n";
    $message .= "Phone: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Vital Info: $vitalInfo\n";

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
    $mail->addAddress('reservations@edenestatesmw.com');
    $mail->addCC($email); // CC the sender
    $mail->Subject = 'New Apartment Reservation';
    $mail->Body = $message;

    // Send email and handle errors
    if ($mail->send()) {
        echo "success";
        // header("Location: ../thank-you.html");
        exit;
    } else {
        echo "Failed to send reservation email. Error: " . $mail->ErrorInfo;
    }
} else {
    // Redirect to the booking page if form was not submitted
    header("Location: /booking-page.html");
    exit;
}
