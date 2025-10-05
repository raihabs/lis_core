<?php
session_start();
require '../config/config1.php';
require CONNECT_PATH;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require DOMAIN_PATH . '/teacher_login/PHPMailer/Exception.php';
require DOMAIN_PATH . '/teacher_login/PHPMailer/PHPMailer.php';
require DOMAIN_PATH . '/teacher_login/PHPMailer/SMTP.php';

// echo "dfd";
if (isset($_POST['check-email'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    // echo $email;
    $check_email = "SELECT * FROM user_list WHERE email = '" . $email . "'";
    $run_sql = mysqli_query($db_connect, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $info = mysqli_fetch_assoc($run_sql);
        $name = $info['firstname'] . " " . $info['middle_name'] . " " . $info['lastname'];
        $username = $info['username'];
        $code = rand(999999, 111111);
        $now = time();
        $time = time() + (30 * 60);

        $insert_code = "UPDATE user_list SET code='" . $code . "', time='$time' WHERE email='" . $email . "'";
        $run_query =  mysqli_query($db_connect, $insert_code);
        if ($run_query) {
            $query = "SELECT code FROM user_list WHERE email = '" . $email . "'";
            $result = mysqli_query($db_connect, $query);
            $row = mysqli_fetch_assoc($result);
            $email_code = $row['code'];

            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "loocintegrated143@gmail.com";
            $mail->Password = "andiuxfknecgvzcm";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom("loocintegrated143@gmail.com", 'LIS Website');
            $mail->addReplyTo('donotreply@gmail.com', 'DONOTREPLY');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $code = rand(999999, 111111);
            $detect_device = $_SERVER['HTTP_USER_AGENT'];

            $query = "SELECT school_logo, school_name FROM school_information";
            $result = mysqli_query($db_connect, $query);
            $row = mysqli_fetch_assoc($result);
            $year = date("Y");
            $prev_year = $year - 1;
            $email_logo = '<img height="110" src="../images/school-logo/' . $row['school_logo'] . '" title="LISLogo" alt="LISLogo">';
            $email_footer = '© ' . $prev_year . '-' . $year . ' ' . $row['school_name'];
            $email_name = strtok($name, " ");
            $code = $email_code;
            $email_device = $detect_device;
            $email_username = $username;

            $email_template = BASE_URL . 'teacher_login/template_mail/reset_password.html';
            $message = file_get_contents($email_template);
            $message = str_replace('%email_logo%', $email_logo, $message);
            $message = str_replace('%email_footer%', $email_footer, $message);
            $message = str_replace('%email_name%', $email_name, $message);
            $message = str_replace('%email_username%', $email_username, $message);
            $message = str_replace('%email_code%', $code, $message);
            $message = str_replace('%email_device%', $email_device, $message);
            $mail->Subject = 'Password Reset Code';
            $mail->MsgHTML($message);
            if ($mail->send()) {
                // $info = "We've sent a password reset code to your email address - $email";
                // $_SESSION['info'] = $info;
                // $_SESSION['email'] = $email;
                // $_SESSION['msg_status'] = array("msg" => "Success", "icon" => "success");
                $info = "We've sent a new password reset code to your email address - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['verify_icon'] = "success";

                header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
                exit();
            } else {
                $_SESSION['forgot_pass'] = "Failed while sending password reset code". $email ;
                $_SESSION['forgot_icon'] = "error";
                header('location: ' . BASE_URL . 'teacher_login/reset-page.php');
                exit();
            }
        } else {
            $_SESSION['forgot_pass'] = "Something went wrong";
            $_SESSION['forgot_icon'] = "error";
            header('location: ' . BASE_URL . 'teacher_login/reset-page.php');
            exit();
        }
    } else {
        $_SESSION['forgot_pass'] = "Email address does not exist";
        $_SESSION['forgot_icon'] = "error";
        header('location: ' . BASE_URL . 'teacher_login/reset-page.php');
        exit();
    }
}

if (isset($_POST['check-code'])) {
    $email = $_POST['email'];
    $code = $_POST['code'];
    if (empty($code)) {
        $_SESSION['verify_status'] = "Please enter the password reset code";
        $_SESSION['verify_icon'] = "warning";
        header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
        exit();
    } elseif (!(is_numeric($code))) {
        $_SESSION['verify_status'] = "Invalid input";
        $_SESSION['verify_icon'] = "error";
        header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
        exit();
    } else {
        $check_code = "SELECT * FROM user_list WHERE email='" . $email . "' AND code='" . $code . "'";
        $run_sql = mysqli_query($db_connect, $check_code);
        if (mysqli_num_rows($run_sql) > 0) {
            while ($info = mysqli_fetch_assoc($run_sql)) {
                $time = $info['time'];
            }
            $expired = time();
            if ($expired > $time) {
                $_SESSION['verify_status'] = "Your password reset code has expired";
                $_SESSION['verify_icon'] = "warning";
                header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
                exit();
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['code'] = $code;
                header('location: ' . BASE_URL . 'teacher_login/reset-password.php');
                exit();
            }
        } else {
            $_SESSION['verify_status'] = "You've entered an invalid code";
            $_SESSION['verify_icon'] = "error";
            header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
            exit();
        }
    }
}

$resend_code = 0;
if (isset($_POST['resend-code'])) {
    $email = $_POST['email'];
    $resend_code = $_SESSION['resend_code_' . md5($email)]  >= 1 ? $_SESSION['resend_code_' . md5($email)]++ : $_SESSION['resend_code_' . md5($email)] = 1;
    if ($resend_code >= 3) {
        $_SESSION['verify_status'] = "Unable to resend new code. Please Contact System Admin.";
        $_SESSION['verify_icon'] = "error";
        header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
        exit();
    } else {
        $check_email = "SELECT * FROM user_list WHERE email='$email'";
        $run_sql = mysqli_query($db_connect, $check_email);
        $info = mysqli_fetch_assoc($run_sql);
        $name = $info['firstname'] . " " . $info['middle_name'] . " " . $info['surname'];
        $username = $info['username'];
        $code = rand(999999, 111111);
        $now = time();
        $time = time() + (30 * 60);
        $insert_code = "UPDATE user_list SET code='$code', time='$time' WHERE email='$email'";
        $run_query =  mysqli_query($db_connect, $insert_code);
        if ($run_query) {
            $query = "SELECT code FROM user_list WHERE email = '" . $email . "'";
            $result = mysqli_query($db_connect, $query);
            $row = mysqli_fetch_assoc($result);
            $email_code = $row['code'];

            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "loocintegrated143@gmail.com";
            $mail->Password = "vxianuqlzupabqvz";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom("loocintegrated143@gmail.com", 'LIS Website');
            $mail->addReplyTo('donotreply@gmail.com', 'DONOTREPLY');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $code = rand(999999, 111111);
            $detect_device = $_SERVER['HTTP_USER_AGENT'];

            $query = "SELECT school_logo, school_name FROM school_information";
            $result = mysqli_query($db_connect, $query);
            $row = mysqli_fetch_assoc($result);
            $year = date("Y");
            $prev_year = $year - 1;
            $email_logo = '<img height="110" src="' . BASE_URL . 'images/school-logo/' . $row['school_logo'] . '" title="LISLogo" alt="LISLogo">';
            $email_footer = '© ' . $prev_year . '-' . $year . ' ' . $row['school_name'];
            $email_name = strtok($name, " ");
            $code = $email_code;
            $email_device = $detect_device;
            $email_username = $username;

            $email_template = BASE_URL . 'teacher_login/template_mail/reset_password.html';
            $message = file_get_contents($email_template);
            $message = str_replace('%email_logo%', $email_logo, $message);
            $message = str_replace('%email_footer%', $email_footer, $message);
            $message = str_replace('%email_name%', $email_name, $message);
            $message = str_replace('%email_username%', $email_username, $message);
            $message = str_replace('%email_code%', $code, $message);
            $message = str_replace('%email_device%', $email_device, $message);
            $mail->Subject = 'New Password Reset Code';
            $mail->MsgHTML($message);
            if ($mail->send()) {
                $info = "We've sent a new password reset code to your email address - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['verify_status'] = "Sent Successfully";
                $_SESSION['verify_icon'] = "success";
                header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
                exit();
            } else {
                $_SESSION['verify_status'] = "Failed while sending new password reset code";
                $_SESSION['verify_icon'] = "error";
                header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
                exit();
            }
        } else {
            $_SESSION['verify_status'] = "Something went wrong";
            $_SESSION['verify_icon'] = "error";
            header('location: ' . BASE_URL . 'teacher_login/verification-code.php');
            exit();
        }
    }
}

if (isset($_POST['reset-pass'])) {
    $newpass = $_POST['newpass'];
    $verifypass = $_POST['verifypass'];
    $email = $_POST['email'];
    $query = "SELECT * FROM user_list WHERE email = '" . $email . "'";
    $result = mysqli_query($db_connect, $query);
    $row = mysqli_fetch_assoc($result);
    $pass = $row['password']; 

    if ($newpass != $verifypass) {
        $_SESSION['reset_status'] = "The input password did not match";
        $_SESSION['reset_icon'] = "error";
        header('location: ' . BASE_URL . 'user_login/reset-password.php');
        exit();
    } if ($newpass == $pass) {
        $_SESSION['reset_status'] = "There is no changes in your password. Please change in a new password!";
        $_SESSION['reset_icon'] = "error";
        header('location: ' . BASE_URL . 'user_login/reset-password.php');
        exit();
    } else {
        $password = md5($newpass);
        $changesql = "SELECT * FROM user_list WHERE email='$email'";
        $changequery = mysqli_query($db_connect, $changesql);
        if (mysqli_num_rows($changequery) > 0) {
            $info = mysqli_fetch_assoc($changequery);
            $name = $info['firstname'] . " " . $info['middle_name'] . " " . $info['surname'];
            $username = $info['username'];
            $updatesql = "UPDATE user_list SET password='$password',locked='0' WHERE email='$email'";
            $updatequery = mysqli_query($db_connect, $updatesql);
            if ($updatequery) {
                $query = "SELECT code FROM user_list WHERE email = '" . $email . "'";
                $result = mysqli_query($db_connect, $query);
                $row = mysqli_fetch_assoc($result);
                $email_code = $row['code'];

                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "loocintegrated143@gmail.com";
                $mail->Password = "vxianuqlzupabqvz";
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom("loocintegrated143@gmail.com", 'LIS Website');
                $mail->addReplyTo('donotreply@gmail.com', 'DONOTREPLY');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $code = rand(999999, 111111);
                $detect_device = $_SERVER['HTTP_USER_AGENT'];

                $query = "SELECT school_logo, school_name FROM school_information";
                $result = mysqli_query($db_connect, $query);
                $row = mysqli_fetch_assoc($result);
                $year = date("Y");
                $prev_year = $year - 1;
                $email_logo = '<img height="110" src="../images/school-logo/' . $row['school_logo'] . '" title="LISLogo" alt="LISLogo">';
                $email_footer = '© ' . $prev_year . '-' . $year . ' ' . $row['school_name'];
                $email_name = strtok($name, " ");
                $email_code = $code;
                $email_device = $detect_device;
                $email_username = $username;
                $email_password = $newpass;

                $email_template = BASE_URL . 'teacher_login/template_mail/reset_account.html';
                $message = file_get_contents($email_template);
                $message = str_replace('%email_logo%', $email_logo, $message);
                $message = str_replace('%email_footer%', $email_footer, $message);
                $message = str_replace('%email_name%', $email_name, $message);
                $message = str_replace('%email_username%', $email_username, $message);
                $message = str_replace('%email_password%', $email_password, $message);

                $mail->Subject = 'Password Reset';
                $mail->MsgHTML($message);
                if ($mail->send()) {
                    $_SESSION['email'] = $email;
                    $_SESSION['success-change'] = "You have successfully updated your password. You may now log in with your new password.";
                    $notice = "We've sent also your username and new password to your email address - $email";
                    $_SESSION['notice-info'] = $notice;
                    header('location: ' . BASE_URL . 'teacher_login/login.php');
                    exit();
                } else {
                    $_SESSION['email'] = $email;
                    $_SESSION['success-change'] = "You have successfully updated your password. You may now log in with your new password.";
                    $_SESSION['notice-info'] = "Sorry, we're unable to send your username and new password to your e-mail address.";
                    header('location: ' . BASE_URL . 'teacher_login/login.php');
                    exit();
                }
            } else {
                $_SESSION['reset_status'] = "Updating password failed";
                $_SESSION['reset_icon'] = "error";
                header('location: ' . BASE_URL . 'teacher_login/reset-password.php');
                exit();
            }
        }
    }
}
