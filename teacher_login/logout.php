<?php
session_start();
session_destroy();

$url = '../teacher_login/login.php';
header('Location: ' . $url);
?>