<?php
header("Access-Control-Allow-Origin: *");  // Allow requests from any origin
header("Access-Control-Allow-Methods: POST");  // Allow POST requests
header("Access-Control-Allow-Headers: Content-Type");  // Allow headers

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $name = filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['contact-phone'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare the email
    $to = "thintujoseph98@gmail.com";  // Replace with your email address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $fullMessage = "Name: $name\n";
    $fullMessage .= "Phone: $phone\n";
    $fullMessage .= "Email: $email\n";
    $fullMessage .= "Subject: $subject\n";
    $fullMessage .= "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
