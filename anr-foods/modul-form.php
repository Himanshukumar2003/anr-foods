<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $city    = trim($_POST['city']);
    $message = trim($_POST['message']);
    $downloadFlag = isset($_POST['download_flag']) ? $_POST['download_flag'] : '0';

    // Server-side validation
    if (empty($name) || empty($email) || empty($phone) || empty($city) || empty($message)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }

    if (!ctype_digit($phone) || strlen($phone) != 10) {
        echo "<script>alert('Phone must be a 10-digit number.'); window.history.back();</script>";
        exit;
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        echo "<script>alert('Name can only contain letters and spaces.'); window.history.back();</script>";
        exit;
    }

    // Email details
    $to = "Info@anr-foods.com";
    $subject = "New Contact Form Submission - ANR Food";
    $body = "
        <html><body>
        <h2>New Submission from ANR Food Website</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>City:</strong> $city</p>
        <p><strong>Message:</strong> $message</p>
        </body></html>
    ";
    $headers = "From: ANR Food <Info@anr-foods.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        if ($downloadFlag === '1') {
            echo "<script>alert('Thank you! Your details have been submitted successfully.'); window.location.href='brochure.pdf';</script>";
        } else {
            echo "<script>alert('Thank you! Your details have been submitted successfully.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Error sending your details. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>