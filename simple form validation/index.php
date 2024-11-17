<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $host = 'localhost'; 
    $username = 'root'; 
    $password = ''; 
    $db_name = 'account'; 

    // Establish the connection
    $conn = mysqli_connect($host, $username, $password, $db_name);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_error($conn));
    }

    $errors = [];
    $username = $email = $password = '';
    $msg = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate input
        if (empty($_POST['username'])) {
            $errors['username'] = "User Name is required.";
        } else {
            $username = trim($_POST['username']);
            if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $errors['username'] = "Only letters and whitespace are allowed.";
            }
        }

        if (empty($_POST['email'])) {
            $errors['email'] = "Email is required.";
        } else {
            $email = trim($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
        }

        if (empty($_POST['password'])) {
            $errors['password'] = "Password is required.";
        } else {
            $password = trim($_POST['password']);
            if (strlen($password) < 6) {
                $errors['password'] = "Password must be at least 6 characters.";
            } elseif (!preg_match("/[A-Za-z]/", $password) || 
                      !preg_match("/[0-9]/", $password) || 
                      !preg_match("/[\W_]/", $password)) {
                $errors['password'] = "Password must include at least one letter, one number, and one special character.";
            }
        }

        // If there are no errors, proceed with the user validation/creation
        if (empty($errors)) {
            // Check if the user already exists
            $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // User exists, verify the password
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    // Successful login, redirect to formvalidation.php
                    header('Location: formvalidation.php');
                    exit();
                } else {
                    $msg = "Invalid password.";
                }
            } else {
                // New user, create the account
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $insert_stmt = mysqli_prepare($conn, $insert_sql);
                mysqli_stmt_bind_param($insert_stmt, "sss", $username, $email, $hashed_password);

                if (mysqli_stmt_execute($insert_stmt)) {
                    // Account created, redirect to formvalidation.php
                    header('Location: formvalidation.php');
                    exit();
                } else {
                    $msg = "Error creating user.";
                }
                mysqli_stmt_close($insert_stmt);
            }
            mysqli_stmt_close($stmt);
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Login Page</h2>

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

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <?php if (isset($errors['password'])) { ?>
            <p class="error"><?php echo $errors['password']; ?></p>
        <?php } ?>

        <?php if (!empty($msg)) { ?>
            <p class="error"><?php echo $msg; ?></p>
        <?php } ?>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>
