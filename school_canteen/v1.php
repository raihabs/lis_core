<?php
//main connection file for both admin & front end
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "table";  //database

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$con) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>