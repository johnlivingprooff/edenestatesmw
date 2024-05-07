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
    $message = "<h2>BOOKING CONFIRMATION - Studio-Loft Apartment</h2>";
    $message .= "<p>Dear $firstName,</p>";
    $message .= "<p>Thank you for choosing Eden Estates for your accommodation needs. Below is the information regarding your reservation:</p>";
    $message .= "<table border='1' cellpadding='5'>";
    $message .= "<tr><td><b>Number of Rooms:</b></td><td>$rooms Apartment(s)</td></tr>";
    $message .= "<tr><td><b>Guest Names:</b></td><td>$guestNames</td></tr>";
    $message .= "<tr><td><b>Price:</b></td><td>$$price</td></tr>";
    $message .= "<tr><td><b>Check-in:</b></td><td>$checkin</td></tr>";
    $message .= "<tr><td><b>Check-out:</b></td><td>$checkout</td></tr>";
    $message .= "<tr><td><b>Phone:</b></td><td>$phone</td></tr>";
    $message .= "<tr><td><b>Email:</b></td><td>$email</td></tr>";
    $message .= "<tr><td><b>Vital Info:</b></td><td>$vitalInfo</td></tr>";
    $message .= "</table>";
    $message .= "<p>We look forward to hosting you at Eden Estates. If you have any questions or need further assistance, please feel free to contact us.</p>";
    $message .= "<img src='https://edenestatesmw.com/static_html/images/sign.png' alt='Eden Estates Sign' style='width: 100%; max-width: 600px;'>";

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
