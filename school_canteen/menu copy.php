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

    <!-- /////////////////////////////////////////////////////////////////////// -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/product.css">

    <!-- custom js file link  -->
    <script src="js/category_button.js" defer></script>
    <script src="js/search.js" defer></script>
    <script src="js/quantity.js" defer></script>

    <!-- /////////////////////////////////////////// -->

    <!-- Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">

        <div class="wrapper text-center">
            <div class="card-body" id="search-container">
                <form action="menu.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search_value" value="<?php if (isset($_GET['search_value'])) {
                                                                                echo $_GET['search_value'];
                                                                            } ?>" class="form-control form-control-lg" placeholder="Type Here..." id="search_value" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="javascript:load_data(this.value)" onfocus="javascript:load_search_history()" />
                            <span id="search_result"></span>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" name="search_btn" id="search">Search</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <button class="button-value" onclick="filterProduct('all')">
                        <img src="images/category/1. cart.jpg" style="width:200px; height:200px; margin:10px;" alt="" onclick="filterProduct('all')">
                    </button>
                    <?php
                    $sql_category = "SELECT * FROM `category`";
                    $category = $db->query($sql_category);

                    while ($res = mysqli_fetch_assoc($category)) { ?>
                        <button class="button-value" onclick="filterProduct('<?php echo $res['c_name'] ?>')">
                            <img src="images/category/<?php echo $res['c_image'] ?>" style="width:200px; height:200px; margin:10px;" alt="" onclick="filterProduct('<?php echo $res['c_name'] ?>')">
                        </button>
                    <?php } ?>
                </div>
            </div>

            <div class="container">
                <div class="products-container">
                    <?php
                    if (isset($_POST['search_value'])) {
                        $value_search = $_POST['search_value'];
                        $query = "SELECT * FROM `dishes` WHERE CONCAT(dishes_name,c_name,d_image) LIKE '%$value_search%' ";
                        $all_products = $db->query($query);

                        if (mysqli_num_rows($all_products) > 0) {
                            foreach ($all_products as $items) {
                                if ($items['stock'] > 0) { ?>

                                    <a href="products_view.php?product=<?= $items['dishes_name'] ?>" style="text-decoration:none;">
                                        <div class="product <?= $items["c_name"] ?>" data-name="p-<?php echo $items['d_id'] ?>">
                                            <img src="images/dishes/<?= $items['d_image'] ?>" alt="">
                                            <h3 style="font-size: 1.8rem;  color: #444;"><?= $items['dishes_name'] ?></h3>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="price" style="font-size: 1.5rem;">$<?php echo $items['selling_price'] ?>.00</div>
                                                </div>
                                            </div>

                                            <div class="stars" style="padding:2rem 0; font-size: 1.2rem; color: #6759ff;">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span style=" color: #999;">( 250 )</span>
                                            </div>
                                            <div>
                                                <?php
                                                $sql_canteen = "SELECT * FROM `canteen` WHERE s_id='" . $items['s_id'] . "'";
                                                $res_canteen = mysqli_query($db, $sql_canteen);
                                                $fetch_canteen = mysqli_fetch_array($res_canteen);
                                                ?>
                                                <span style=" color: #333;"><?php echo $fetch_canteen['school_name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                            <?php }
                            }
                        } else { ?>
                            <div class="empty">
                                <img src="images/dishes/1.png" alt="">
                                <h3>NO RESULT FOUND</h3>
                                <div class="price">Please Try again</div>
                            </div>
                        <?php }
                    } else { ?> <?php
                        $query = "SELECT * FROM dishes ";
                        $all_products = $db->query($query);

                        if (mysqli_num_rows($all_products) > 0) {
                            foreach ($all_products as $items) {
                                if ($items['stock'] > 0) {
                        ?>

                                    <a href="products_view.php?product=<?= $items['dishes_name'] ?>" style="text-decoration:none;">
                                        <div class="product <?= $items["c_name"] ?>" data-name="p-<?php echo $items['d_id'] ?>">
                                            <img src="images/dishes/<?= $items['d_image'] ?>" alt="">
                                            <h3 style="font-size: 1.8rem;  color: #444;"><?= $items['dishes_name'] ?></h3>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="price" style="font-size: 1.5rem;">$<?php echo $items['selling_price'] ?>.00</div>
                                                </div>
                                            </div>

                                            <div class="stars" style="padding: 2rem 0; font-size: 1.2rem; color: #6759ff;">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span style=" color: #999;">( 250 )</span>
                                            </div>
                                            <div>
                                                <?php
                                                $sql_canteen = "SELECT * FROM `canteen` WHERE s_id='" . $items['s_id'] . "'";
                                                $res_canteen = mysqli_query($db, $sql_canteen);
                                                $fetch_canteen = mysqli_fetch_array($res_canteen);
                                                ?>
                                                <span style=" color: #333;"><?php echo $fetch_canteen['school_name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                        <?php }
                            }
                        } ?>
                    <?php   } ?>
                </div>
            </div>
        </div>




        <!-- /////////////////////////////////////////////////////////// -->
        <?php
        $prod_pass = $_GET['product'];
        $sql_prod = "SELECT * FROM `dishes` WHERE `dishes_name` = '" . $prod_pass . "' LIMIT 1";
        $res_prod = mysqli_query($db, $sql_prod);
        $product = mysqli_fetch_array($res_prod);

        $p_id = $product['d_id'];

        $sql_canteen = "SELECT * FROM `canteen` WHERE s_id = '" . $product['s_id'] . "'";
        $res_canteen = mysqli_query($db, $sql_canteen);
        $fetch_canteen = mysqli_fetch_array($res_canteen);

        if ($product) { ?>

            <div style="width: 100%; padding: 30px 50px; background: #eee; ">

                <div class=" product_data bg-white" style="width: 100%; height: auto; ">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="shadow">
                                <img src="images/dishes/<?= $product['d_image']; ?>" alt="Product Image" class="image-fluid w-100">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <h4 class="fw-bold"><?= $product['dishes_name']; ?></h4>
                            <!-- <div class="stars" style="font-size: 0.8rem; color: #6759ff;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span style=" color: #999;">( 23 )</span>
                            </div> -->
                            <hr>
                            <div class="row text-xs-left">
                                <div class="col-xs-12 col-sm-12 left-text">
                                    <p><?= $product['small_description'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <h5>P <s class="text-danger"><?= $product['original_price'] ?></s></h5>
                                </div>
                                <div class="col-md-8" style="color: #6759ff;">
                                    <h5 style=" font-size: .8rem;">P <span class="fw-bold"><?= $product['selling_price'] ?></span></h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-4 text-secondary">
                                    <h6>Delivery</h6>
                                </div>

                                <div class="col-md-8">
                                    <p><?php echo $fetch_canteen['address']; ?></p>
                                </div>
                            </div>

                            <div class="row" style="padding: 1rem 0;">
                                <div class="col-md-4 text-secondary">
                                    <h6>Product Description</h6>
                                </div>
                                <div class="col-md-8">
                                    <p><?= $product['long_description'] ?></p>
                                </div>
                            </div>

                            <hr>
                            <div class="row" style="padding: 1rem 0;">
                                <div class="col-md-4 text-secondary">
                                    <h6>Quantity</h6>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group mb-2" style=" width:150px;">
                                        <button class="input-group-text bg-white decrement-btn" style="width:40px; font-size: 1.5rem;">
                                            <center>-</center>
                                        </button>
                                        <input type="text" class="form-control text-center input-qty bg-white" style="width:20px; font-size:1.5rem;" value="1" disabled>
                                        <button class="input-group-text bg-white increment-btn" style="width:40px; font-size: 1.5rem;">
                                            <center>+</center>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="padding: 2rem 0;">
                                <div class="col-md-4">
                                    <?php
                                    error_reporting(0);
                                    session_start();
                                    if (empty($_SESSION["user_id"])) // if user is not login
                                    { ?>
                                        <a href="start.php"><button class="buyNowBtn">buy now</button></a>
                                    <?php } else { ?>
                                        <button class="btn btn-danger px-22 buyNowBtn" value="<?php echo $product['d_id'] ?>">buy now</button>
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    <?php if (empty($_SESSION["user_id"])) { ?>
                                        <a href="start.php"><button class="addToCartBtnn">add to cart</button></a>
                                    <?php } else { ?>
                                        <button class="btn btn-danger px-22 addToCartBtn" value="<?= $product['d_id']; ?>"><?= $product['d_id'] ?></button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="width: 100%; padding: 10px 50px; background: #eee;">
                <div class=" product_data bg-white" style="width: 100%; height: auto; padding: 10px 50px;">

                    <div class="row" style="font-size: .8em;">
                        <div class="col-md-2">
                            <img src="images/logo/<?php echo $fetch_canteen['image']; ?>" alt="Product Image" class="img-responsive radius" style="padding: 10px; width: 110px; height: 110px;">
                        </div>
                        <div class="col-md-8">

                            <p style="margin-top: 20px;"><?php echo $fetch_canteen['school_name']; ?></p>
                            <?php if (!empty($_SESSION['adm_id'])) {
                                echo '
                                <p><?php echo $fetch_canteen["school_name"]; ?></p><div style=" margin-top: -20px; border-bottom: solid 2px orange; width: 100px;color: green;"><center>online</center></div>';
                            } else {
                                echo '
                                <p style="top: 50px;"><?php echo $fetch_canteen["school_name"]; ?></p><div style="margin-top: -20px; border-bottom: solid 2px orange; width: 100px;  color: orange"><center>closed</center></div>';
                            }
                            ?>
                            <p><?php echo $fetch_canteen['address']; ?></p>
                        </div>
                        <div class="col-md-2">
                            <button style="margin-top: 40px; border: none; padding: 10px 30px;
                                border: 0 solid #E2E8F0;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                box-sizing: border-box;
                                color: #1A202C;">View Canteen</button>
                        </div>

                    </div>

                </div>
            </div>

        <?php } ?>
        <!-- //////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////// -->

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

        <script src="js/jquery-ui.js"></script>
        <!-- <script src="js/popper.min.js"></script> -->
        <!-- <script src="js/bootstrap.min.js"></script> -->
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <!-- /////////// -->
        <!-- <script src="js/aos.js"></script>-->
        <script src="js/slider.js"></script>
        <script src="js/page.js"></script> 
        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.6.0.js"></script>

        <!-- <script src="js/quantity.js" defer></script> -->
        <script>
            $(document).ready(function() {
                $('.increment-btn').click(function(e) {
                    e.preventDefault();

                    var qty = $(this).closest('.product_data').find('.input-qty').val();

                    var value = parseInt(qty, 10);
                    value = isNaN(value) ? 0 : value;

                    if (value < 100) {
                        value++;
                        $(this).closest('.product_data').find('.input-qty').val(value);
                    }
                });

                $('.decrement-btn').click(function(e) {
                    e.preventDefault();

                    var qty = $(this).closest('.product_data').find('.input-qty').val();

                    var value = parseInt(qty, 10);
                    value = isNaN(value) ? 0 : value;

                    if (value > 1) {
                        value--;
                        $(this).closest('.product_data').find('.input-qty').val(value);
                    }
                });





                $('.addToCartBtn').click(function(e) {
                    e.preventDefault();

                    var qty = $(this).closest('.product_data').find('.input-qty').val();
                    var prod_id = $(this).val();

                    $.ajax({
                        method: "POST",
                        url: "handlecart.php",
                        data: {
                            "prod_id": prod_id,
                            "prod_qty": qty,
                            "scope": "add"
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
                    });


                });
            });
        </script>
</body>

</html>