<?php
// Configuration
$to = "your@email.com"; // 🔁 Replace with your receiving email
$subject = "New Lead from Landing Page";

// Sanitize & Validate input
$name = htmlspecialchars(trim($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// Validate required fields
if (empty($name) || !$email || empty($phone)) {
    http_response_code(400);
    echo "Name, email, and phone are required with valid formats.";
    exit;
}

// Prepare email body
$body = "You have received a new lead:\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Message: $message\n";

$headers = "From: no-reply@yourdomain.com\r\n"; // Optional - update domain if needed

// Send email
if (mail($to, $subject, $body, $headers)) {
    header("Location: thank-you.html");
    exit;
} else {
    http_response_code(500);
    echo "Failed to send.";
}
?>