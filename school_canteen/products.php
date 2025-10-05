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

    <!-- Favicons -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/page.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php include 'include/user_header.php'; ?>



    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->
    <?php
    $category_pass = $_GET['category'];
    $sql_category = "SELECT * FROM `category` WHERE `c_name` = '" . $category_pass . "' LIMIT 1";
    $category = mysqli_query($db, $sql_category);
    $res_cat = mysqli_fetch_array($category);
    $c_id = $res_cat['c_id'];
    ?>

    <div style="width: 100%; padding: 70px 0; background: #0C0A4A; background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); background: linear-gradient(to top right, #0C0A4A, #592F95); ">
        <div class="title text-left" style="margin-left: 55px;">
            <div class="row">
                <div class="col-md-12">

                    <button class="button-value">
                        <img src="images/category/<?= $res_cat['c_image'] ?>" style="object-fit: contain; width:150px; height:150px; margin: 5px;" alt="">
                    </button>

                    <h2 style="color: #fff; text-transform: uppercase; border-left: solid 0.3em; border-left-color: #fff; padding-left: 25px; margin-left: 125px;" class="position-relative d-inline-block"><?= $res_cat['c_name'] ?></h2>
                </div>
            </div>
        </div>
    </div>
    <main id="main">


        <!-- ======= Our Clients Section ======= -->
        <section id="clients">
            <div class="container" data-aos="zoom-in">

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <?php
                        $sql_category = "SELECT * FROM `category`";
                        $query_category = $db->query($sql_category);

                        if (mysqli_num_rows($query_category) > 0) {
                            foreach ($query_category as $res) { 
                                if ($res['stock'] > 0) {?>
                                <div class="swiper-slide">
                                    <a href="products.php?category=<?php echo $res['c_name'] ?>">
                                        <img src="images/category/<?php echo $res['c_image'] ?>" style="object-fit: contain; width:150px; height:150px; margin-top:10px;" alt="">
                                    </a>
                                </div>
                        <?php }
                        } }?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Our Clients Section -->



        <section id="team"  style="background-color: #fff;">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3>MENU</h3>
                </div>
            </div>
            <div class="page">
                <div class="display-content" style="display: none">
                    <div class="row">

                        <?php
                        $query = "SELECT * FROM `dishes` WHERE c_id = $c_id ";
                        $all_products = $db->query($query);

                        if (mysqli_num_rows($all_products) > 0) {
                            foreach ($all_products as $items) {
                                if ($items['stock'] > 0) { ?>
                                   
                                        <div class="display">
                                            <a href="products_view.php?product=<?= $items['d_id'] ?>" style="text-decoration:none;">
                                            <div class="display-image"><img src="images/dishes/<?= $items['d_image'] ?>" alt=""></div>
                                            <div class="display-info">
                                                <h3><?= $items['dishes_name'] ?></h3>
                                                <h3 style="font-size: 0.8rem;  color: #444;"><s>P<?php echo $items['original_price'] ?>.00</s> P<?php echo $items['selling_price'] ?>.00</h3>

                                                <?php
                                                $string = $items['long_description'];
                                                $count = 0;
                                                $length = strlen($string);

                                                for ($i = 0; $i < $length; $i++) {
                                                    if (ctype_alpha($string[$i])) {
                                                        $count++;
                                                    }
                                                }

                                                // Printing the result
                                                $right_side = $count  - 25;
                                                ?>

                                                <p><?php echo substr($items['long_description'], 0, -$right_side); ?>..</p>
                                                <div class="stars" style="padding: 0.7rem 0; font-size: 0.7rem; color: #6759ff;">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span style=" color: #999;">( 250 )</span>
                                                </div>
                                            </div>
                                    </a>
                                        </div>

                            <?php }
                            }
                        } else { ?>

                            <div class="display" style="padding: 30px 0;">
                                <div class="display-image"><img src="images/background/cart.svg" alt=""></div>
                                <div class="display-info">
                                    <h3>No Item Available</h3>
                                    <p>try other menu.</p>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="row" style="width: 1800px;">
                        <div class="col-md-12">
                            <div class="part">
                                <li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                                <li class="page-item current-page purple"><a class="page-link" href="#">1</a></li>
                                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </section>
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
        <script src="js/page.js"></script>

</body>

</html>