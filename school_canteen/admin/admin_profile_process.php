<?php
require '../config/config.php';

if (isset($_POST['update_profile'])) {
    $id = $_POST['id'];
    $upload_name = $_FILES['upload']['name'];
    $upload_size = $_FILES['upload']['size'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($upload_name == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.'.$upload_name,
        ];
        echo json_encode($res);
        return;
    } else {
        $upload_ex = pathinfo($upload_name, PATHINFO_EXTENSION);
        $upload_ex_lc = strtolower($upload_ex);
        $allowed_exs = array("jpeg", "jpg", "png");

        if (in_array($upload_ex_lc, $allowed_exs)) {
            $new_upload_name = $upload_ex_lc;
            $upload_path = "../images/profile/" .  $upload_name;
            move_uploaded_file($tmp_name, $upload_path);

            $query = " UPDATE `admin` 
            SET `image` = '" . $upload_name. "', 
            `date` = '" . $created_date . "' 
            WHERE `adm_id` = '" . $id . "'  ";
            $query_run = mysqli_query($db, $query);
            if ($query_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Profile Updated Successfully!',
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