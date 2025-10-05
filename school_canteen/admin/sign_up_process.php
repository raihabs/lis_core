<?php
require '../config/config.php';

// Validation for Add
if (isset($_POST['valid_sign_up'])) {

    $user = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, md5($_POST['pass']));
    $cpass = mysqli_real_escape_string($db, md5($_POST['cpass']));
    $codes = mysqli_real_escape_string($db, $_POST['code']);


    // $sql_sid = "SELECT * FROM `admin_codes` WHERE `username` = $user";
    // $rs = mysqli_query($db, $sql_sid);
    // $rw = mysqli_fetch_array($rs);
    // $s_id = $rw['s_id'];

    //username from admin
    $sql_user = "SELECT `username` FROM `admin` WHERE `username` = '" . $user . "'";
    $res_user = mysqli_query($db, $sql_user);

    //email from admin
    $sql_email = "SELECT `email` FROM `admin` WHERE `email` = '" . $email . "'";
    $res_email = mysqli_query($db, $sql_email);

    //codes from admin
    $sql_codes1 = "SELECT `codes` FROM `admin` WHERE `codes` = '" . $codes . "'";
    $res_codes1 = mysqli_query($db, $sql_codes1);
    
    // $un = mysqli_query($db,"SELECT `username` FROM `admin_codes` WHERE `codes` = '" . $codes . "'");
    
    //codes from admin
    $cd = mysqli_query($db,"SELECT `cd_id` FROM `admin_codes` WHERE `codes` = '" . $codes . "' ");
    
    $sel_code = "SELECT * FROM `admin_codes` WHERE codes = '" . $codes . "'";
    $res_code = mysqli_query($db, $sel_code);
    $show = mysqli_fetch_array($res_code);
    
    // $cd = mysqli_fetch_array($res_codes2);
    // //username from admin_codes
    // $sql_user2 = "SELECT `username` FROM `admin_codes` WHERE `username` = '" . $_POST['username'] . "'";
    // $res_user2 = mysqli_query($db, $sql_user2);


    

    if ($user == "" || $email == "" || $pass == "" || $cpass == "" || $codes == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } elseif ($pass != $cpass) {
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
            if(mysqli_num_rows($cd) == 0) {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Try Other Valid Code.',
                ];
                echo json_encode($res);
                return;
            } elseif ( $show['username'] != $user) {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Try Other Valid Username.',
                ];
                echo json_encode($res);
                return;
            }  else {

                $query = "INSERT INTO `admin` (`username`,  `email`, `user_role`, `password`,`s_id`,`codes`, `date`) VALUE ('$user', '$email',  '". $show['user_role'] ."', '$pass', '". $show['s_id'] ."', '$codes',NOW())";

                $query_run = mysqli_query($db, $query);
                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'School Canteen Successfully Submitted!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}
// INSERT INTO `admin_codes` (`cd_id`, `codes`, `username`, `user_role`, `s_id`, `date`) VALUES (1, 'QWERTYUI', '2023-00001', 'super-admin', '1', '');