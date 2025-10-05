<?php 
require '../config/config.php'; 

$user_id = $_SESSION['adm_id'];

$sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $adm_id . "'";
$res_creator = mysqli_query($db, $sel_user);
$show = mysqli_fetch_array($res_creator);
$adm_id = $show['s_id'];

if (isset($_POST['grade'])) {
	$query = "SELECT * FROM `section` where `grade` = '".$_POST['grade']. "' AND `s_id` = '".$adm_id. "'  ";
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['sc_id'].'>'.$row['section'].'</option>';
		 }
	}else{
		echo '<option>No secttion Found!</option>';
	}

}


?>