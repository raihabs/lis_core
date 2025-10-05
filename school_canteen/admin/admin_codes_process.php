<?php
require '../config/config.php';
session_start();

// Validation for Add
if (isset($_POST['valid_code'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $codes = mysqli_real_escape_string($db, $_POST['codes']);


    $user_id = $_SESSION['adm_id'];
    $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
    $res_creator = mysqli_query($db, $sel_user);
    $show = mysqli_fetch_array($res_creator);
    $s_id = $show['s_id'];

    $user_role = 'admin';
    //schoolname must unique
    $user_sql = "SELECT `username` FROM `admin_codes` WHERE `username` = '" . $username . "'";
    $result = mysqli_query($db, $user_sql);
    // filenames
    $code_sql = "SELECT `codes` FROM `admin_codes` WHERE `codes` = '" . $codes . "'";
    $result1 = mysqli_query($db, $code_sql);

    if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The Username already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif (mysqli_num_rows($result1) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The Generated Code already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif ($codes == "" || $s_id == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
       

       
           
            $query = "INSERT INTO `admin_codes` ( `codes`, `username`, `user_role`,`s_id`, `date`) VALUE ('$codes', '$username', '$user_role', '$s_id', NOW())";
            // $query = "UPDATE pdf_file SET description='" . mysqli_real_escape_string($db,$description) . "', file_names='" . mysqli_real_escape_string($db,$upload_name) . "', created_date = '" . $created_date . "' WHERE id = '" . $id . "'";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Generated Code Added Successfully!',
                ];
                echo json_encode($res);
                return;
            }
       
    }
}
?>