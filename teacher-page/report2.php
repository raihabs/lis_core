<!DOCTYPE html>
<?php
include '../config/config.php';

error_reporting(0);
session_start();


?>
<html lang="en">

<head>
    <style>
        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        .table-striped tbody>tr:nth-child(odd)>td,
        .table-striped tbody>tr:nth-child(odd)>th {
            background-color: #f9f9f9;
        }

        @media print {
            #print {
                display: none;
            }
        }

        @media print {
            #PrintButton {
                display: none;
            }
        }

        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>

    <?php
    // $date = date("Y-m-d h:i:s", strtotime("+20 HOURS"));
    // echo $date;
    $declaration = base64_decode($_GET['declaration']);


    $school_query = "SELECT * FROM `school_information`";
    $school_result = mysqli_query($db, $school_query);
    $school = mysqli_fetch_array($school_result);

    $tch_id = $_SESSION['tch_id'];
    $teacher_query = "SELECT * FROM `user_list` WHERE `tch_id` = '" . $tch_id . "'";
    $teacher_result = mysqli_query($db, $teacher_query);
    $teacher = mysqli_fetch_array($teacher_result);

    $declared_grade = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' ";
    $result_declared_grade = mysqli_query($db, $declared_grade);
    $declared = mysqli_fetch_array($result_declared_grade);


    $section_query = "SELECT * FROM `grade_section` WHERE  `gs_id` = " .  $teacher['section'] . " ";
    $section_result = mysqli_query($db, $section_query);
    $section = mysqli_fetch_array($section_result);


    ?>


    <h2 style="text-align:center;">Looc integrated School</h2>
    <div class="line2" style="text-align:center;">09627772637</div>
    <div class="line6" style="text-align:center;">Looc Calamba City, Laguna</div>
    <div class="content-title" style="text-align:center;">School Report</div>
    <div class="content-title" style="text-align:center;"><?php echo $school['school_year']; ?></div>
    <br /> <br /> <br /> <br />
    <b style="color:blue;">Grade Level: </b><?php echo $declared['grade_level']; ?><br>
    <b style="color:blue;">Section: </b><?php echo $section['section']; ?><br>
    <b style="color:blue;">Date Prepared:<span></b>
    <?php

    date_default_timezone_set('Asia/Manila');
    $created_date = date("Y-m-d h:i:s");
    echo $created_date;

    ?>
    <br /><br />

    <div class="table-wrapper table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th rowspan="2" class="border border-dark">
                    <center>LEARNING AREAS</center>
                </th>
                <th colspan="5" scope="colgroup" class="border border-dark">
                    <center>1st Quarter</center>
                </th>
                <th colspan="5" scope="colgroup" class="border border-dark">
                    <center>2nd Quarter</center>
                </th>
                <th colspan="5" scope="colgroup" class="border border-dark">
                    <center>3rd Quarter</center>
                </th>
                <th colspan="5" scope="colgroup" class="border border-dark">
                    <center>4th Quarter</center>
                </th>

            </tr>
            <tr>
                <th scope="col" class="border border-dark">
                    <center>90-100</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>85-89</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>80-84</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75-79</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75 below</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>90-100</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>85-89</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>80-84</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75-79</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75 below</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>90-100</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>85-89</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>80-84</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75-79</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>75 below</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>90-100</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>85-89</center>
                </th>
                <th scope="col" class="border border-dark">
                    <center>80-84</center>
                </th>
                <th scope="col" class="border border-dark">
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


                                <td scope="col" class="border border-dark">
                                    <center>
                                        <h7><?php echo $rws1; ?></h7>
                                    </center>
                                </td>
                                <?php
                                $sql_grade2 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "' AND $qrtr > 83 AND $qrtr < 90 ";
                                $result_grade2 = mysqli_query($db, $sql_grade2);
                                $rws2 = mysqli_num_rows($result_grade2);
                                ?>
                                <td scope="col" class="border border-dark">
                                    <center>
                                        <h7><?php echo $rws2; ?></h7>
                                    </center>
                                </td>
                                <?php
                                $sql_grade3 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "' AND $qrtr > 79 AND $qrtr < 85 ";
                                $result_grade3 = mysqli_query($db, $sql_grade3);
                                $rws3 = mysqli_num_rows($result_grade3);
                                ?>
                                <td scope="col" class="border border-dark">
                                    <center>
                                        <h7><?php echo $rws3; ?></h7>
                                    </center>
                                </td>
                                <?php
                                $sql_grade4 = "SELECT * FROM `student_grade` $declaration `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "'  AND $qrtr > 74 AND $qrtr < 80";
                                $result_grade4 = mysqli_query($db, $sql_grade4);
                                $rws4 = mysqli_num_rows($result_grade4);
                                ?>
                                <td scope="col" class="border border-dark">
                                    <center>
                                        <h7><?php echo $rws4; ?></h7>
                                    </center>
                                </td>
                                <?php
                                $sql_grade5 = "SELECT * FROM `student_grade` $declaration  `grade_level` = " .  $teacher['grade_level'] . " AND  `section` = " .  $teacher['section'] . " AND  `school_year_start` = '" .  $school['school_year'] . "' AND `subject` = '" . $subject['subject'] . "'  AND  $qrtr > 0 AND $qrtr < 75 ";
                                $result_grade5 = mysqli_query($db, $sql_grade5);
                                $rws5 = mysqli_num_rows($result_grade5);
                                ?>
                                <td scope="col" class="border border-dark">
                                    <center>
                                        <h7><?php echo $rws5; ?></h7>
                                    </center>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php    }
                } else { ?>
                    <tr class="border border-dark">
                        <td class="min-width" colspan="7" class="border border-dark">
                            <center>No Grades-Data-Found!</center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
        <!-- end table -->
    </div>
    <center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
<script type="text/javascript">
    function PrintPage() {
        window.print();
    }
    document.loaded = function() {

    }
    window.addEventListener('DOMContentLoaded', (event) => {
        PrintPage()
        setTimeout(function() {
            window.close()
        }, 750)
    });
</script>

</html>