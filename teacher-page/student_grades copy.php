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
                                            <div class="col-sm-2">
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
                                            </div>

                                            <div class="col-md-2">
                                                <input type="submit" name="Submit" value="FILTER" class="btnModal btn float-end" style=" border-radius:0%; padding: 7px 15px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
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
                                    <input type="hidden" name="year_select_input" id="" value="<?php if (isset($_POST['year_select'])) {
                                                                                                    echo $_GET['year_select_input'] = $_POST['year_select'];
                                                                                                } else {
                                                                                                    echo $_GET['year_select_input'] = '';
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
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
                                                <h6>Year & Quarter Started</h6>
                                            </th>
                                            <th>
                                                <h6>AVERAGE</h6>
                                            </th>
                                            <th>
                                                <h6>REMARKS</h6>
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

                                        if ($_GET['mark_select_input'] == '' || $_GET['status_select_input'] == '') {
                                            $declaration = ' WHERE ';
                                        } else {

                                            $mark = $_GET['mark_select_input'];
                                            $one_select = "`mark` = '" . $mark . "'" . " AND ";
                                            if ($_GET['status_select_input'] == ' ') {
                                                $two_select = "";
                                            } else {

                                                $status = $_GET['status_select_input'];
                                                $two_select = " `status` = '" . $status . "' " . " AND ";
                                            }

                                            if ($_GET['year_select_input'] == '') {
                                                $three_select = "";
                                            } else {

                                                $year_level = $_GET['year_select_input'];
                                                $three_select = "`school_year_start`= '" . $year_level  . "' " . " AND ";
                                            }
                                            $declaration =  " WHERE " . $one_select . " " . $two_select . " " . $three_select;
                                        }

                                        $student_query = "SELECT * FROM `student_list` $declaration  `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' ORDER BY `gender` ASC";
                                        $res_query = mysqli_query($db, $student_query);
                                        if (mysqli_num_rows($res_query) > 0) {
                                            while ($row = mysqli_fetch_array($res_query)) {

                                                if ($row['gender'] == 1) {
                                                    $gender = "Male";
                                                    $color = " blue";
                                                } else {
                                                    $gender = "Female";
                                                    $color = " pink";
                                                }

                                                // $student_query1 = "SELECT `sg_id`,`st_id`,`lrn`, `grade_level`, `section`, `school_year_start`, `school_quarter_start`,`final_grade`, COUNT(*) FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' GROUP BY `lrn` ORDER BY `sg_id` DESC";
                                                // $res_query1 = mysqli_query($db, $student_query1);
                                                // if (mysqli_num_rows($res_query1) > 0) {
                                                //     while ($row1 = mysqli_fetch_array($res_query1)) {
                                        ?>

                                                <tr style="text-transform: capitalize;">
                                                    <td class="min-width">
                                                        <i class="bx bx-user" style="color: <?php echo $color; ?>; font-size:30px;"></i>
                                                    </td>
                                                    <td class="min-width">
                                                        <h4> <b> <?php echo $row['lrn']; ?> </b> </h4>
                                                    </td>
                                                    <td class="min-width" width="25%">
                                                        <?php if ($row['suffix'] == 'none') {
                                                            $suffix = "";
                                                        } else {
                                                            $suffix = $row['suffix'] . ".";
                                                        } ?>
                                                        <p><?= $row['firstname'] . " " . $suffix . " " . $row['middle_name'] . " " . $row['lastname'] ?></p>
                                                    </td>
                                                    <td class="min-width">

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
                                                    <?php
                                                    $num = $row1['st_id'] + 1;
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

                                                    <td>
                                                        <div class="action">
                                                            <a href="student_add_grades.php?student=<?= $row['st_id'] ?>" style="text-decoration:none;">
                                                                <button class="btn btn-info btn-sm m-b-10 student_edit_enrolled button1" style="background-color: #6c8cc4; border: solid 5px; border-color: #6c8cc4;"><i class='bx bx-pencil' style="color: #fff;"></i></button>&nbsp;&nbsp;&nbsp;
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>


                                            <?php
                                                //     }
                                                // }
                                            }
                                        } else { ?>
                                            <tr>
                                                <td class="min-width" colspan="10">
                                                    <center>No Admin-Data-Found!</center>
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




    <?php include '../include/footer.php'; ?>

</main>
<!-- ======== main-wrapper end =========== -->

<?php include '../include/teacher_bottom.php'; ?>

</body>

</html>