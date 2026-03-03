<?php
// PHP Script to handle our Newsletter Signup
header('Content-Type: application/json');

// Get the email from the form
$subscriber_email = $_POST['email'];

// Basic check
if (empty($subscriber_email)) {
    echo json_encode(array("status" => "error", "message" => "Please enter your email address."));
    exit;
}

// 1. SAVE TO DATABASE
include(__DIR__ . '/db.php'); // connect to db

try {
    // Check if email already exists first
    $check_query = "SELECT * FROM newsletter_signups WHERE email = ?";
    $check_stmt = $pdo->prepare($check_query);
    $check_stmt->execute(array($subscriber_email));
    
    if ($check_stmt->rowCount() > 0) {
        echo json_encode(array("status" => "info", "message" => "You are already subscribed to our newsletter!"));
        exit;
    }

    // Insert new email
    $query = "INSERT INTO newsletter_signups (email) VALUES (?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($subscriber_email));
    $db_ok = true;
} catch (Exception $e) {
    $db_ok = false;
    $db_err = $e->getMessage();
}

// 2. SEND WELCOME EMAIL
include(__DIR__ . '/PHPMailer/src/Exception.php');
include(__DIR__ . '/PHPMailer/src/PHPMailer.php');
include(__DIR__ . '/PHPMailer/src/SMTP.php');
include(__DIR__ . '/mail-config.php'); // grab my settings
include(__DIR__ . '/email-templates.php'); // grab my email templates

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_user;
    $mail->Password = $smtp_pass;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Port = $smtp_port;

    $mail->setFrom($smtp_user, $from_name);
    $mail->addAddress($subscriber_email);
    $mail->isHTML(true);
    $mail->Subject = "Welcome to Brew Haven Insider!";
    $mail->Body = get_newsletter_welcome_content($subscriber_email);
    $mail->send();
    $mail_ok = true;
} catch (Exception $e) {
    $mail_ok = false;
}

// 3. SEND RESULT BACK
if ($db_ok && $mail_ok) {
    echo json_encode(array("status" => "success", "message" => "Success! Welcome to our newsletter."));
} else if ($db_ok) {
    echo json_encode(array("status" => "success", "message" => "You've been added to our list, but welcome email failed."));
} else {
    echo json_encode(array("status" => "error", "message" => "Failed to join: " . $db_err));
}
