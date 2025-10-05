<?php
session_start();
session_destroy();

$url = '../admin/start.php';
header('Location: ' . $url);
?>