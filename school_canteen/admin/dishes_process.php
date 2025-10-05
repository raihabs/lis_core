<?php
require '../config/config.php';

session_start();
// Validation for Add
if (isset($_POST['valid_menu'])) {

    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];
    
    $dishes_name = mysqli_real_escape_string($db, $_POST['dishes_name']);
    $small_description = mysqli_real_escape_string($db, $_POST['small_description']);
    $long_description = mysqli_real_escape_string($db, $_POST['long_description']);
    $price1 = mysqli_real_escape_string($db, $_POST['price1']);
    $price2 = mysqli_real_escape_string($db, $_POST['price2']);
    $stock = mysqli_real_escape_string($db, $_POST['stock']);
    // $status = '1';


    $c_id =  $_POST['category'];

    $sql = "SELECT * FROM `category` WHERE `c_id` = '" . $c_id. "'";
    $result = mysqli_query($db, $sql);
    $show1 = mysqli_fetch_array($result);
    $c_name = $show1['c_name'];

    $user_id = $_SESSION['adm_id'];
    $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
    $res_creator = mysqli_query($db, $sel_user);
    $show2 = mysqli_fetch_array($res_creator);
    $schl_id = $show2['s_id'];

    
    if ($upload_name == "" || $dishes_name == "" ||  $small_description == "" || $long_description == "" || $price2 == ""  || $c_id == "--Select your category--") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");

        if (in_array($upload_ex_lc, $allowed_exs)) {
            $new_upload_name = $upload_ex_lc;
            $upload_path = "../images/dishes/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = "INSERT INTO `dishes` (`s_id`, `c_id`,  `c_name`, `dishes_name`, `small_description`,`long_description`, `original_price`,`selling_price`, `stock`, `d_image`,  `date`) VALUE ('$schl_id', '$c_id','$c_name', '$dishes_name', '$small_description', '$long_description', '$price1', '$price2',  '$stock','$upload_name', NOW())";
            // $query = "UPDATE pdf_file SET description='" . mysqli_real_escape_string($db,$description) . "', file_names='" . mysqli_real_escape_string($db,$upload_name) . "', created_date = '" . $created_date . "' WHERE id = '" . $id . "'";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Menu Item Updated Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        } else if (!in_array($upload_ex_lc, $allowed_exs)) {
            $res = [
                'status' => 400,
                'msg' => "You can't upload files of this type."
            ];
            echo json_encode($res);

            return;
        }
    }
}

if (isset($_POST['update_menu'])) {

    $id = $_POST['id'];
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    
    $c_id =  $_POST['category'];

    $sql = "SELECT * FROM `category` WHERE `c_id` = '" . $c_id. "'";
    $result = mysqli_query($db, $sql);
    $show1 = mysqli_fetch_array($result);
    $c_name = $show1['c_name'];


    $dishes_name = mysqli_real_escape_string($db, $_POST['dishes_name']);
    $small_description = mysqli_real_escape_string($db, $_POST['small_description']);
    $long_description = mysqli_real_escape_string($db, $_POST['long_description']);
    $original_price =  mysqli_real_escape_string($db, $_POST['originalPrice']);
    $selling_price = mysqli_real_escape_string($db,  $_POST['sellingPrice']);
    
    // $status = mysqli_real_escape_string($db, $_POST['status']);
    $stock = mysqli_real_escape_string($db, $_POST['stock']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($dishes_name == "" || $small_description == "" || $long_description == ""  || $selling_price == ""  || $c_id == "--Select your category--" || $upload_name == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.'.$status,
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");


        if (in_array($upload_ex_lc, $allowed_exs)) {
            // "upload-" . date("Y.m.d") . " - " . date("h.i.sa.") . 
            $new_upload_name = $upload_ex_lc;
            $upload_path = "../images/dishes/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = " UPDATE `dishes` 
            SET `c_id` = '" . $c_id . "',
            `c_name` = '" . $c_name . "',
            `dishes_name` = '" . $dishes_name . "',
            `small_description` = '" . $small_description . "',
            `long_description` = '" . $long_description . "',
            `original_price` =  $original_price , 
            `selling_price` =  $selling_price , 
            `stock` = '" . $stock . "', 
            `d_image` = '" . $upload_name . "', 
            `date` = '" . $created_date . "' 
            WHERE `d_id` = '" . $id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Menu Item Updated Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        } else if (!in_array($upload_ex_lc, $allowed_exs)) {
            $res = [
                'status' => 400,
                'msg' => "You can't upload files of this type."
            ];
            echo json_encode($res);

            return;
        }
    }
}
