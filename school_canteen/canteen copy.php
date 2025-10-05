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
    <link href="assets/img/favicon.png" rel="icon">
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
    <link href="css/page.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php include 'include/user_header.php';

    $cnt = $_GET['canteen'];
    $sql_canteen = "SELECT * FROM `canteen` WHERE s_id = '" . $cnt['s_id'] . "'";
    $res_canteen = mysqli_query($db, $sql_canteen);
    $canteen = mysqli_fetch_array($res_canteen);

    $s_id = $canteen['s_id'];
    ?>


    <!-- ======= hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>
                <div class="carousel-item active" style="background-image: url(assets/img/hero-carousel/2.jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">CFOS WEBSITE</h2>
                            <p class="animate__animated animate__fadeInUp">New web application for students and teachers.</p>

                            <img src="images/logo/<?php echo $school['image']; ?>" alt="Product Image" style="border-radius: 50%; padding: 10px; width: 110px; height: 110px;">

                            <p class="animate__animated animate__fadeInUp">Welcome.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-inner" role="listbox">
                    <?php $query = "SELECT * FROM `info_slide` WHERE s_id = $s_id ORDER BY `i_image` ASC";
                    $result = mysqli_query($db, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="carousel-item" style="background-image: url(images/announcement/<?php echo $row['i_image']; ?>)">
                                <div class="carousel-container">
                                    <div class="container">
                                        <h2 class="animate__animated animate__fadeInDown" style="text-transform: uppercase;"><?php echo $row['i_name']; ?></h2>
                                        <p class="animate__animated animate__fadeInUp"><?php echo $row['i_description']; ?></p>
                                        <a href="<?php echo $school['url']; ?>" class="btn-get-started scrollto animate__animated animate__fadeInUp">visit our social media</a>

                                        <p class="animate__animated animate__fadeInUp"><?php echo $school['school_name']; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }  ?>
                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>
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


        <section id="team" style="width: 100%; padding: 20px; background: #eee; ">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3>OUR MENU</h3>
                </div>
            </div>
            <div class="page">
                <div class="display-content" style="display: none">
                    <div class="row">

                        <?php
                        $dishes = $product['c_name'];
                        $original_price = $product['original_price'];
                        $query = "SELECT * FROM `dishes` WHERE s_id = $s_id AND CONCAT(original_price,c_name,d_image) LIKE '%$dishes%' ";
                        $all_products = $db->query($query);

                        if (mysqli_num_rows($all_products) > 0) {
                            foreach ($all_products as $items) {
                                if ($items['stock'] > 0) { ?>

                                    <div class="display">
                                        <a href="products_view.php?product=<?= $items['dishes_name'] ?>" style="text-decoration:none;">
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

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-info">
                            <h3>BizPage</h3>
                            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h4>Contact Us</h4>
                            <p>
                                A108 Adam Street <br>
                                New York, NY 535022<br>
                                United States <br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>

                            <div class="social-links">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-6 footer-newsletter">
                            <h4>Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer><!-- End Footer -->

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
        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.6.0.js"></script>


</body>

</html>