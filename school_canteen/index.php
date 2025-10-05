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

</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Our Clients Section ======= -->
        <section id="clients">
            <div class="container" data-aos="zoom-in">

                <header class="section-header">
                    <h3>Categories</h3>
                </header>

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <?php
                        $sql_category = "SELECT * FROM `category`";
                        $query_category = $db->query($sql_category);

                        if (mysqli_num_rows($query_category) > 0) {
                            foreach ($query_category as $res) {
                        ?>
                                <div class="swiper-slide">
                                    <a href="products.php?category=<?php echo $res['c_name'] ?>">
                                        <img src="images/category/<?php echo $res['c_image'] ?>" style="object-fit: contain; width:150px; height:150px; margin-top:10px;" alt="">
                                    </a>
                                </div>
                        <?php }
                        } ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Our Clients Section -->

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
            $userId = $_SESSION['user_id'];
            $loginquery = "SELECT * FROM `users` WHERE u_id = $userId";
            $result = mysqli_query($db, $loginquery);
            $row = mysqli_fetch_array($result);
            $s_id = $row['s_id']; ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">



                <?php $query = "SELECT o.o_id as ordid, o.d_id, o.d_qty,o.date, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock,d.d_image,COUNT(*) as name_count   
                FROM users_orders o, dishes d 
                WHERE o.date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND o.d_id = d.d_id AND o.s_id = '$s_id'AND d.stock > 0 
                GROUP BY d.dishes_name ORDER BY COUNT(*) DESC LIMIT 28";


                $all_products = $db->query($query);

                if (mysqli_num_rows($all_products) > 0) {
                    foreach ($all_products as $items) {
                        if ($items['stock'] > 0) { ?>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $items['c_name'] ?>">
                                <a href="products_view.php?product=<?= $items['did'] ?>" style="text-decoration:none;">
                                    <div class="portfolio-wrap">
                                        <figure>
                                            <img src="images/dishes/<?= $items['d_image'] ?>" class="img-fluid" alt="">
                                            <a href="images/dishes/<?= $items['d_image'] ?>" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="<?= $items['dishes_name'] ?>"></a>
                                        </figure>

                                        <div class="portfolio-info">
                                            <h4><a href="#"><?= $items['dishes_name'] ?></a></h4>
                                            <p>P<s><?= $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                <?php   }
                    }
                } ?>
            </div>
            </div>
        </section><!-- End Portfolio Section -->



        <section id="team" style="height: auto; background:#fff;">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3>POPULAR MENU OF THE WEEK
                        <hr> of the Teachers and Students
                    </h3>
                </div>
            </div>

            <div class="row">

                <div class="site-wrap">

                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- SLIDER START  -->
                    <div class="site-section block-3 site-blocks-2 bg-light">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
                                    <div class="nonloop-block-3 owl-carousel">

                                        <a href="products_view.php?product=<?= $items['did'] ?>" style="text-decoration:none;">
                                            <?php $query = "SELECT o.o_id as ordid, o.d_id, o.d_qty,o.date, d.d_id as did, d.dishes_name, d.c_name, d.long_description, d.d_image, d.original_price, d.selling_price, d.stock,d.d_image,COUNT(*) as name_count   
                                        FROM users_orders o, dishes d 
                                        WHERE o.date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND o.d_id = d.d_id AND o.s_id = '$s_id'AND d.stock > 0 
                                        GROUP BY d.dishes_name ORDER BY COUNT(*) DESC LIMIT 28";


                                            $all_products = $db->query($query);

                                            if (mysqli_num_rows($all_products) > 0) {
                                                foreach ($all_products as $items) {
                                                    if ($items['stock'] > 0) {
                                            ?>
                                                        <div class="item">
                                                            <div class="block-4 text-center">
                                                                <figure class="block-4-image">
                                                                    <img src="images/dishes/<?= $items['d_image'] ?>" class="img-fluid" alt="">
                                                                </figure>
                                                                <div class="block-4-text p-4">
                                                                    <h3><a href="#"><?= $items['dishes_name'] ?></a></h3>
                                                                    <p class="text-primary font-weight-bold">P<s><?= $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php   }
                                                }
                                            } ?>

                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    </div>
                </div>
        </section>


        <section id="team" style="height: auto; background:#fff;">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3>POPULAR MENU OF THE MONTH
                        <hr> of the Teachers and Students
                    </h3>
                </div>
            </div>

            <div class="row">

                <div class="site-wrap">

                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- SLIDER START  -->
                    <div class="site-section block-3 site-blocks-2 bg-light">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
                                    <div class="nonloop-block-3 owl-carousel">
                                        <a href="products_view.php?product=<?= $items['did'] ?>" style="text-decoration:none;">
                                            <?php $query = "SELECT o.o_id as ordid, o.d_id, o.d_qty,o.date, d.d_id as did, d.dishes_name, d.c_name, d.long_description, d.d_image, d.original_price, d.selling_price, d.stock,d.d_image,COUNT(*) as name_count   
                                        FROM users_orders o, dishes d 
                                        WHERE o.date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND o.d_id = d.d_id AND o.s_id = '$s_id'AND d.stock > 0 
                                        GROUP BY d.dishes_name ORDER BY COUNT(*) DESC LIMIT 28";


                                            $all_products = $db->query($query);

                                            if (mysqli_num_rows($all_products) > 0) {
                                                foreach ($all_products as $items) {
                                                    if ($items['stock'] > 0) {
                                            ?>

                                                        <div class="item">
                                                            <div class="block-4 text-center">
                                                                <figure class="block-4-image">
                                                                    <img src="images/dishes/<?= $items['d_image'] ?>" class="img-fluid" alt="">
                                                                </figure>
                                                                <div class="block-4-text p-4">
                                                                    <h3><a href="#"><?= $items['dishes_name'] ?></a></h3>
                                                                    <p class="text-primary font-weight-bold">P<s><?= $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php   }
                                                }
                                            } ?>

                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    </div>
                </div>
        </section>




        <section id="team" style="height: auto; background:#fff;">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3>POPULAR MENU OF THE YEAR
                        <hr> of the Teachers and Students
                    </h3>
                </div>
            </div>

            <div class="row">

                <div class="site-wrap">

                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- SLIDER START  -->
                    <div class="site-section block-3 site-blocks-2 bg-light">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
                                    <div class="nonloop-block-3 owl-carousel">
                                        <a href="products_view.php?product=<?= $items['did'] ?>" style="text-decoration:none;">

                                            <?php $query = "SELECT o.o_id as ordid, o.d_id, o.d_qty,o.date, d.d_id as did, d.dishes_name, d.c_name, d.long_description, d.d_image, d.original_price, d.selling_price, d.stock,d.d_image,COUNT(*) as name_count   
                                        FROM users_orders o, dishes d 
                                        WHERE o.date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND o.d_id = d.d_id AND o.s_id = '$s_id'AND d.stock > 0 
                                        GROUP BY d.dishes_name ORDER BY COUNT(*) DESC LIMIT 28";


                                            $all_products = $db->query($query);

                                            if (mysqli_num_rows($all_products) > 0) {
                                                foreach ($all_products as $items) {
                                                    if ($items['stock'] > 0) {
                                            ?>
                                                        <div class="item">
                                                            <div class="block-4 text-center">
                                                                <figure class="block-4-image">
                                                                    <img src="images/dishes/<?= $items['d_image'] ?>" class="img-fluid" alt="">
                                                                </figure>
                                                                <div class="block-4-text p-4">
                                                                    <h3><a href="#"><?= $items['dishes_name'] ?></a></h3>
                                                                    <p class="text-primary font-weight-bold">P<s><?= $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php   }
                                                }
                                            } ?>

                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                    </div>
                </div>
        </section>




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

</body>

</html>