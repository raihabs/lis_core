<?php
require '../config/config.php';


if (isset($_POST['update_info'])) {
    $id = $_POST['id'];
    $school_name = mysqli_real_escape_string($db, $_POST['schl_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone1 = mysqli_real_escape_string($db, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($db, $_POST['phone2']);
    $phone = $phone1 . $phone2;
    $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
    $url = mysqli_real_escape_string($db, $_POST['url']);
    $o_hr = mysqli_real_escape_string($db, $_POST['o_hr']);
    $c_hr = mysqli_real_escape_string($db, $_POST['c_hr']);
    $o_days = mysqli_real_escape_string($db, $_POST['o_days']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $about_us = mysqli_real_escape_string($db, $_POST['about_us']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");
    
   if ( $school_name == "" || $email == "" || $phone2 == "" ||  $telephone == "" || $url == "" || $o_hr == "" || $c_hr == "" || $o_days == "" || $address == "" || $about_us == ""){
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
            $query = " UPDATE `canteen` 
            SET `school_name` = '" .$school_name. "',
            `email` = '" .$email. "',
            `phone` = '" . $phone. "',
            `telephone` = '" .$telephone. "', 
            `url` = '" .$url. "',
            `o_hr` = '" .$o_hr. "',
            `c_hr` = '" . $c_hr. "', 
            `o_days` = '" . $o_days. "', 
            `address` = '" .$address. "', 
            `about_us` = '" .$about_us. "', 
            `date` = '" .$created_date . "' 
            WHERE `s_id` = '" .$id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'School Information Updated Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        }
    }
?>