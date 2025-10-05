<?php
require '../config/config.php';

session_start();
// Validation for Add
if (isset($_POST['valid_student'])) {

    $grade = mysqli_real_escape_string($db, "grade ". $_POST['grade']);

    $section = $_POST['section'];
    $sel_section = "SELECT * FROM `section` WHERE sc_id = '" . $section . "'";
    $res_section = mysqli_query($db, $sel_section);
    $show1 = mysqli_fetch_array($res_section);
    $sc = $show1['section'];
    $location = $show1['location'];

    $username = mysqli_real_escape_string($db, $sc . "-" .  $_POST['lrn']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);


    $user_id = $_SESSION['adm_id'];
    $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
    $res_creator = mysqli_query($db, $sel_user);
    $show2 = mysqli_fetch_array($res_creator);
    $schl_id = $show2['s_id'];

    
    if ($username == "" || $firstname == "" || $lastname == "" ) {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' .$show1['section'],
        ];
        echo json_encode($res);
        return;
    } else {
      
        $query = "INSERT INTO `username` (`s_id`, `username`,`firstname`,`lastname`, `location`,`user_type`, `date`) VALUE ('$schl_id', '$username','$firstname','$lastname','$location', '$grade',  NOW())";
        // $query = "UPDATE pdf_file SET description='" . mysqli_real_escape_string($db,$description) . "', file_names='" . mysqli_real_escape_string($db,$upload_name) . "', created_date = '" . $created_date . "' WHERE id = '" . $id . "'";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'User Added Successfully!',
                ];
                echo json_encode($res);
                return;
            }
       
    }
}



if (isset($_POST['update_student'])) {

    $id = $_POST['id'];
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone1'] . $_POST['phone2']);
    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");


    if ($firstname == "" || $lastname == "" ||  $email == "" ||  $phone == "" ) {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 400,
            'msg' => 'Invalid email address please type a valid email!',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = " UPDATE `users` 
        SET `firstname` = '" . $firstname . "',
        `lastname` = '" . $lastname . "',
        `email` = '" . $email . "',
        `phone` = '" . $phone . "',
        `date` = '" . $created_date . "' 
        WHERE `u_id` = '" . $id . "'  ";
        $query_run = mysqli_query($db, $query);
        if ($query_run) {
            $res = [
                'status' => 200,
                'msg' => 'User Updated Successfully!',
            ];
            echo json_encode($res);
            return;
        }
    }
}



if (isset($_POST['valid_teacher'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $location = mysqli_real_escape_string($db, $_POST['location']);


    $user_id = $_SESSION['adm_id'];
    $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
    $res_creator = mysqli_query($db, $sel_user);
    $show2 = mysqli_fetch_array($res_creator);
    $schl_id = $show2['s_id'];
    $usertype = 'teacher';

    
    if ($username == "" ) {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
      
            $query = "INSERT INTO `username` (`s_id`, `username`,`firstname`,`lastname`, `user_type`, `location`, `date`) VALUE ('$schl_id', '$username','$firstname','$lastname', '$usertype','$location',  NOW())";
            // $query = "UPDATE pdf_file SET description='" . mysqli_real_escape_string($db,$description) . "', file_names='" . mysqli_real_escape_string($db,$upload_name) . "', created_date = '" . $created_date . "' WHERE id = '" . $id . "'";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'User Added Successfully!',
                ];
                echo json_encode($res);
                return;
            }
       
    }
}
