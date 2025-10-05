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

                    </div>
                    <!-- end col -->
                    <div class="col-md-6">

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->




            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">

                <?php

                $student = $_GET['student'];
                $student_query = "SELECT * FROM `student_list` WHERE `st_id` = $student";
                $res_query = mysqli_query($db, $student_query);
                $student = mysqli_fetch_array($res_query);

                if ($student['gender'] == 1) {
                    $gender = "Male";
                    $color = " blue";
                } else {
                    $gender = "Female";
                    $color = " pink";
                }
                if ($student['suffix'] == 'none') {
                    $suffix = "";
                } else {
                    $suffix = $row['suffix'] . ".";
                }
                ?>

                <!-- ========== tables-header start ========== -->
                <div class="bg-white" style="width: 100%; margin: 10px 0; background: #eee; height: 200;">
                    <div class="card bg-white justify-content-between p-4 top">
                        <div class="d-flex">
                            <h5>
                                STUDENT ID:
                                <span style=" color: #8f00ff;" class="font-weight-bold"> # <?php echo  $student['lrn']; ?></span>
                            </h5>
                        </div>
                    </div>
                    <div class="row" style="align-items: right; height: 200px;">
                        <div class="col-md-12 px-5" style="bottom: 55px; align-items: center; display:flex; justify-content:center;">
                            <div class="d-flex d-inline-block  flex-column text-sm-left align-left px-5">
                                <i class="bx bx-user" style="color: <?php echo $color; ?>; font-size:60px;"></i>
                            </div>

                            <div class="d-flex d-inline-block  flex-column text-sm-left align-left px-5">
                                <h2 class="mb-0"> <strong><?php echo $student['firstname'] . " " . $suffix . " " . $student['middle_name'] . " " . $student['lastname']; ?></strong>
                                 <?php
                                                        $gs_query = "SELECT gs_id, section FROM `grade_section` WHERE  gs_id = '" . $student['section'] . "' ";
                                                        $res_query_sec = mysqli_query($db, $gs_query);
                                                        $section = mysqli_fetch_array($res_query_sec);
                                                        ?>
                                </h2><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;"><b>Grade</b> <?php echo $student['grade_level'] . " - " . $section['section']; ?></span>
                                </h2><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;"></b>Mark</b> <?php echo $student['mark'];  ?></span>
                                </h2><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;"></b>Status</b> <?php echo $student['status']; ?></span>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">All Students Data</h6>

                            <div class="table-wrapper table-responsive">
                                <table class="table" height="300" style="text-align:center; border: 2px solid #000;">
                                    <thead>
                                        <tr>
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
                                        $sub_query = "SELECT * FROM `subject_list` ORDER BY `sub_id` ASC";
                                        $result_subject = $db->query($sub_query);
                                        foreach ($result_subject as $subject) { ?>
                                            <tr style="text-transform: capitalize;">

                                                <?php
                                                $grade_query = "SELECT * FROM `student_grade` WHERE st_id = '" . $student['st_id'] . "' ";
                                                $grade_result = mysqli_query($db, $grade_query);
                                                $grade = mysqli_fetch_array($grade_result);
                                                if ($grade['1st_quarter'] != '' || $grade['2nd_quarter'] != '' || $grade['3rd_quarter'] != '' || $grade['4th_quarter'] != '') { ?>
                                                    <form id="update">
                                                    <?php } else { ?>
                                                        <form id="add">
                                                        <?php } ?>

                                                        <td style="width:0; padding: 0; margin: 0; height:80px;text-align:center; border: 2px solid #000;">
                                                            <h4> <input type="text" name="subject[]" value="<?php echo $subject['subject']; ?>" style=" padding: 0; margin: 0; width:400px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                        </td>

                                                        <input type="hidden" name="sub[]" value="<?= $subject['subject']; ?>">
                                                        <input type="hidden" name="st_id[]" value="<?= $student['st_id']; ?>">
                                                        <input type="hidden" name="lrn[]" value="<?= $student['lrn']; ?>">
                                                        <input type="hidden" name="mark[]" value="<?= $student['mark']; ?>">
                                                        <input type="hidden" name="status[]" value="<?= $student['status']; ?>">
                                                        <input type="hidden" name="firstname[]" value="<?= $student['firstname']; ?>">
                                                        <input type="hidden" name="middle_name[]" value="<?= $student['middle_name']; ?>">
                                                        <input type="hidden" name="lastname[]" value="<?= $student['lastname']; ?>">
                                                        <input type="hidden" name="grade_level[]" value="<?= $student['grade_level']; ?>">
                                                        <input type="hidden" name="section[]" value="<?= $student['section']; ?>">
                                                        <input type="hidden" name="school_year_start[]" value="<?= $student['school_year_start']; ?>">
                                                        <input type="hidden" name="school_quarter_start[]" value="<?= $student['school_quarter_start']; ?>">

                                                        <?php
                                                        $grade1_query = "SELECT * FROM `student_grade` WHERE st_id = '" . $student['st_id'] . "'  AND `subject` = '" . $subject['subject'] . "' ";
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
                                                                    <h4> <input type="text" name="first[]" value="<?php echo $first_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="second[]" value="<?php echo $second_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="third[]" value="<?php echo $third_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                                </td>
                                                                <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                    <h4> <input type="text" name="fourth[]" value="<?php echo $fourth_quarter; ?>" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
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
                                                                <h4> <input type="text" name="first[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="second[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="third[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="fourth[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h4> <input type="text" name="final_grade[]" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h4>
                                                            </td>
                                                            <td class="min-width" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                                <h5> <input type="text" name="remark[]" value="NO REMARK" style="width:100px; height:80px;text-align:center; border: 2px solid #fff;" readonly></h5>
                                                            </td>
                                                        <?php  } ?>
                                            </tr>
                                            <?php $sql_sub = "select * from `subject_list`";
                                            $result_sub = mysqli_query($db, $sql_sub);
                                            $rws = mysqli_num_rows($result_sub);
                                            $sub = $sub + $final_grade;
                                            $final = round($sub / $rws, 2);

                                            if ($final >= 89) {
                                                $final_remark = "Passed";
                                            } else if ($final >= 84) {
                                                $final_remark = "Passed";
                                            } else if ($final >= 79) {
                                                $final_remark = "Passed";
                                            } else if ($final >= 75) {
                                                $final_remark = "Passed";
                                            } else if ($final >= 40) {
                                                $final_remark = "Failed";
                                            } else {
                                                $final_remark = "No Remark";
                                            }
                                            ?>
                                        <?php } ?>
                                        <tr style="text-transform: capitalize;">

                                            <td class="min-width" colspan="5" style="width:100px; height:80px;text-align:left; border: 2px solid #000;">
                                                <h4> General Average </h4>
                                            </td>
                                            <td class="min-width" colspan="1" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                <h5><?php echo $final; ?></h5>
                                            </td>
                                            <td class="min-width" colspan="2" style="width:100px; height:80px;text-align:center; border: 2px solid #000;">
                                                <h5><?php echo $final_remark; ?></h5>
                                            </td>

                                        </tr>
                                        <!-- <tr style="text-transform: capitalize;">
                                            <td class="min-width" colspan="7" style="width:100vh; height:80px;text-align:left; border: 2px solid #000;">
                                                <div class="text-center">
                                                    <input type="submit" name="submit" style="padding: 15px 25px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;" value="Submit">
                                                </div>
                                            </td>

                                        </tr> -->
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