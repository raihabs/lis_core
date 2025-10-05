<?php
require '../config/config.php';

session_start();
if (isset($_POST['update_admin'])) {

    $id = $_POST['id'];
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middlename']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone1'] . $_POST['phone2']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $barangay = mysqli_real_escape_string($db, $_POST['barangay']);
    $street = mysqli_real_escape_string($db, $_POST['street']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");


    if ($firstname == "" || $middlename == "" || $surname == "" || $email == "" || $phone == "" || $city == "city" || $barangay == "barangay" || $street == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = " UPDATE `admin` 
        SET `firstname` = '" . $firstname . "',
        `middlename` = '" . $middlename . "',
        `surname` = '" . $surname . "',
        `email` = '" . $email . "',
        `phone` = '" . $phone . "', 
        `c_id` = '" . $city . "', 
        `b_id` = '" . $barangay . "', 
        `street` = '" . $street . "', 
        `date` = '" . $created_date . "' 
        WHERE `adm_id` = '" . $id . "'  ";
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

    $adm_id = $_POST['id'];
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $newpassword1 = mysqli_real_escape_string($db, $_POST['newpassword1']);
    $newpassword2 = mysqli_real_escape_string($db, $_POST['newpassword2']);
 
    
    $sql = mysqli_query($db,"SELECT * FROM `admin` WHERE `adm_id` = '$adm_id'");
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

            $query = " UPDATE `admin` 
            SET `password` = '" . md5($newpassword1) . "',
            `date` = '" . $created_date . "' 
            WHERE `adm_id` = '" . $adm_id . "'  ";
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

