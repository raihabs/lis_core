<?php
include 'config/config.php';

if (isset($_POST['valid_info'])) {
	$checked_array = $_POST['prodid'];
	foreach ($_POST['prodname'] as $key => $value) {
		if (in_array($_POST['prodname'][$key], $checked_array)) {
			$order_id = $_POST['order_id'][$key];
			$order_date = $_POST['order_date'][$key];
			$status = $_POST['status'][$key];
			$admin = $_POST['admin'][$key];

			if ($order_id == "" || $status == "" || $order_date == "") {
				$res = [
					'status' => 400,
					'msg' => 'Fields are Required.',
				];
				echo json_encode($res);
				return;
			} else{
				$insertqry = " UPDATE `users_orders` 
                SET  `status` = '" . $status . "'
                WHERE `o_id` = '" . $order_id . "'  ";
                $query_res = mysqli_query($db, $insertqry);
		}
	}
}
if ($query_res) {
	$res = [
		'status' => 200,
		'msg' => 'Order Successfully Change!',
	];
	echo json_encode($res);
	return;
}
header('Location: index.php');
}
// <?php
// include 'database.php';

// if (isset($_POST['valid_info'])) {
// 	$checked_array = $_POST['prodid'];
// 	foreach ($_POST['prodname'] as $key => $value) {
// 		if (in_array($_POST['prodname'][$key], $checked_array)) {
// 			$prodname = $_POST['prodname'][$key];
// 			$prod_price = $_POST['prod_price'][$key];
// 			$prod_qty = $_POST['prod_qty'][$key];

// 			if ($prodname == "" || $prod_price == "" || $prod_qty == "") {
// 				$res = [
// 					'status' => 400,
// 					'msg' => 'Fields are Required.',
// 				];
// 				echo json_encode($res);
// 				return;
// 			} else{
// 			$insertqry = "INSERT INTO `product`( `product_name`, `product_price`, `product_quantity`) VALUES ('$prodname','$prod_price','$prod_qty')";
// 			$insertqry = mysqli_query($con, $insertqry);}
// 		}
// 	}
// }
// if ($insertqry) {
// 	$res = [
// 		'status' => 200,
// 		'msg' => 'Admin Account Successfully Submitted!',
// 	];
// 	echo json_encode($res);
// 	return;
// }
// header('Location: index.php');
