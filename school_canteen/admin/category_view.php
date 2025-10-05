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
            <?php  include '../include/admin_header.php';
        ?>


        <div class="main-content">
            <!-- Bread crumb -->
            <div class="row" style=" padding: 1rem 0; background-color: #fff;">
                <div class="col-7 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>
                <div class="col-2 align-self-right">
                    <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#addCategory" style=" background-color:#6c8cc4; color:white; font-size:15px; color:white; margin-left:225%; ">
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
                                <h4 class="card-title">All Category data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Category Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Category Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody id="canteen_table">
                                            <?php
                                            $query = "SELECT * FROM `category` ORDER BY `c_id` DESC LIMIT 10";
                                            $result = mysqli_query($db, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr id="<?php echo $row['c_id']; ?>" class="text-center">
                                                        <td data-target="c_name"><?php echo $row['c_name']; ?></td>
                                                        <td data-target="upload">
                                                            <div class="col-md-3 col-lg-8 m-b-10">
                                                                <center><img src="../images/category/<?php echo $row['c_image']; ?>" class="img-responsive radius" style="width:180px; height:190px;" /></center>
                                                            </div>
                                                        </td>
                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <!-- <button class="btn btn-danger btn-sm m-b-10 category_delete button2" data-role="update" id=" -->
                                                            <?php
                                                            // echo $row['c_id']; 
                                                            ?>
                                                            <!-- "> -->
                                                            <!-- <i class='bx bxs-trash-alt' style="color:white;"></i></button> -->
                                                            <button class="btn btn-info btn-sm m-b-10 category_edit button1" data-bs-toggle="modal" data-bs-target="#updateCategory" value="<?= $row['c_id']; ?>" data-role="update" id="<?php echo $row['c_id']; ?>"><i class='bx bx-cog' style="color: white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="11">
                                                    <center>No Category-Data-Found!</center>
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
            <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="savecategory">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Food Canteen Name</label>
                                            <input type="text" name="category_name" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-danger">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="upload" class="form-control" />
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
            <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editcategory">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="id" id="id">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Category Name</label>
                                            <input type="text" name="c_name" id="updcategoryName" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-danger">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="upload" id="updcategoryImage" class="form-control" />
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
    $(document).on('submit', '#savecategory', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_category", true);
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
                        url: "category_process.php", //action
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
        $(document).on('click', '.category_edit', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "category_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        console.log(res);
                        $('#id').val(res.data.c_id);
                        $('#updcategoryName').val(res.data.c_name);
                        $('#updcategoryImage').val(res.data.c_image);
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editcategory', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_category", true);
            Swal.fire({
                title: 'Do you want to Update School Category?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "category_process.php", //action
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
        $('.category_delete').click(function() {
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
                        url: 'category_delete.php',
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