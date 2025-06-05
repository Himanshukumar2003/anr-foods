<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    require_once 'PHPMailer/Exception.php';

$errors = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $contactno = htmlspecialchars(trim($_POST['contactno']));
    $email = htmlspecialchars(trim($_POST['email']));
    $company = htmlspecialchars(trim($_POST['company']));
    $selectstate = htmlspecialchars(trim($_POST['selectstate']));
    $selectcity = htmlspecialchars(trim($_POST['selectcity']));
    $nopeople = htmlspecialchars(trim($_POST['nopeople']));
    $foodpreference = htmlspecialchars(trim($_POST['foodpreference']));

    // 🚀 **Step 1: Basic Validation**
    if (empty($fullname)) {
        $errors[] = "Full Name is required!";
    }
    if (empty($contactno)) {
        $errors[] = "Contact No. is required!";
    }
    if (empty($email)) {
        $errors[] = "Email is required!";
    }
    if (empty($company)) {
        $errors[] = "Company Name is required!";
    }
    if (empty($selectstate)) {
        $errors[] = "State Name is required!";
    }
    if (empty($selectcity)) {
        $errors[] = "City Name is required!";
    }
    if (empty($nopeople)) {
        $errors[] = "No. of People is required!";
    }
    if (empty($foodpreference)) {
        $errors[] = "Food Preference is required!";
    }

    // 🚀 **Step 2: Validate Email Format**
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Format!";
    }

    // If there are errors, show the alerts and exit
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>
                    window.alert('Oops Went Wrong');
                    window.location.href='home.html';
                  </script>";
        }
        exit();
    }

    // 🚀 **Step 3: Send Email if no errors**
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'jakhmolayakshi12@gmail.com'; // Your email
        $mail->Password = 'bhaqwkrwvshvyftv'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Details
        $mail->setFrom('jakhmolayakshi12@gmail.com', 'The Flavour Profile');
        $mail->addAddress('jakhmolayakshi12@gmail.com'); // Recipient

        $mail->isHTML(true);
        $mail->Subject = 'ANR Food Form Submission';
        $mail->Body    = "
            <p>Contact Form Details</p>
            <p><b>Full Name:</b> $fullname</p>
            <p><b>Contact No.:</b> $contactno</p>
            <p><b>Email:</b> $email</p>
            <p><b>Company:</b> $company</p>
            <p><b>State:</b> $selectstate</p>
            <p><b>City:</b> $selectcity</p>
            <p><b>No. of People:</b> $nopeople</p>
            <p><b>Food Preference:</b> $foodpreference</p>
        ";

        $mail->send();
        $successMessage = 'Thank you for reaching out! Our expert counselor will connect with you shortly.';
    } catch (Exception $e) {
        echo "<script>
                window.alert('Oops Went Wrong');
                window.location.href='home.html';
              </script>";
        exit();
    }

    // If the email is successfully sent, show the success message and redirect
    if ($successMessage) {
        echo "<script>
                window.alert('Thankyou for Submitted Form');
                window.location.href='home.html';
              </script>";
    }
}
?>
