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
            </div>
            <!-- End Bread crumb -->

            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Admin Staff Data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Barangay</th>
                                                <th>Street</th>
                                                <th>School Name</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Username</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Barangay</th>
                                                <th>Street</th>
                                                <th>School Name</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody id="canteen_table">
                                            <?php
                                            $user_id = $_SESSION['adm_id'];
                                            $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                            $res_creator = mysqli_query($db, $sel_user);
                                            $show = mysqli_fetch_array($res_creator);
                                            $adm_id = $show['s_id'];
                                            $query = "SELECT * FROM `admin` WHERE   user_role = 'admin' AND s_id = '" . $adm_id . "' ORDER BY `adm_id` DESC";
                                            $result = mysqli_query($db, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr id="<?php echo $row['adm_id']; ?>" class="text-center">
                                                        <td data-target="username"><?php echo $row['username']; ?></td>
                                                        <td data-target="firstname"><?php echo $row['firstname']; ?></td>
                                                        <td data-target="middle_name"><?php echo $row['middlename']; ?></td>
                                                        <td data-target="surname"><?php echo $row['surname']; ?></td>
                                                        <td data-target="email"><?php echo $row['email']; ?></td>
                                                        <td data-target="phone"><?php echo $row['phone']; ?></td>

                                                        <?php
                                                        $res_c = mysqli_query($db, "SELECT * FROM `city` WHERE c_id = '" . $row['c_id'] . "'");
                                                        $c_ftch = mysqli_fetch_array($res_c);
                                                        ?>
                                                        <td data-target="city"><?php echo $c_ftch['c_name']; ?></td>

                                                        <?php
                                                        $res_b = mysqli_query($db, "SELECT * FROM `barangay` WHERE b_id='" . $row['b_id'] . "'");
                                                        $b_ftch = mysqli_fetch_array($res_b);
                                                        ?>
                                                        <td data-target="barangay"><?php echo $b_ftch['b_name']; ?></td>

                                                        <td data-target="street"><?php echo $row['street']; ?></td>
                                                        <?php
                                                        $sql_canteen = "SELECT * FROM `canteen` WHERE s_id='" . $row['s_id'] . "'";
                                                        $res_canteen = mysqli_query($db, $sql_canteen);
                                                        $fetch_canteen = mysqli_fetch_array($res_canteen);
                                                        ?>
                                                        <td data-target="school_name"><?php echo $fetch_canteen['school_name']; ?></td>


                                                        <td data-target="upload">
                                                            <div class="col-md-3 col-lg-8 m-b-10">
                                                                <center><img src="../images/profile/<?php echo $row['image']; ?>" class="img-responsive radius" style="width:230px; height:230px;" /></center>
                                                            </div>
                                                        </td>
                                                        <td><?php echo date('m-d-Y H:i A', strtotime($row['date'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm m-b-10 info_delete button2" data-role="update" id="<?php echo $row['adm_id']; ?>"><i class='bx bxs-trash-alt' style="color:white;"></i></button>
                                                            <button class="btn btn-info btn-sm m-b-10 info_edit button1" data-bs-toggle="modal" data-bs-target="#updateAdmin" value="<?= $row['adm_id']; ?>" data-role="update" id="<?php echo $row['adm_id']; ?>"><i class='bx bx-cog' style="color: white;"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <td colspan="13">
                                                    <center>No Admin-Data-Found!</center>
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


            <!-- Update Modal -->
            <div class="modal fade" id="updateAdmin" tabindex="-1" aria-labelledby="adminModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editadmin">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>
                                <input type="hidden" name="id" id="id">

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">username</label>
                                            <input type="text" name="username" id="adminUsername" class="form-control" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">first name</label>
                                            <input type="text" name="firstname" id="adminFirstname" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">middle name</label>
                                            <input type="text" name="middlename" id="adminMiddlename" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">last lame</label>
                                            <input type="text" name="surname" id="adminSurname" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">email</label>
                                            <input type="text" name="email" id="adminEmail" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                            <label class="control-label">phone</label>
                                            <input type="text" name="phone1" id="adminPhone1" class="form-control form-control-danger" placeholder="+639" value="+639" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-danger">
                                            <label class="control-label">number</label>
                                            <input type="text" name="phone2" id="adminPhone2" class="form-control form-control-danger" placeholder="123.." pattern="[0-9]+" maxlength="9">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="addressField" class="col-md-3 form-label">city</label>
                                            <select name="city" id="city" class="form-control" onchange="FetchUpdateBarangay(this.value)" required>
                                                <option value="">city</option>
                                                <?php
                                                $query = "SELECT * FROM city";
                                                $result = mysqli_query($db, $query);

                                                while ($res = $result->fetch_assoc()) {
                                                    echo '<option value=' . $res['c_id'] . '>' . $res['c_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="addressField" class="col-md-3 form-label">barangay</label>
                                            <select name="barangay" id="barangay" class="form-control" required>
                                                <option>barangay</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="addressField" class="col-md-3 form-label">street</label>
                                            <input type="text" class="form-control" id="street" name="street" placeholder="street #" required>
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
    // Update for Files
    $(document).ready(function() {
        $(document).on('click', '.info_edit', function() {

            var edit_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "admin_get_data.php?edit_id=" + edit_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        console.log(res);
                        $('#id').val(res.data.adm_id);
                        $('#adminUsername').val(res.data.username);
                        $('#adminFirstname').val(res.data.firstname);
                        $('#adminMiddlename').val(res.data.middlename);
                        $('#adminSurname').val(res.data.surname);
                        $('#adminEmail').val(res.data.email);
                        $('#adminPhone2').val(res.data.phone);
                        $('#street').val(res.data.street);
                    }
                    // $('#memo').html(data);
                }

            });
        });
    });

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editadmin', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_admin", true);
            Swal.fire({
                title: 'Do you want to update your contact details?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "admin_process.php", //action
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
        $('.info_delete').click(function() {
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
                        url: 'admin_delete.php',
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
    function FetchUpdateBarangay(c_id) {
        $('#barangay').html('');
        $.ajax({
            type: 'post',
            url: 'address_update_data.php',
            data: {
                city_id: c_id
            },
            success: function(data) {
                $('#barangay').html(data);
            }
        })
    }
</script>