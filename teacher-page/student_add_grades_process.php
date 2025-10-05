<?php
include '../config/config.php';

if (isset($_POST['add_info'])) {
    $checked_array = $_POST['fullname'];
    foreach ($_POST['name'] as $key => $value) {
        if (in_array($_POST['name'][$key], $checked_array)) {
            $st_id = $_POST['st_id'][$key];
            $lrn = $_POST['lrn'][$key];
            $mark = $_POST['mark'][$key];
            $status = $_POST['status'][$key];
            $firstname = $_POST['firstname'][$key];
            $middle_name = $_POST['middle_name'][$key];
            $lastname = $_POST['lastname'][$key];
            $grade_level = $_POST['grade_level'][$key];
            $section = $_POST['section'][$key];
            $school_year_start = $_POST['school_year_start'][$key];
            $school_quarter_start = $_POST['school_quarter_start'][$key];
            
            $subject = $_POST['subject'][$key];
            $first = $_POST['first'][$key];
            $second = $_POST['second'][$key];
            $third = $_POST['third'][$key];
            $fourth = $_POST['fourth'][$key];

            // if ($subject == '' || $first == '') {
            //     $res = [
            //         'status' => 400,
            //         'msg' => 'Field is requiered!',
            //     ];
            //     echo json_encode($res);
            //     return;
            // } 
             if ($first > 100 || $second > 100 || $third > 100 || $fourth > 100) {
                $res = [
                    'status' => 400,
                    'msg' => 'Invalid grade higher number!',
                ];
                echo json_encode($res);
                return;
            } else   if ($first < 0 || $second < 0 || $third < 0 || $fourth < 0 ) {
                $res = [
                    'status' => 400,
                    'msg' => 'Invalid grade negative number!',
                ];
                echo json_encode($res);
                return;
            }
            $insertqry = "INSERT INTO `student_grade`( `st_id`,`lrn`,`mark`,`status`, `firstname`,`middle_name`,`lastname`,`grade_level`,`section`,`school_year_start`,`school_quarter_start`, `subject`, `1st_quarter`, `2nd_quarter`, `3rd_quarter`, `4th_quarter`) 
            VALUES ('$st_id','$lrn','$mark','$status','$firstname','$middle_name','$lastname','$grade_level','$section','$school_year_start','$school_quarter_start','$subject','$first','$second','$third','$fourth')";
            $insertqry = mysqli_query($db, $insertqry);

            if($subject == 'Health'){
                $grade_status = 'with grade';
            } else{
                $grade_status = '';
            }
            $updateqry = "UPDATE `student_list` 
            SET `grade_status` = '$grade_status'
            WHERE `lrn` = '" . $lrn . "' AND `st_id` = '" . $st_id . "'  ";
            $updateqry = mysqli_query($db, $updateqry);
        }
    }
    if ($insertqry && $updateqry) {
        $res = [
            'status' => 200,
            'msg' => 'Grades Successfully Update!',
        ];
        echo json_encode($res);
        return;
    }
    header('Location: ../teacher-page/student_add_grades.php');
}


if (isset($_POST['update_info'])) {
    $checked_array = $_POST['fullname'];
    foreach ($_POST['name'] as $key => $value) {
        if (in_array($_POST['name'][$key], $checked_array)) {
            $st_id = $_POST['st_id'][$key];
            $lrn = $_POST['lrn'][$key];
            $mark = $_POST['mark'][$key];
            $status = $_POST['status'][$key];
            $firstname = $_POST['firstname'][$key];
            $middle_name = $_POST['middle_name'][$key];
            $lastname = $_POST['lastname'][$key];
            $grade_level = $_POST['grade_level'][$key];
            $section = $_POST['section'][$key];
            $school_year_start = $_POST['school_year_start'][$key];
            $school_quarter_start = $_POST['school_quarter_start'][$key];
            
            $subject = $_POST['subject'][$key];
            $first = $_POST['first'][$key];
            $second = $_POST['second'][$key];
            $third = $_POST['third'][$key];
            $fourth = $_POST['fourth'][$key];
            $final_grade = $_POST['final_grade'][$key];
            $remark = $_POST['remark'][$key];
            $sg_id = $_POST['sg_id'][$key];

            
            
            if ($first > 100 || $second > 100 || $third > 100 || $fourth > 100) {
                $res = [
                    'status' => 400,
                    'msg' => 'Invalid grade higher number!',
                ];
                echo json_encode($res);
                return;
            } else   if ($first < 0 || $second < 0 || $third < 0 || $fourth < 0 ) {
                $res = [
                    'status' => 400,
                    'msg' => 'Invalid grade negative number!',
                ];
                echo json_encode($res);
                return;
            }
            $insertqry = "UPDATE `student_grade` 
            SET `grade_level` = '" . $grade_level . "',
            `section` = '" . $section . "',
            `school_year_start` = '" . $school_year_start . "',
            `school_quarter_start` = '" . $school_quarter_start . "',
            `1st_quarter` = '" . $first . "',
            `2nd_quarter` = '" . $second . "',
            `3rd_quarter` = '" . $third . "',
            `4th_quarter` = '" . $fourth . "',
            `final_grade` = '" . $final_grade . "',
            `remarks` = '" . $remark . "'
            WHERE `lrn` = '" . $lrn . "' AND `sg_id` = '" . $sg_id . "'  ";
            $insertqry = mysqli_query($db, $insertqry);
        }
    }
    if ($insertqry) {
        $res = [
            'status' => 200,
            'msg' => 'Grades Successfully Update!',
        ];
        echo json_encode($res);
        return;
    }
    header('Location: ../teacher-page/student_add_grades.php');
}
