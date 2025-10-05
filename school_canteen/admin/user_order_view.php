<!DOCTYPE html>
<html lang="en">
<?php
// Start the session

?>
</head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<title>CFOS</title>
<link href="images/logo/cfos.png" rel="icon">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!----css3---->
<link rel="stylesheet" href="../css/admin_sidebar_header.css">
<link rel="stylesheet" href="css/style.css">
<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<!--google material icon-->
<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<!-- sweetalert message -->
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="page.css"> -->

   
<title>CFOS</title>
    <link href="../images/logo/cfoss.png" rel="icon">

<!-- Template Main CSS File -->
<link href="../assets/css/style.css" rel="stylesheet">

<!--  -->



<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
include '../include/admin_top.php';
include '../config/config.php';
error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header("Location: ../admin/dashboard.php");
} else {

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


                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card card-stats">
                                <!-- ======= Records Section ======= -->
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card mt-5">
                                                
                                                <div class="card-body">

                                                    <form action="" method="GET">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>From Date</label>
                                                                    <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                                                                    echo $_GET['from_date'];
                                                                                                                } ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>To Date</label>
                                                                    <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                                                                    echo $_GET['to_date'];
                                                                                                                } ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Click to Filter</label> <br>
                                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="card mt-4">
                                                <div class="card-body">
                                                    <table class="table table-borderd">
                                                        <thead>
                                                            <tr>
                                                                <th>Order Code</th>
                                                                <th>Date</th>
                                                                <th>Full Name</th>
                                                                <th>Order Product</th>
                                                                <th>Order QTY</th>
                                                                <th>Order Price</th>
                                                                <th>Order SUBTOTAL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $user_id = $_SESSION['adm_id'];
                                                            $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                                                            $res_creator = mysqli_query($db, $sel_user);
                                                            $show = mysqli_fetch_array($res_creator);
                                                            $adm_id = $show['s_id'];

                                                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                                                $from_date = $_GET['from_date'];
                                                                $to_date = $_GET['to_date'];

                                                                $query = "SELECT * FROM users_orders WHERE `date` BETWEEN '$from_date' AND '$to_date' AND s_id = '$adm_id' AND status = 'Delivered' ";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    foreach ($query_run as $row) {
                                                            ?>
                                                                        <tr>
                                                                            <td><?= $row['order_code']; ?></td>
                                                                            <td><?= $row['date']; ?></td>
                                                                            <td><?= $row['firstname'] . " " . $row['lastname']; ?></td>
                                                                            <td><?= $row['dishes_name']; ?></td>
                                                                            <td><?= $row['d_qty']; ?></td>
                                                                            <td><?= $row['selling_price']; ?></td>
                                                                            <?php
                                                                            $subtotal = $row['d_qty'] * $row['selling_price'];
                                                                            $total =  $total + $subtotal ?>
                                                                            <td><?php echo $subtotal; ?></td>
                                                                        </tr>
                                                            <?php
                                                                    }
                                                                } else {
                                                                    echo "No Record Found";
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="6">Total</th>
                                                                <th colspan="1" style="text-align: right;"><?php echo $total; ?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



        </div>
        <!-- Vendor JS Files -->
        <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="../assets/vendor/aos/aos.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../assets/js/main.js"></script>

        <script src="../js/aos.js"></script>

        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <!-- <script src="js/popper.min.js"></script> -->
        <!-- <script src="js/bootstrap.min.js"></script> -->
        <script src="../js/owl.carousel.min.js"></script>
        <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
        <script src="../js/aos.js"></script>
        <script src="../js/slider.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>







<?php 
} ?>