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
        .product .card {
            z-index: 0;
            background-color: #eceff1;
            padding-bottom: 20px;
            margin-top: 90px;
            margin-bottom: 90px;
            border-radius: 10px;
        }

        .product .top {
            padding-top: 40px;
            padding-left: 13% !important;
            padding-right: 13% !important;
        }

        /* Icon progressbar */

        .product #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455a64;
            padding-left: 0;
            margin-top: 30px;
        }

        .product #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400;
        }

        .product #progressbar .step0::before {
            font-family: FontAwesome;
            content: '\f10c';
            color: #fff;
        }

        .product #progressbar li::before {
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
        .product #progressbar li::after {
            content: '';
            width: 100%;
            height: 12px;
            background-color: #c5cae9;
            position: absolute;
            top: 16px;
            left: 0;
            z-index: -1;
        }

        .product #progressbar li:last-child::after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%;
        }

        .product #progressbar li:nth-child(2)::after,
        .product #progressbar li:nth-child(3)::after {
            left: -50%;
        }

        .product #progressbar li:first-child::after {
            border-top-left-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: 50%;
        }

        /* Color number of the step and the connect tor before it */

        .product #progressbar li.active::before,
        .product #progressbar li.active::after {
            background-color: #651fff;
        }

        .product #progressbar li.active::before {
            font-family: FontAwesome;
            content: '\f00c';
        }

        .product .icon {
            width: 80px;
            height: 60px;
            margin-right: 15px;
        }

        .product .product .icon-content {
            padding-bottom: 20px;
        }

        @media screen and (max-width: 992px) {
            .product .icon-content {
                width: 50%;
            }
        }

        .product .top {
            padding-top: 37px;
            padding-left: 12% !important;
            padding-right: 4% !important;
        }

        /* /////////////// */

        @import url('https://fonts.googleapis.com/css?family=Lato:400,700');



        .card_product .container {
            position: relative;
            margin: auto;

            justify-content: right;
            overflow: hidden;
            width: 520px;
            height: 200px;
            background: #F5F5F5;
            box-shadow: 5px 5px 15px rgba(#BA7E7E, .5);
            border-radius: 10px;
        }

        .card_product p {
            font-size: 0.6em;
            color: #BA7E7E;
            letter-spacing: 1px;
        }

        .card_product .card_product h1 {
            font-size: 1em;
            color: #4E4E4E;
            margin-top: -5px;
        }

        .card_product h2 {
            color: #C3A1A0;
            margin-top: -5px;
        }

        .card_product img {
            width: 250px;
            margin-top: 47px;
        }

        .card_product.slideshow-buttons {
            top: 70%;
            display: none;
        }

        .card_product.one,
        .two,
        .three,
        .four {
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #E0C9CB;
        }

        .card_product .one {
            left: 22%;
        }

        .card_product .two {
            left: 27%;
        }

        .card_product .three {
            left: 32%;
        }

        .card_product .four {
            left: 37%;
        }

        .card_product .product {
            position: absolute;
            width: 40%;
            height: 100%;
            top: 10%;
            left: 60%;
        }

        .card_product .desc {
            text-transform: none;
            letter-spacing: 0;
            margin-bottom: 17px;
            color: #4E4E4E;
            font-size: 1.2em;
            line-height: 1.6em;
            margin-right: 25px;
            text-align: right;
        }

        .card_product button {
            background: darken(#E0C9CB, 10%);
            padding: 10px;
            display: inline-block;
            outline: 0;
            border: 0;
            margin: -1px;
            border-radius: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #F5F5F5;
            cursor: pointer;

        }

        .card_product .add {
            width: 67%;
        }

        .card_product .like {
            width: 22%;
        }

        .card_product .sizes {
            display: grid;
            color: #D9AAB7;
            grid-template-columns: repeat(auto-fill, 30px);
            width: 60%;
            grid-gap: 4px;
            margin-left: 20px;
            margin-top: 5px;

        }

        .card_product .pick {
            margin-top: 11px;
            margin-bottom: 0;
            margin-left: 20px;
        }

        .card_product .size {
            padding: 9px;
            border: 1px solid #E0C9CB;
            font-size: 0.7em;
            text-align: center;

        }

        .card_product .focus {
            background: #BA7E7E;
            color: #F5F5F5;
        }

        .button_1 {
            /* Button #1 from SimpleCSSButtons.com */
            display: flex;
            color: #fff;
            /* Text Color */
            background-color: #0C0A4A;
            /* Background Color */
            width: 1200px;
            /* Button Width */
            transition: 0.5s;
            /* Hover Transition Time */
            border: .2vmax solid rgb(47, 36, 148);
            /* Border Width & Color */
            padding: 20px 30px;
            /* Padding */
            text-decoration: none;
            justify-content: center;
            /* Text Decoration */
            border-radius: 80vmax;
            font-size: 1.5rem;
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
    <?php include 'include/user_header.php';

    
    $userId = $_SESSION['user_id'];
    $sql_orders = "SELECT o_id, order_code, s_id,school_name, u_id, d_id,  day_arrival, time_arrival, `status`,`date`, COUNT(*) as name_count 
    FROM `users_orders` WHERE o_id = '" . $_GET["orderId"] . "' AND u_id = '" . $userId . "'
    GROUP BY order_code
	ORDER BY `o_id` DESC";

    // $sql_orders = "SELECT * FROM `users_orders` WHERE o_id = '" . $o_id . "'";
    $res_orders = mysqli_query($db, $sql_orders);
    $orders = mysqli_fetch_array($res_orders);

    $s_id = $orders['s_id'];
    $code = $orders['order_code'];
    $status = $orders['status'];
    ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">

        <div style="width: 100%; padding: 50px 100px; background: #eee;">



            <div class="product bg-white" style="width: 100%; margin: 20px 0; background: #eee; height: auto;">

                <div class="container px-1 px-md-4 py-5 mx-auto">
                    <div class="card">
                        <div class="row d-flex justify-content-between px-3 top">
                            <div class="d-flex">
                                <h5>
                                    ORDER
                                    <span style=" color: #8f00ff;" class="font-weight-bold">#<?php echo $orders['order_code']; ?></span>
                                </h5>
                            </div>
                            <div class="d-flex flex-column text-sm-right">
                                <p class="mb-0">
                                    <b>Expected Arrival</b> <span class="font-weight-bold"><?php echo $orders['time_arrival']; ?></span>
                                </p>
                                <p>
                                    <b>Today</b> <span class="font-weight-bold"><?php echo $orders['day_arrival']; ?></span>
                                </p>
                            </div>
                        </div>
                        <!-- Add class "active" to progress -->
                        <div class="row d-flex justify-content-between px-3">
                            <div class="col-12">
                                <ul id="progressbar" class="text-center">
                                    <?php
                                    if ($orders["status"] == "Check Out") {
                                    ?>
                                        <li class="active step0"></li>
                                        <li class=" step0"></li>
                                        <li class=" step0"></li>
                                        <li class="step0"></li>
                                    <?php   } else if ($orders["status"] == "In Process") { ?>

                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                        <li class=" step0"></li>
                                        <li class="step0"></li>
                                    <?php   } else  if ($orders["status"] == "On The Way") { ?>

                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                        <li class="step0"></li>
                                    <?php   } else if ($orders["status"] == "Delivered") { ?>

                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                        <li class="active step0"></li>
                                    <?php   }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-between  px-5 top">
                            <?php
                            if ($orders["status"] == "Check Out") {
                            ?>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/CheckList.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Checkout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Delivery.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />Processed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Shipping.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />On The Way</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Home.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            <?php   } else if ($orders["status"] == "In Process") { ?>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/CheckList.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Checkout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Delivery.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Processed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Shipping.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />On The Way</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Home.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            <?php   } else  if ($orders["status"] == "On The Way") { ?>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/CheckList.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Checkout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Delivery.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Processed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Shipping.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />On The Way</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Home.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold">Order <br />Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            <?php   } else if ($orders["status"] == "Delivered") { ?>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/CheckList.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Checkout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Delivery.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Processed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Shipping.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />On The Way</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row d-flex icon-content">
                                        <img src="images/background/Home.png" alt="" class="icon" style="width: 80px;" />
                                        <div class="d-flex flex-column">
                                            <p class="font-weight-bold" style=" color: #8f00ff;">Order <br />Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            <?php   }
                            ?>

                        </div>
                    </div>
                </div>

            </div>


            <div class="product bg-white" style="width: 100%; margin: 20px 0; background: #eee; height: auto;">

                <div class="card bg-white justify-content-between top">
                    <div class="d-flex">
                        <h5>
                            ORDER
                            <span style=" color: #8f00ff;" class="font-weight-bold">SUMMARY</span>
                        </h5>
                    </div>
                </div>



                <div class="row p-0">
                    <div class="col-md-6">

                        <?php
                        $sql_canteen = "SELECT *  FROM `canteen` WHERE s_id = '" . $s_id . "' ";

                        // $sql_orders = "SELECT * FROM `users_orders` WHERE o_id = '" . $o_id . "'";
                        $res_canteen = mysqli_query($db, $sql_canteen);
                        $canteen = mysqli_fetch_array($res_canteen);
                        ?>

                        <div class="container mt-5 mb-5">
                            <div class="d-flex justify-content-center row">
                                <div class="col-md-10">


                                    <div class="row p-2 bg-white border rounded">
                                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="images/logo/<?php echo $canteen["image"] ?>"></div>
                                        <div class="col-md-6 mt-1">
                                            <h5><?= $canteen['school_name']; ?></h5>
                                            <div class="mt-1 mb-1 spec-1"><i class="bx bxs-map"></i><?= $canteen['address']; ?></span></div>
                                            <!-- <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div> -->

                                            <h5>ABOUT US</h5>
                                            <p class="text-justify text-truncate para mb-0"><?= $canteen['about_us']; ?>.<br><br></p>
                                            <div class="justify-content-right">
                                                <h6 class="text-success"><?php echo $canteen['o_days'] . " - " . $canteen['c_hr']; ?></h6>
                                                <h6 class="text-success"><?php echo $canteen['o_hr'] . " - " . $canteen['c_hr']; ?></h6>
                                                <div class="d-flex flex-row align-items-center">

                                                    <i class="bx bxs-phone" style="font-size:1rem;"><span class="strike-text"></i><?= $canteen['phone']; ?></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">

                                            <a href="<?php echo $canteen["url"]; ?>">
                                                <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Visit our Facebook</button>
                                            </a>
                                            <a href="canteen.php?canteen=<?php echo $canteen["s_id"]; ?>"><button class="btn btn-outline-primary btn-sm mt-2" type="button">Visit our Canteen</button></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-md-6">
                    <?php

                    $query_items = "SELECT * FROM `users_orders` WHERE u_id = '$userId' AND order_code = '" . $code . "' ORDER BY o_id DESC";

                    $res_items = mysqli_query($db, $query_items);

                    $row = mysqli_fetch_array($res_items);
                    foreach ($res_items as $o_items) {
                        $d_id = $o_items['d_id'];
                        $sql_dishes = "SELECT *  FROM `dishes` WHERE d_id = '" . $d_id . "' ";

                        // $sql_orders = "SELECT * FROM `users_orders` WHERE o_id = '" . $o_id . "'";
                        $res_dishes = mysqli_query($db, $sql_dishes);
                        $dishes = mysqli_fetch_array($res_dishes);

                    ?>



                        <div class="container mt-5 mb-5">
                            <div class="d-flex justify-content-center row">
                                <div class="col-md-10">


                                    <div class="row p-2 bg-white border rounded">
                                        <div class="col-md-3 mt-1"><img src="images/dishes/<?= $dishes['d_image']; ?>" alt="" class="product-img" style="width: 100px; height: 100px;" /></div>
                                        <div class="col-md-6 mt-4">
                                            <h5><?= $dishes['dishes_name']; ?></h5>
                                            <div class="d-flex flex-row">
                                                <div class="ratings mr-2"></div><span>x <?= $o_items['d_qty']; ?></span>
                                            </div>
                                            <!-- <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div> -->
                                            <!-- <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>
                                            <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br></p> -->
                                        </div>
                                        <div class="align-items-center align-content-center col-md-3 border-left mt-4">
                                            <div class="d-flex flex-row align-items-center">
                                                <h4 class="mr-1"><s><?php if ($dishes['original_price'] == 0) {
                                                                        echo '';
                                                                    } else {
                                                                        echo "P " . $dishes['original_price'];
                                                                    } ?></s></h4>
                                                <span class="strike-text"><b>P <?php echo $prod_total = $o_items['d_qty'] * $dishes['selling_price']; ?></b></span>
                                            </div>
                                            <!-- <h6 class="text-success align-items-right"><?php echo $dishes['selling_price']; ?></h6> -->
                                        </div>
                                    </div>
                                    <?php
                                    $subtotal = $subtotal + $prod_total;
                                    $final_qty = $final_qty + $o_items['d_qty'];
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php
        // $sql_users = "SELECT *  FROM `users` WHERE u_id = '" . $userId . "' ";
        // $res_users = mysqli_query($db, $sql_users);
        // $users = mysqli_fetch_array($res_users);
        // if ($users['s_id'] == 1) {
        //     if ($canteen["s_id"] == 1) {
        //         $tax1 = 0;
        //     } else {
        //         $tax1 = 17;
        //         if ($final_qty == 1) {
        //             $tax1 = $tax1;
        //         } elseif ($final_qty > 2 && $final_qty < 5) {
        //             $tax1 = $tax1 + 20;
        //         } elseif ($final_qty > 6 && $final_qty < 10) {
        //             $tax1 = $tax1 + 40;
        //         } elseif ($final_qty > 11 && $final_qty < 15) {
        //             $tax1 = $tax1 + 60;
        //         } elseif ($final_qty > 16 && $final_qty < 25) {
        //             $tax1 = $tax1 + 80;
        //         }
        //     }
        //     if ($canteen["s_id"] == 2) {
        //         $tax2 = 0;
        //     } else {
        //         $tax2 = 17;
        //         if ($final_qty == 1) {
        //             $tax2 = $tax2;
        //         } elseif ($final_qty > 2 && $final_qty < 5) {
        //             $tax2 = $tax2 + 20;
        //         } elseif ($final_qty > 6 && $final_qty < 10) {
        //             $tax2 = $tax2 + 40;
        //         } elseif ($final_qty > 11 && $final_qty < 15) {
        //             $tax2 = $tax2 + 60;
        //         } elseif ($final_qty > 16 && $final_qty < 25) {
        //             $tax2 = $tax2 + 80;
        //         }
        //     }
        //     $tax = $tax1 + $tax2;
        // } else {
        //     if ($canteen["s_id"] == 1) {
        //         $tax1 = 17;
        //         if ($final_qty == 1) {
        //             $tax1 = $tax1;
        //         } elseif ($final_qty > 2 && $final_qty < 5) {
        //             $tax1 = $tax1 + 20;
        //         } elseif ($final_qty > 6 && $final_qty < 10) {
        //             $tax1 = $tax1 + 40;
        //         } elseif ($final_qty > 11 && $final_qty < 15) {
        //             $tax1 = $tax1 + 60;
        //         } elseif ($final_qty > 16 && $final_qty < 25) {
        //             $tax1 = $tax1 + 80;
        //         }
        //     } else {
        //         $tax1 = 0;
        //     }
        //     if ($canteen["s_id"] == 1) {
        //         $tax2 = 17;
        //         if ($final_qty == 1) {
        //             $tax2 = $tax2;
        //         } elseif ($final_qty > 2 && $final_qty < 5) {
        //             $tax2 = $tax2 + 20;
        //         } elseif ($final_qty > 6 && $final_qty < 10) {
        //             $tax2 = $tax2 + 40;
        //         } elseif ($final_qty > 11 && $final_qty < 15) {
        //             $tax2 = $tax2 + 60;
        //         } elseif ($final_qty > 16 && $final_qty < 25) {
        //             $tax2 = $tax2 + 80;
        //         }
        //         echo $tax2;
        //     } else {
        //         $tax2 = 0;
        //         echo $tax2;
        //     }

        //     $tax = $tax1 + $tax2;
        // }
        ?>


        <div class="product bg-white" style="width: 100%;  background: #eee; height: auto;">
            <div class="card bg-white justify-content-between top">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="d-flex">
                            <h4>
                                SUBTOTAL
                            </h4><br>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex">
                            <h5>
                                <span style=" color: #000;" class="font-weight-bold"><?php echo "P " . $subtotal . ".00"; ?></span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row" style="text-align:right;">
                    <div class="col-sm-9">
                        <div class="d-flex">
                            <h5>
                                CASH
                            </h5>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex">
                            <h5>
                                <?php
                                if ($row['cash'] == 0) {
                                    $cash = "EXACT AMOUNT";
                                } else {
                                    $cash = "P" . $row['cash'] . ".00";
                                }
                                ?>
                                <span style=" color: #000;" class="font-weight-bold"><?php echo  $cash;  ?></span>
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="product bg-white" style="width: 100%;  background: #eee; height: auto;">
            <div class="card bg-white justify-content-between top">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="d-flex">
                            <h5>
                                CHANGE
                            </h5><br>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex">
                            <h5>
                                <?php
                                if ($row['change'] == 0) {
                                    $change = "No Change";
                                } else {
                                    $change = "P " . $row['change'] . ".00";
                                }
                                ?>
                                <span style=" color: #000;" class="font-weight-bold"><?php echo $change; ?></span>
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php if ($orders["status"] == "Check Out") { ?>
            <form id="addOrder">
                <div class="product bg-white" style="width: 100%;  background: #eee; height: 100px;">

                </div>
            </form>
        <?php  } else if ($orders["status"] == "In Process" || $orders["status"] == "Cancelled") { ?>
            <form id="Cancelled">
                <input type="text" name="prodid[]" class="form-control" value="<?php echo $code; ?>">
                <input type="text" name="prodname[]" class="form-control" value="<?php echo $code; ?>">
                <!-- <input type="text" name="order_id[]" class="form-control" value="<?php echo $o_id['o_id']; ?>"> -->
                <!-- <input type="hidden" name="order_date[]" class="form-control" value="<?php echo $created_date; ?>"> -->
                <input type="text" name="status[]" class="form-control" value="<?php echo $status_in_process = "Cancelled"; ?>">
                <!-- <input type="hidden" name="admin[]" class="form-control" value="<?php echo $user_id; ?>"> -->
                <div class="product bg-white" style="width: 100%; display:flex;  background: #eee; height: auto;">
                    <input type="submit" name="submit" id="button_1" class="btn button_1" value="Cancel">
                </div>
            </form>
        <?php  } else if ($orders["status"] == "On The Way") { ?>
            <form id="Completed">
                <input type="text" name="prodid[]" class="form-control" value="<?php echo $code; ?>">
                <input type="text" name="prodname[]" class="form-control" value="<?php echo $code; ?>">
                <!-- <input type="text" name="order_id[]" class="form-control" value="<?php echo $o_id['o_id']; ?>"> -->
                <!-- <input type="hidden" name="order_date[]" class="form-control" value="<?php echo $created_date; ?>"> -->
                <input type="text" name="status[]" class="form-control" value="<?php echo $status_in_process = "Delivered"; ?>">
                <!-- <input type="hidden" name="admin[]" class="form-control" value="<?php echo $user_id; ?>"> -->
                <div class="product bg-white" style="width: 100%; display:flex;  background: #eee; height: auto;">
                    <input type="submit" name="submit" id="button_1" class="btn button_1" value="Completed">
                </div>
            </form>
        <?php   } ?>


        </div>
    </main>


    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////// -->

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- sweetalert2 message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>


    <script>
        $(document).on('submit', '#Cancelled', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("valid_info", true);
            {
                Swal.fire({
                    title: 'Do you want to cancel your order?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "order_cancel_process.php", //action
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

                                        location.href = '/order_cancelled.php';
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
            }
        });



        $(document).on('submit', '#Completed', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("valid_info", true);
            {
                Swal.fire({
                    title: 'Do you want to cancel your order?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "order_cancel_process.php", //action
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

                                        location.href = '/order_completed.php';
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
            }
        });
    </script>
</body>

</html>