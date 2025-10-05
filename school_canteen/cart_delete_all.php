<?php
require 'config/config.php';
if(isset($_POST['checkbox1'][0])){
	foreach($_POST['checkbox1'] as $list1){
		$id1=mysqli_real_escape_string($db,$list1);
		
		mysqli_query($db,"delete from cart where crt_id='$id1'");
	}
}

if(isset($_POST['checkbox2'][0])){
	foreach($_POST['checkbox2'] as $list2){
		$id2=mysqli_real_escape_string($db,$list2);
		mysqli_query($db,"delete from cart where crt_id='$id2'");
	}
}


if(isset($_POST['checkbox3'][0])){
	foreach($_POST['checkbox3'] as $list3){
		$id3=mysqli_real_escape_string($db,$list3);
		mysqli_query($db,"delete from cart where crt_id='$id3'");
	}
}
?>