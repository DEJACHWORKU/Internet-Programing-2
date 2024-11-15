<?php

$host = 'localhost'; 
$db = 'register'; 
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Main script
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = 0;

if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['name'];
    $dob = $_REQUEST['dob'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $id_number = $_REQUEST['id_number'];
    $age = $_REQUEST['age'];
    $sex = $_REQUEST['sex'];
    $country = $_REQUEST['country'];
    $born_city = $_REQUEST['born_city'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];

    // Validation logic
    if (empty($name)) {
        $name_error = "Please enter the Name";
        $error = 1;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $name_error = "Only letters are allowed";
        $error = 1;
    }
    if (empty($dob)) {
        $dob_error = "Please enter the Date of Birth";
        $error = 1;
    }
    if (empty($email)) {
        $email_error = "Please enter the Email Id";
        $error = 1;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid Email Format";
        $error = 1;
    }
    if (empty($mobile)) {
        $mobile_error = "Please enter the Mobile Number";
        $error = 1;
    } else if (!preg_match("/^\d{10}$/", $mobile)) {
        $mobile_error = "Mobile number must be 10 digits";
        $error = 1;
    }
    if (empty($id_number)) {
        $id_error = "Please enter the ID Number";
        $error = 1;
    }
    if (empty($age)) {
        $age_error = "Please enter the Age";
        $error = 1;
    } else if (!is_numeric($age) || $age <= 0) {
        $age_error = "Age must be a positive number";
        $error = 1;
    }
    if (empty($sex)) {
        $sex_error = "Please select the Sex";
        $error = 1;
    }
    if (empty($country)) {
        $country_error = "Please enter the Country";
        $error = 1;
    }
    if (empty($born_city)) {
        $born_city_error = "Please enter the Born City";
        $error = 1;
    }
    if (empty($password)) {
        $password_error = "Please enter the Password";
        $error = 1;
    } else if (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters";
        $error = 1;
    }
    if ($password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match";
        $error = 1;
    }

 
    if ($error == 0) {
      
        $stmt = $pdo->prepare("INSERT INTO student (`full name`, `date birth`, `Email`, `password`, `confirm password`, `mobile no`, `id number`, `Age`, `sex`, `country`, `born city`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
      
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
       
        try {
            $stmt->execute([$name, $dob, $email, $hashed_password, $hashed_password, $mobile, $id_number, $age, $sex, $country, $born_city]);
            $msg = "Registration successful";
        } catch (Exception $e) {
            $msg = "Error: " . $e->getMessage();
        }
    } else {
        $msg = "Please fill all fields correctly";
    }
}
?>
<html>
<head>
    <title>Registration form</title>
    <link rel="stylesheet" href="css/validform.css">
</head>
<body>
    <div class="container">
 <div class="table-responsive">
<h3 style="text-align: center;">Student Registration Form</h3><br/>


<div class="box">
<form id="validate_form" method="post">
<div class="form-group">
<label for="name">Full Name</label>
<input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php if(isset($name)){ echo htmlspecialchars($name); }?>"/>
 <span class="text-danger"><?php if(!empty($name_error)){ echo $name_error; } ?></span>
</div>


<div class="form-group">
<label for="dob">Date of Birth</label>
<input type="date" name="dob" class="form-control" value="<?php if(isset($dob)){ echo htmlspecialchars($dob); }?>"/>
 <span class="text-danger"><?php if(!empty($dob_error)){ echo $dob_error; } ?></span>
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php if(isset($email)){ echo htmlspecialchars($email); }?>"/>
<span class="text-danger"><?php if(!empty($email_error)){ echo $email_error; } ?></span>
</div>

<div class="form-group">
 <label for="password">Password</label>
<input type="password" name="password" placeholder="Enter Password" class="form-control" />
<span class="text-danger"><?php if(!empty($password_error)){ echo $password_error; } ?></span>
                    </div>

<div class="form-group">
<label for="confirm_password">Confirm Password</label>
<input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" />
<span class="text-danger"><?php if(!empty($confirm_password_error)){ echo $confirm_password_error; } ?></span>
</div>

<div class="form-group">
<label for="mobile">Mobile No.</label>
<input type="text" name="mobile" id="mob" placeholder="Enter Mobile" class="form-control" value="<?php if(isset($mobile)){ echo htmlspecialchars($mobile); }?>"/>
<span class="text-danger"><?php if(!empty($mobile_error)){ echo $mobile_error; } ?></span>
</div>

                    
<div class="form-group">
<label for="id_number">ID Number</label>
<input type="text" name="id_number" placeholder="Enter ID Number" class="form-control" value="<?php if(isset($id_number)){ echo htmlspecialchars($id_number); }?>"/>
<span class="text-danger"><?php if(!empty($id_error)){ echo $id_error; } ?></span>
</div>

<div class="form-group">
<label for="age">Age</label>
<input type="number" name="age" placeholder="Enter Age" class="form-control" value="<?php if(isset($age)){ echo htmlspecialchars($age); }?>"/>
<span class="text-danger"><?php if(!empty($age_error)){ echo $age_error; } ?></span>
</div>

<div class="form-group">
<label for="sex">Sex</label>
<select name="sex" class="form-control">
<option value="">Select</option>
<option value="Male" <?php if(isset($sex) && $sex == "Male"){ echo 'selected'; }?>>Male</option>
<option value="Female" <?php if(isset($sex) && $sex == "Female"){ echo 'selected'; }?>>Female</option>
</select>
                        
<span class="text-danger"><?php if(!empty($sex_error)){ echo $sex_error; } ?></span>

</div>
<div class="form-group">
<label for="country">Country</label>
<input type="text" name="country" placeholder="Enter Country" class="form-control" value="<?php if(isset($country)){ echo htmlspecialchars($country); }?>"/>
 <span class="text-danger"><?php if(!empty($country_error)){ echo $country_error; } ?></span>
</div>

                    
<div class="form-group">
<label for="born_city">Born City</label>
<input type="text" name="born_city" placeholder="Enter Born City" class="form-control" value="<?php if(isset($born_city)){ echo htmlspecialchars($born_city); }?>"/>
<span class="text-danger"><?php if(!empty($born_city_error)){ echo $born_city_error; } ?></span>
</div>

<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-success" />
</div>
                    
<p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
</form>
</div>
</div>
</div>
</body>
</html>