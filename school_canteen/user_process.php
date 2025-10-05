<?php
require 'config/config.php';

if (isset($_POST['update_profile'])) {
    $id = $_POST['id'];
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($upload_name == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.'.$upload_name,
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");

        if (in_array($upload_ex_lc, $allowed_exs)) {
            $new_upload_name = $upload_ex_lc;
            $upload_path = "images/user_profile/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = " UPDATE `users` 
            SET `image` = '" . $upload_name. "', 
            `date` = '" . $created_date . "' 
            WHERE `u_id` = '" . $id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Profile Updated Successfully!',
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


if (isset($_POST['update_user'])) {

    $id = $_POST['id'];
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone1'] . $_POST['phone2']);
    $location = mysqli_real_escape_string($db, $_POST['location']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");


    if ($firstname == "" || $lastname == "" || $email == "" || $phone == "" || $location == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = " UPDATE `users` 
        SET `firstname` = '" . $firstname . "',
        `lastname` = '" . $lastname . "',
        `email` = '" . $email . "',
        `phone` = '" . $phone . "', 
        `location` = '" . $location . "', 
        `date` = '" . $created_date . "' 
        WHERE `u_id` = '" . $id . "'  ";
        $query_run = mysqli_query($db, $query);
        if ($query_run) {
            $res = [
                'status' => 200,
                'msg' => 'School Admin Updated Successfully!',
            ];
            echo json_encode($res);
            return;
        }
    }
}



if (isset($_POST['update_password'])) {

    $id = $_POST['id'];
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $newpassword1 = mysqli_real_escape_string($db, $_POST['newpassword1']);
    $newpassword2 = mysqli_real_escape_string($db, $_POST['newpassword2']);
 
    
    $sql = mysqli_query($db,"SELECT * FROM `users` WHERE `u_id` = '$id'");
    $row = mysqli_fetch_array($sql);
    $pass = $row['password'];

    
    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($password == "" || $newpassword1 == "" || $newpassword2 == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.'.$row['password'].'  '.md5($password),
        ];
        echo json_encode($res);
        return;
    } else {
        
        if (md5($password) != $pass) {
            $res = [
                'status' => 400,
                'msg' => 'Invalid Current Password Please Try Again.',
            ];
            echo json_encode($res);
            return;
        } elseif ($newpassword1 != $newpassword2) {
            $res = [
                'status' => 400,
                'msg' => 'New Passwords Are Not Match.',
            ];
            echo json_encode($res);
            return;
        } else {

            $query = " UPDATE `users` 
            SET `password` = '" . md5($newpassword1) . "',
            `date` = '" . $created_date . "' 
            WHERE `u_id` = '" . $id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Password Updated Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        }
    }
}


?>