<?php
require '../config/config.php';

// Validation for Add
// if (isset($_POST['valid_announcement'])) {
//     $upload_name = $_FILES['upload']['name'];
//     $upload_size = $_FILES['upload']['size'];
//     $tmp_name = $_FILES['upload']['tmp_name'];
//     $error = $_FILES['upload']['error'];

//     $title = mysqli_real_escape_string($db, $_POST['title']);
//     $description = mysqli_real_escape_string($db, $_POST['description']);


//     // filenames
//     $sql = "SELECT `i_image` FROM `info_slide` WHERE `i_image` = '" .  $upload_name . "'";
//     $result = mysqli_query($db, $sql);

//   if (mysqli_num_rows($result) > 0) {
//         $res = [
//             'status' => 400,
//             'msg' => 'The uploaded image already exist.',
//         ];
//         echo json_encode($res);
//         return;
//     } elseif ($title == "" || $description == "" || $upload_name == "") {
//         $res = [
//             'status' => 400,
//             'msg' => 'Fields are Required.',
//         ];
//         echo json_encode($res);
//         return;
//     } else {
//         $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
//         $upload_ex_lc = strtolower($upload_ex);
//         $allowed_exs = array("jpeg", "jpg", "png");

//         if (in_array($upload_ex_lc, $allowed_exs)) {
//             $new_upload_name = $upload_ex_lc;
//             $upload_path = "../images/announcement/" .  $upload_name;
//             move_uploaded_file($tmp_name, $upload_path);
//             $query = "INSERT INTO `info_slide` (`i_name`, `i_description`, `i_image`, `date`) VALUE ('$title', '$description', '$upload_name',NOW())";
            
//             $query_run = mysqli_query($db, $query);
//             if ($query_run) {
//                 $res = [
//                     'status' => 200,
//                     'msg' => 'Category Added Successfully!',
//                 ];
//                 echo json_encode($res);
//                 return;
//             }
//         } else if (!in_array($upload_ex_lc, $allowed_exs)) {
//             $res = [
//                 'status' => 500,
//                 'msg' => "You can't upload files of this type."
//             ];
//             echo json_encode($res);

//             return;
//         }
//     }
// }


if (isset($_POST['update_announcement'])) {

    $i_id = $_POST['id'];
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

  

    // filenames
    $sql = "SELECT `i_image` FROM `info_slide` WHERE `i_image` = '" .  $upload_name . "'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $res = [
            'status' => 400,
            'msg' => 'The uploaded image already exist.',
        ];
        echo json_encode($res);
        return;
    } elseif ($title == "" || $description == "" || $upload_name == "") {
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
            $upload_path = "../images/announcement/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = " UPDATE `info_slide` 
            SET `i_name` = '" . $title. "',
            `i_description` = '" . $description. "', 
            `i_image` = '" . $upload_name. "', 
            `date` = '" . $created_date . "' 
            WHERE `i_id` = '" . $i_id . "'  ";
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