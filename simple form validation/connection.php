<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$db_name = 'account'; 


$conn = mysqli_connect($host, $username, $password, $db_name);

if ($conn) {
    echo " connected";
} else {
 
    die("Connection failed: " . mysqli_error($conn));
}
?>