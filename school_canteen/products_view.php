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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .button_1 {
            /* Button #1 from SimpleCSSButtons.com */
            color: #fff;
            /* Text Color */
            background-color: #0C0A4A;
            /* Background Color */
            width: 150px;
            /* Button Width */
            transition: 0.5s;
            /* Hover Transition Time */
            border: .2vmax solid rgb(47, 36, 148);
            /* Border Width & Color */
            padding: 10px 30px;
            /* Padding */
            text-decoration: none;
            /* Text Decoration */
            /* border-radius: 101vmax; */
            /* Border Roundness */
            cursor: pointer;
            /* Cursor */
        }

        .button_1:hover {
            color: #FFFFFF;
            /* Text Color */
            background-color: #398AB9;
            /* Background Color */
        }
    </style>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">
        <form method="post" action="cart_checkout.php" id="form" style="margin-bottom: 100vh;">
            <?php
            $prod_pass = $_GET['product'];
            $sql_prod = "SELECT * FROM `dishes` WHERE `d_id` = '" . $prod_pass . "' LIMIT 1";
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

                                <div class="row" style="padding: .8rem 0;">
                                    <div class="col-md-4 text-secondary">
                                        <h6>Product Description</h6>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?= $product['long_description'] ?></p>
                                    </div>
                                </div>
                                <div class="row" style="padding: .8rem 0;">
                                    <div class="col-md-4 text-secondary">
                                        <h6>Stock</h6>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?= $product['stock'] ?></p>
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
                                            <?php if ($fetch_canteen['s_id'] == 1) { ?>
                                                <input type="hidden" id="<?php echo $product['d_id']; ?>" name="chck1[]" value="<?php echo $product['dishes_name']; ?>">

                                                <input type="text" name="prod_qty1[]" class="form-control text-center input-qty bg-white" style="width:20px; font-size:1.5rem;" value="1" readonly>
                                            <?php  } else { ?>
                                                <input type="hidden" id="<?php echo $product['d_id']; ?>" name="chck2[]" value="<?php echo $product['dishes_name']; ?>">

                                                <input type="text" name="prod_qty2[]" class="form-control text-center input-qty bg-white" style="width:20px; font-size:1.5rem;" value="1" readonly>
                                            <?php  } ?>

                                            <button class="input-group-text bg-white increment-btn" style="width:40px; font-size: 1.5rem;">
                                                <center>+</center>
                                            </button>

                                        </div>
                                    </div>

                                    <input type="hidden" name="prodid1[]" value="<?= $product['d_id']; ?>">
                                    <input type="hidden" name="prodname1[]" value="<?= $product['dishes_name']; ?>">
                                    <input type="hidden" name="prod_price1[]" value="<?= $product['selling_price']; ?>">
                                    <input type="hidden" name="prodid2[]" value="<?= $product['d_id']; ?>">
                                    <input type="hidden" name="prodname2[]" value="<?= $product['dishes_name']; ?>">
                                    <input type="hidden" name="prod_price2[]" value="<?= $product['selling_price']; ?>">
                                    <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $product['stock'] ?>" disabled>
                                </div>


                                <div class="row" style="padding: 1rem 0;">
                                    <div class="col-md-4">
                                        <?php
                                        error_reporting(0);
                                        session_start();
                                        if (empty($_SESSION["user_id"])) // if user is not login
                                        { ?>
                                            <a href="start.php" style=" border: 2px solid #6c5ce7;
                                            padding: 0.2em 0.4em;
                                            border-radius: 0.2em;
                                            background-color: #a29bfe;
                                            transition: 1s; color: #fff;">
                                                buy now
                                            </a>
                                        <?php } else { ?><input type="submit" name="submit" id="button_1" class="btn button_1" style="border:none; " value="Buy Now">
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-8">
                                        <?php if (empty($_SESSION["user_id"])) { ?>
                                            <a href="start.php" style=" border: 2px solid #6c5ce7;
                                            padding: 0.2em 0.4em;
                                            border-radius: 0.2em;
                                            background-color: #a29bfe;
                                            transition: 1s;
                                            color: #fff;">
                                                add to cart
                                            </a>
                                        <?php } else { ?>
                                            <button class="btn btn-danger px-22 addToCartBtn" value="<?= $product['d_id']; ?>">add to cart</button>
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
                            <div class="col-md-2" style="margin-top:55px;">
                                <?php if (empty($_SESSION["user_id"])) { ?>
                                    <a href="start.php" style="margin-top: 40px; border: none; padding: 10px 30px;
                                border: 0 solid #E2E8F0;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                box-sizing: border-box;
                                color: #1A202C;">
                                        View Canteen
                                    </a>
                                <?php } else { ?>
                                    <a href="canteen.php?canteen=<?php echo $fetch_canteen["s_id"]; ?>" style="margin-top: 40px; border: none; padding: 10px 30px;
                                border: 0 solid #E2E8F0;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                box-sizing: border-box;
                                color: #1A202C;">
                                        View Canteen
                                    </a>
                                <?php } ?>

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

            <section id="team" style="width: 100%; padding: 20px; background: #eee; ">
                <div class="container" data-aos="fade-up">
                    <div class="section-header">
                        <h3>OTHER MENU
                            <hr>YOU MAY LIKE ALSO
                        </h3>
                    </div>
                </div>
                <div class="page">
                    <div class="display-content" style="display: none">


                    
                        <div class="row">

                            <?php
                            if (!empty($_SESSION["user_id"])) {
                            $id = $_SESSION['user_id'];
                            $loginquery = "SELECT * FROM `users` WHERE u_id = $id";
                            $result = mysqli_query($db, $loginquery);
                            $row = mysqli_fetch_array($result);
                            $s_id = $row['s_id'];
                            $dishes = $product['c_name'];
                            $query = "SELECT * FROM `dishes` WHERE   s_id ='" . $s_id . "' AND CONCAT(s_id,original_price,c_name,d_image) LIKE '%$dishes%' ";
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
                                                    <!-- <div class="stars" style="padding: 0.7rem 0; font-size: 0.7rem; color: #6759ff;">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span style=" color: #999;">( 250 )</span>
                                                </div> -->
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
                            <?php }  } else{ 
                                $id = $_SESSION['user_id'];
                            $loginquery = "SELECT * FROM `users`";
                            $result = mysqli_query($db, $loginquery);
                            $row = mysqli_fetch_array($result);
                            $s_id = $row['s_id'];
                            $dishes = $product['c_name'];
                            $query = "SELECT * FROM `dishes` WHERE CONCAT(original_price,c_name,d_image) LIKE '%$dishes%' ";
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
                                                    <!-- <div class="stars" style="padding: 0.7rem 0; font-size: 0.7rem; color: #6759ff;">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span style=" color: #999;">( 250 )</span>
                                                </div> -->
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
                            <?php } }
                                ?>

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

        </form>
    </main>
    <!-- ======= Footer ======= -->
    <?php include 'include/user_footer.php';?>

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

    <!-- <script src="js/quantity.js" defer></script> -->
    <script>
        $(document).ready(function() {
            $('.increment-btn').click(function(e) {
                e.preventDefault();

                var qty = $(this).closest('.product_data').find('.input-qty').val();
                var stock = $(this).closest('.product_data').find('.input-stock').val();
                var value = parseInt(qty, 10);
                value = isNaN(value) ? 0 : value;

                if (value < stock) {
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