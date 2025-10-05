<?php
defined('DOMAIN_PATH') || define('DOMAIN_PATH', dirname(__DIR__));
include DOMAIN_PATH.'/config/db_data.php';
$db_connect = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);

if (mysqli_connect_errno()){
  $error = "Failed to connect to Database: " . mysqli_connect_error();
  error_log($error);
  echo $error;
  exit();
}

function escape($con = "",$str=""){
	global $db_connect;
	$string=mysqli_real_escape_string($db_connect,$str);
	return $string;
}