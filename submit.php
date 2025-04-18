<?php

// Email address submissions will go to
$to = "youremail@example.com";

// Get form data
$name = htmlspecialchars($_POST['name']);
$type = htmlspecialchars($_POST['type']);
$description = htmlspecialchars($_POST['description']);
$source = htmlspecialchars($_POST['source']);

// Get uploaded file
$file = $_FILES['photo'];

if ($file['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileContent = chunk_split(base64_encode(file_get_contents($fileTmpPath)));

    // Email headers
    $boundary = md5(time());
    $headers = "From: TKT.archive <no-reply@yourdomain.com>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Email body
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= "New submission received from TKT.archive:\n\n";
    $body .= "Name: $name\n";
    $body .= "Type: $type\n";
    $body .= "Description: $description\n";
    $body .= "Source: $source\n\n";

    // Attachment
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= $fileContent . "\r\n";
    $body .= "--$boundary--";

    // Send email
    if (mail($to, "New Archive Submission", $body, $headers)) {
        echo "Submission sent successfully.";
    } else {
        echo "Failed to send submission.";
    }

} else {
    echo "There was an error uploading the file.";
}
?>