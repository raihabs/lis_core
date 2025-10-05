<!DOCTYPE html>
<html lang="en">
<?php
// Start the session

session_start();
if (!isset($_SESSION['adm_id'])) {
    header("Location: ../admin/start.php");
} else
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

   
<title>CFOS</title>
    <link href="../images/logo/cfoss.png" rel="icon">
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
                        <?php
                        $user_id = $_SESSION['adm_id'];
                        $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
                        $res_creator = mysqli_query($db, $sel_user);
                        $show = mysqli_fetch_array($res_creator);
                        $adm_id = $show['s_id'];
                        if ($show['user_role'] == 'super-admin') { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">

                                    <div class="card-header">
                                        <div class="icon icon-warning">
                                            <span class="material-icons">group</span>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <p class="category"><strong>users</strong></p>
                                        <h3 class="card-title">
                                            <?php $sql = "select * from `users` WHERE s_id = '$adm_id'";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws; ?>
                                        </h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons text-info">info</i>
                                            <a href="#pablo">See all users</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else {
                            echo '';
                        } ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-rose">
                                        <span class="material-symbols-outlined">widgets</span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>categories</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from `category`";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);
                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all categories</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-success">
                                        <span class="material-icons">
                                            local_dining
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>dishes</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from `dishes`";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);

                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all dishes</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-info">
                                        <span class="material-icons">
                                            shopping_cart
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>all-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from users_orders WHERE s_id = '$adm_id'";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);

                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--  -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">

                                <div class="card-header">
                                    <div class="icon icon-warning">
                                        <span class="material-symbols-outlined">
                                            transfer_within_a_station
                                        </span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>check-out-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from `users_orders` WHERE status = 'Check Out' WHERE s_id = '$adm_id'";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);
                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">

                                <div class="card-header">
                                    <div class="icon icon-warning">
                                        <span class="material-symbols-outlined">
                                            local_mall
                                        </span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>in-process-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from users_orders WHERE status = 'In Process' WHERE s_id = '$adm_id'";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);
                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-success">
                                        <span class="material-symbols-outlined">
                                            check
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>delivered-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from users_orders WHERE status = 'Delivered' WHERE s_id = '$adm_id'";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);
                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-rose">
                                        <span class="material-symbols-outlined">
                                            cancel
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>cancelled-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from users_orders WHERE status = 'Cancelled' WHERE s_id = '$adm_id'";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);

                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-success">
                                        <span class="material-symbols-outlined">
                                            shopping_cart_checkout
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>on-the-way-orders</strong></p>
                                    <h3 class="card-title">
                                        <?php $sql = "select * from users_orders WHERE status = 'On The Way' WHERE s_id = '$adm_id' ";
                                        $result = mysqli_query($db, $sql);
                                        $rws = mysqli_num_rows($result);
                                        echo $rws; ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-rose">
                                        <span class="material-symbols-outlined">
                                            attach_money
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>total-earnings</strong></p>
                                    <h3 class="card-title">
                                        <?php $result = mysqli_query($db, "SELECT * FROM `users_orders` WHERE `status` = 'Delivered' WHERE s_id = '" . $adm_id . "'");
                                        while ($row = mysqli_fetch_array($result)) {
                                            $subtotal = $row['d_qty'] * $row['selling_price'];
                                            $total = $total + $subtotal;
                                        }
                                        echo $total;
                                        ?>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons  text-info">info</i>
                                        <a href="#pablo">See all orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-stats">
                                    <!-- ======= Portfolio Section ======= -->
                                    <section id="portfolio" class="section-bg">
                                        <div class="container" data-aos="fade-up">

                                            <header class="section-header">
                                                <h3 class="section-title">RECOMMENDED TODAY
                                                    <hr> to the Teachers and Students
                                                </h3>
                                            </header>

                                            <div class="row" data-aos="fade-up" data-aos-delay="100"">
                    <div class=" col-lg-12">
                                                <ul id="portfolio-flters">
                                                    <li data-filter="*" class="filter-active">All</li>
                                                    <?php
                                                    $sql_category = "SELECT * FROM `category`";
                                                    $query_category = $db->query($sql_category);

                                                    if (mysqli_num_rows($query_category) > 0) {
                                                        foreach ($query_category as $res) { ?>
                                                            <li data-filter=".filter-<?php echo $res['c_name'] ?>"><?php echo $res['c_name'] ?></li>
                                                    <?php }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <?php
                                        $userId = $_SESSION['adm_id'];
                                        $loginquery = "SELECT * FROM `admin` WHERE adm_id = $userId";
                                        $result = mysqli_query($db, $loginquery);
                                        $row = mysqli_fetch_array($result);
                                        echo $s_id = $row['s_id']; ?>
                                        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">



                                            <?php $query = "SELECT o.o_id as ordid, o.d_id, o.d_qty,o.date, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock,d.d_image,COUNT(*) as name_count   
                FROM users_orders o, dishes d 
                WHERE o.date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND o.d_id = d.d_id AND o.s_id = '".$s_id."' AND d.stock > 0 
                GROUP BY d.dishes_name ORDER BY COUNT(*) DESC LIMIT 28";


                                            $all_products = $db->query($query);

                                            if (mysqli_num_rows($all_products) > 0) {
                                                foreach ($all_products as $items) {
                                                    if ($items['stock'] > 0) { ?>

                                                        <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $items['c_name'] ?>">
                                                            <!-- <a href="products_view.php?product=<?= $items['did'] ?>" style="text-decoration:none;"> -->
                                                            <div class="portfolio-wrap">
                                                                <figure>
                                                                    <img src="../images/dishes/<?= $items['d_image'] ?>" class="img-fluid" alt="">
                                                                    <a href="../images/dishes/<?= $items['d_image'] ?>" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="<?= $items['dishes_name'] ?>"></a>
                                                                </figure>

                                                                <div class="portfolio-info">
                                                                    <h4><a href="#"><?= $items['dishes_name'] ?></a></h4>
                                                                    <p>P<s><?= $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</p>
                                                                </div>
                                                            </div>
                                                            <!-- </a> -->
                                                        </div>

                                            <?php   }
                                                }
                                            } ?>
                                        </div>
                                </div>
                                </section><!-- End Portfolio Section -->


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
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  

    <?php include '../include/admin_bottom.php';
} ?>