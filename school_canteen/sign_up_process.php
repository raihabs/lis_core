<?php

require 'config/config.php';
// Validation for Add
if (isset($_POST['valid_sign_up'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone1'] . $_POST['phone2']);

    $password = mysqli_real_escape_string($db, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($db, md5($_POST['cpassword']));

   
    $usn = mysqli_query($db, "SELECT `us_id` FROM `username` WHERE `username` = '" . $username . "' ");
    $usn1 = mysqli_query($db, "SELECT `u_id` FROM `users` WHERE `username` = '" . $username . "' ");

    $sel_user = "SELECT * FROM `username` WHERE username = '" . $username . "'";
    $res_user = mysqli_query($db, $sel_user);
    $show = mysqli_fetch_array($res_user);
    $s_id = $show['s_id'];
    $us_id = $show['username'];
    $location = $show['location'];
    $usertype = $show['user_type'];
    $mark = 'Owned';
 
    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($username == "" || $firstname == "" || $lastname == "" || $email == "" || $phone == "" || $password == "" || $cpassword == "") {
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
        if (mysqli_num_rows($usn) == 0) {
            $res = [
                'status' => 400,
                'msg' => 'Please Try Other Valid Username.',
            ];
            echo json_encode($res);
            return;
        }  elseif (mysqli_num_rows($usn1) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'Please Try Other Valid Username1.',
            ];
            echo json_encode($res);
            return;
        } else {

                $query = "INSERT INTO `users` (`s_id`,`username`,`firstname`,`lastname`,`email`,`phone`, `password`,  `location`,   `user_type`,   `date`) VALUE ('$s_id','$username','$firstname','$lastname', '$email', '$phone', '$password','$location','$usertype', NOW())";
                $query1 = " UPDATE `username` 
                SET `mark` = 'Owned'
                WHERE `username` = '" . $username . "'  ";

                $query_run = mysqli_query($db, $query);
                $query_run1 = mysqli_query($db, $query1);
                if ($query_run && $query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'User Account Successfully Submitted!',
                    ];
                    echo json_encode($res);
                    return;
                    // }
                }
            }
        }
    }
?>