<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = 'localhost'; 
    $username = 'root'; 
    $password = ''; 
    $db_name = 'account'; 

    // Establish the connection
    $conn = mysqli_connect($host, $username, $password, $db_name);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $errors = [];
    $username = $email = '';
    $msg = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate input
        if (empty($_POST['username'])) {
            $errors['username'] = "User Name is required.";
        } else {
            $username = trim($_POST['username']);
        }

        if (empty($_POST['email'])) {
            $errors['email'] = "Email is required.";
        } else {
            $email = trim($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
        }

        // If there are no errors, proceed with user validation
        if (empty($errors)) {
            // Check if the user exists
            $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // Successful login (no password check)
                $_SESSION['username'] = $username; // Store username in session
                header('Location: formvalidation.php');
                exit();
            } else {
                $msg = "User does not exist.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>SIGN IN Page</h2>

        <label for="username">User Name</label>
        <input type="text" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($username); ?>" required>
        <?php if (isset($errors['username'])) { ?>
            <p class="error"><?php echo $errors['username']; ?></p>
        <?php } ?>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
        <?php if (isset($errors['email'])) { ?>
            <p class="error"><?php echo $errors['email']; ?></p>
        <?php } ?>

        <?php if (!empty($msg)) { ?>
            <p class="error"><?php echo $msg; ?></p>
        <?php } ?>

        <button type="submit" class="btn btn-primary">SIGN IN</button>
    </form>
</body>
</html>