<?php
// handle_files.php

// File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'upload_file') {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        echo "File uploaded successfully.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    exit;
}

// Fetch File List
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_file_list') {
    $files = scandir('uploads/');
    $output = '';

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $output .= '<p>' . $file . ' <a href="#" class="delete-file" data-filename="' . $file . '">Delete</a></p>';
        }
    }
    echo $output;
    exit;
}

// Delete File
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'delete_file') {
    $fileName = $_POST['fileName'];
    $filePath = 'uploads/' . $fileName;

    if (file_exists($filePath)) {
        unlink($filePath);
        echo "File deleted successfully.";
    } else {
        echo "File not found or already deleted.";
    }
    exit;
}
?>
