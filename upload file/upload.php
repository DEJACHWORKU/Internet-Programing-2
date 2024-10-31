<?php
$targetDir = "uploads/";
// Create uploads directory if it doesn't exist
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$files = scandir($targetDir);

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $fileName;

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "<div class='alert error'>File already exists. Please choose a different file.</div>";
    } else {
        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo "<div class='alert success'>File uploaded successfully.</div>";
        } else {
            echo "<div class='alert error'>Sorry, there was an error uploading your file.</div>";
        }
    }
}

// Handle file deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['file'])) {
    $fileToDelete = $targetDir . basename($_GET['file']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "<div class='alert success'>File deleted successfully.</div>";
    } else {
        echo "<div class='alert error'>File not found.</div>";
    }
}

// Handle file renaming
if (isset($_POST['rename'])) {
    $oldName = $targetDir . basename($_POST['old_name']);
    $newName = $targetDir . basename($_POST['new_name']);

    // Check if new file name already exists
    if (file_exists($newName)) {
        echo "<div class='alert error'>File with that name already exists. Please choose a different name.</div>";
    } else {
        rename($oldName, $newName);
        echo "<div class='alert success'>File renamed successfully.</div>";
    }
}

// Handle file reading
$content = "";
if (isset($_GET['action']) && $_GET['action'] === 'read' && isset($_GET['file'])) {
    $fileToRead = $targetDir . basename($_GET['file']);
    if (file_exists($fileToRead)) {
        $content = file_get_contents($fileToRead);
    } else {
        $content = "File not found.";
    }
}

// Handle writing to a file
if (isset($_POST['write'])) {
    $fileToWrite = $targetDir . basename($_POST['write_file']);
    $textToWrite = $_POST['file_content'];

    if (file_exists($fileToWrite)) {
        file_put_contents($fileToWrite, $textToWrite, FILE_APPEND);
        echo "<div class='alert success'>Content written to file successfully.</div>";
    } else {
        echo "<div class='alert error'>File not found.</div>";
    }
}
?>

