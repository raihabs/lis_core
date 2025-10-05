<?php include '../config/config.php';

error_reporting(0);
session_start();

include '../include/teacher_meta_data.php';
?>

<title>LIS | Student Add Grades</title>

<?php
include '../include/teacher_top.php';
include '../include/teacher_sidebar.php';
?>


<!-- ======== main-wrapper start =========== -->
<main class="main-wrapper">

    <?php include '../include/teacher_header.php'; ?>


    <!-- ========== table components start ========== -->
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Settings</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Student Add Grades
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">

                <?php

                $subject = $_GET['subject'];
                $subject_query = "SELECT * FROM `subject_list` WHERE `sub_id` = $subject";
                $res_query = mysqli_query($db, $subject_query);
                $subj = mysqli_fetch_array($res_query);
                ?>

                <!-- ========== tables-header start ========== -->
                <div class="bg-white" style="width: 100%; margin: 10px 0; background: #eee; height: 200;">
                    <div class="card bg-white justify-content-between p-4 top">
                        <div class="d-flex">
                            <h5>
                                SUBJECT
                                <span style=" color: #8f00ff;" class="font-weight-bold"> : <?php echo $subj['subject']; ?></span>
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- ========== tables-header start ========== -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-style mb-30">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <b class="" style=" font-size: 2rem; color: #000;">Grades of Students</b>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label>Mark</label>
                                                        <select name="mark_select" id="mark" class="light-bg">
                                                            <option value="enrolled">enrolled</option>
                                                            <option value="retained">retained</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label>Status</label>
                                                        <select name="status_select" id="status" class="light-bg">
                                                            <option value=" ">ALL</option>
                                                            <option value="old">old</option>
                                                            <option value="new">new</option>
                                                            <option value="transferee">transferee</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label for="year">Year: </label>
                                                        <select name="year_select" id="year" class="light-bg">
                                                            <?php
                                                            $year_query = "SELECT `school_year_start`, COUNT(*) as name_count 
                                                            FROM `student_list` 
                                                             GROUP BY school_year_start DESC";
                                                            $year_result = $db->query($year_query);

                                                            if (mysqli_num_rows($year_result) > 0) {
                                                                foreach ($year_result as $year) {
                                                                    echo '<option  value=' . $year['school_year_start'] . '>' . $year['school_year_start'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label>Quarter</label>
                                                        <select name="quarter_select" id="quarter" class="light-bg">
                                                            <option value=" ">ALL</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label>Grade Per Quarter</label>
                                                        <select name="gs_select" id="gs" class="light-bg">
                                                            <option value="1">with grade</option>
                                                            <option value="2">empty grade</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" name="Submit" value="FILTER" class="btnModal btn float-end" style=" border-radius:0%; padding: 7px 15px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
                                            </div>


                                        </div>
                                    </form>
                                </div>

                                <form action="" method="GET">
                                    <input type="text" name="mark_select_input" id="" value="<?php if (isset($_POST['mark_select'])) {
                                                                                                    echo $_GET['mark_select_input'] = $_POST['mark_select'];
                                                                                                } else {
                                                                                                    echo $_GET['mark_select_input'] = '';
                                                                                                } ?>">
                                    <input type="text" name="status_select_input" id="" value="<?php if (isset($_POST['status_select'])) {
                                                                                                    echo $_GET['status_select_input'] = $_POST['status_select'];
                                                                                                } else {
                                                                                                    echo $_GET['status_select_input'] = '';
                                                                                                } ?>">
                                    <!-- <input type="hidden" name="year_select_input" id="" value="<?php if (isset($_POST['year_select'])) {
                                                                                                        echo $_GET['year_select_input'] = $_POST['year_select'];
                                                                                                    } else {
                                                                                                        echo $_GET['year_select_input'] = '';
                                                                                                    } ?>"> -->
                                    <input type="text" name="quarter_select_input" id="" value="<?php if (isset($_POST['quarter_select'])) {
                                                                                                    echo $_GET['quarter_select_input'] = $_POST['quarter_select'];
                                                                                                } else {
                                                                                                    echo $_GET['quarter_select_input'] = '';
                                                                                                } ?>">
                                    <input type="text" name="gs_select_input" id="" value="<?php if (isset($_POST['gs_select'])) {
                                                                                                echo $_GET['gs_select_input'] = $_POST['gs_select'];
                                                                                            } else {
                                                                                                echo $_GET['gs_select_input'] = '';
                                                                                            } ?>">

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">All Students Data</h6>

                            <div class="table-wrapper table-responsive">
                                <table class="table" height="300" style="text-align:center; border: 2px solid #000;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align:center; border: 2px solid #000;">
                                                <h5> <b> # </b> </h5>
                                            </th>
                                            <th rowspan="2" style="text-align:center; border: 2px solid #000;">
                                                <h5> <b> Learning Areas </b> </h5>
                                            </th>
                                            <th colspan="4" style="text-align:center; border: 2px solid #000;">
                                                <h5> <b> Quarter </b> </h5>
                                            </th>
                                            <th rowspan="2" style="text-align:center; border: 2px solid #000;">
                                                <h5> <b> Final Grade</b> </h5>
                                            </th>
                                            <th rowspan="2" style="text-align:center; border: 2px solid #000;">
                                                <h5> <b> Remarks </b> </h5>
                                            </th>
                                        </tr>
                                        <tr>

                                            <th style="text-align:center; border: 2px solid #000;">
                                                <h6>1st</h6>
                                            </th>
                                            <th style="text-align:center; border: 2px solid #000;">
                                                <h6>2nd</h6>
                                            </th>
                                            <th style="text-align:center; border: 2px solid #000;">
                                                <h6>3rd</h6>
                                            </th>
                                            <th style="text-align:center; border: 2px solid #000;">
                                                <h6>4th</h6>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php


                                        $tch_id = $_SESSION['tch_id'];
                                        $teacher_query = "SELECT * FROM `user_list` WHERE `tch_id` = '" . $tch_id . "'";
                                        $teacher_result = mysqli_query($db, $teacher_query);
                                        $teacher = mysqli_fetch_array($teacher_result);
                                        $grade_level_teacher = $teacher['grade_level'];
                                        $section_teacher = $teacher['section'];
                                        $school_year_teacher =  $school['school_year'];

                                        $school_query = "SELECT * FROM `school_information`";
                                        $school_result = mysqli_query($db, $school_query);
                                        $school = mysqli_fetch_array($school_result);

                                        if ($_GET['mark_select_input'] == '' || $_GET['status_select_input'] == '' || $_GET['quarter_select_input'] == '' || $_GET['gs_select_input'] == 1) {
                                            echo  $declaration1 = ' WHERE `grade_level` =  ' . $teacher['grade_level'] . ' AND `section` =  ' . $section_teacher . ' AND `school_year_start`= ' . " '$school_year_teacher'";
                                            echo  $declaration2 = "WHERE  `grade_level` =  " . $teacher['grade_level'] . " AND `section` =  " . $section_teacher . " AND `subject` = '" . $subj['subject'] . "' AND  (`1st_quarter` != '' OR `2nd_quarter` != '' OR `3rd_quarter` != '' OR `4th_quarter` != '') ";
                                        } else {

                                            $mark = $_GET['mark_select_input'];
                                            $one_select = "`mark` = '" . $mark . "'" . " AND ";
                                            if ($_GET['status_select_input'] == ' ') {
                                                $two_select = "";
                                            } else {

                                                $status = $_GET['status_select_input'];
                                                $two_select = " `status` = '" . $status . "' " . " AND ";
                                            }

                                            // if ($_GET['year_select_input'] == '') {
                                            //     $three_select = "";
                                            // } else {

                                            //     $year_level = $_GET['year_select_input'];
                                            //     $three_select = " AND `school_year_start`= '" . $year_level . "'";
                                            // }                   

                                            if ($_GET['quarter_select_input'] == ' ') {
                                                $three_select = "";
                                            } else {

                                                $quarter_level = $_GET['quarter_select_input'];
                                                $three_select = " AND `school_quarter_start`= " . $quarter_level;
                                            }

                                            // if ($_GET['gs_select_input'] == 1) {
                                            //     $three_select = "";
                                            // } else {

                                            //     $quarter_level = $_GET['gs_select_input'];
                                            //     $four_select = " AND `school_quarter_start`= " . $quarter_level;
                                            // }

                                            echo   $declaration1 =  " WHERE " . $one_select . " " . $two_select . " `grade_level` =  $grade_level_teacher AND `section` =  $section_teacher " . $three_select;
                                            echo  $declaration2 = " WHERE `st_id` = '" . $student['st_id'] . "'  AND `subject` = '" . $subj['subject'] . "' AND  (`1st_quarter` != '' OR `2nd_quarter` != '' OR `3rd_quarter` != '' OR `4th_quarter` != '') ";
                                        }


                                        $student_query = "SELECT * FROM `student_list` $declaration1  ORDER BY `gender` ASC";
                                        $result_student = $db->query($student_query);
                                        foreach ($result_student as $student) {

                                            if ($student['gender'] == 1) {
                                                $gender = "Male";
                                                $color = " blue";
                                            } else {
                                                $gender = "Female";
                                                $color = " pink";
                                            }
                                        ?>
                                            <tr style="text-transform: capitalize;">

                                                <?php
                                                $grade_query = "SELECT * FROM `student_grade` $declaration2 ";
                                                $grade_result = mysqli_query($db, $grade_query);
                                                $grade = mysqli_fetch_array($grade_result);
                                                if ($grade['1st_quarter'] != '' || $grade['2nd_quarter'] != '' || $grade['3rd_quarter'] != '' || $grade['4th_quarter'] != '') { ?>
                                                    <form id="update">up <br>
                                                    <?php } else { ?>
                                                        <form id="add">add <br>
                                                        <?php } ?>
                                                        <td style="width:20px; padding: 10px; margin: 0; height:80px;text-align:center; border: 2px solid #000;">
                                                            <i class="bx bx-user" style="color: <?php echo $color; ?>; font-size:30px;"></i>
                                                        </td>
                                                        <td style="width:0; padding: 0; margin: 0; height:80px;text-align:center; border: 2px solid #000;">
                                                            <h4> <input type="text" value="<?php echo $student['firstname'] . " " . $student['middle_name'] . " " . $student['lastname']; ?>" style=" padding: 0; margin: 0; width:400px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                        </td>

                                                        <input type="text" name="fullname[]" value="<?= $student['firstname'] . "_" . $student['lrn']; ?>">
                                                        <input type="text" name="name[]" value="<?= $student['firstname'] . "_" . $student['lrn']; ?>">
                                                        <input type="text" name="st_id[]" value="<?= $student['st_id']; ?>">
                                                        <input type="text" name="lrn[]" value="<?= $student['lrn']; ?>">
                                                        <input type="text" name="mark[]" value="<?= $student['mark']; ?>">
                                                        <input type="text" name="status[]" value="<?= $student['status']; ?>">
                                                        <input type="text" name="firstname[]" value="<?= $student['firstname']; ?>">
                                                        <input type="text" name="middle_name[]" value="<?= $student['middle_name']; ?>">
                                                        <input type="text" name="lastname[]" value="<?= $student['lastname']; ?>">
                                                        <input type="text" name="grade_level[]" value="<?= $student['grade_level']; ?>">
                                                        <input type="text" name="section[]" value="<?= $student['section']; ?>">
                                                        <input type="text" name="school_year_start[]" value="<?= $student['school_year_start']; ?>">
                                                        <input type="text" name="school_quarter_start[]" value="<?= $student['school_quarter_start']; ?>">

                                                        <input type="text" name="subject[]" value="<?= $subj['subject']; ?>">
                                                        <?php
                                                        $grade1_query = "SELECT * FROM `student_grade` WHERE st_id = '" . $student['st_id'] . "'  AND `subject` = '" . $subj['subject'] . "' ";
                                                        $grade1_result = mysqli_query($db, $grade1_query);
                                                        if (mysqli_num_rows($grade1_result) > 0) {
                                                            while ($grade1 = mysqli_fetch_array($grade1_result)) {
                                                                if ($grade1['1st_quarter'] == 0) {
                                                                    $first_quarter = '';
                                                                } else {
                                                                    $first_quarter = $grade1['1st_quarter'];
                                                                }
                                                                if ($grade1['2nd_quarter'] == 0) {
                                                                    $second_quarter = '';
                                                                } else {
                                                                    $second_quarter = $grade1['2nd_quarter'];
                                                                }
                                                                if ($grade1['3rd_quarter'] == 0) {
                                                                    $third_quarter = '';
                                                                } else {
                                                                    $third_quarter = $grade1['3rd_quarter'];
                                                                }
                                                                if ($grade1['4th_quarter'] == 0) {
                                                                    $fourth_quarter = '';
                                                                } else {
                                                                    $fourth_quarter = $grade1['4th_quarter'];
                                                                }
                                                        ?>

                                                                <input type="hidden" name="sg_id[]" value="<?= $grade1['sg_id']; ?>">
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="first[]" value="<?php echo $first_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="second[]" value="<?php echo $second_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="third[]" value="<?php echo $third_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="fourth[]" value="<?php echo $fourth_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                                </td>
                                                                <?php
                                                                $add = ($grade1['1st_quarter'] + $grade1['2nd_quarter'] + $grade1['3rd_quarter'] + $grade1['4th_quarter']);
                                                                $final_grade = $add / 4;

                                                                ?>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h5> <input type="text" name="final_grade[]" value="<?php echo $final_grade; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h5>
                                                                </td>

                                                                <?php
                                                                if ($final_grade >= 89) {
                                                                    $remark = "Passed";
                                                                } else if ($final_grade >= 84) {
                                                                    $remark = "Passed";
                                                                } else if ($final_grade >= 79) {
                                                                    $remark = "Passed";
                                                                } else if ($final_grade >= 75) {
                                                                    $remark = "Passed";
                                                                } else if ($final_grade >= 40) {
                                                                    $remark = "Failed";
                                                                } else {
                                                                    $remark = "No Remark";
                                                                }
                                                                ?>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h5> <input type="text" name="remark[]" value="<?php echo $remark; ?>" readonly value="Passed" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h5>
                                                                </td>
                                                            <?php   }
                                                        } else { ?>

                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="first[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="second[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="third[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="fourth[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;"></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="final_grade[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h5> <input type="text" name="remark[]" value="NO REMARK" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h5>
                                                            </td>
                                                        <?php  } ?>
                                            </tr>
                                        <?php } ?>

                                        <tr style="text-transform: capitalize;">
                                            <td class="min-width" colspan="8" style="width:100vh; height:80px;text-align:left; border: 2px solid #000;">
                                                <div class="text-center">
                                                    <input type="submit" name="submit" style="padding: 15px 25px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;" value="Submit">
                                                </div>
                                            </td>

                                        </tr>
                                        </form>
                                    </tbody>

                                </table>
                                <!-- end table -->

                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
    <!-- ========== table components end ========== -->


    <?php include '../include/footer.php'; ?>

</main>
<!-- ======== main-wrapper end =========== -->

<?php include '../include/teacher_bottom.php'; ?>


<script>
    // Add Modal
    $(document).on('submit', '#add', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("add_info", true);
        {
            Swal.fire({
                title: 'Do you want to save the grades?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_add_grades_process.php", //action
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 400) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Something Went Wrong.',
                                    text: res.msg,
                                    timer: 3000
                                })
                            } else if (res.status == 500) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Something Went Wrong.',
                                    text: res.msg,
                                    timer: 3000
                                })
                            } else if (res.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'SUCCESS',
                                    text: res.msg,
                                    timer: 2000
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(function() {
                        location.reload();
                    });
                }
            })
        }
    });

    // Add Modal
    $(document).on('submit', '#update', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("update_info", true);
        {
            Swal.fire({
                title: 'Do you want to save the grades?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_add_grades_process.php", //action
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 400) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Something Went Wrong.',
                                    text: res.msg,
                                    timer: 3000
                                })
                            } else if (res.status == 500) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Something Went Wrong.',
                                    text: res.msg,
                                    timer: 3000
                                })
                            } else if (res.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'SUCCESS',
                                    text: res.msg,
                                    timer: 2000
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(function() {
                        location.reload();
                    });
                }
            })
        }
    });
</script>

</body>

</html>