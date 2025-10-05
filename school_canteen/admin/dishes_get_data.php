<?php
require '../config/config.php';

if(isset($_GET['edit_id'])){
    $d_id = $_GET['edit_id'];
    $query = "SELECT * FROM dishes WHERE d_id = '" . $d_id . "'";
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