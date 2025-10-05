<?php
require '../config/config.php';
session_start();

// Validation for Add
if (isset($_POST['valid_section'])) {

    $grade = mysqli_real_escape_string($db, $_POST['grade']);
    $section = mysqli_real_escape_string($db, $_POST['section']);
    $location = mysqli_real_escape_string($db, $_POST['location']);
    
    $user_id = $_SESSION['adm_id'];
    $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
    $res_creator = mysqli_query($db, $sel_user);
    $show = mysqli_fetch_array($res_creator);
    $adm_id = $show['s_id'];

    $sel_grade = "SELECT * FROM `section` ORDER BY sc_id DESC";
    $res_grade = mysqli_query($db, $sel_grade);
    $fetch = mysqli_fetch_array($res_grade);

    $u = $fetch['g_id'] + 1;

    if ($grade == "" || $section == "" || $location == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' .$location,
        ];
        echo json_encode($res);
        return;
    } else {
       
            $query = "INSERT INTO `section` (`s_id`, `section`,`location`, `g_id`,`grade`, `date`) VALUE ('$adm_id', '$section', '$location', '$u', '$grade', NOW())";
            
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Section Added Successfully!',
                ];
                echo json_encode($res);
                return;
            }
       
    }
}




if (isset($_POST['update_section'])) {
    $id = $_POST['id'];
    $section = mysqli_real_escape_string($db, $_POST['section']);
    $location = mysqli_real_escape_string($db, $_POST['location']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");
    
   if ( $section == ""  || $location == ""){
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' ,
        ];
        echo json_encode($res);
        return;
    } else {
            $query = " UPDATE `section` 
            SET `section` = '" .$section. "',
            `location` = '" .$location. "',
            `date` = '" .$created_date . "' 
            WHERE `sc_id` = '" .$id . "' ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Section Updated Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        }
    }
?>
?>