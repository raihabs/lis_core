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
                <div class="col-2 align-self-right">
                    <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#addSchool" style=" background-color:#6c8cc4; color:white; font-size:15px; color:white; margin-left:225%; ">
                        <b class="pb-2" style="color:white;">Add</b>
                    </button>
                </div>
            </div>
            <!-- End Bread crumb -->

            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Foods data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Genarated Codes</th>
                                                <th>Username</th>
                                                <th>Full Name</th>
                                                <th>Mark</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="canteen_table">
                                            <?php
                                            $user_id = $_SESSION['adm_id'];
                                            $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                            $res_u = mysqli_query($db, $sel_user);
                                            $show = mysqli_fetch_array($res_u);

                                            $code_query = "SELECT * FROM `admin_codes` WHERE user_role = 'admin' AND s_id = '" . $show['s_id'] . "' ORDER BY `cd_id` DESC";
                                            $result = mysqli_query($db, $code_query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr id="<?php echo $row['cd_id']; ?>" class="text-center">
                                                        <?php


                                                        $user_query = "SELECT * FROM `admin` WHERE username = '" . $row['username'] . "' ORDER BY `adm_id` DESC";
                                                        $user_res = mysqli_query($db, $user_query);
                                                        $u_ftch = mysqli_fetch_array($user_res);
                                                        ?>
                                                        <td data-target="codes"><?php echo $row['codes']; ?></td>
                                                        <td data-target="username"><?php echo $row['username']; ?></td>
                                                        <td data-target="fullname"><?php echo $u_ftch['firstname'] . " " . $u_ftch['surname']; ?></td>
                                                        <td data-target="mark"><?php echo $row['mark']; ?></td>
                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm m-b-10 code_delete button2" data-role="update" id="<?php echo $row['cd_id']; ?>"><i class='bx bxs-trash-alt' style="color:white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="11">
                                                    <center>No Codes-Data-Found!</center>
                                                </td>

                                            <?php }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Genarated Codes</th>
                                                <th>Username</th>
                                                <th>Full Name</th>
                                                <th>Mark</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
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
            <div class="modal fade" id="addSchool" tabindex="-1" aria-labelledby="schoolModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add School</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <form id="savecodes">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <?php $sql_user = "SELECT * FROM `admin_codes` ORDER BY `cd_id` DESC";
                                $res_user = mysqli_query($db, $sql_user);
                                $rw = mysqli_fetch_array($res_user);

                                if (is_array($rw)) {  ?>

                                    <div class="row p-t-20">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label class="control-label">Generated Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="" value="<?php $year = date("Y");
                                                                                                                                echo $year . "-" . sprintf('%05d', $rw['cd_id'] + 1);
                                                                                                                            } ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $sql_cd = "SELECT * FROM `admin_codes`";
                                    $res_cd = mysqli_query($db, $sql_cd);

                                    if (mysqli_num_rows($res_cd) > 0) {
                                        while ($ftch = mysqli_fetch_array($res_cd)) {
                                            $randString = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 8);
                                            if ($ftch['codes'] != $randString) {
                                                $newcode = $randString;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="row p-t-20">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label class="control-label">Generated Code</label>
                                                <input type="text" name="codes" class="form-control" placeholder="" value="<?php echo $randString; ?>" readonly>
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
    $(document).on('submit', '#savecodes', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_code", true);
        {
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "admin_codes_process.php", //action
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


    // Delete 
    $(document).ready(function() {
        $('.code_delete').click(function() {
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
                        url: 'admin_codes_delete.php',
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