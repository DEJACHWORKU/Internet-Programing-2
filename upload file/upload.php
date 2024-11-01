<?php
$targetDir = "uploads/";
// Create uploads directory if it doesn't exist
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$files = scandir($targetDir);

// file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $fileName;

    //  file already exists
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File Upload assignment internet programing-2</title>
</head>
<body>
    <div class="container">
        <h1>File Upload internet program-2 second assignment</h1>
        <form action="" method="post" enctype="multipart/form-data" class="upload-form">
 <input type="file" name="file" required>
 <button type="submit">Upload</button>
</form>

 <h2> Files Uploaded </h2>
 <ul class="file-list">
<?php if (count($files) > 2): ?>
<?php foreach ($files as $file): ?>
<?php if ($file !== '.' && $file !== '..'): ?>
                        
    <li>
<?php echo htmlspecialchars($file); ?>
<a class="btn" href="?action=read&file=<?php echo urlencode($file); ?>">Read to file</a>
<a class="btn" href="#" onclick="document.getElementById('rename-form').style.display='block'; document.getElementById('old-name').value='<?php echo htmlspecialchars($file); ?>';">Rename to file</a>
<a class="btn" href="?action=delete&file=<?php echo urlencode($file); ?>">Delete to file</a>
<a class="btn" href="#" onclick="document.getElementById('write-form').style.display='block'; document.getElementById('write-file').value='<?php echo htmlspecialchars($file); ?>';">Write to file</a>
</li>

<?php endif; ?>
<?php endforeach; ?>
<?php else: ?>
<li>No files uploaded yet.</li>
<?php endif; ?>
</ul>

<div id="rename-form" class="rename-form" style="display:none;">
<h2>Rename File</h2>
<form action="" method="post">
<input type="hidden" name="old_name" id="old-name">
<input type="text" name="new_name" placeholder="New file name" required>
<button type="submit" name="rename">Rename</button>
</form>
</div>

<div id="write-form" class="write-form" style="display:none;">
<h2>Write to File</h2>
<form action="" method="post">
<input type="hidden" name="write_file" id="write-file">
<textarea name="file_content" placeholder="Write your content here..." required></textarea>
<button type="submit" name="write">Write </button>
 </form>
</div>

        <?php if ($content): ?>
            <h2>File Content</h2>
            <pre><?php echo htmlspecialchars($content); ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>