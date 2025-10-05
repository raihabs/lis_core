<?php

require '../config/config.php';
// Validation for Add
if (isset($_POST['valid_sign_up'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone1'] . $_POST['phone2']);

    $password = mysqli_real_escape_string($db, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($db, md5($_POST['cpassword']));
    $codes = mysqli_real_escape_string($db, $_POST['code']);


    //username from admin
    $sql_user = "SELECT `username` FROM `admin` WHERE `username` = '" . $username . "'";
    $res_user = mysqli_query($db, $sql_user);

    //email from admin
    $sql_email = "SELECT `email` FROM `admin` WHERE `email` = '" . $email . "'";
    $res_email = mysqli_query($db, $sql_email);

    //codes from admin
    $sql_codes1 = "SELECT `codes` FROM `admin` WHERE `codes` = '" . $codes . "'";
    $res_codes1 = mysqli_query($db, $sql_codes1);

    //codes from admin
    $cd = mysqli_query($db, "SELECT `cd_id` FROM `admin_codes` WHERE `codes` = '" . $codes . "' ");

    $sel_code = "SELECT * FROM `admin_codes` WHERE codes = '" . $codes . "'";
    $res_code = mysqli_query($db, $sel_code);
    $show = mysqli_fetch_array($res_code);


    if ($username == "" || $firstname == "" || $lastname == "" || $email == "" || $phone == "" || $password == "" || $cpassword == "" || $codes == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } elseif ($password != $cpassword) {
        $res = [
            'status' => 400,
            'msg' => 'Password not match.',
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
        if (mysqli_num_rows($res_user) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'The User Name exist.',
            ];
            echo json_encode($res);
            return;
        } else if (mysqli_num_rows($res_email) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'The Email already exist.',
            ];
            echo json_encode($res);
            return;
        } else if (mysqli_num_rows($res_codes1) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'The Code already exist.',
            ];
            echo json_encode($res);
            return;
        } else {
            if (mysqli_num_rows($cd) == 0) {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Try Other Valid Code.',
                ];
                echo json_encode($res);
                return;
            } elseif ($show['username'] != $username) {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Try Other Valid Username.',
                ];
                echo json_encode($res);
                return;
            } else {
                $query = "INSERT INTO `admin` (`username`,`firstname`,`surname`,`email`,`phone`, `user_role`, `password`,`s_id`,`codes`, `date`) VALUE ('$username','$firstname','$lastname','$email', '$phone',  '" . $show['user_role'] . "', '$password', '" . $show['s_id'] . "', '$codes',NOW())";
                $query1 = " UPDATE `admin_codes` 
                SET `mark` = 'owned'
                WHERE `username` = '" . $username . "'  ";


                $query_run = mysqli_query($db, $query);
                $query_run1 = mysqli_query($db, $query1);
                if ($query_run && $query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'Admin Account Successfully Submitted!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}
