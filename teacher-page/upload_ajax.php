<?php

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include_once '../config/config.php';
if (!empty($_FILES["upload_csv"]["name"])) {

    $array_data = [];
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['upload_csv']['name']) && in_array($_FILES['upload_csv']['type'], $fileMimes)) {

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['upload_csv']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);


        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

            if ($getData['0'] == '') {
                break;
            }

            // If user already exists in the database with the same email
            $query = "SELECT * FROM student_list WHERE lrn = '" . $getData[0] . "'";
            $check = mysqli_query($db, $query);

            if ($check->num_rows > 0) {
                $res = [
                    'status' => 400,
                    'msg' => 'LRN of ' . ucwords($getData[3]) . ' ' . ucwords($getData[5]) . ' already exists.'
                ];
                echo json_encode($res);
                return;
            }

            $csv_array = array(
                'lrn' =>  $getData[0],
                'mark' =>  $getData[1],
                'status' =>  $getData[2],
                'firstname' =>  $getData[3],
                'middle_name' =>  $getData[4],
                'lastname' =>  $getData[5],
                'suffix' =>  $getData[6],
                'gender' =>  $getData[7],
                'grade_level' =>  $getData[8],
                'section' =>  $getData[9],
                'teacher_name' =>  $getData[10],
                'school_year_start' =>  $getData[11],
                'school_quarter_start' =>  $getData[12],
            );
            // Get row data

            $array_data[] = $csv_array;
        }
        // Close opened CSV file
        fclose($csvFile);

        // echo json_encode($array_data);
        // exit();

        foreach ($array_data as $value) {

            $lrn =  mysqli_real_escape_string($db, validate($value['lrn']));
            $mark =  mysqli_real_escape_string($db, validate($value['mark']));
            $status =  mysqli_real_escape_string($db, validate($value['status']));
            $firstname =  mysqli_real_escape_string($db, validate($value['firstname']));
            $middle_name =  mysqli_real_escape_string($db, validate($value['middle_name']));
            $lastname = mysqli_real_escape_string($db, validate($value['lastname']));
            $suffix = mysqli_real_escape_string($db, validate($value['suffix']));
            $gender =  mysqli_real_escape_string($db, validate($value['gender']));
            if ($gender == 'male') {
                $gender = 1;
            } else {
                $gender = 2;
            }
            $grade_level =  mysqli_real_escape_string($db, validate($value['grade_level']));
            $section =  mysqli_real_escape_string($db, validate($value['section']));

            $gs_query = "SELECT * FROM `grade_section` WHERE `section` = '" . $section . "' ";
            $gs_result = mysqli_query($db, $gs_query);
            $gs = mysqli_fetch_array($gs_result);

            if (ucwords($section) != $gs['section'] || $section != $gs['section']) {
                $res = [
                    'status' => 400,
                    'msg' => 'Incorrect Spelling of a value in CSV'
                ];
                echo json_encode($res);
                return;
            } else {
                $section = $gs['gs_id'];
            }
            
            $teacher_name =  mysqli_real_escape_string($db, validate($value['teacher_name']));
            $school_year_start =  mysqli_real_escape_string($db, validate($value['school_year_start']));
            $school_quarter_start =  mysqli_real_escape_string($db, validate($value['school_quarter_start']));


            // inserting of csv file to database
            $insert = mysqli_query($db, "INSERT INTO student_list (`lrn`,`mark`,`status`,`firstname`,`middle_name`,`lastname`,`suffix`,`gender`,`grade_level`,`section`,`teacher_name`,`school_year_start`,`school_quarter_start`,`date_created`) values('$lrn', '$mark','$status', '$firstname','$middle_name', '$lastname', '$suffix', '$gender', '$grade_level', '$section', '$teacher_name', '$school_year_start', '$school_quarter_start', NOW())");

            if (!$insert) {
                $res = [
                    'status' => 400,
                    'msg' => 'Inserting failed'
                ];
                echo json_encode($res);
                return;
            }
        }

        if (!isset($_SESSION)) {
            session_start();
        }
        //location reload
        $res = [
            'status' => 200,
            'msg' => 'File ADDED Successfully!',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Invalid type of file'
        ];
        echo json_encode($res);
        return;
    }
} else {
    $res = [
        'status' => 400,
        'msg' => 'Empty csv file'
    ];
    echo json_encode($res);
    return;
}
