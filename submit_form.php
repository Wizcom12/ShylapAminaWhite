<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate form inputs
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400); // Bad request
        echo "Please fill out all required fields.";
        exit;
    }

    // Configure email parameters
    $to = "wizzcom12@gmail.com"; // Replace with the recipient's email address
    $subject = "Contact Form Submission from $name";
    $headers = "From: $email\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200); // Success
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500); // Internal server error
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    http_response_code(405); // Method not allowed
    echo "Method not allowed.";
}
?>
