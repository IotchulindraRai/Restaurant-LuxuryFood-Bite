<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form field values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Set recipient email address
    $to = 'chulindrarai123@gmail.com'; // Replace with your own email address

    // Set email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

    // Construct the email body
    $email_body = "<h3>New Contact Form Submission</h3>";
    $email_body .= "<p><strong>Name:</strong> $name</p>";
    $email_body .= "<p><strong>Email:</strong> $email</p>";
    $email_body .= "<p><strong>Subject:</strong> $subject</p>";
    $email_body .= "<p><strong>Message:</strong> $message</p>";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        // Email sent successfully
        header("Location: contact.html?status=success");
        exit();
    } else {
        // Error sending email
        header("Location: contact.html?status=error");
        exit();
    }
} else {
    // Invalid request method
    header("Location: contact.html?status=error");
    exit();
}
?>
