<?php
include '../include/admin_meta_data.php';
include '../include/admin_top.php';
include '../config/config.php';

error_reporting(0);
session_start();
?>

<div class="wrapper">
        <div class="body-overlay"></div>
        <?php
        $user_id = $_SESSION['adm_id'];
        $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
        $res_creator = mysqli_query($db, $sel_user);
        $show = mysqli_fetch_array($res_creator);
        $adm_id = $show['s_id'];
        if ($show['user_role'] == 'super-admin') {
            include '../include/admin_super_sidebar.php';
        } else if ($show['user_role'] == 'admin') {
            include '../include/admin_sidebar.php';
        }
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
        $user_id = $_SESSION['adm_id'];
        $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
        $res_creator = mysqli_query($db, $sel_user);
        $show = mysqli_fetch_array($res_creator);
        $adm_id = $show['s_id'];
        if ($show['user_role'] == 'super-admin') {
            include '../include/admin_header_super.php';
        } else if ($show['user_role'] == 'admin') {
            include '../include/admin_header.php';
        }
        ?>
        <div class="main-content">
            <!-- Bread crumb -->
            <div class="row" style=" padding: 1rem 0; background-color: #fff;">
                <div class="col-7 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>
                <!-- <div class="col-2 align-self-right">
                    <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#addStudent" style=" background-color:#6c8cc4; color:white; font-size:15px; color:white; margin-left:225%; ">
                        <b class="pb-2" style="color:white;">Add</b>
                    </button>
                </div> -->
            </div>
            <!-- End Bread crumb -->

            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Student data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>UserName</th>
                                                <th>Full Name</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Delivery Location</th>
                                                <th>Mark</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>UserName</th>
                                                <th>Full Name</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Delivery Location</th>
                                                <th>Mark</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody id="canteen_table">
                                            <?php
                                            session_start();
                                            $user_id = $_SESSION['adm_id'];
                                            $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                            $res_creator = mysqli_query($db, $sel_user);
                                            $show = mysqli_fetch_array($res_creator);
                                            $adm_id = $show['s_id'];

                                            $query = "SELECT * FROM `users`  WHERE user_type = 'grade 11' AND s_id = '" . $adm_id . "' ORDER BY `u_id` DESC";
                                            $result = mysqli_query($db, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {

                                                    $sel_user = "SELECT * FROM `username` WHERE username = '" . $row['username'] . "'";
                                                    $res_user = mysqli_query($db, $sel_user);
                                                    $show = mysqli_fetch_array($res_user);
                                                    $mark = $show['mark'];
                                            ?>
                                                    <tr id="<?php echo $row['u_id']; ?>" class="text-center">
                                                        <td data-target="username"><?php echo $row['username']; ?></td>
                                                        <td data-target="fname"><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                        <td data-target="usertype"><?php echo $row['user_type']; ?></td>
                                                        <td data-target="email"><?php echo $row['email']; ?></td>
                                                        <td data-target="phone"><?php echo $row['phone']; ?></td>
                                                        <td data-target="location"><?php echo $row['location']; ?></td>
                                                        <td data-target="mark"><?php echo $mark; ?></td>
                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm m-b-10 student_delete button2" data-role="update" id="<?php echo $row['u_id']; ?>"><i class='bx bxs-trash-alt' style="color:white;"></i></button>
                                                            <button class="btn btn-info btn-sm m-b-10 student_edit button1" data-bs-toggle="modal" data-bs-target="#updateStudent" value="<?= $row['u_id']; ?>" data-role="update" id="<?php echo $row['u_id']; ?>"><i class='bx bx-cog' style="color: white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="11">
                                                    <center>No Student-Data-Found!</center>
                                                </td>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->


            <!-- Add Modal -->
            <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="studentModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="savestudent">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                            <select name="grade" id="grade" class="form-control custom-select" data-placeholder="Choose Grade" tabindex="1" onchange="FetchAddSection(this.value)">
                                                <?php
                                                $query = "SELECT sc_id, g_id, grade, COUNT(*) as name_count FROM section where `date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY grade";
                                                $result = $db->query($query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    foreach ($result as $res) {
                                                        echo '<option value=' . $res['grade'] . '> grade ' . $res['grade'] . '</option>';
                                                    }
                                                } ?>
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">section</label>
                                            <select name="section" id="section" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">LRN</label>
                                            <input type="text" name="lrn" class="form-control" placeholder="lrn">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" placeholder="firstname">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" placeholder="lastname">
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
            <div class="modal fade" id="updateStudent" tabindex="-1" aria-labelledby="studentModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editstudent">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <input type="text" name="id" id="id">

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Firstname</label>
                                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Lastname</label>
                                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">email</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                            <label class="control-label">phone</label>
                                            <input type="text" name="phone1" id="phone1" class="form-control form-control-danger" placeholder="+639" value="+639" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-danger">
                                            <label class="control-label">number</label>
                                            <input type="text" name="phone2" id="phone2" class="form-control form-control-danger" placeholder="123.." pattern="[0-9]+" maxlength="9">
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

        </div>
    </div>
</div>


<?php include '../include/admin_bottom.php'; ?>


<script>
    // Add Modal
    // $(document).on('submit', '#savestudent', function(e) {
    //     e.preventDefault();
    //     var formData = new FormData(this);
    //     formData.append("valid_student", true);
    //     {
    //         Swal.fire({
    //             title: 'Do you want to save the student info?',
    //             showDenyButton: true,
    //             showCancelButton: true,
    //             confirmButtonText: 'Save',
    //             denyButtonText: `Don't save`,
    //         }).then((result) => {
    //             /* Read more about isConfirmed, isDenied below */
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     type: "POST",
    //                     url: "user_process.php", //action
    //                     data: formData,
    //                     processData: false,
    //                     contentType: false,
    //                     success: function(response) {
    //                         var res = jQuery.parseJSON(response);
    //                         if (res.status == 400) {
    //                             Swal.fire({
    //                                 icon: 'warning',
    //                                 title: 'Something Went Wrong.',
    //                                 text: res.msg,
    //                                 timer: 3000
    //                             })
    //                         } else if (res.status == 500) {
    //                             Swal.fire({
    //                                 icon: 'warning',
    //                                 title: 'Something Went Wrong.',
    //                                 text: res.msg,
    //                                 timer: 3000
    //                             })
    //                         } else if (res.status == 200) {
    //                             Swal.fire({
    //                                 icon: 'success',
    //                                 title: 'SUCCESS',
    //                                 text: res.msg,
    //                                 timer: 2000
    //                             }).then(function() {
    //                                 location.reload();
    //                             });
    //                         }
    //                     }
    //                 })
    //             } else if (result.isDenied) {
    //                 Swal.fire('Changes are not saved', '', 'info').then(function() {
    //                     location.reload();
    //                 });
    //             }
    //         })
    //     }
    // });

    // Update for Files
    $(document).ready(function() {
        $(document).on('click', '.student_edit', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "user_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        console.log(res);
                        $('#id').val(res.data.u_id);
                        $('#firstname').val(res.data.firstname);
                        $('#lastname').val(res.data.lastname);
                        $('#email').val(res.data.email);
                        $('#phone2').val(res.data.phone);
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editstudent', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_student", true);
            Swal.fire({
                title: 'Do you want to Update Student?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "user_process.php", //action
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

        });

    });

    // Delete 
    $(document).ready(function() {
        $('.student_delete').click(function() {
            var del_id = $(this).attr('id');
            var $ele = $(this).parent().parent();
            Swal.fire({
                title: 'Are you Sure?',
                text: "You won't be able to recover this file!",
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
                        url: 'user_delete2.php',
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
            url: 'section_add_data.php',
            data: {
                grade: grade
            },
            success: function(data) {
                $('#section').html(data);
            }
        })
    }
</script>