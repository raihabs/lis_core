<?php
require '../config/config.php';

// Validation for Add
if (isset($_POST['valid_category'])) {
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    $c_name = mysqli_real_escape_string($db, $_POST['category_name']);

    //schoolname must unique
    $sql = "SELECT `c_name` FROM `category` WHERE `c_name` = '" . $c_name . "'";
    $result = mysqli_query($db, $sql);
    // filenames
    $sql1 = "SELECT `c_image` FROM `category` WHERE `c_image` = '" .  $upload_name . "'";
    $result1 = mysqli_query($db, $sql1);

    if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The School Category already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif (mysqli_num_rows($result1) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The uploaded image already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif ($upload_name == "" || $c_name == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");

        if (in_array($upload_ex_lc, $allowed_exs)) {
            // "upload-" . date("Y.m.d") . " - " . date("h.i.sa.") . 
            $new_upload_name = $upload_ex_lc;
            $upload_path = "../images/category/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);
            $query = "INSERT INTO `category` (`c_name`, `c_image`, `date`) VALUE ('$c_name', '$upload_name',NOW())";
            // $query = "UPDATE pdf_file SET description='" . mysqli_real_escape_string($db,$description) . "', file_names='" . mysqli_real_escape_string($db,$upload_name) . "', created_date = '" . $created_date . "' WHERE id = '" . $id . "'";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Category Added Successfully!',
                ];
                echo json_encode($res);
                return;
            }
        } else if (!in_array($upload_ex_lc, $allowed_exs)) {
            $res = [
                'status' => 500,
                'msg' => "You can't upload files of this type."
            ];
            echo json_encode($res);

            return;
        }
    }
}


if (isset($_POST['update_category'])) {

    $c_id = $_POST['id'];
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    $c_name = mysqli_real_escape_string($db, $_POST['c_name']);

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    
    // filenames
    $sql1 = "SELECT `c_image` FROM `category` WHERE `c_image` = '" .  $upload_name . "'";
    $result1 = mysqli_query($db, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The uploaded image already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif ($upload_name == "" || $c_name == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.',
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");


        if (in_array($upload_ex_lc, $allowed_exs)) {
            // "upload-" . date("Y.m.d") . " - " . date("h.i.sa.") . 
            $new_upload_name = $upload_ex_lc;
            $upload_path = "../images/category/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = " UPDATE `category` 
            SET `c_name` = '" .$c_name. "',
            `c_image` = '" . $upload_name. "', 
            `date` = '" . $created_date . "' 
            WHERE `c_id` = '" . $c_id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'School Category Updated Successfully!',
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
?>