<?php
require '../config/config.php';

if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    
    $query = "SELECT * FROM `admin` WHERE adm_id = '" . $id . "'";
    $result = mysqli_query($db, $query);
    $data = mysqli_fetch_assoc($result);
    $data['phone'] = substr_replace($data['phone'], "",0, 4);

    $res=[
        'status'=>200,
        'data'=>$data
    ];
    echo json_encode($res);
    return;
}

?>