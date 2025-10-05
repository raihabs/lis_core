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
                                <div class="title mb-30">

                                    <h2>Student Grades
                                    </h2>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-6">
                                <div class="breadcrumb-wrapper mb-30">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../admin-page/inndex.php">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Subjects View
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>



                    <!-- ========== tables-wrapper start ========== -->
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-style mb-30">
                                    <h6 class="mb-10">All Students Data</h6>

                                    <div class="table-wrapper table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <h6>Subject Id</h6>
                                                    </th>
                                                    <th>
                                                        <h6>LRN</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Year & Quarter Started</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Action</h6>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php


                                                $subject_query = "SELECT * FROM `subject_list` ";
                                                $res_query = mysqli_query($db, $subject_query);
                                                if (mysqli_num_rows($res_query) > 0) {
                                                    while ($row = mysqli_fetch_array($res_query)) {
                                                        $school_query = "SELECT * FROM `school_information`";
                                                        $school_result = mysqli_query($db, $school_query);
                                                        $school = mysqli_fetch_array($school_result);

                                                ?>

                                                        <tr style="text-transform: capitalize;">
                                                            <td class="min-width">
                                                                <h4> <b> <?php echo $num = $num + 1; ?> </b> </h4>
                                                            </td>
                                                            <td class="min-width">
                                                                <p><a href="#0"><?php echo $row['subject']; ?></a></p>
                                                            </td>
                                                            <td class="min-width">
                                                                <p><a href="#0"><?php echo $school['school_year'] . " - " . $school['school_quarter']; ?></a></p>
                                                            </td>

                                                            <td>
                                                                <div class="action">
                                                                    <a href="student_add_grades.php?subject=<?= $row['sub_id'] ?>" style="text-decoration:none;">
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
                                                            <center>No Subject-Data-Found!</center>
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