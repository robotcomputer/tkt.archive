<?php
// Include PHPMailer files (adjust the path if needed)
require 'PHPMailerAutoload.php'; // Or the file location where you downloaded PHPMailer

// Email address submissions will go to
$to = "youremail@example.com"; // Adjust to the recipient email address

// Get form data
$name = htmlspecialchars($_POST['name']);
$type = htmlspecialchars($_POST['type']);
$description = htmlspecialchars($_POST['description']);
$source = htmlspecialchars($_POST['source']);

// Get uploaded file
$file = $_FILES['photo'];

// Create a new PHPMailer instance
$mail = new PHPMailer;

$mail->isSMTP();  // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
$mail->SMTPAuth = true;  // Enable SMTP authentication
$mail->Username = 'youremail@gmail.com';  // Your Gmail email address
$mail->Password = 'your-app-specific-password';  // The app-specific password you created
$mail->SMTPSecure = 'tls';  // Enable TLS encryption
$mail->Port = 587;  // TCP port to connect to

// Sender's and recipient's details
$mail->setFrom('youremail@gmail.com', 'TKT.archive');  // Sender's email
$mail->addAddress($to, 'Recipient Name');  // Recipient's email

// Email content
$mail->isHTML(true);  // Set email format to HTML
$mail->Subject = 'New Archive Submission';  // Email subject
$mail->Body    = "New submission received from TKT.archive:<br><br>" .
                 "Name: $name<br>" .
                 "Type: $type<br>" .
                 "Description: $description<br>" .
                 "Source: $source<br><br>" .
                 "<b>Attachment:</b><br>" .
                 "<a href='link-to-image'>Click here to view the image</a>";

// If a file was uploaded
if ($file['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileType = $file['type'];

    // Attach the file
    $mail->addAttachment($fileTmpPath, $fileName);
}

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>