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
                    <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#addSection" style=" background-color:#6c8cc4; color:white; font-size:15px; color:white; margin-left:225%; ">
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
                                <h4 class="card-title">All Section data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Section</th>
                                                <th>Grade</th>
                                                <th>Location</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Section</th>
                                                <th>Grade</th>
                                                <th>Location</th>
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

                                            $query = "SELECT * FROM `section`  WHERE grade =  9 AND s_id = '" . $adm_id . "' ORDER BY `sc_id`";
                                            $result = mysqli_query($db, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr id="<?php echo $row['sc_id']; ?>" class="text-center">
                                                        <td data-target="section"><?php echo $row['section']; ?></td>
                                                        <td data-target="grade">grade <?php echo $row['grade']; ?></td>
                                                        <td data-target="location"><?php echo $row['location']; ?></td>

                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm m-b-10 section_delete button2" data-role="update" id="<?php echo $row['sc_id']; ?>"><i class='bx bxs-trash-alt' style="color:white;"></i></button>
                                                            <button class="btn btn-info btn-sm m-b-10 section_edit button1" data-bs-toggle="modal" data-bs-target="#updateSection" value="<?= $row['sc_id']; ?>" data-role="update" id="<?php echo $row['sc_id']; ?>"><i class='bx bx-cog' style="color: white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="11">
                                                    <center>No Section-Data-Found!</center>
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
            <div class="modal fade" id="addSection" tabindex="-1" aria-labelledby="sectionModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="savesection">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                            <input type="text" name="grade" value="9" class="form-control" placeholder="grade" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Section</label>
                                            <input type="text" name="section" class="form-control" placeholder="section">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Location</label>
                                            <textarea class="form-control" name="location" rows="3"></textarea>
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
            <div class="modal fade" id="updateSection" tabindex="-1" aria-labelledby="sectionModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editsection">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="id" id="id">


                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                            <input type="text" id="grade" name="grade" value="9" class="form-control" placeholder="grade" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Section</label>
                                            <input type="text" id="section" name="section" class="form-control" placeholder="section">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Location</label>
                                            <input type="text" id="location" name="location" class="form-control" placeholder="Room & Building">
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
    $(document).on('submit', '#savesection', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_section", true);
        {
            Swal.fire({
                title: 'Do you want to save the section?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "grade_section_process.php", //action
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
        $(document).on('click', '.section_edit', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "grade_section_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        console.log(res);
                        $('#id').val(res.data.sc_id);
                        $('#section').val(res.data.section);
                        $('#location').val(res.data.location);
                        $('#grade').val(res.data.grade);
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editsection', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_section", true);
            Swal.fire({
                title: 'Do you want to Update Grade Section?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "grade_section_process.php", //action
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
        $('.section_delete').click(function() {
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
                        url: 'grade_section_delete.php',
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