
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <h2>LOGIN PAGE</h2>

        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Full Name" required>
        <?php if (isset($errors['fullname'])) { ?>
            <p class="error"><?php echo $errors['fullname']; ?></p>
        <?php } ?>

        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
        <?php if (isset($errors['email'])) { ?>
            <p class="error"><?php echo $errors['email']; ?></p>
        <?php } ?>

        <label>User Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <?php if (isset($errors['password'])) { ?>
            <p class="error"><?php echo $errors['password']; ?></p>
        <?php } ?>

        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <?php if (isset($errors['phone'])) { ?>
            <p class="error"><?php echo $errors['phone']; ?></p>
        <?php } ?>

        <?php if (isset($errors['login'])) { ?>
            <p class="error"><?php echo $errors['login']; ?></p>
        <?php } ?>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>