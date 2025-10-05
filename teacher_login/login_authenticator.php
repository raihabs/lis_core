<?php
include '../config/config.php'; 
session_start();

function message()
{
	$response['success'] = "200";
	$response['title'] = 'Welcome!';
	$response['message'] = 'Login Succesfully!';

	echo json_encode($response);
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$response = array(
	'success' => "400",
	'message' => 'Unknown Error',
	'title' => ''
);

$query = "SELECT * FROM `user_list` WHERE ( `username` = '".$username."' OR  `email` = '".$username."') AND `password` = '".md5($password)."'";
$query_run = mysqli_query($db, $query);
if (mysqli_num_rows($query_run) > 0) {
	$row = mysqli_fetch_assoc($query_run);
    

    $_SESSION["tch_id"] = $row['tch_id'];
    $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
	message();
	
} 
elseif($username == "" || $password == ""){
    $res = [
		'success' => 400,
		'title' => "Try again!",
		'message' => "Fields are Required."
	];

	echo json_encode($res);
	return;
} 
else{

	$res = [
		'success' => 400,
		'title' => "SOMETHING WENT WRONG!",
		'message' => "Invalid Username or Password."
	];

	echo json_encode($res);
	return;

}