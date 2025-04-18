<?php
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['photo'];

    $name = htmlspecialchars($_POST['name'] ?? '');
    $type = htmlspecialchars($_POST['type'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $source = htmlspecialchars($_POST['source'] ?? '');

    if (isset($file) && $file['error'] === 0) {
        $filename = basename($file['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];

        // make sure file type is allowed
        if (in_array($ext, $allowedExts)) {
            $uniqueName = uniqid('img_') . '.' . $ext;
            $targetPath = $uploadDir . $uniqueName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // save metadata
                $entry = [
                    'name' => $name,
                    'type' => $type,
                    'description' => $description,
                    'source' => $source,
                    'file' => $targetPath,
                    'time' => date('Y-m-d H:i:s')
                ];

                file_put_contents('data.txt', json_encode($entry) . PHP_EOL, FILE_APPEND);

                echo "✅ Upload successful! Thank you for your submission.";
            } else {
                echo "❌ Error moving uploaded file.";
            }
        } else {
            echo "❌ Invalid file type. Only JPG and PNG allowed.";
        }
    } else {
        echo "❌ No valid file uploaded.";
    }
} else {
    echo "❌ Invalid request.";
}
?>
