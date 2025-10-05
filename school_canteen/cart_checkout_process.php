<?php
require 'config/config.php';

if (isset($_POST['valid_order'])) {
    $checked_array1 = $_POST['chck'];
    foreach ($_POST['prodname'] as $key => $value1) {
        if (in_array($_POST['prodname'][$key], $checked_array1)) {
            $prodname = $_POST['prodname'][$key];
            $prodid = $_POST['prodid'][$key];
            $prod_price = $_POST['prod_price'][$key];
            $prod_qty = $_POST['prod_qty'][$key];
            $code = $_POST['code'][$key];
            $s_id = $_POST['s_id'][$key];
            $school_name = $_POST['school_name'][$key];
            $school_address = $_POST['school_address'][$key];
            $school_phone = $_POST['school_phone'][$key];
            $u_id = $_POST['u_id'][$key];

            $firstname = $_POST['firstname'][$key];
            $lastname = $_POST['lastname'][$key];
            $email = $_POST['email'][$key];
            $phone = $_POST['phone'][$key];
            $stock = $_POST['stock'][$key];
            $time_arrival = $_POST['time_arrival'][$key];
            $day_arrival = $_POST['day_arrival'][$key];
            $status = $_POST['status'][$key];

            $cash = $_POST['cash'][$key];
            // $cash2 = $_POST['cash2'][$key];
            $change = $_POST['change'][$key];
            $ordered = $_POST['ordered'][$key];
            // $change2 = $_POST['change2'][$key];
            if ($prodname == "" || $prod_price == "" || $prod_qty == "" || $prodid == "") {
                $res = [
                    'status' => 400,
                    'msg' => 'Fields are Required.' . $prodname . "<br>",
                ];
                echo json_encode($res);
                return;
            }elseif ($cash > $ordered && 1 > $ordered) {
                $res = [
                    'status' => 400,
                    'msg' => 'Try Higher Amount',
                ];
                echo json_encode($res);
                return;
            } 
            else {
                $insertqry = "INSERT INTO `users_orders`(`order_code`,  `s_id`, `school_name`,`address`,`school_phone`, `u_id`,`firstname`,`lastname`,`email`,`phone`, `dishes_name`, `selling_price`, `d_id`,`d_qty`, `cash`,`change`,`day_arrival`,`time_arrival`,`status`) VALUES ('$code','$s_id','$school_name','$school_address','$school_phone','$u_id','$firstname','$lastname','$email','$phone','$prodname','$prod_price','$prodid','$prod_qty', '$cash','$change','$day_arrival','$time_arrival','$status')";
                $insertqry = mysqli_query($db, $insertqry);

                $query = "DELETE FROM `cart` WHERE `d_id` = '" . $prodid . "' AND `u_id` = '" . $u_id . "' ";
                $result = mysqli_query($db, $query);

                $insertqry_code = "INSERT INTO `order_code`(`order_code`,`date`)VALUES('$code',NOW())";
                $insertqry_code = mysqli_query($db, $insertqry_code);

                $querystock = " UPDATE `dishes` 
                SET `stock` = '" . $stock . "'
                WHERE `d_id` = '" . $prodid . "'  ";
                $query_res = mysqli_query($db, $querystock);
            }
        }
    }


    if ($insertqry && $result && $insertqry_code && $query_res) {
        $res = [
            'status' => 200,
            'msg' => 'Item Check Out Successfully!',
        ];
        echo json_encode($res);
        return;
    }
}
