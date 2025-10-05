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
                    <h3 class="text-primary">Profile</h3>
                </div>
            </div>
            <!-- End Bread crumb -->

            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <label> <strong>edit</strong> </label>
                            <h6 class="card-subtitle">use appropriate image, example: JPEG/JPG/PNG.</h6>
                            <hr>
                            <div class="card-body profile-card pt-5 d-flex flex-column align-items-center">
                                <?php
                                $id = $_SESSION['adm_id'];
                                $loginquery = "SELECT * FROM `admin` WHERE adm_id = $id";
                                $result = mysqli_query($db, $loginquery);
                                $row = mysqli_fetch_array($result);
                                if (is_array($row)) { ?>
                                    <?php if (empty($row['image'])) {  ?>
                                        <div class="profileBorder">
                                            <i class="bx bx-user" style="font-size:155px;  height: fit-content;"></i>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../images/profile/<?php echo $row["image"] ?>" alt="Profile" class="rounded-circle" style="object-fit:cover;width:155px;height:155px;">
                                    <?php } ?>
                                    <h5 class="pt-4"><?php echo $row["firstname"] . " " . $row["surname"] ?> </h5>
                                    <h7><?php echo $row["username"]; ?></h7>
                                    <div class="pt-5">
                                        <button type="button" class="btn btn-primary profile_edit button1" data-bs-toggle="modal" data-bs-target="#updateProfile" value="<?= $row['adm_id']; ?>" data-role="update" id="<?php echo $row['adm_id']; ?>"><i class="bx bx-upload"></i></button>
                                        <!-- <button type="button" class="btn btn-danger profile_delete button2" data-role="update" id="<?php echo $row['adm_id']; ?>" data-bs-toggle="modal" data-bs-target="#addProfileModal"><i class="bx bx-trash"></i></button> -->
                                    </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <label> <strong>edit</strong> </label>
                                <h6 class="card-subtitle">complete the following data below.</h6>
                                <hr>

                                <form id="editadmin">
                                    <div class="modal-body">
                                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                                        <input type="hidden" name="id" id="id" value="<?= $row['adm_id']; ?>">

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">first name</label>
                                                    <input type="text" name="firstname" id="adminFirstname" class="form-control form-control-danger" placeholder="" value="<?= $row['firstname']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">middle name</label>
                                                    <input type="text" name="middlename" id="adminMiddlename" class="form-control" placeholder="" value="<?= $row['middlename']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">last lame</label>
                                                    <input type="text" name="surname" id="adminSurname" class="form-control form-control-danger" placeholder="" value="<?= $row['surname']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">email</label>
                                                    <input type="text" name="email" id="adminEmail" class="form-control" placeholder="" value="<?= $row['email']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-2">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">phone</label>
                                                    <input type="text" name="phone1" id="adminPhone1" class="form-control form-control-danger" placeholder="+639" value="+639" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">number</label>
                                                    <input type="text" name="phone2" id="adminPhone2" class="form-control form-control-danger" placeholder="123.." pattern="[0-9]+" maxlength="9" value="<?php echo $row['phone'] = substr_replace($row['phone'], "", 0, 4); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="addressField" class="col-md-6 form-label">city</label>
                                                    <select name="city" id="city" class="form-control" onchange="FetchUpdateBarangay(this.value)" required>
                                                        <?php
                                                        $sql_c1 = "SELECT * FROM city WHERE c_id = '" . $row['c_id'] . "'";
                                                        $res_c1 = mysqli_query($db, $sql_c1);
                                                        $res1 = $res_c1->fetch_assoc();
                                                        echo '<option value=' . $res1['c_id'] . '>' . $res1['c_name'] . '</option>';
                                                        ?>
                                                        <?php
                                                        $sql_c2 = "SELECT * FROM city";
                                                        $res_c2 = mysqli_query($db, $sql_c2);

                                                        while ($res2 = $res_c2->fetch_assoc()) {
                                                            echo '<option value=' . $res2['c_id'] . '>' . $res2['c_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="addressField" class="col-md-6 form-label">barangay</label>
                                                    <select name="barangay" id="barangay" class="form-control" required>
                                                        <?php
                                                        $sql_b = "SELECT * FROM barangay WHERE b_id = '" . $row['b_id'] . "'";
                                                        $res_b = mysqli_query($db, $sql_b);
                                                        $res1 = $res_b->fetch_assoc();
                                                        echo '<option value=' . $res1['b_id'] . '>' . $res1['b_name'] . '</option>';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="addressField" class="col-md-6 form-label">street</label>
                                                    <input type="text" class="form-control" id="street" name="street" placeholder="street #" required value="<?= $row['street']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body pt-3">
                                <label> <strong>CHANGE PASSWORD </strong> </label>
                                <hr>
                                <form id="changePassword">
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['adm_id'] ?>">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword1" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword2" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->




            <!-- Update Modal Profile -->
            <div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="profileModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editprofile">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="id" id="id" value="<?php echo $row['adm_id'] ?>">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-danger">
                                            <label for="">Upload Image Profile</label>
                                            <input type="file" name="upload" id="updprofileImage" class="form-control" />
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

<?php } ?>

<?php include '../include/admin_bottom.php'; ?>


<script>
    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editprofile', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_profile", true);
            Swal.fire({
                title: 'Do you want to Update your Profile?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
                denyButtonText: `Don't Update`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "admin_profile_process.php", //action
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

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#changePassword', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_password", true);
            Swal.fire({
                title: 'Do you want to update your password',
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
        $('.profile_delete').click(function() {
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
                        url: 'admin_profile_delete.php',
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