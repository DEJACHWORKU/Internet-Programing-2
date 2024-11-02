<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
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
    
    if ($conn) {
        // Connection successful
    } else {
        die("Connection failed: " . mysqli_error($conn));
    }

    $errors = [];
    $fullname = $email = $password = $phone = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate input
        if (empty($_POST['fullname'])) {
            $errors['fullname'] = "Full Name is required.";
        } else {
            $fullname = trim($_POST['fullname']);
            if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
                $errors['fullname'] = "Only letters and whitespace are allowed.";
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

        if (empty($_POST['phone'])) {
            $errors['phone'] = "Phone Number is required.";
        } else {
            $phone = trim($_POST['phone']);
            if (!preg_match("/^\d{10}$/", $phone)) {
                $errors['phone'] = "Phone number must be 10 digits.";
            }
        }

        if (empty($errors)) {
            // Insert data into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (fullname, email, password, phone) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashed_password, $phone);

            if (mysqli_stmt_execute($stmt)) {
                $msg = "Registration successful!";
                header('location:form.php');
            }
            
            else {
                $msg = "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>LOGIN PAGE</h2>

        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($fullname); ?>" required>
        <?php if (isset($errors['fullname'])) { ?>
            <p class="error"><?php echo $errors['fullname']; ?></p>
        <?php } ?>

        <label>Email</label>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
        <?php if (isset($errors['email'])) { ?>
            <p class="error"><?php echo $errors['email']; ?></p>
        <?php } ?>

        <label>User Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <?php if (isset($errors['password'])) { ?>
            <p class="error"><?php echo $errors['password']; ?></p>
        <?php } ?>

        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone); ?>" required>
        <?php if (isset($errors['phone'])) { ?>
            <p class="error"><?php echo $errors['phone']; ?></p>
        <?php } ?>

        <?php if (isset($msg)) { ?>
            <p class="success"><?php echo $msg; ?></p>
        <?php } ?>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
        
</body>
</html>