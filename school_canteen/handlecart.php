<?php
session_start();
include("config/config.php");

if (isset($_POST['scope'])) {
    $scope = $_POST['scope'];
    switch ($scope) {
        case "add":
            $user_id = $_SESSION['user_id'];


            $prod_id = $_POST['prod_id'];
            $prod_qty = $_POST['prod_qty'];

            date_default_timezone_set('Asia/Manila');
            $created_date = date("Y-m-d H:i:s");

            $check_cart = "SELECT * FROM cart WHERE u_id = '" . $user_id . "' AND d_id = '" . $_POST['prod_id'] . "'";
            $check_cart_run = mysqli_query($db, $check_cart);
            $row = mysqli_fetch_array($check_cart_run);
            $qty =  $row['d_qty'];
            $res_qty = $prod_qty + $qty;
            $status = 'cart';
          
            $sel_prod = "SELECT * FROM `dishes` WHERE d_id = '" . $_POST['prod_id'] . "' ";
            $res_prod = mysqli_query($db, $sel_prod);
            $ftch = mysqli_fetch_array($res_prod);
            $d_id =  $ftch['d_id'];
            $s_id =  $ftch['s_id'];
            if (mysqli_num_rows($check_cart_run) > 0) {

                $update_query = " UPDATE `cart`
                SET `s_id` = '" . $s_id . "',
                `d_id` =  '" .  $d_id . "',
                `d_qty` =  '" . $res_qty . "',
                `status` =  '" . $status . "',
                `created_at` = '" . $created_date . "' 
                WHERE u_id = '$user_id' AND d_id = '" . $_POST['prod_id'] . "'";

                $query_run = mysqli_query($db, $update_query);
                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'Item Addedd Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            } else {

                $insert_query = "INSERT INTO `cart`(`u_id`, `s_id`,`d_id`,`d_qty`,`created_at`) VALUES('$user_id', '" . $s_id . "',  '" .  $d_id . "', '$prod_qty', NOW())";
                $query_run = mysqli_query($db, $insert_query);
                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'Item Addedd Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
    }
}
