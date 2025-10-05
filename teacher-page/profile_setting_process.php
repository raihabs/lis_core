<?php
include '../config/config.php';


if (isset($_POST['update_password'])) {

    $tch_id = $_POST['id'];
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $newpassword1 = mysqli_real_escape_string($db, $_POST['newpassword1']);
    $newpassword2 = mysqli_real_escape_string($db, $_POST['newpassword2']);


    $sql = mysqli_query($db, "SELECT * FROM `user_list` WHERE `tch_id` = '$tch_id'");
    $row = mysqli_fetch_array($sql);
    $pass = $row['password'];


    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($password == "" || $newpassword1 == "" || $newpassword2 == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
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

            $query = " UPDATE `user_list` 
            SET `password` = '" . md5($newpassword1) . "',
            `date_created` = '" . $created_date . "' 
            WHERE `tch_id` = '" . $tch_id . "'  ";
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


if (isset($_POST['update_account'])) {

    $id = $_POST['id'];

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone1 = mysqli_real_escape_string($db, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($db, $_POST['phone2']);
    $phone =  $phone1 . $phone2;

    $city = mysqli_real_escape_string($db, $_POST['city']);
    $barangay = mysqli_real_escape_string($db, $_POST['barangay']);
    $street = mysqli_real_escape_string($db, $_POST['street']);

    $query_admin = "SELECT * FROM `user_list` 
    WHERE  `firstname` = '" . $firstname . "' AND `middle_name` = '" . $middlename . "'  AND `lastname` = '" . $lastname . "' AND `email` = '" . $email . "' AND `phone` = '" . $phone . "' AND `city` = '" . $city . "' AND `barangay` = '" . $barangay . "' AND `street` = '" . $street . "'   ";
    $result = mysqli_query($db, $query_admin);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");


    if ($firstname == "" || $middlename == "" || $lastname == "" || $email == "" || $phone2 == "" || $street == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else  if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'There has no changes in your data field.',
        ];
        echo json_encode($res);
        return;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 400,
            'msg' => 'Invalid email address please type a valid email!',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = " UPDATE `user_list` 
        SET `firstname` = '" . $firstname . "',
        `middle_name` = '" . $middlename . "',
        `lastname` = '" . $lastname . "',
        `email` = '" . $email . "',
        `phone` = '" . $phone . "', 
        `city` = '" . $city . "', 
        `barangay` = '" . $barangay . "', 
        `street` = '" . $street . "', 
        `date_created` = '" . $created_date . "' 
        WHERE `tch_id` = '" . $id . "'  ";
        $query_run = mysqli_query($db, $query);
        if ($query_run) {
            $res = [
                'status' => 200,
                'msg' => 'Your Information Updated Successfully!',
            ];
            echo json_encode($res);
            return;
        }
    }
}

// SCHOOL PROFILE


if (isset($_POST['update_school'])) {

    $id = $_POST['id'];
    $school_name = mysqli_real_escape_string($db, $_POST['school_name']);
    $school_year1 = mysqli_real_escape_string($db, $_POST['school_year1']);
    $school_year2 = mysqli_real_escape_string($db, $_POST['school_year2']);
    $school_quarter = mysqli_real_escape_string($db, $_POST['school_quarter']);
    
    $school_query = "SELECT * FROM `school_information`";
    $school_result = mysqli_query($db, $school_query);
    $school = mysqli_fetch_array($school_result);

    $right_side = substr_replace($school['school_year'], "", 0, 5);
    $school_year = chop($school['school_year'], $right_side);
    $rt_side = substr_replace($school_year, "", 0, 4);
    $left_side = chop($school_year, $rt_side);


    $school_year_verify1 = $left_side + 1;
    $school_year_verify2 = $right_side + 1;

    if($school['school_quarter']==4){
        $school_quarter_verify =  $school['school_quarter']-3;
    } else{
        $school_quarter_verify = $school['school_quarter'] + 1;
    }
    

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    $school_year_result = $_POST['school_year1'] . "/" . $_POST['school_year2'];
    $query_admin = "SELECT * FROM `school_information` 
    WHERE  `school_name` = '" . $school_name . "' AND `school_year` = '" . $school_year_result . "'  AND `school_quarter` = '" . $school_quarter . "' ";
    $result = mysqli_query($db, $query_admin);


    if ($school_name == "" || $school_year1 == "" || $school_year2 == "" || $school_quarter == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' . $school_year_verify2,
        ];
        echo json_encode($res);
        return;
    } else  if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'There has no changes in your school profile.',
        ];
        echo json_encode($res);
        return;
    } else  if ($school_quarter == 1 && $school_year_verify1 != $school_year1) {
        $res = [
            'status' => 400,
            'msg' => 'There SCHOOL YEAR START is not Suit to DECLARED Next School Year.',
        ];
        echo json_encode($res);
        return;
    } else  if ($school_quarter == 1 && $school_year_verify2 != $school_year2) {
        $res = [
            'status' => 400,
            'msg' => 'There SCHOOL YEAR END is not Suit to DECLARED Next School Year.',
        ];
        echo json_encode($res);
        return;
    } else  if ($school_quarter_verify != $school_quarter) {
        $res = [
            'status' => 400,
            'msg' => 'The QUARTER is not Suit to DECLARED Next Quarter.',
        ];
        echo json_encode($res);
        return;
    } else {



        $query = " UPDATE `school_information` 
            SET `school_name` = '" . $school_name . "',
            `school_year` = '" . $school_year_result . "' ,
            `school_quarter` = '" . $school_quarter . "' ,
            `created_date` = '" . $created_date . "'
            WHERE `id` = '" . $id . "'  ";
        $query_run = mysqli_query($db, $query);
        if ($query_run) {
            $res = [
                'status' => 200,
                'msg' => 'School Profile Updates Successfully!',
            ];
            echo json_encode($res);
            return;
        }
    }
}




if (isset($_POST['update_school_info'])) {

    $id = $_POST['id'];

    $city = mysqli_real_escape_string($db, $_POST['city']);
    $barangay = mysqli_real_escape_string($db, $_POST['barangay']);
    $street = mysqli_real_escape_string($db, $_POST['street']);

    $phone1 = mysqli_real_escape_string($db, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($db, $_POST['phone2']);
    $phone =  $phone1 . $phone2;
    $telephone = mysqli_real_escape_string($db, $_POST['telephone']);

    $email = mysqli_real_escape_string($db, $_POST['email']);


    $query_admin = "SELECT * FROM `school_information` 
    WHERE  `city` = '" . $city . "' AND `barangay` = '" . $barangay . "'  AND `street` = '" . $street . "' AND `phone` = '" . $phone . "' AND `telephone` = '" . $telephone . "' AND `school_email` = '" . $email . "' ";
    $result = mysqli_query($db, $query_admin);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");


    if ($city == "" || $barangay == "" || $street == "" || $city == "" || $phone2 == "" || $telephone == "" || $email == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else  if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'There has no changes in your data field.',
        ];
        echo json_encode($res);
        return;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 400,
            'msg' => 'Invalid email address please type a valid email!',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = " UPDATE `school_information` 
        SET `city` = '" . $city . "',
        `barangay` = '" . $barangay . "',
        `street` = '" . $street . "',
        `phone` = '" . $phone . "',
        `telephone` = '" . $telephone . "', 
        `school_email` = '" . $email . "', 
        `created_date` = '" . $created_date . "' 
        WHERE `id` = '" . $id . "'  ";
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
