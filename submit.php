<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader or manual includes if not using Composer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

// Email address to receive submissions
$to = "tkt.arcv@gmail.com"; // Change this to your real email

// Get form data
$name = htmlspecialchars($_POST['Name']);
$type = htmlspecialchars($_POST['Type']);
$description = htmlspecialchars($_POST['Description']);
$source = htmlspecialchars($_POST['Source']);

// File
$file = $_FILES['photo'];

// Create a new PHPMailer instance
$mail = new PHPMailer(true); // `true` enables exceptions

try {
    // Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Gmail SMTP server
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tkt.arcv@gmail.com';              // Your Gmail address
    $mail->Password = 'ucbt yciy efna lnpi';      // Your app-specific password
    $mail->SMTPSecure = 'tls';                            // TLS encryption
    $mail->Port = 587;                                    // TCP port

    // Recipients
    $mail->setFrom('tkt.arcv@gmail.com', 'TKT.archive'); // Sender info
    $mail->addAddress($to, 'Archive Submission');         // Recipient

    // Attach uploaded file if there is one
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = basename($file['name']);
        $mail->addAttachment($fileTmpPath, $fileName);
    }

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Archive Submission';
    $mail->Body    = "
        <h2>New submission received from TKT.archive:</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Type:</strong> $type</p>
        <p><strong>Description:</strong> $description</p>
        <p><strong>Source:</strong> $source</p>
        <p><strong>Attachment:</strong> Image attached.</p>
    ";

    // Send the email
    if ($mail->send()) {
        echo "Message has been sent successfully!";
    } else {
        echo "Message could not be sent.";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
