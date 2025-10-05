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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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

    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <?php include 'include/user_header.php'; ?>


    <!-- ======= hero Section ======= -->
    <section id="top" style="background-color: #000;padding: 35px;">
    </section><!-- End Hero Section -->

    <main id="main">



        <form action="menu.php" method="POST">
            <div class="row" style="padding: 50px;">
                <div class="col-md-4">
                    <input type="text" name="search_value" value="<?php if (isset($_GET['search_value'])) {
                                                                        echo $_GET['search_value'];
                                                                    } ?>" class="form-control form-control-lg" placeholder="Type Here..." id="search_value" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="javascript:load_data(this.value)" onfocus="javascript:load_search_history()" />
                    <span id="search_result"></span>
                </div>
                <div class="col-md-1">

                    <button type="submit" name="search_btn" id="search" style="padding:10px 20px; background-color: #8f00ff; color:#fff; border: none; border-radius: 12%;">Search</button>

                </div>
            </div>
        </form>

        <section id="clients">
            <div class="container" data-aos="zoom-in">
                <!-- 
                <header class="section-header">
                    <h3>Categories</h3>
                </header> -->

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <?php
                        $sql_category = "SELECT * FROM `category`";
                        $query_category = $db->query($sql_category); ?>
                        <div class="swiper-slide">
                            <img src="images/category/1. cart.jpg" style="object-fit: contain; width: 300px; height:150px; margin: 10px; padding-right: 100px;" alt="" onclick="filterProduct('all')">
                        </div>
                        <?php if (mysqli_num_rows($query_category) > 0) {
                            foreach ($query_category as $res) {
                        ?>
                                <div class="swiper-slide">
                                    <img src="images/category/<?php echo $res['c_image'] ?>" onclick="filterProduct('<?php echo $res['c_name'] ?>')" style="object-fit: contain; width:150px; height:150px; margin-top:10px;" alt="">
                                </div>
                        <?php }
                        } ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Our Clients Section -->


        <section id="team" style="width: 100%; padding: 20px; background: #eee;">
            <div class="page">
                <div class="display-content" style="display: none">
                    <div class="row">

                        <?php
                        $id = $_SESSION['user_id'];
                        $loginquery = "SELECT * FROM `users` WHERE u_id = $id";
                        $result = mysqli_query($db, $loginquery);
                        $row = mysqli_fetch_array($result);
                        $s_id = $row['s_id'];
                        if (isset($_POST['search_value'])) {
                            $value_search = $_POST['search_value'];
                            $query = "SELECT * FROM `dishes` WHERE  s_id ='" . $s_id . "' ANDCONCAT(s_id,dishes_name,c_name,d_image) LIKE '%$value_search%' ";
                            $all_products = $db->query($query);

                            if (mysqli_num_rows($all_products) > 0) {
                                foreach ($all_products as $items) {
                                    if ($items['stock'] > 0) { ?>

                                        <div class="display <?= $items["d_id"] ?>" data-name="p-<?php echo $items['d_id'] ?>">
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
                                        <h3>No Available Item</h3>
                                        <p>try other menu.</p>
                                    </div>
                                </div>

                            <?php }
                        } else { ?>
                            <?php
                            $query = "SELECT * FROM `dishes` WHERE s_id ='" . $s_id . "' AND stock > 0";
                            $all_products = $db->query($query);

                            if (mysqli_num_rows($all_products) > 0) {
                                foreach ($all_products as $items) {
                                    if ($items['stock'] > 0) { ?>

                                        <div class="display <?= $items["c_name"] ?>" data-name="p-<?php echo $items['d_id'] ?>">
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
                            } ?>

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