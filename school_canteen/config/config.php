<?php

//main connection file for both admin & front end
$servername = "127.0.0.1:3306"; //server
$username = "u784395287_school_canteen"; //username
$password = "t=S7JbO2k6k"; //password
$dbname = "u784395287_school_canteen";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>