<?php include '../config/config.php';

error_reporting(0);
session_start();

include '../include/teacher_meta_data.php';
?>

<title>LIS | School Grade Reports</title>

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
                        <div class="title mb-30">
                            <h2>School Report</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../admin-page/index.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Report
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

                <!-- ========== tables-header start ========== -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-style mb-30">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                                        <div class="row">
                                            <div class="col-md-2">
                                                <b class="" style=" font-size: 2rem; color: #000;">Grades</b>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="select-style-1">
                                                    <div class="select-position">
                                                        <label>Mark</label>
                                                        <select name="mark_select" id="mark" class="light-bg">
                                                            <option value=" ">ALL</option>
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



                                            <div class="col-md-3">
                                                <input type="submit" name="Submit" value="FILTER" class="btnModal btn float-end" style=" border-radius:0%; padding: 7px 20px; margin:0; background-color:#6c8cc4; color:white; font-size:25%px; color:white;">
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

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <?php

                if ($_GET['mark_select_input'] == '' || $_GET['status_select_input'] == '') {
                    $declaration = 'WHERE ';
                } else {


                    if ($_GET['mark_select_input'] == ' ') {
                        $one_select = "";
                    } else {

                        $mark = $_GET['mark_select_input'];
                        $one_select = "`mark` = '" . $mark . "' AND ";
                    }

                    if ($_GET['status_select_input'] == ' ') {
                        $two_select = "";
                    } else {

                        $status = $_GET['status_select_input'];
                        $two_select = "`status` = '" . $status . "' AND ";
                    }


                    $declaration = "WHERE " . $one_select . " " . $two_select;
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <a href="report2.php?declaration=<?php echo base64_encode($declaration); ?>" target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PRINT</a>
                            <h6 class="mb-10">All Report Data</h6>

                            <div class="table-wrapper table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <tr>
                                        <th rowspan="2" class="border border-dark" >
                                            <center>LEARNING AREAS</center>
                                        </th>
                                        <th colspan="5" scope="colgroup" class="border border-dark" >
                                            <center>1st Quarter</center>
                                        </th>
                                        <th colspan="5" scope="colgroup" class="border border-dark" >
                                            <center>2nd Quarter</center>
                                        </th>
                                        <th colspan="5" scope="colgroup" class="border border-dark" >
                                            <center>3rd Quarter</center>
                                        </th>
                                        <th colspan="5" scope="colgroup" class="border border-dark" >
                                            <center>4th Quarter</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th scope="col" class="border border-dark" >
                                            <center>90-100</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>85-89</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>80-84</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75-79</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75 below</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>90-100</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>85-89</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>80-84</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75-79</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75 below</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>90-100</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>85-89</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>80-84</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75-79</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75 below</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>90-100</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>85-89</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>80-84</center>
                                        </th>
                                        <th scope="col" class="border border-dark" >
                                            <center>75-79</center>
                                        </th>
                                        <th scope="col" class="border border-dark" s>
                                            <center>75 below</center>
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sub_query = "SELECT * FROM `subject_list` ORDER BY `sub_id` ASC";
                                        $result_subject = $db->query($sub_query);
                                        if (mysqli_num_rows($result_subject) > 0) {
                                            foreach ($result_subject as $subject) {
                                        ?>
                                                  <tr class="border border-dark" style="text-transform: capitalize;">
                                                    <td class="border border-dark" scope="col" style="width:0; padding: 0; margin: 0; height: 30px;text-align:center; border: 2px solid #eee;">
                                                        <h7> <input type="text" name="subject[]" value="<?php echo $subject['subject']; ?>" style="font-size: 12px; padding: 0; margin: 0; width:300px; height:30px;text-align:center; border: 2px solid #fff;" readonly></h7>
                                                    </td>

                                                    <?php
                                                    $quarter_query = "SELECT * FROM `quarter` ORDER BY `qr_id` ASC";
                                                    $result_quarter = $db->query($quarter_query);
                                                    foreach ($result_quarter as $quarter) {

                                                        $school_query = "SELECT * FROM `school_information`";
                                                        $school_result = mysqli_query($db, $school_query);
                                                        $school = mysqli_fetch_array($school_result);

                                                        $tch_id = $_SESSION['tch_id'];
                                                        $teacher_query = "SELECT * FROM `user_list` WHERE `tch_id` = '" . $tch_id . "'";
                                                        $teacher_result = mysqli_query($db, $teacher_query);
                                                        $teacher = mysqli_fetch_array($teacher_result);

                                                        $qrtr = $quarter['quarter'] . "_quarter";
                                                        $sql_grade1 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "'  AND `subject` = '" . $subject['subject'] . "' AND $qrtr > 89 ";
                                                        $result_grade1 = mysqli_query($db, $sql_grade1);
                                                        $rws1 = mysqli_num_rows($result_grade1);
                                                    ?>


                                                        <td scope="col" class="border border-dark" >
                                                            <center>
                                                                <h7><?php echo $rws1; ?></h7>
                                                            </center>
                                                        </td>
                                                        <?php
                                                        $sql_grade2 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "' AND $qrtr > 83 AND $qrtr < 90 ";
                                                        $result_grade2 = mysqli_query($db, $sql_grade2);
                                                        $rws2 = mysqli_num_rows($result_grade2);
                                                        ?>
                                                        <td scope="col" class="border border-dark" >
                                                            <center>
                                                                <h7><?php echo $rws2; ?></h7>
                                                            </center>
                                                        </td>
                                                        <?php
                                                        $sql_grade3 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "' AND $qrtr > 79 AND $qrtr < 85 ";
                                                        $result_grade3 = mysqli_query($db, $sql_grade3);
                                                        $rws3 = mysqli_num_rows($result_grade3);
                                                        ?>
                                                        <td scope="col" class="border border-dark" >
                                                            <center>
                                                                <h7><?php echo $rws3; ?></h7>
                                                            </center>
                                                        </td>
                                                        <?php
                                                        $sql_grade4 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "'  AND $qrtr > 74 AND $qrtr < 80";
                                                        $result_grade4 = mysqli_query($db, $sql_grade4);
                                                        $rws4 = mysqli_num_rows($result_grade4);
                                                        ?>
                                                        <td scope="col" class="border border-dark" >
                                                            <center>
                                                                <h7><?php echo $rws4; ?></h7>
                                                            </center>
                                                        </td>
                                                        <?php
                                                        $sql_grade5 = "SELECT * FROM `student_grade` $declaration  `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "'  AND  $qrtr > 0 AND $qrtr < 75 ";
                                                        $result_grade5 = mysqli_query($db, $sql_grade5);
                                                        $rws5 = mysqli_num_rows($result_grade5);
                                                        ?>
                                                        <td scope="col" class="border border-dark" >
                                                            <center>
                                                                <h7><?php echo $rws5; ?></h7>
                                                            </center>
                                                        </td>

                                                    <?php } ?>
                                                </tr>
                                            <?php    }
                                        } else { ?>
                                            <tr class="border border-dark" >
                                                <td class="min-width" colspan="7" class="border border-dark" >
                                                    <center>No Grades-Data-Found!</center>
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




    <?php include '../include/footer.php'; ?>

</main>
<!-- ======== main-wrapper end =========== -->

<?php include '../include/teacher_bottom.php'; ?>


<?php
$adm_id = $_SESSION['adm_id'];
$admin_query = "SELECT * FROM `admin_list` WHERE adm_id = '" . $adm_id . "'";
$admin_result = mysqli_query($db, $admin_query);
$admin = mysqli_fetch_array($admin_result);
?>
<script>
    $(document).ready(function() {
        $('#student_record1').DataTable({
            "ordering": false,
            pagingType: 'full_numbers',
            pagingType: 'full_numbers',
            "aLengthMenu": [
                [5, 25, 50, 75, -1],
                [5, 25, 50, 75, "All"]
            ],
            "iDisplayLength": 5,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                title: '',
                alignment: 'center',
                header: true,
                footer: false,

                messageBottom: `<div class="footer-title">Prepared By: <?php echo $admin['firstname'] . " " . $admin['lastname']; ?></div>
                                   
                                        <div class="footer-date">Date Printed : as <?php echo date("m/d/Y") . " " . date("h:i:sa"); ?></div>
                                        <br>`,
                customize: function(data) {
                    $(data.document.body)
                        .css({
                            'background-color': '#ffffff',
                            'color': 'black'
                        })
                        .addClass('print-watermark')
                        .prepend(
                            `<div class="watermark-logo"> 
        <img src="../images/school-logo/LIS.jpg;" style="width: 90px; height: 90px; margin: 10% 0;" >
                                    </div>`
                        )
                        .addClass('print-custom')
                        .prepend(
                            `<div class="line1"><?php echo  $school['street'] . " Barangay " . $school['barangay'] . " " . $school['city']; ?></div>
                                    <div class="line2"><?php echo $school['school_name']; ?></div>
                                    <div class="line6"><?php echo $school['phone']; ?></div>
                                    <div class="content-title">Student Report</div>`
                        );
                    $(data.document.body).find('table')
                        .removeClass('display')
                        .addClass('print-table');
                    $(data.document.body).find('table span')
                        .removeClass('status-green')
                        .removeClass('status-teal')
                        .removeClass('status-orange')
                        .removeClass('status-teal')
                        .removeClass('status-red')
                        .removeClass('status-yellow');
                    $(data.document.body).find('table').find('img')
                        .css('width', '100px');
                },
                // exportOptions: {
                //     stripHtml: false,
                //     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                // }


            }],


        });
    });
</script>


</body>

</html>