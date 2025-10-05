<?php 
require '../config/config.php';

if (isset($_POST['city_id'])) {
	$query = "SELECT * FROM `barangay` where `c_id`=".$_POST['city_id'];
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option value="">barangay</option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['b_id'].'>'.$row['b_name'].'</option>';
		 }
	}else{
		echo '<option>No barangay Found!</option>';
	}

}


?>