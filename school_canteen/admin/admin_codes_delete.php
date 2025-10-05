<?php
require '../config/config.php';

$id = $_POST['del_id'];

$sel_user = "SELECT * FROM `admin_codes` WHERE `cd_id` = '" . $id . "'";
$res_user = mysqli_query($db, $sel_user);
$show = mysqli_fetch_array($res_user);
$us = $show['username'];

$query2 = "DELETE FROM `admin` WHERE `username` = '" . $us . "'";
$query1 = "DELETE FROM `admin_codes` WHERE `cd_id` = '" . $id . "'";
$result1 = mysqli_query($db, $query1);


$result2 = mysqli_query($db, $query2);

if ($result1 && $result2) {
    $res = [
        'status' => 200,
        'msg' => 'The Generated Code has been Deleted.',
    ];
    echo json_encode($res);
    return;
} else {
    $res = [
        'status' => 400,
        'msg' => 'The Deleted files has Error Occured.',
    ];
    echo json_encode($res);
    return;
}
?>