<?php
include '../config/config.php';
require CL_SESSION_PATH;
include CONNECT_PATH;

$detect_device = $_SERVER['HTTP_USER_AGENT'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require DOMAIN_PATH . '/admin_login/PHPMailer/Exception.php';
require DOMAIN_PATH . '/admin_login/PHPMailer/PHPMailer.php';
require DOMAIN_PATH . '/admin_login/PHPMailer/SMTP.php';

if (isset($_POST['check-email'])) {
    $email = $_POST['email'];
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        // $info = mysqli_fetch_assoc($run_sql);
        // $name = $info['name'];
        // $username = $info['username'];
        $code = rand(999999, 111111);
        $now = time();
        $time = time() + (30 * 60);
        $insert_code = "UPDATE users SET code='$code', time='$time' WHERE email='$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        if ($run_query) {
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $system_info['system_email'];
            $mail->Password = $system_info['password'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom($system_info['system_email'], 'CBISWebsite');
            $mail->addReplyTo('donotreply@gmail.com', 'DONOTREPLY');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $email_name = strtok($name, " ");
            $email_code = $code;
            $email_device = $detect_device;
            $email_username = $username;

            $email_template = BASE_URL . 'template_mail/reset_password.html';
            $message = file_get_contents($email_template);
            $message = str_replace('%email_logo%', $email_logo, $message);
            $message = str_replace('%email_footer%', $email_footer, $message);
            $message = str_replace('%email_name%', $email_name, $message);
            $message = str_replace('%email_username%', $email_username, $message);
            $message = str_replace('%email_code%', $email_code, $message);
            $message = str_replace('%email_device%', $email_device, $message);

            $mail->Subject = 'Password Reset Code';
            $mail->MsgHTML($message);
            if ($mail->send()) {
         
                header('location: ' . BASE_URL . 'verification-code.php');
                exit();
            } else {

                header('location: ' . BASE_URL . 'login.php');
                exit();
            }
        } else {
          
            header('location: ' . BASE_URL . 'login.php');
            exit();
        }
    } else {
       
        header('location: ' . BASE_URL . 'login.php');
        exit();
    }
}

