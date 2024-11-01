<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
</head>
<body>
    <form action="login.php" method="post" onsubmit="return validateForm()">
        <h2>LOGIN PAGE</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        
        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Full Name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>

        <label>User Password</label>
        <input type="password" name="password" placeholder="Password" required>

        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="Phone Number" required>

        <button type="submit">Login</button>
    </form>

    <script>
        function validateForm() {
            const fullname = document.forms[0]["fullname"].value;
            const phone = document.forms[0]["phone"].value;
            const email = document.forms[0]["email"].value;

            // Validate full name (only letters and spaces)
            const nameRegex = /^[A-Za-z\s]+$/;
            if (!nameRegex.test(fullname)) {
                alert("Full Name must contain only letters and spaces.");
                return false;
            }

            // Validate phone number (must be at least 10 digits and only numbers)
            const phoneRegex = /^\d{10,}$/;
            if (!phoneRegex.test(phone)) {
                alert("Phone Number must be at least 10 digits and contain only numbers.");
                return false;
            }

            // Validate email using a simple regex
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true; // All validations passed
        }
    </script>
</body>
</html>