<?php


$user_id = $session_class->getValue('id');
if(isset($user_id)){
	$loginquery = "SELECT * FROM admin_list WHERE adm_id = " . escape($db_connect, $user_id);
	if ($result = mysqli_query($db_connect, $loginquery)) {
		if ($row = mysqli_fetch_array($result)) {
			if (!defined('USER_ROLE')) {
				define('USER_ROLE', $row['role']);
				define('USER_ID', $row['id']);
			}
		}
	}
}

//fallback
if(!defined('USER_ROLE')){
	define('USER_ROLE', '');
	define('USER_ID', '');
}