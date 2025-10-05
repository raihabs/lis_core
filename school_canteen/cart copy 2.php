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

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">
        <form method="post" action="cart_checkout.php" id="form" style="margin-bottom: 100vh;">
            <div style="width: 100%; padding: 10px 10px; background: #eee;">
                <div class="bg-white" style="width: 100%; height: auto;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="font-size: .8em; border-bottom: solid 10px #eee; ">
                                    <th style="padding-left: 25px;" scope="col-md-2" class="border-0 bg-white">
                                        <div class="p-3 text-uppercase"> <input type="checkbox" onclick="select_all1()" id="select1"></input></div>
                                    </th>
                                    <th style="padding-left: 355px;" scope="col-md-3" class="border-0 bg-white">
                                        <div class="p-3 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th style="padding-left: 95px;" scope="col-md-2" class="border-0 bg-white">
                                        <div class="py-3 text-uppercase">Price</div>
                                    </th>
                                    <th style="padding-left: 195px;" scope="col-md-2" class="border-0 bg-white">
                                        <div class="py-3 px-3 text-uppercase">Quantity</div>
                                    </th>
                                    <th style="padding-left: 15px;" scope="col-md-2" class="border-0 bg-white">
                                        <div class="py-3 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <?php

                    $userId = $_SESSION['user_id'];
                    $sql_cart = "SELECT * FROM `cart` WHERE s_id = 1 AND u_id = $userId";
                    $res_cart = mysqli_query($db, $sql_cart);
                    if (mysqli_num_rows($res_cart) > 0) {
                    ?>


                        <div class="row" style="padding: 20px; border-bottom: solid 25px #eee;">
                            <div class="col-lg-12">
                                <!-- Shopping cart table -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                            $sql_canteen = "SELECT * FROM `canteen` WHERE s_id = 1";
                                            $res_canteen = mysqli_query($db, $sql_canteen);
                                            $fetch_canteen = mysqli_fetch_array($res_canteen); ?>

                                            <tr style="width: 100%; padding: 50px 100%; border-bottom: solid 2px #eee; background-color: blue; color: #fff; opacity: .2;">
                                                <td><input type="checkbox" onclick="select_one()" id="delete1" style="margin: 0 20px;" /><?php echo $fetch_canteen["school_name"]; ?></td>
                                            </tr>

                                            <?php
                                            $userId = $_SESSION['user_id'];
                                            $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
                                            FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 1 AND stock > 0
                                            ORDER BY c.crt_id DESC";

                                            $items = mysqli_query($db, $query);
                                            foreach ($items as $citem) { ?>


                                                <tr style="padding: 30px; border-bottom: solid 2px #eee;" id="box<?php echo $citem['crtid'] ?>">
                                                    <td class="border-0 align-middle" style="padding-left: 20px; font-size: .8em;"><input type="checkbox" id="<?php echo $citem['crtid'] ?>" name="checkbox1[]" value="<?= $citem['dishes_name']; ?>" />
                                                        <input type="text" name="prodid1[]" value="<?= $citem['d_id']; ?>">
                                                    </td>
                                                    </td>
                                                    <td class="border-0 align-middle" style="padding-left: 100px; width: 32%; ">
                                                        <img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                        <div class="ml-0 d-inline-block align-middle">
                                                            <input type="text" name="prodname1[]" value="<?= $citem['dishes_name']; ?>">
                                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle" style="font-size: .6em"><strong><?= $citem['dishes_name']; ?></strong></a></h5><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;">Category: <?= $citem['c_name'] ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="font-size: .8em; padding-left: 60px; width: 22%;" class="border-0 align-middle">P<s><?= $citem['original_price'] ?></s> <strong>P<?= $citem['selling_price'] ?></strong>
                                                        <input type="text" name="prod_price1[]" value="$<?= $citem['selling_price']; ?>">
                                                    </td>

                                                    <td class=" product_data border-0 align-middle">
                                                        <div class="input-group " style=" height:10px; width: 180px;">
                                                            <button class="input-group-text bg-white decrement-btn" style="width:30px; font-size: 1rem;">
                                                                <center>-</center>
                                                            </button>
                                                            <input type="text" name="prod_qty1[]" class="form-control text-center input-qty bg-white" style="width:30px; font-size:1rem;" value="<?= $citem['d_qty'] ?>">
                                                            <button class="input-group-text bg-white increment-btn" style="width:30px; font-size: 1rem;">
                                                                <center>+</center>
                                                            </button>
                                                        </div>
                                                        <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                                    </td>
                                                    <td class="border-0 align-middle"><a class="btn btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $citem['crtid']; ?>">DELETE</a></td>
                                                </tr>

                                            <?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End -->
                            </div>
                        </div>
                    <?php } else {
                        echo '';
                    } ?>

                    <?php $sql_cart = "SELECT * FROM `cart` WHERE s_id = 2 AND u_id = $userId";
                    $res_cart = mysqli_query($db, $sql_cart);
                    if (mysqli_num_rows($res_cart) > 0) {  ?>


                        <div class="row" style="padding: 20px; border-bottom: solid 25px #eee;">
                            <div class="col-lg-12">
                                <!-- Shopping cart table -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody> <?php
                                                $sql_canteen = "SELECT * FROM `canteen` WHERE s_id = 2";
                                                $res_canteen = mysqli_query($db, $sql_canteen);
                                                $fetch_canteen = mysqli_fetch_array($res_canteen); ?>

                                            <tr style="width: 100%; padding: 50px 100%; border-bottom: solid 2px #eee; background-color: blue; color: #fff; opacity: .2;">
                                                <td><input type="checkbox" onclick="select_two()" id="delete2" style="margin: 0 20px;" /><?php echo $fetch_canteen["school_name"]; ?></td>
                                            </tr>

                                            <?php
                                            $userId = $_SESSION['user_id'];
                                            $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
                                            FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 2  AND stock > 0
                                            ORDER BY c.crt_id DESC";

                                            $items = mysqli_query($db, $query);
                                            foreach ($items as $citem) { ?>

                                                <tr style="padding: 30px; border-bottom: solid 2px #eee;" id="box<?php echo $citem['crtid'] ?>">
                                                    <td class="border-0 align-middle" style="padding-left: 20px; font-size: .8em;"><input type="checkbox" id="<?php echo $citem['crtid'] ?>" name="checkbox2[]" value="<?= $citem['dishes_name']; ?>" />
                                                        <input type="text" name="prodid2[]" value="<?= $citem['d_id']; ?>">
                                                    </td>
                                                    </td>
                                                    <td class="border-0 align-middle" style="padding-left: 100px; width: 32%; ">
                                                        <img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                        <div class="ml-0 d-inline-block align-middle">
                                                            <input type="text" name="prodname2[]" value="<?= $citem['dishes_name']; ?>">
                                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle" style="font-size: .6em"><strong><?= $citem['dishes_name']; ?></strong></a></h5><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;">Category: <?= $citem['c_name'] ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="font-size: .8em; padding-left: 60px; width: 22%;" class="border-0 align-middle">P<s><?= $citem['original_price'] ?></s> <strong>P<?= $citem['selling_price'] ?></strong>
                                                        <input type="text" name="prod_price2[]" value="<?= $citem['selling_price']; ?>">
                                                    </td>

                                                    <td class=" product_data border-0 align-middle">
                                                        <div class="input-group " style=" height:10px; width: 180px;">
                                                            <button class="input-group-text bg-white decrement-btn" style="width:30px; font-size: 1rem;">
                                                                <center>-</center>
                                                            </button>
                                                            <input type="text" name="prod_qty2[]" class="form-control text-center input-qty bg-white" style="width:30px; font-size:1rem;" value="<?= $citem['d_qty'] ?>">
                                                            <button class="input-group-text bg-white increment-btn" style="width:30px; font-size: 1rem;">
                                                                <center>+</center>
                                                            </button>
                                                            <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                                        </div>
                                                    </td>
                                                    <td class="border-0 align-middle"><a class="btn btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $citem['crtid']; ?>">DELETE</a></td>
                                                </tr>

                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End -->
                            </div>
                        </div>
                    <?php } else {
                        echo '';
                    } ?>



                    <?php $sql_cart = "SELECT * FROM `cart` WHERE s_id = 3 AND u_id = $userId";
                    $res_cart = mysqli_query($db, $sql_cart);
                    if (mysqli_num_rows($res_cart) > 0) {   ?>


                        <div class="row" style="padding: 20px; border-bottom: solid 25px #eee;">
                            <div class="col-lg-12">
                                <!-- Shopping cart table -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody> <?php
                                                $sql_canteen = "SELECT * FROM `canteen` WHERE s_id = 3";
                                                $res_canteen = mysqli_query($db, $sql_canteen);
                                                $fetch_canteen = mysqli_fetch_array($res_canteen); ?>


                                            <tr style="width: 100%; padding: 50px 100%; border-bottom: solid 2px #eee; background-color: blue; color: #fff; opacity: .2;">
                                                <td><input type="checkbox" onclick="select_three()" id="delete3" style="margin: 0 20px;" /><?php echo $fetch_canteen["school_name"]; ?></td>
                                            </tr>
                                            <?php
                                            $userId = $_SESSION['user_id'];
                                            $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
                                            FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 3  AND stock > 0
                                            ORDER BY c.crt_id DESC";

                                            $items = mysqli_query($db, $query);
                                            foreach ($items as $citem) { ?>

                                                <tr style="padding: 30px; border-bottom: solid 2px #eee;" id="box<?php echo $citem['crtid'] ?>">
                                                    <td class="border-0 align-middle" style="padding-left: 20px; font-size: .8em;"><input type="checkbox" id="<?php echo $citem['crtid'] ?>" name="checkbox3[]" value="<?= $citem['dishes_name']; ?>" />
                                                        <input type="text" name="prodid3[]" value="<?= $citem['d_id']; ?>">
                                                    </td>
                                                    </td>
                                                    <td class="border-0 align-middle" style="padding-left: 100px; width: 32%; ">
                                                        <img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                        <div class="ml-0 d-inline-block align-middle">
                                                            <input type="text" name="prodname3[]" value="<?= $citem['dishes_name']; ?>">
                                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle" style="font-size: .6em"><strong><?= $citem['dishes_name']; ?></strong></a></h5><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;">Category: <?= $citem['c_name'] ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="font-size: .8em; padding-left: 60px; width: 22%;" class="border-0 align-middle">P<s><?= $citem['original_price'] ?></s> <strong>P<?= $citem['selling_price'] ?></strong>
                                                        <input type="text" name="prod_price3[]" value="<?= $citem['selling_price']; ?>">
                                                    </td>

                                                    <td class=" product_data border-0 align-middle">
                                                        <div class="input-group " style=" height:10px; width: 180px;">
                                                            <button class="input-group-text bg-white decrement-btn" style="width:30px; font-size: 1rem;">
                                                                <center>-</center>
                                                            </button>
                                                            <input type="text" name="prod_qty3[]" class="form-control text-center input-qty bg-white" style="width:30px; font-size:1rem;" value="<?= $citem['d_qty'] ?>">
                                                            <button class="input-group-text bg-white increment-btn" style="width:30px; font-size: 1rem;">
                                                                <center>+</center>
                                                            </button>
                                                        </div>
                                                        <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                                    </td>
                                                    <td class="border-0 align-middle"><a class="btn btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $citem['crtid']; ?>">DELETE</a></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End -->
                            </div>
                        </div>
                    <?php } else {
                        echo '';
                    } ?>

                    <?php
                    $userId = $_SESSION["user_id"];
                    $sql = "SELECT u_id, COUNT(*) as name_count  FROM `cart` WHERE `u_id` = '" . $userId . "'";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($result);
                    ?>

                    <section id="bottom" style="background-color: #000;
                    width: 100%; padding: 40px; background: #0C0A4A; 
                    background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: linear-gradient(to top right, #0C0A4A, #592F95); " class="fixed-bottom d-flex align-items-center">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" onclick="select_all2()" id="select2">(select all (<?php echo $row['name_count'] ?>))</input>
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:void(0)" class="link_delete" onclick="delete_all()" style=" border: none; padding: 10px 30px;
                                border: 0 solid #E2E8F0;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                background-color: #E2E8F0;
                                box-sizing: border-box;
                                color: #000;">Delete</a>
                            </div>
                            <p>Calculated Price: $<input type="text" name="price" id="price" disabled /></p>

                            <div class="col-md-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>


                    </section>


                </div>
            </div>

        </form>
    </main>


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

            function calculateSum() {
                var sumTotal = 0;
                $(' tbody tr').each(function() {
                    var $tr = $(this);

                    if ($tr.find('input[type="checkbox"]').prop("checked")) {

                        var $columns = $tr.find('td').next('td').next('td');

                        var $Qnty = parseInt($tr.find('input[type="text"]').val());
                        var $Cost = parseInt($columns.next('td').html().split('$')[1]);
                        sumTotal += $Qnty * $Cost;
                    }
                });

                $("#price").val(sumTotal);

            }

            $('#sum').on('click', function() {
                calculateSum();
            });

            $("input[type='text']").keyup(function() {
                calculateSum();
            });

            $("input[type='checkbox']").change(function() {
                calculateSum();
            });



        });
    </script>

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
                });


            });
        });




        // Delete 
        $(document).ready(function() {
            $('.menu_delete').click(function() {
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
                            url: 'cart_delete.php',
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

        function select_all1() {
            if (jQuery('#select1').prop("checked")) {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }

        function select_all2() {
            if (jQuery('#select2').prop("checked")) {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }

        function select_one() {
            var items1 = document.getElementsByName('checkbox1[]');
            if (jQuery('#delete1').prop("checked")) {
                jQuery(items1).each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery(items1).each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }

        function select_two() {
            var items2 = document.getElementsByName('checkbox2[]');
            if (jQuery('#delete2').prop("checked")) {
                jQuery(items2).each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery(items2).each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }


        function select_three() {
            var items3 = document.getElementsByName('checkbox3[]');
            if (jQuery('#delete3').prop("checked")) {
                jQuery(items3).each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery(items3).each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }

        function delete_all() {
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
                    jQuery.ajax({
                        url: 'cart_delete_all.php',
                        type: 'post',
                        data: jQuery('#form').serialize(),
                        success: function(result) {
                            jQuery('input[type=checkbox]').each(function() {
                                if (jQuery('#' + this.id).prop("checked")) {
                                    jQuery('#box' + this.id).remove();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'SUCCESS',
                                        text: 'Item Successfully Deleted!',
                                        timer: 2000
                                    }).then(function() {
                                        location.reload();
                                    });
                                }
                            })
                        }
                    });
                }
            });
        }


        // function checkout() {
        //     Swal.fire({
        //         title: 'Are you Sure?',
        //         text: "You won't be able to recover this file!",
        //         // showDenyButton: true,
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#bb2d3b',
        //         confirmButtonText: 'Yes, Delete it!',
        //     }).then((result) => {
        //         /* Read more about isConfirmed, isDenied below */
        //         if (result.isConfirmed) {
        //             jQuery.ajax({
        //                 url: 'cart_checkout2.php',
        //                 type: 'post',
        //                 data: jQuery('#form').serialize(),
        //                 success: function(result) {
        //                     jQuery('input[type=checkbox]').each(function() {
        //                         if (jQuery('#' + this.id).prop("checked")) {
        //                             jQuery('#box' + this.id).remove();
        //                             Swal.fire({
        //                                 icon: 'success',
        //                                 title: 'SUCCESS',
        //                                 text: 'Item Successfully Deleted!',
        //                                 timer: 2000
        //                             }).then(function() {
        //                                 location.reload();

        //                     location.href = '/CFOS/cart_checkout.php';
        //                             });
        //                         }
        //                     })
        //                 }
        //             });
        //         }
        //     });
        // }
    </script>
</body>

</html>