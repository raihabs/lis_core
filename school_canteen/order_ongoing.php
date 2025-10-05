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
    <link href="images/logo/cfos.png" rel="icon">
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
    <link href="css/page.css" rel="stylesheet">

    <!-- /////////////////////////////////////////////////////////////////////// -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <!-- <link rel="stylesheet" href="css/product.css"> -->

    <link href="css/page.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- custom js file link  -->
    <script src="js/category_button.js" defer></script>
    <script src="js/search.js" defer></script>
    <script src="js/quantity.js" defer></script>

    <!-- /////////////////////////////////////////// -->

    <!-- Stylesheet -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- FontAwesome 4.7.0 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #8c9eff;
            background-repeat: no-repeat;
        }

        .card {
            z-index: 0;
            background-color: #eceff1;
            padding-bottom: 20px;
            margin-top: 90px;
            margin-bottom: 90px;
            border-radius: 10px;
        }

        .top {
            padding-top: 40px;
            padding-left: 13% !important;
            padding-right: 13% !important;
        }

        /* Icon progressbar */

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455a64;
            padding-left: 0;
            margin-top: 30px;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400;
        }

        #progressbar .step0::before {
            font-family: FontAwesome;
            content: '\f10c';
            color: #fff;
        }

        #progressbar li::before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #c5cae9;
            border-radius: 50%;
            margin: auto;
            padding: 0;
        }

        /* Progressbar connector */
        #progressbar li::after {
            content: '';
            width: 100%;
            height: 12px;
            background-color: #c5cae9;
            position: absolute;
            top: 16px;
            left: 0;
            z-index: -1;
        }

        #progressbar li:last-child::after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%;
        }

        #progressbar li:nth-child(2)::after,
        #progressbar li:nth-child(3)::after {
            left: -50%;
        }

        #progressbar li:first-child::after {
            border-top-left-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: 50%;
        }

        /* Color number of the step and the connect tor before it */

        #progressbar li.active::before,
        #progressbar li.active::after {
            background-color: #651fff;
        }

        #progressbar li.active::before {
            font-family: FontAwesome;
            content: '\f00c';
        }

        .icon {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .icon-content {
            padding-bottom: 20px;
        }

        @media screen and (max-width: 992px) {
            .icon-content {
                width: 50%;
            }
        }

        .top {
            padding-top: 37px;
            padding-left: 12% !important;
            padding-right: 4% !important;
        }
    </style>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">
        <div style="width: 100%; padding: 50px 0; background: #0C0A4A; background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); background: linear-gradient(to top right, #0C0A4A, #592F95); ">
            <div class="title text-left" style="margin-left: 55px;">
                <div class="row">
                    <div class="col-md-12">


                        <button class="button-value">
                            <a href="order_waiting.php" style="text-decoration: none; border: 2px solid #6c5ce7;
                                            padding:1.8em 1.9em;
                                            border-radius: 0.2em;
                                            background-color: #a29bfe;
                                            transition: 1s; color: #fff;">
                                Waiting
                            </a>
                        </button>

                        <button class="button-value">
                            <a href="order_ongoing.php" style="text-decoration: none; border: 2px solid #6c5ce7;
                                            padding:1.8em 1.9em;
                                            border-radius: 0.2em;
                                            background-color:  #0C0A4A;;
                                            transition: 1s; color: #fff;">
                                Ongoing
                            </a>
                        </button>


                        <button class="button-value">
                            <a href="order_cancelled.php" style="text-decoration: none; border: 2px solid #6c5ce7;
                                            padding:1.8em 1.9em;
                                            border-radius: 0.2em;
                                            background-color: #a29bfe;
                                            transition: 1s; color: #fff;">
                                Cancelled
                            </a>
                        </button>

                        <button class="button-value">
                            <a href="order_completed.php" style="text-decoration: none; border: 2px solid #6c5ce7;
                                            padding:1.8em 1.9em;
                                            border-radius: 0.2em;
                                            background-color: #a29bfe;
                                            transition: 1s; color: #fff;">
                                Completed
                            </a>
                        </button>




                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%; padding: 10px 100px; background: #eee;">


            <?php
            session_start();
            $userId = $_SESSION['user_id'];
            $query_code = "SELECT o_id, order_code, s_id, school_name, u_id, d_id, day_arrival, time_arrival, status, date, COUNT(*) as name_count FROM `users_orders` 
                WHERE u_id = '" . $userId . "' GROUP BY order_code
		        ORDER BY `o_id` DESC";
            $items_code = mysqli_query($db, $query_code);
            foreach ($items_code as $code) {


                $sql_product = "SELECT *  FROM `users_orders` WHERE order_code = '" . $code['order_code'] . "' AND status = 'On The Way' ";
                $items_product = mysqli_query($db, $sql_product);
                foreach ($items_product as $product) {

                    $query_dishes = "SELECT * FROM `dishes` WHERE d_id = '" . $code['d_id'] . "'";
                    $res_dishes = mysqli_query($db, $query_dishes);
                    $row = mysqli_fetch_array($res_dishes);
            ?>


                    <div class="bg-white" style="width: 100%; margin: 10px 0; background: #eee; height: auto;">
                        <div class="card bg-white justify-content-between px-5 top">
                            <div class="d-flex">
                                <h5>
                                    ORDER
                                    <span style=" color: #8f00ff;" class="font-weight-bold">#<?php echo $product['order_code']; ?></span>
                                </h5>
                            </div>
                            <!-- <?php
                                    $sql_header = "SELECT order_code,s_id,school_name COUNT(*)  FROM `users_orders` WHERE order_code = '" . $code['order_code'] . "' AND s_id = '" . $product['s_id'] . "' ";

                                    // $sql_orders = "SELECT * FROM `users_orders` WHERE o_id = '" . $o_id . "'";
                                    $res_header = mysqli_query($db, $sql_header);
                                    foreach ($res_header as $header) { ?>
                        <div class="d-flex" style="padding: 1.5rem;">
                            <i class="bx bxs-home" style="font-size:1.5rem;"></i> <span style="font-size:1rem; margin-left: 15px;"><?php echo $product['school_name']; ?></span>
                        </div>
                        <?php } ?> -->
                        </div>
                        <div class="row">
                            <div class="col-md-6 px-5" style="bottom: 55px; align-items: center; display:flex; justify-content:center;">
                                <div class="d-flex d-inline-block  flex-column text-sm-left align-left px-5">
                                    <img src="images/dishes/<?= $row['d_image']; ?>" alt="" width="220" class="img-fluid shadow-sm">
                                </div>

                                <div class="d-flex d-inline-block  flex-column text-sm-left align-left px-5">
                                    <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle" style="font-size: .6em"><strong><?php echo $row['dishes_name']; ?></strong></a>
                                    </h5><span class="text-muted font-weight-normal font-italic d-block" style="font-size: .8em;">Category: <?php echo $row['c_name'] ?></span>
                                    <p><a href="#" class=" .button_1">to see more details please click view order</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 px-5" style="bottom: 25px; ">
                                <div class="d-flex d-inline-block  flex-column text-sm-right align-right px-5">
                                    <p class="mb-0">
                                        Expected Arrival by<span class="font-weight-bold">&nbsp;<?php echo $product['time_arrival']; ?></span>
                                    </p>
                                    <p>
                                        Today <span class="font-weight-bold">&nbsp;<?php echo $product['day_arrival']; ?></span>
                                    </p>
                                   

                                    <a href="order.php?orderId=<?php echo  $product["o_id"]; ?>">
                                        <input type="submit" name="submit" id="button_1" class="btn button_1" style="border:none; " value="View Order">
                                    </a>

                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
            <?php }
            } ?>

        </div>
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