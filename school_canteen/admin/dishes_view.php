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
                <div class="col-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>

                <div class="col-2 align-self-right">
                    <button type="button" name="available" class="btn float-end" style=" background-color:red; color:white; font-size:15px; color:white; margin-left:275%; ">
                        <a href="dishes_view2.php"><b class="pb-2" style="color:white;">Unavailable</b></a>
                    </button>
                </div>
                <div class="col-2 align-self-right">
                    <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#addDishes" style=" background-color:#6c8cc4; color:white; font-size:15px; color:white; margin-left:225%; ">
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
                                <h4 class="card-title">All Available Foods Data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Dishes Name</th>
                                                <th>Small Description</th>
                                                <th>Long Description</th>
                                                <th>Original Price</th>
                                                <th>Selling Price</th>
                                                <th>Category</th>
                                                <th>Stock</th>
                                                <th>Dishes Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Dishes Name</th>
                                                <th>Small Description</th>
                                                <th>Long Description</th>
                                                <th>Original Price</th>
                                                <th>Selling Price</th>
                                                <th>Category</th>
                                                <th>Stock</th>
                                                <th>Dishes Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody id="dishes_table">
                                            <?php
                                            session_start();
                                            $user_id = $_SESSION['adm_id'];
                                            $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                            $res_creator = mysqli_query($db, $sel_user);
                                            $show = mysqli_fetch_array($res_creator);
                                            $adm_id = $show['s_id'];

                                            $query = "SELECT * FROM `dishes`  WHERE stock > 0 AND s_id = '" . $adm_id . "'  ORDER BY `date` DESC";
                                            $result = mysqli_query($db, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {  ?>
                                                    <tr id="<?php echo $row['d_id']; ?>" class="text-center">
                                                        <td data-target="dishes_name"><?php echo $row['dishes_name']; ?></td>
                                                        <td data-target="description1"><?php echo $row['small_description']; ?></td>
                                                        <td data-target="description2"><?php echo $row['long_description']; ?></td>
                                                        <td data-target="price1"><?php echo $row['original_price']; ?></td>
                                                        <td data-target="price2"><?php echo $row['selling_price']; ?></td>



                                                        <?php $sql_category = "SELECT * FROM `category` WHERE c_id='" . $row['c_id'] . "'";
                                                        $res_category = mysqli_query($db, $sql_category);
                                                        $fetch_category = mysqli_fetch_array($res_category); ?>
                                                        <td data-target="category"><?php echo $fetch_category['c_name']; ?></td>


                                                        <td data-target="stock"><?php echo $row['stock']; ?></td>
                                                        <td data-target="upload">
                                                            <div class="col-md-3 col-lg-8 m-b-10">
                                                                <center><img src="../images/dishes/<?php echo $row['d_image']; ?>" class="img-responsive radius" style="width:180px; height:230px;" /></center>
                                                            </div>
                                                        </td>

                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $row['d_id']; ?>"><i class='bx bxs-trash-alt' style="color:white;"></i></button>
                                                            <button class="btn btn-info btn-sm m-b-10 menu_edit button1" data-bs-toggle="modal" data-bs-target="#updateDishes" value="<?= $row['d_id']; ?>" data-role="update" id="<?php echo $row['d_id']; ?>"><i class='bx bx-cog' style="color: white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="11">
                                                    <center>No Dishes-Data-Found!</center>
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
            <div class="modal fade" id="addDishes" tabindex="-1" aria-labelledby="dishesModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Dishes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="savedishes">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="control-label">Item Name</label>
                                            <input type="text" name="dishes_name" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Small Description</label>
                                            <textarea type="text" name="small_description" style="height:100px;" class="form-control form-control-danger"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Long Description</label>
                                            <textarea type="text" name="long_description" style="height:100px;" class="form-control form-control-danger"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Original Price</label>
                                            <input type="text" name="price1" class="form-control" placeholder="" pattern="[0-9]+" maxlength="5">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Selling Price</label>
                                            <input type="text" name="price2" class="form-control" placeholder="" pattern="[0-9]+" maxlength="5">
                                        </div>
                                    </div>
                                </div>


                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">category</label>
                                            <select name="category" class="form-control custom-select" data-placeholder="Choose a Category" required>
                                                <option>--Select your category--</option>

                                                <?php
                                                $query = "SELECT * FROM category";
                                                $result = mysqli_query($db, $query);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value=' . $row['c_id'] . '>' . $row['c_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Stock</label>
                                            <input type="text" name="stock" class="form-control" placeholder="stock" pattern="[0-9]+" maxlength="5">
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
            <div class="modal fade" id="updateDishes" tabindex="-1" aria-labelledby="dishesModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Dishes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editdishes">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>
                                <input type="hidden" name="id" id="id">

                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="control-label">Item Name</label>
                                            <input type="text" name="dishes_name" id="upditemName" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Small Description</label>
                                            <textarea type="text" name="small_description" id="upditemSmallDescription" style="height:100px;" class="form-control form-control-danger"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="row p-t-20">
                                    <div class="col-sm">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Long Description</label>
                                            <textarea type="text" name="long_description" id="upditemLongDescription" style="height:100px;" class="form-control form-control-danger"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Original Price</label>
                                            <input type="text" name="originalPrice" id="upditemPrice1" class="form-control" placeholder="" pattern="[0-9]+" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Selling Price</label>
                                            <input type="text" name="sellingPrice" id="upditemPrice2" class="form-control" placeholder="" pattern="[0-9]+" maxlength="5">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">category</label>
                                            <select name="category" id="upditemCategory" class="form-control custom-select" data-placeholder="Choose a Category" required>
                                                <option>--Select your category--</option>

                                                <?php
                                                $query = "SELECT * FROM category";
                                                $result = mysqli_query($db, $query);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value=' . $row['c_id'] . '>' . $row['c_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Stock</label>
                                            <input type="text" name="stock" id="stock" class="form-control" placeholder="stock" pattern="[0-9]+" maxlength="5">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-danger">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="upload" id="upditemImage" class="form-control" />
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
    $(document).on('submit', '#savedishes', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_menu", true);
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
                        url: "dishes_process.php", //action
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
        $(document).on('click', '.menu_edit', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "dishes_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        console.log(res);
                        $('#id').val(res.data.d_id);
                        $('#updSchoolName').val(res.data.s_id);
                        $('#upditemCategory').val(res.data.c_id);
                        $('#upditemName').val(res.data.dishes_name);
                        $('#upditemSmallDescription').val(res.data.small_description);
                        $('#upditemLongDescription').val(res.data.long_description);
                        $('#upditemPrice1').val(res.data.original_price);
                        $('#upditemPrice2').val(res.data.selling_price);
                        $('#stock').val(res.data.stock);
                        $('#upditemImage').val(res.data.d_image);
                    }
                    // $('#memo').html(data);
                }

            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editdishes', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_menu", true);
            Swal.fire({
                title: 'Do you want to Update School Menu?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "dishes_process.php", //action
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
        $('.menu_delete').click(function() {
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
                        url: 'dishes_delete.php',
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