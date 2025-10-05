<?php
require 'config/config.php';
if(isset($_POST['checkbox1'][0])){
	foreach($_POST['checkbox1'] as $list1){
		$id1=mysqli_real_escape_string($db,$list1);
		$_SESSION['id1'] = $id1;
		$_SESSION['id2'] = $list1;
		// $query1 = mysqli_query($db,"SELECT * from cart where crt_id='$id1'");
		// $res1 = mysqli_fetch_array($query1);
		// echo $res1['dishes_name'];
	}
}

if(isset($_POST['checkbox2'][0])){
	foreach($_POST['checkbox2'] as $list2){
		$id2=mysqli_real_escape_string($db,$list2);
		// $query2 = mysqli_query($db,"SELECT * from cart where crt_id='$id2'");
		// $res2 = mysqli_fetch_array($query2);
		// echo $res2['dishes_name'];
	}
}


if(isset($_POST['checkbox3'][0])){
	foreach($_POST['checkbox3'] as $list3){
		$id3=mysqli_real_escape_string($db,$list3);
		// $query3 = mysqli_query($db,"SELECT * from cart where crt_id='$id3'");
		// $res3 = mysqli_fetch_array($query3);
		// echo $res3['dishes_name'];

	}
}
?>