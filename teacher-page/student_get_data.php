<?php
require '../config/config.php';

if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $query = "SELECT * FROM student_list WHERE st_id = '" . $id . "'";
    $result = mysqli_query($db, $query);
    $data = mysqli_fetch_assoc($result);

    $res=[
        'status'=>200,
        'data'=>$data
    ];
    echo json_encode($res);
    return;
}

?>