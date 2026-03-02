<?php
// PHP Script to handle our Contact Form
header('Content-Type: application/json');

// Get form input values
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Simple validation to make sure nothing is empty
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(array("status" => "error", "message" => "Please fill in all the details."));
    exit;
}

// 1. SAVE TO DATABASE
// Connect to the database
include('db.php');

try {
    // Insert into table
    $query = "INSERT INTO contact_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($name, $email, $subject, $message));
    $db_ok = true;
} catch (Exception $e) {
    $db_ok = false;
    $db_err = $e->getMessage();
}

// 2. SEND EMAILS WITH PHPMAILER
// We need to include the files first
include('PHPMailer/src/Exception.php');
include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');
include('mail-config.php'); // grab my settings
include('email-templates.php'); // grab my email templates

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Send Admin Email
$admin_mail = new PHPMailer(true);
try {
    $admin_mail->isSMTP();
    $admin_mail->Host = $smtp_host;
    $admin_mail->SMTPAuth = true;
    $admin_mail->Username = $smtp_user;
    $admin_mail->Password = $smtp_pass;
    $admin_mail->SMTPSecure = $smtp_secure;
    $admin_mail->Port = $smtp_port;

    $admin_mail->setFrom($smtp_user, $from_name);
    $admin_mail->addAddress($admin_email); 
    $admin_mail->isHTML(true);
    $admin_mail->Subject = "New Website Message - $subject";
    $admin_mail->Body = get_admin_email_content($name, $email, $subject, $message);
    $admin_mail->send();
    $mail_1_ok = true;
} catch (Exception $e) {
    $mail_1_ok = false;
}

// Send User Confirmation Email
$user_mail = new PHPMailer(true);
try {
    $user_mail->isSMTP();
    $user_mail->Host = $smtp_host;
    $user_mail->SMTPAuth = true;
    $user_mail->Username = $smtp_user;
    $user_mail->Password = $smtp_pass;
    $user_mail->SMTPSecure = $smtp_secure;
    $user_mail->Port = $smtp_port;

    $user_mail->setFrom($smtp_user, $from_name);
    $user_mail->addAddress($email);
    $user_mail->isHTML(true);
    $user_mail->Subject = "We got your message! - $from_name";
    $user_mail->Body = get_user_confirmation_content($name, $subject, $message);
    $user_mail->send();
    $mail_2_ok = true;
} catch (Exception $e) {
    $mail_2_ok = false;
}

// 3. SEND RESULT BACK TO THE WEBSITE
if ($db_ok && $mail_1_ok && $mail_2_ok) {
    echo json_encode(array("status" => "success", "message" => "Everything worked! Mail sent and message saved."));
} else if ($db_ok) {
    echo json_encode(array("status" => "warning", "message" => "Saved to database, but there was an error with Gmail. Try checking settings."));
} else {
    echo json_encode(array("status" => "error", "message" => "Submission failed. Error from database: " . $db_err));
}
