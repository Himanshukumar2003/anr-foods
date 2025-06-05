<?php  
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $city    = trim($_POST['city']);
    $message = trim($_POST['message']);

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($city) || empty($message)) {
        echo "<script>alert('All fields must be filled.'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.'); window.history.back();</script>";
        exit;
    }

    if (!ctype_digit($phone) || strlen($phone) != 10) {
        echo "<script>alert('Enter a valid 10-digit mobile number.'); window.history.back();</script>";
        exit;
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        echo "<script>alert('Name must contain only letters and spaces.'); window.history.back();</script>";
        exit;
    }

    // Email
    $to = "Info@anr-foods.com";
    $subject = "New Contact Form Submission - ANR Food";
    $body = "
        <html><body>
            <h2>New Submission from ANR Food Website</h2>
            <p><strong>Full Name:</strong> $name</p>
            <p><strong>Email Address:</strong> $email</p>
            <p><strong>Phone Number:</strong> $phone</p>
            <p><strong>City:</strong> $city</p>
            <p><strong>Message / Query:</strong> $message</p>
        </body></html>
    ";

    $headers = "From: ANR Food <Info@anr-foods.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thank you! Your details have been submitted successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to send your details. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>