<?php
require '../config/config.php';

// Validation for Add
if (isset($_POST['valid_student'])) {


    $lrn = mysqli_real_escape_string($db, $_POST['lrn']);
    $mark = "enrolled";
    $status = mysqli_real_escape_string($db, $_POST['status']);

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middle_name']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $suffix = mysqli_real_escape_string($db, $_POST['suffix']);

    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    $grade_level = mysqli_real_escape_string($db, $_POST['grade_level']);
    $section = mysqli_real_escape_string($db, $_POST['section']);

    $schl_query = "SELECT * FROM `school_information` ";
    $res_query_schl = mysqli_query($db, $schl_query);
    $school = mysqli_fetch_array($res_query_schl);
    $school_year = $school['school_year'];
    $school_quarter = $school['school_quarter'];

    $tch_query = "SELECT * FROM `user_list` WHERE `grade_level` = $grade_level AND `section` = $section   ";
    $res_query_tch = mysqli_query($db, $tch_query);
    $teacher = mysqli_fetch_array($res_query_tch);
    $teacher_name = $teacher['firstname'] . " " . $teacher['lastname'];


    //no changes in the data
    $sql_lrn = "SELECT `lrn` FROM `student_list` WHERE `lrn` = '" . $lrn . "' ";
    $res_lrn = mysqli_query($db, $sql_lrn);

    $sql_name = "SELECT `firstname`,`middle_name`,`lastname` FROM `student_list` WHERE `firstname` = '" . $firstname . "' AND `middle_name` = '" . $middlename . "' AND `lastname` = '" . $lastname . "' ";
    $res_name = mysqli_query($db, $sql_name);


    if ($lrn == "" || $firstname == "" || $lastname == "" || $grade_level == "" || $section == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' . $teacher_name,
        ];
        echo json_encode($res);
        return;
    } else if ($gender == 2 && $suffix == "jr" || $gender == 2 && $suffix == "sr") {
        $res = [
            'status' => 400,
            'msg' => 'Please Select Right Suffix.',
        ];
        echo json_encode($res);
        return;
    } else {
        if (mysqli_num_rows($res_lrn) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'The LRN: ' . $lrn . ' is already exist.',
            ];
            echo json_encode($res);
            return;
        } else if (mysqli_num_rows($res_name) > 0) {
            $res = [
                'status' => 400,
                'msg' => 'The ' . $firstname . ' ' . $middlename . ' ' . $lastname . ' is already exist.',
            ];
            echo json_encode($res);
            return;
        } else {
            if ($status == "Status") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Status.',
                ];
                echo json_encode($res);
                return;
            } else if ($suffix == "Select Suffix") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Suffix.',
                ];
                echo json_encode($res);
                return;
            } else if ($gender == "Select Gender") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Gender.',
                ];
                echo json_encode($res);
                return;
            } else {

                $query = "INSERT INTO `student_list` (`lrn`,`mark`, `status`,`firstname`,`middle_name`,`lastname`,`suffix`,`gender`,`grade_level`,`section`,`teacher_name`,`school_year_start`,`school_quarter_start`,`date_created`) VALUE ('$lrn','$mark','$status','$firstname','$middlename','$lastname','$suffix','$gender','$grade_level','$section','$teacher_name', '$school_year', '$school_quarter', NOW())";
                $query_run = mysqli_query($db, $query);
                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'Student Added Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}

if (isset($_POST['update_student_enrolled'])) {

    $id = $_POST['id'];

    $lrn = mysqli_real_escape_string($db, $_POST['lrn']);
    $mark = mysqli_real_escape_string($db, $_POST['mark']);

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middle_name']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $suffix = mysqli_real_escape_string($db, $_POST['suffix']);

    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    $grade_level = mysqli_real_escape_string($db, $_POST['grade_level']);
    $section = mysqli_real_escape_string($db, $_POST['section']);


    $schl_query = "SELECT * FROM `school_information` ";
    $res_query_schl = mysqli_query($db, $schl_query);
    $school = mysqli_fetch_array($res_query_schl);
    $school_year = $school['school_year'];
    $school_quarter = $school['school_quarter'];

    if ($mark == 'enrolled') {
        $school_year_retained = '';
        $school_quarter_retained = '';
    } else {
        $school_year_retained = $school_year;
        $school_quarter_retained = $school_quarter;
    }

    $tch_query = "SELECT * FROM `user_list` WHERE `grade_level` = $grade_level AND `section` = $section   ";
    $res_query_tch = mysqli_query($db, $tch_query);
    $teacher = mysqli_fetch_array($res_query_tch);
    $teacher_name = $teacher['firstname'] . " " . $teacher['lastname'];


    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($lrn == "" || $firstname == "" || $lastname == ""  || $section == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' . $section,
        ];
        echo json_encode($res);
        return;
    } else if ($gender == 2 && $suffix == "jr" || $suffix == "sr") {
        $res = [
            'status' => 400,
            'msg' => 'Please Select Right Suffix.',
        ];
        echo json_encode($res);
        return;
    } else {
        if ($suffix == "Select Suffix") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Suffix.',
            ];
            echo json_encode($res);
            return;
        } else if ($gender == "Select Gender") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Gender.',
            ];
            echo json_encode($res);
            return;
        } else if ($section == "No Section Found!") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Other Section.',
            ];
            echo json_encode($res);
            return;
        } else {
            if ($mark == "Mark") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Mark.',
                ];
                echo json_encode($res);
                return;
            } else {


                $query = "UPDATE `student_list` 
                SET `lrn` = '" . $lrn . "',
                `mark` = '" . $mark . "',
                `firstname` = '" . $firstname . "',
                `middle_name` = '" . $middlename . "',
                `lastname` = '" . $lastname . "',
                `suffix` = '" . $suffix . "',
                `gender` = '" . $gender . "',
                `grade_level` = '" . $grade_level . "',
                `section` = '" . $section . "',
                `teacher_name` = '" . $teacher_name . "',
                `school_year_retained` = '" . $school_year_retained . "',
                `school_quarter_retained` = '" . $school_quarter_retained . "',
                `date_created` = '" . $created_date . "' 
                    WHERE `st_id` = '" . $id . "'  ";
                $query_run = mysqli_query($db, $query);

                $query1 = "UPDATE `student_grade` 
                SET `mark` = '" . $mark . "',
                `firstname` = '" . $firstname . "',
                `middle_name` = '" . $middlename . "',
                `lastname` = '" . $lastname . "',
                `grade_level` = '" . $grade_level . "',
                `section` = '" . $section . "'
                WHERE `st_id` = '" . $id . "'  ";
                $query_run1 = mysqli_query($db, $query1);
                if ($query_run && $query_run1) {
                    $res = [
                        'status' => 200,
                        'msg' => 'student Updated Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}


if (isset($_POST['update_student_retained_not_one_year'])) {

    $id = $_POST['id'];

    $lrn = mysqli_real_escape_string($db, $_POST['lrn']);
    $mark = mysqli_real_escape_string($db, $_POST['mark']);
    $status = "old";
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middle_name']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $suffix = mysqli_real_escape_string($db, $_POST['suffix']);

    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    $grade_level = mysqli_real_escape_string($db, $_POST['grade_level']);
    $section = mysqli_real_escape_string($db, $_POST['section']);


    $schl_query = "SELECT * FROM `school_information` ";
    $res_query_schl = mysqli_query($db, $schl_query);
    $school = mysqli_fetch_array($res_query_schl);
    $school_year = $school['school_year'];

    if ($mark == 'enrolled') {
        $school_year_retained = '';
    } else {
        $school_year_retained = $school_year;
    }

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($lrn == "" || $firstname == "" || $lastname == ""  || $section == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' . $section,
        ];
        echo json_encode($res);
        return;
    } else if ($gender == 2 && $suffix == "jr" || $suffix == "sr") {
        $res = [
            'status' => 400,
            'msg' => 'Please Select Right Suffix.',
        ];
        echo json_encode($res);
        return;
    } else {
        if ($suffix == "Select Suffix") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Suffix.',
            ];
            echo json_encode($res);
            return;
        } else if ($gender == "Select Gender") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Gender.',
            ];
            echo json_encode($res);
            return;
        } else if ($section == "No Section Found!") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Other Section.',
            ];
            echo json_encode($res);
            return;
        } else {
            if ($mark == "Mark") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Mark.',
                ];
                echo json_encode($res);
                return;
            } else {


                $query = "UPDATE `student_list` 
                SET `lrn` = '" . $lrn . "',
                `status` = '" . $status . "',
                `mark` = '" . $mark . "',
                `firstname` = '" . $firstname . "',
                `middle_name` = '" . $middlename . "',
                `lastname` = '" . $lastname . "',
                `suffix` = '" . $suffix . "',
                `grade_level` = '" . $grade_level . "',
                `section` = '" . $section . "',
                `gender` = '" . $gender . "',
                `date_created` = '" . $created_date . "' 
                WHERE `st_id` = '" . $id . "'  ";
                $query_run = mysqli_query($db, $query);

                
                $query1 = "UPDATE `student_grade` 
                SET `mark` = '" . $mark . "',
                `status` = '" . $status . "',
                `firstname` = '" . $firstname . "',
                `middle_name` = '" . $middlename . "',
                `lastname` = '" . $lastname . "',
                `grade_level` = '" . $grade_level . "',
                `section` = '" . $section . "'
                WHERE `st_id` = '" . $id . "'  ";
                $query_run1 = mysqli_query($db, $query1);

                if ($query_run && $query_run1) {
                    $res = [
                        'status' => 200,
                        'msg' => 'student Updated Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}



if (isset($_POST['update_student_retained_one_year'])) {

    $id = $_POST['id'];

    $lrn = mysqli_real_escape_string($db, $_POST['lrn']);
    $mark = "enrolled";
    $status = mysqli_real_escape_string($db, $_POST['status']);

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($db, $_POST['middle_name']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $suffix = mysqli_real_escape_string($db, $_POST['suffix']);

    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    $grade_level = mysqli_real_escape_string($db, $_POST['grade_level']);
    $section = mysqli_real_escape_string($db, $_POST['section']);
  
    $schl_query = "SELECT * FROM `school_information` ";
    $res_query_schl = mysqli_query($db, $schl_query);
    $school = mysqli_fetch_array($res_query_schl);
    $school_year = $school['school_year'];
    $school_year_retained = '';
    

    $tch_query = "SELECT * FROM `user_list` WHERE `grade_level` = $grade_level AND `section` = $section   ";
    $res_query_tch = mysqli_query($db, $tch_query);
    $teacher = mysqli_fetch_array($res_query_tch);
    $teacher_name = $teacher['firstname'] . " " . $teacher['lastname'];


    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d H:i:s");

    if ($lrn == "" || $firstname == "" || $lastname == ""  || $section == "") {
        $res = [
            'status' => 400,
            'msg' => 'Fields are Required.' . $section,
        ];
        echo json_encode($res);
        return;
    } else if ($gender == 2 && $suffix == "jr" || $suffix == "sr") {
        $res = [
            'status' => 400,
            'msg' => 'Please Select Right Suffix.',
        ];
        echo json_encode($res);
        return;
    } else {
        if ($suffix == "Select Suffix") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Suffix.',
            ];
            echo json_encode($res);
            return;
        } else if ($gender == "Select Gender") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Gender.',
            ];
            echo json_encode($res);
            return;
        } else if ($section == "No Section Found!") {
            $res = [
                'status' => 400,
                'msg' => 'Please Select Other Section.',
            ];
            echo json_encode($res);
            return;
        } else {
            if ($mark == "Mark") {
                $res = [
                    'status' => 400,
                    'msg' => 'Please Select Mark.',
                ];
                echo json_encode($res);
                return;
            } else {


                $query = "UPDATE `student_list` 
                SET `lrn` = '" . $lrn . "',
                `mark` = '" . $mark . "',
                `status` = '" . $status . "',
                `firstname` = '" . $firstname . "',
                `middle_name` = '" . $middlename . "',
                `lastname` = '" . $lastname . "',
                `suffix` = '" . $suffix . "',
                `gender` = '" . $gender . "',
                `grade_level` = '" . $grade_level . "',
                `section` = '" . $section . "',
                `teacher_name` = '" . $teacher_name . "',
                `school_year_start` = '" . $school_year . "',
                `school_year_retained` = '" . $school_year_retained . "',
                `date_created` = '" . $created_date . "' 
                    WHERE `st_id` = '" . $id . "'  ";
                $query_run = mysqli_query($db, $query);
                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'msg' => 'student Updated Successfully!',
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        }
    }
}





$id = $_POST['del_id'];

$query = "DELETE FROM `student_list` WHERE `st_id` = '" . $id . "'";
$result = mysqli_query($db, $query);


if ($result) {
    $res = [
        'status' => 200,
        'msg' => 'The Syudent has been Deleted.',
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
