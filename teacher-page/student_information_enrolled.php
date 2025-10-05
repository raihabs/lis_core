<?php include '../config/config.php';

error_reporting(0);
session_start();

include '../include/teacher_meta_data.php';
?>

<title>LIS | Student</title>

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

                <!-- ========== tables-header start ========== -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-style mb-30">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                                        <div class="row">
                                            <!-- <div class="col-md-2">
                                                <b class="" style=" font-size: 2rem; color: #000;">Students</b>
                                            </div> -->

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

                                            <div class="col-md-2">
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

                                            <!-- <div class="col-md-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label for="year">School Year: </label>
                                                        <select name="year_select" id="year" class="light-bg">
                                                            <?php
                                                            $year_query = "SELECT `school_year_start`, COUNT(*) as name_count 
                                                            FROM `student_list` 
                                                             GROUP BY school_year_start ASC";
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
                                                <input type="submit" name="Submit" value="FILTER" class="btnModal btn float-end" style=" border-radius:0%; padding: 7px 15px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
                                            </div>

                                            <div class="col-md-2">
                                                <a href="#" style="padding:0; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
                                                    <button type="button" class="btnModal btn float-end" data-bs-toggle="modal" data-bs-target="#addExcel">
                                                        <b class="pb-2" style="color:white; ">IMPORT</b>
                                                    </button>
                                                </a>
                                                &nbsp;&nbsp;
                                                <a href="#" style="padding:0; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
                                                    <button type="button" class="btnModal btn float-end" data-bs-toggle="modal" data-bs-target="#addAdmin">
                                                        <b class="pb-2" style="color:white; padding: 0 15px ">ADD</b>
                                                    </button>
                                                </a>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <form action="" method="GET">
                                    <input type="hidden" name="mark_select_input" id="" value="<?php if (isset($_POST['mark_select'])) {
                                                                                                    echo $_GET['mark_select_input'] = $_POST['mark_select'];
                                                                                                } else {
                                                                                                    echo $_GET['mark_select_input'] = '';
                                                                                                } ?>">
                                    <input type="hidden" name="status_select_input" id="" value="<?php if (isset($_POST['status_select'])) {
                                                                                                        echo $_GET['status_select_input'] = $_POST['status_select'];
                                                                                                    } else {
                                                                                                        echo $_GET['status_select_input'] = '';
                                                                                                    } ?>">
                                    <!-- <input type="text" name="year_select_input" id="" value="<?php if (isset($_POST['year_select'])) {
                                                                                                    echo $_GET['year_select_input'] = $_POST['year_select'];
                                                                                                } else {
                                                                                                    echo $_GET['year_select_input'] = '';
                                                                                                } ?>"> -->

                                    <input type="hidden" name="quarter_select_input" id="" value="<?php if (isset($_POST['quarter_select'])) {
                                                                                                    echo $_GET['quarter_select_input'] = $_POST['quarter_select'];
                                                                                                } else {
                                                                                                    echo $_GET['quarter_select_input'] = '';
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
                                <table class="table" id="student_record">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>LRN</h6>
                                            </th>
                                            <th>
                                                <h6>Student Fullname</h6>
                                            </th>
                                            <th>
                                                <h6>Gender</h6>
                                            </th>
                                            <th>
                                                <h6>MARK</h6>
                                            </th>
                                            <th>
                                                <h6>STATUS</h6>
                                            </th>
                                            <th>
                                                <h6>Year & Quarter Start</h6>
                                            </th>
                                            <th>
                                                <h6>Year & Quarter Retained</h6>
                                            </th>
                                            <th>
                                                <h6>AVERAGE</h6>
                                            </th>
                                            <th>
                                                <h6>REMARK</h6>
                                            </th>
                                            <th>
                                                <h6>Date Created</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $school_query = "SELECT * FROM `school_information`";
                                        $school_result = mysqli_query($db, $school_query);
                                        $school = mysqli_fetch_array($school_result);

                                        $tch_id = $_SESSION['tch_id'];
                                        $teacher_query = "SELECT * FROM `user_list` WHERE `tch_id` = '" . $tch_id . "'";
                                        $teacher_result = mysqli_query($db, $teacher_query);
                                        $teacher = mysqli_fetch_array($teacher_result);
                                        $grade_level_teacher = $teacher['grade_level'];
                                        $section_teacher = $teacher['section'];
                                        $school_year_teacher =  $school['school_year'];

                                        if ($_GET['mark_select_input'] == '' || $_GET['status_select_input'] == '' || $_GET['quarter_select_input'] == '') {
                                              $declaration = ' WHERE `grade_level` =  ' . $teacher['grade_level'] . ' AND `section` =  ' . $section_teacher . ' AND `school_year_start`= ' . " '$school_year_teacher'";
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

                                              $declaration =  " WHERE " . $one_select . " " . $two_select . " `grade_level` =  $grade_level_teacher AND `section` =  $section_teacher " . $three_select ;
                                        }

                                        $student_query = "SELECT * FROM `student_list` $declaration ORDER BY `date_created` DESC";
                                        $res_query = mysqli_query($db, $student_query);
                                        if (mysqli_num_rows($res_query) > 0) {
                                            while ($row = mysqli_fetch_array($res_query)) {
                                        ?>

                                                <tr style="text-transform: capitalize;">
                                                    <td class="min-width">
                                                        <h5> <b> <?php echo $row['st_id']."  ".$row['lrn']; ?> </b> </h5>
                                                    </td>
                                                    <td class="min-width" width="15%">
                                                        <?php if ($row['suffix'] == 'none') {
                                                            $suffix = "";
                                                        } else {
                                                            $suffix = $row['suffix'] . ".";
                                                        } ?>
                                                        <p><?= $row['firstname'] . " " . $suffix . " " . $row['middle_name'] . " " . $row['lastname'] ?></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <?php
                                                        if ($row['gender'] == 1) {
                                                            $gender = "Male";
                                                        } else {
                                                            $gender = "Female";
                                                        }
                                                        ?>
                                                        <p><a href="#0"><?php echo $gender; ?></a></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><a href="#0"><?php echo $row['mark']; ?></a></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><a href="#0"><?php echo $row['status']; ?></a></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><a href="#0"><?php echo $row['school_year_start'] . " - " . $row['school_quarter_start']; ?></a></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <?php if ($row['school_year_retained'] == 0 || $row['school_quarter_retained'] == 0) {
                                                            $sq = "STILL ENROLLEE";
                                                        } else {
                                                            $sq = $row['school_year_retained'] . " - " . $row['school_quarter_retained'];
                                                        } ?>
                                                        <p><a href="#0"><?php echo $sq; ?></a></p>
                                                    </td>
                                                    </td>
                                                    <?php
                                                    $num = $row['st_id'] + 1;
                                                    $final_grade = "$" . "final_grade_" . $num;
                                                    $grade_query = "SELECT * FROM `student_grade` WHERE st_id = '" . $row['st_id'] . "' ";
                                                    $grade_result = mysqli_query($db, $grade_query);
                                                    while ($grade = mysqli_fetch_array($grade_result)) {
                                                        $final_grade = $final_grade + $grade['final_grade'] . "<br>";
                                                    }
                                                    $sql_sub = "select * from `subject_list`";
                                                    $result_sub = mysqli_query($db, $sql_sub);
                                                    $rws = mysqli_num_rows($result_sub);
                                                    $final = round($final_grade / $rws, 2);
                                                    if ($final > 89  && $final < 100) {
                                                        $final_remark = "Passed";
                                                    } else if ($final > 84 && $final < 89) {
                                                        $final_remark = "Passed";
                                                    } else if ($final > 79 && $final < 84) {
                                                        $final_remark = "Passed";
                                                    } else if ($final > 74 && $final < 80) {
                                                        $final_remark = "Passed";
                                                    } else if ($final > 1 && $final < 74) {
                                                        $final_remark = "Failed";
                                                    }

                                                    $sql_st = "select * from `student_list` WHERE st_id = '" . $row1['st_id'] . "'";
                                                    $result_st = mysqli_query($db, $sql_st);
                                                    $st = mysqli_fetch_array($result_st);
                                                    ?>

                                                    <td class="min-width">
                                                        <p><?php echo $final; ?></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><?php echo $final_remark; ?></p>
                                                    </td>
                                                    <td class="min-width">
                                                        <p><?php echo date('m-d-Y h:i A', strtotime($row['date_created'])); ?></a></p>
                                                    </td>
                                                    <td>
                                                        <div class="action">

                                                            <a href="student_view_grades.php?student=<?= $row['st_id'] ?>" style="text-decoration:none;">
                                                                <button class="btn btn-info btn-sm m-b-10 student_edit_enrolled button1" style="background-color: #6c8cc4; border: solid 5px; border-color: #6c8cc4; color:#fff;"><i class='bx bx-eye' style="color: #fff;"></i> View</button>&nbsp;&nbsp;&nbsp;
                                                            </a>
                                                            <?php if ($row['mark'] == "enrolled") { ?>
                                                                <button class="btn btn-info btn-sm m-b-10 student_edit_enrolled button1" data-bs-toggle="modal" data-bs-target="#updatestudentEnrolled" value="<?= $row['st_id']; ?>" data-role="update" id="<?php echo $row['st_id']; ?>" style="background-color: #6c8cc4; border: solid 5px; border-color: #6c8cc4;"><i class='bx bx-pencil' style="color: #fff;"></i></button>&nbsp;&nbsp;&nbsp;
                                                                <?php } else {

                                                                $school_query = "SELECT * FROM `school_information`";
                                                                $school_result = mysqli_query($db, $school_query);
                                                                $school = mysqli_fetch_array($school_result);

                                                                $right_side_info = substr_replace($school['school_year'], "", 0, 5);
                                                                $school_year_info = chop($school['school_year'], $right_side_info);
                                                                $rt_side_info = substr_replace($school_year_info, "", 0, 4);
                                                                $left_side_info = chop($school_year_info, $rt_side_info);

                                                                $right_side = substr_replace($row['school_year_retained'], "", 0, 5);
                                                                $school_year = chop($row['school_year_retained'], $right_side) . "<br>";
                                                                $rt_side = substr_replace($school_year, "", 0, 4) . "<br>";
                                                                $left_side = chop($school_year, $rt_side) . "<br>";

                                                                $right_one_year_exceed = $right_side + 1;
                                                                $left_one_year_exceed = $left_side + 1;
                                                                $left  = substr_replace($right_one_year_exceed, "", 0, 5);

                                                                $right_two_year_exceed = $right_side + 2;
                                                                $left_two_year_exceed = $left_side + 2;
                                                                if ($left_side_info == $left_side || $right_side_info == $right_side) { ?>
                                                                    <button class="btn btn-info btn-sm m-b-10 updatestudentReainedOneYear button1" data-bs-toggle="modal" data-bs-target="#student_edit_retained_not_one_year" value="<?= $row['st_id']; ?>" data-role="update" id="<?php echo $row['st_id']; ?>" style="background-color: #6c8cc4; border: solid 5px; border-color: #6c8cc4;"><i class="bx bx-pencil" style="color: #fff;"></i></button>&nbsp;&nbsp;&nbsp;
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td class="min-width" colspan="10">
                                                    <center>No Student-Data-Found!</center>
                                                </td>
                                            </tr>
                                        <?php } ?>

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

    <!-- Add Modal -->
    <div class="modal fade" id="addExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-light" style=" background-color: rgb(8 169 106 / 62%);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Add File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form id="import_form" class="form-inline mt-2" style="padding:10px;">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table" style="border: 2px solid #000; outline: 2px;">
                                        <thead>
                                            <tr style="border: 2px solid #000; outline: 2px;">

                                                <th>
                                                    <h6>
                                                        <center>LRN</center>
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6>
                                                        <center>Student Fullname</center>
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6>
                                                        <center>Gender</center>
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6>
                                                        <center>MARK</center>
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6>
                                                        <center>STATUS</center>
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6>
                                                        <center>Year & Quarter Start</center>
                                                    </h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr style="text-transform: capitalize;">
                                                <td class="min-width">
                                                    <h5> <b>
                                                            <center>123456789012</center>
                                                        </b> </h5>
                                                </td>
                                                <td class="min-width" width="15%">
                                                    <p>
                                                        <center>Firstname Suffix Middlename Lastname</center>
                                                    </p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0">
                                                            <center>male/female</center>
                                                        </a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0">
                                                            <center>enrolled/retained</center>
                                                        </a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0">
                                                            <center>old/new/transferee</center>
                                                        </a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0">
                                                            <center>2022/2023</center>
                                                        </a></p>
                                                </td>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select File</label>
                                        <input type="file" name="upload_csv" accept=".csv" class="form-control" id="upload_csv">
                                    </div>
                                </div>
                            </div>
                            <label for="content">Please use .cvs/.xlsx extension to your excel file.</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="import" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- IMPORT Modal -->
    <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-light" style=" background-color: rgb(8 169 106 / 62%);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Add student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="savestudent">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for=""></label>
                        </div>


                        <div class="mb-3">
                            <label for="content">STUDENT LRN</label>

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="lrn" placeholder="LRN" pattern="[0-9]+" maxlength="12" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <select name="status" class="form-select" aria-label="Default select example">
                                        <option select hidden>Status</option>
                                        <option value="old">Old</option>
                                        <option value="new">New</option>
                                        <option value="transferee">Transferee</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content">STUDENT FULLNAME</label>

                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="firstname" placeholder="First Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="middle_name" placeholder="Middle Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="lastname" placeholder="Last Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <select name="suffix" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Suffix</option>
                                        <option value="jr">Jr</option>
                                        <option value="sr">Sr</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="content">STUDENT OTHER INFORMATION</label>

                            <div class="row">
                                <div class="col-md-4">
                                    <select name="gender" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <input type="hidden" name="grade_level" class="form-control" value="<?php echo $teacher['grade_level'] ?>" />

                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="section" class="form-control" value="<?php echo $teacher['section'] ?>" />
                                </div>

                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Update Modal -->
    <div class="modal fade" id="updatestudentEnrolled" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-light" style=" background-color: rgb(8 169 106 / 62%);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updstudentEnrolled">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for=""></label>
                        </div>


                        <div class="mb-3">
                            <label for="content">STUDENT LRN</label>
                            <input type="hidden" name="id" id="id">

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="lrn" id="lrn" placeholder="LRN" pattern="[0-9]+" maxlength="12" class="form-control" readonly />
                                </div>
                                <div class="col-md-4">
                                    <select name="mark" id="markk" class="form-select" aria-label="Default select example">
                                        <option select hidden>Mark</option>
                                        <option value="enrolled">enrolled</option>
                                        <option value="retained">retained</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="gender" id="gender" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content">STUDENT FULLNAME</label>

                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <select name="suffix" id="suffix" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Suffix</option>
                                        <option value="jr">Jr</option>
                                        <option value="sr">Sr</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" name="grade_level" class="form-control" value="<?php echo $teacher['grade_level'] ?>" />
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="section" class="form-control" value="<?php echo $teacher['section'] ?>" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- NOT EXCEEDING ONE YEAR -->
    <!-- Update Modal -->
    <div class="modal fade" id="student_edit_retained_not_one_year" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-light" style=" background-color: rgb(8 169 106 / 62%);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updstudentRetainedNotOneYear">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for=""></label>
                        </div>


                        <div class="mb-3">
                            <label for="content">STUDENT LRN</label>
                            <input type="hidden" name="id" id="id_one">

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="lrn" id="lrn_one" placeholder="LRN" pattern="[0-9]+" maxlength="12" class="form-control" readonly />
                                </div>
                                <div class="col-md-4">
                                    <select name="mark" id="mark_one" class="form-select" aria-label="Default select example">
                                        <option select hidden>Mark</option>
                                        <option value="enrolled">enrolled</option>
                                        <option value="retained">retained</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="gender" id="gender_one" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content">STUDENT FULLNAME</label>

                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="firstname" id="firstname_one" placeholder="First Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="middle_name" id="middle_name_one" placeholder="Middle Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="lastname" id="lastname_one" placeholder="Last Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <select name="suffix" id="suffix_one" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Suffix</option>
                                        <option value="jr">Jr</option>
                                        <option value="sr">Sr</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" name="grade_level" class="form-control" value="<?php echo $teacher['grade_level'] ?>" />
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="section" class="form-control" value="<?php echo $teacher['section'] ?>" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- exceed one or two years already -->

    <!-- NOT EXCEEDING ONE YEAR -->
    <!-- Update Modal -->
    <div class="modal fade" id="student_edit_retained_two_year" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-light" style=" background-color: rgb(8 169 106 / 62%);">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updstudentRetainedOneYear">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for=""></label>
                        </div>


                        <div class="mb-3">
                            <label for="content">STUDENT LRN</label>
                            <input type="hidden" name="id" id="id_two">

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="lrn" id="lrn_two" placeholder="LRN" pattern="[0-9]+" maxlength="12" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <select name="status" id="status_two" class="form-select" aria-label="Default select example">
                                        <option select hidden>Status</option>
                                        <option value="old">Old</option>
                                        <option value="new">New</option>
                                        <option value="transferee">Transferee</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content">STUDENT FULLNAME</label>

                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="firstname" id="firstname_two" placeholder="First Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="middle_name" id="middle_name_two" placeholder="Middle Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="lastname" id="lastname_two" placeholder="Last Name" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <select name="suffix" id="suffix_two" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Suffix</option>
                                        <option value="jr">Jr</option>
                                        <option value="sr">Sr</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="content">STUDENT OTHER INFORMATION</label>

                            <div class="row">
                                <div class="col-md-4">
                                    <select name="gender" id="gender_two" class="form-select" aria-label="Default select example">
                                        <option select hidden>Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="grade_level" class="form-control" value="<?php echo $teacher['grade_level'] ?>" />

                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="section" class="form-control" value="<?php echo $teacher['section'] ?>" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../include/footer.php'; ?>

</main>
<!-- ======== main-wrapper end =========== -->

<?php include '../include/teacher_bottom.php'; ?>



<script>
    $(document).ready(function() {
        $('#import_form').on("submit", function(e) {
            e.preventDefault(); //form will not submitted  
            $.ajax({
                url: "upload_ajax.php",
                method: "POST",
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.  
                cache: false, // To unable request pages to be cached  
                processData: false, // To send DOMDocument or non processed data file it is set to false  
                success: function(data) {
                    var res = jQuery.parseJSON(data);
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
        });
    });


    $(document).ready(function() {
        $('#student_record').DataTable({
            "ordering": false,
            pagingType: 'full_numbers',
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 25, 50, 75, -1],
                [5, 25, 50, 75, "All"]
            ],
            "iDisplayLength": 5,

        });
    });


    // Add Modal
    $(document).on('submit', '#savestudent', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_student", true);
        {
            Swal.fire({
                title: 'Do you want to save the user?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_information_process.php", //action
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


    // Update for Files
    $(document).ready(function() {
        $(document).on('click', '.student_edit_enrolled', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "student_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        // console.log(res);
                        $('#id').val(res.data.st_id);
                        $('#lrn').val(res.data.lrn);
                        $('#markk').val(res.data.mark);
                        $('#status').val(res.data.status);
                        $('#firstname').val(res.data.firstname);
                        $('#middle_name').val(res.data.middle_name);
                        $('#lastname').val(res.data.lastname);
                        $('#suffix').val(res.data.suffix);
                        $('#gender').val(res.data.gender);
                        $('#grade_level').val(res.data.grade_level);
                        $('#section1').val(res.data.section);
                    }
                    // $('#memo').html(data);
                }

            });
        });
    });

    // Update for Files
    $(document).ready(function() {
        $(document).on('click', '.updatestudentReainedOneYear', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "student_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        // console.log(res);
                        $('#id_one').val(res.data.st_id);
                        $('#lrn_one').val(res.data.lrn);
                        $('#mark_one').val(res.data.mark);
                        $('#status_one').val(res.data.status);
                        $('#firstname_one').val(res.data.firstname);
                        $('#middle_name_one').val(res.data.middle_name);
                        $('#lastname_one').val(res.data.lastname);
                        $('#suffix_one').val(res.data.suffix);
                        $('#gender_one').val(res.data.gender);
                        $('#grade_level_one').val(res.data.grade_level);
                        $('#section1_one').val(res.data.section);
                    }
                    // $('#memo').html(data);
                }

            });
        });
    });

    // Update for Files
    $(document).ready(function() {
        $(document).on('click', '.updatestudentRetainedTwoYear', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "student_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        // console.log(res);
                        $('#id_two').val(res.data.st_id);
                        $('#lrn_two').val(res.data.lrn);
                        $('#status_two').val(res.data.status);
                        $('#status_two').val(res.data.status);
                        $('#firstname_two').val(res.data.firstname);
                        $('#middle_name_two').val(res.data.middle_name);
                        $('#lastname_two').val(res.data.lastname);
                        $('#suffix_two').val(res.data.suffix);
                        $('#gender_two').val(res.data.gender);
                        $('#grade_level_two').val(res.data.grade_level);
                        $('#section1_two').val(res.data.section);
                    }
                    // $('#memo').html(data);
                }

            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#updstudentEnrolled', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_student_enrolled", true);
            Swal.fire({
                title: 'Do you want to Update student?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_information_process.php", //action
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

        });

    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#updstudentRetainedNotOneYear', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_student_retained_not_one_year", true);
            Swal.fire({
                title: 'Do you want to Update student?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_information_process.php", //action
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

        });

    });
    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#updstudentRetainedOneYear', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_student_retained_one_year", true);
            Swal.fire({
                title: 'Do you want to Update student?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "student_information_process.php", //action
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

        });

    });

    // Delete 
    $(document).ready(function() {
        $('.student_delete').click(function() {
            var del_id = $(this).attr('id');
            var $ele = $(this).parent().parent();
            Swal.fire({
                title: 'Are you Sure?',
                text: "You won't be able to recover this data!",
                // showDenyButton: true,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#bb2d3b',
                confirmButtonText: 'Yes, Delete it!',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'student_information_process.php',
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 400) {
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
        });
    });
</script>

<script type="text/javascript">
    function FetchAddSection(grade) {
        $('#section').html('');
        $.ajax({
            type: 'post',
            url: 'student_section_add_data.php',
            data: {
                grade: grade
            },
            success: function(data) {
                $('#section').html(data);
            }
        })
    }

    function FetchUpdateEnrolledSection(grade) {
        $('#section1').html('');
        $.ajax({
            type: 'post',
            url: 'student_section_add_data.php',
            data: {
                grade: grade
            },
            success: function(data) {
                $('#section1').html(data);
            }
        })
    }

    function FetchUpdateRetainedSection(grade) {
        $('#section2_one').html('');
        $.ajax({
            type: 'post',
            url: 'student_section_add_data.php',
            data: {
                grade: grade
            },
            success: function(data) {
                $('#section2_one').html(data);
            }
        })
    }

    function FetchUpdateRetained2Section(grade) {
        $('#section2_two').html('');
        $.ajax({
            type: 'post',
            url: 'student_section_add_data.php',
            data: {
                grade: grade
            },
            success: function(data) {
                $('#section2_two').html(data);
            }
        })
    }
</script>
</body>

</html>