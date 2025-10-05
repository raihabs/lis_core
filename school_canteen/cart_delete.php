<?php
require 'config/config.php';

$id = $_POST['del_id'];
$query = "DELETE FROM `cart` WHERE `crt_id` = '" . $id . "'";
$result = mysqli_query($db, $query);

if ($result == true) {
    $res = [
        'status' => 200,
        'msg' => 'Item has been deleted. ',
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