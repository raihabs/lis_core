<?php include 'config/config.php';

error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

   
    <title>CFOS</title>
    <link href="images/logo/cfoss.png" rel="icon">
    
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicons -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- Bread crumb -->
        <div class="row ms-5 mt-5" style=" padding: 1rem 0; background-color: #fff;">
            <div class="col-7 align-self-center">
                <h3 class="text-primary">Profile</h3>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row m-5">
                <div class="col-xl-4 ms-5">
                    <div class="card p-5">
                        <label> <strong>edit</strong> </label>
                        <h6 class="card-subtitle">use appropriate image, example: JPEG/JPG/PNG.</h6>
                        <hr>
                        <div class="card-body profile-card pt-5 d-flex flex-column align-items-center">
                            <?php
                            $id = $_SESSION['user_id'];
                            $loginquery = "SELECT * FROM `users` WHERE u_id = $id";
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
                                    <img src="images/user_profile/<?php echo $row["image"] ?>" alt="Profile" class="rounded-circle" style="object-fit:cover;width:200px;height:200px;">
                                <?php } ?>
                                <h5 class="pt-4" style="text-transform: capitalize;"><?php echo $row["firstname"] . " " . $row["lastname"] ?> </h5>
                                <h7><?php echo $row["username"]; ?></h7>
                                <div class="pt-5">
                                    <button type="button" class="btn btn-primary profile_edit button1" data-bs-toggle="modal" data-bs-target="#updateProfile" value="<?= $row['u_id']; ?>" data-role="update" id="<?php echo $row['u_id']; ?>"><i class="bx bx-upload" style="font-size:xx-large;"></i></button>
                                </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-7">
                    <div class="card p-3 mb-5">
                        <div class="card-body">
                            <label> <strong>edit</strong> </label>
                            <h6 class="card-subtitle">complete the following data below.</h6>
                            <hr>

                            <form id="edituser">
                                <div class="modal-body">
                                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                                    <input type="hidden" name="id" id="id" value="<?php echo $row["u_id"]; ?>">
                                    <div class="row p-t-20">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="control-label">Firstname</label>
                                                <input type="text" name="firstname" class="form-control" placeholder="" value="<?php echo $row["firstname"]; ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Lastname</label>
                                                <input type="text" name="lastname" class="form-control form-control-danger" value="<?php echo $row["lastname"]; ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-20">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Email</label>
                                                <input type="text" name="email"  class="form-control form-control-danger" placeholder="example@gmail.com" value="<?php echo $row["email"]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" name="phone1" class="form-control" placeholder="" value="+639" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" name="phone2" class="form-control" placeholder="" placeholder="123.." pattern="[0-9]+" maxlength="9" value="<?php echo $row['phone'] = substr_replace($row['phone'], "", 0, 4); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <h3 class="box-title m-t-40">Location</h3>
                                            <hr>
                                            <div class="form-group">
                                                <textarea name="location" type="text" style="height: 200px;" readonly class="form-control"><?php echo $row["location"]; ?></textarea>
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

                    <div class="card p-3 mb-5">
                        <div class="card-body pt-3">
                            <label> <strong>CHANGE PASSWORD </strong> </label>
                            <hr>
                            <form id="changePassword">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['u_id'] ?>">

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

                            <input type="hidden" name="id" id="id" value="<?php echo $row['u_id'] ?>">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label for="">Upload Image Profile</label>
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

        </div>



    <?php } ?>

    </main>

    <!-- ======= Footer ======= -->
    <?php include 'include/user_footer.php';?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="js/aos.js"></script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!-- <script src="js/popper.min.js"></script> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
    <script src="js/aos.js"></script>
    <script src="js/slider.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.6.0.js"></script>
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

    $(document).ready(function() {
        // new form update
        $(document).on('submit', '#edituser', function(e) {
            e.preventDefault();
            // alert("äw");
            var formData = new FormData(this);
            formData.append("update_user", true);
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

</script>
</body>

</html>