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
                                $user_id = $_SESSION['adm_id'];
                                $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                $res_creator = mysqli_query($db, $sel_user);
                                $show = mysqli_fetch_array($res_creator);
                                $s_id = $show['s_id'];

                                $query = "SELECT * FROM `canteen` WHERE s_id = '" . $s_id . "'";
                                $result = mysqli_query($db, $query);
                                $row = mysqli_fetch_array($result);
                                if (is_array($row)) { ?>
                                    <?php if (empty($row['image'])) {  ?>
                                        <div class="profileBorder">
                                            <i class="bx bx-user" style="font-size:155px;  height: fit-content;"></i>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../images/logo/<?php echo $row["image"] ?>" alt="Logo" class="rounded-circle" style="object-fit:cover;width:200px;height:200px;">
                                    <?php } ?>
                                    <h5 class="pt-4"><?php echo $row["school_name"]; ?></h5>

                                    <div class="pt-5">
                                        <button type="button" class="btn btn-primary profile_edit button1" data-bs-toggle="modal" data-bs-target="#updateLogo" value="<?= $row['adm_id']; ?>" data-role="update" id="<?php echo $row['adm_id']; ?>"><i class="bx bx-upload"></i></button>
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

                                <form id="editschool">
                                    <div class="modal-body">
                                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                                        <input type="hidden" name="id" id="id" value="<?php echo $row["s_id"]; ?>">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Food Canteen Name</label>
                                                    <input type="text" name="schl_name" id="updschoolName" class="form-control" placeholder="" value="<?php echo $row["school_name"]; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Bussiness E-mail</label>
                                                    <input type="text" name="email" id="updschoolEmail" class="form-control form-control-danger" placeholder="example@gmail.com" value="<?php echo $row["email"]; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Phone </label>
                                                    <input type="text" name="phone1" class="form-control" placeholder="" value="+639" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Phone </label>
                                                    <input type="text" name="phone2" class="form-control" placeholder="" placeholder="123.." pattern="[0-9]+" maxlength="9" value="<?php echo $row['phone'] = substr_replace($row['phone'], "", 0, 4); ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">website URL</label>
                                                    <input type="text" name="telephone" class="form-control form-control-danger" placeholder="(123) 12345)" value="<?php echo $row["telephone"]; ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">website URL</label>
                                                    <input type="text" name="url" class="form-control form-control-danger" placeholder="http://example.com" value="<?php echo $row["url"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Open Hours</label>
                                                    <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                                        <option value="<?php echo $row["o_hr"]; ?>"><?php echo $row["o_hr"]; ?></option>
                                                        <option value="6am">6am</option>
                                                        <option value="7am">7am</option>
                                                        <option value="8am">8am</option>
                                                        <option value="9am">9am</option>
                                                        <option value="10am">10am</option>
                                                        <option value="11am">11am</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Close Hours</label>
                                                    <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                                        <option value="<?php echo $row["c_hr"]; ?>"><?php echo $row["c_hr"]; ?></option>
                                                        <option value="3pm">3pm</option>
                                                        <option value="4pm">4pm</option>
                                                        <option value="5pm">5pm</option>
                                                        <option value="6pm">6pm</option>
                                                        <option value="7pm">7pm</option>
                                                        <option value="8pm">8pm</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Open Days</label>
                                                    <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="<?php echo $row["o_days"]; ?>"><?php echo $row["o_days"]; ?></option>
                                                        <option value="mon-tue">mon-tue</option>
                                                        <option value="mon-wed">mon-wed</option>
                                                        <option value="mon-thu">mon-thu</option>
                                                        <option value="mon-fri">mon-fri</option>
                                                        <option value="mon-sat">mon-sat</option>
                                                        <option value="24hr-x7">24hr-x7</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 ">
                                                <h3 class="box-title m-t-40">School Canteen Address</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <textarea name="address" type="text" style="height:100px;" class="form-control"><?php echo $row["address"]; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 ">
                                                <h3 class="box-title m-t-40">About Us</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <textarea name="about_us" type="text" style="height:100px;" class="form-control"><?php echo $row["about_us"]; ?></textarea>
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

                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->




            <!-- Update Modal Profile -->
            <div class="modal fade" id="updateLogo" tabindex="-1" aria-labelledby="logoModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Logo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editlogo">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="id" id="id" value="<?php echo $row['s_id'] ?>">

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
</div>

<?php } ?>

<?php include '../include/admin_bottom.php'; ?>


<script>
    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#editlogo', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_logo", true);
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
                        url: "canteen_logo_process.php", //action
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
        $(document).on('submit', '#editschool', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_info", true);
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
                        url: "canteen_process.php", //action
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
</script>