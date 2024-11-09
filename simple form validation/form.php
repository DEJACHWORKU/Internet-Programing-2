
<html>
<head>
    <title>Registration form</title>
    <link rel="stylesheet" href="validform.css">
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