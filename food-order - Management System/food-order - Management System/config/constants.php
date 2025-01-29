<?php

// Start Session
session_start();

// Create Constant to store non-repeating values
define('SITEURL', 'http://localhost/food-order/');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');  // Leave empty if no password is set in XAMPP
define('DB_NAME', 'food-order');  // Your actual database name
define('DB_PORT', 3307);  // Use port 3307 if MySQL is running on this port

// Create connection
// $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT); 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 



// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
   // echo "Database connection successful!";
}

?>
