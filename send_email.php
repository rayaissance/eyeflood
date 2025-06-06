<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $contact = filter_var(trim($_POST['contact']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    if (!empty($name) && !empty($contact) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rhya.maria04@gmail.com'; // Your Gmail address
            $mail->Password = 'puwyemdomfdfpxpk'; // Replace with your Gmail App Password
            $mail->SMTPSecure = 'ssl'; // Use PHPMailer::ENCRYPTION_SMTPS if STARTTLS fails
            $mail->Port = 465; // Use 465 if 587 does not work

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Email settings
            // Email settings
            $mail->setFrom('rhya.maria04@gmail.com', 'Website Contact Form'); // Set a static sender name
            $mail->addReplyTo($email, $name); // User's email as a reply-to address
            $mail->addAddress('support@eyeflood.xyz'); // Send to support@eyeflood.xyz


            $mail->Subject = 'New Contact Form Submission';
            $mail->Body = "Name: $name\nContact: $contact\nEmail: $email\nMessage: $message";

            // Send email
            if ($mail->send()) {
                echo "Thank you! Your message has been sent.";
            } else {
                echo "Sorry, there was an error sending your message. Please try again later.";
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "All fields are required, and please enter a valid email address.";
    }
} else {
    echo "Invalid request.";
}
?>
