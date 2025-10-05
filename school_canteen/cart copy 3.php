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
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet"> -->

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
    <style>
        .button_1 {
            /* Button #1 from SimpleCSSButtons.com */
            color: #fff;
            /* Text Color */
            background-color: #0C0A4A;
            /* Background Color */
            width: 200px;
            /* Button Width */
            transition: 0.5s;
            /* Hover Transition Time */
            border: .2vmax solid rgb(47, 36, 148);
            /* Border Width & Color */
            padding: 10px 30px;
            /* Padding */
            text-decoration: none;
            /* Text Decoration */
            border-radius: 101vmax;
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

            $id = $_SESSION['user_id'];
            $loginquery = "SELECT * FROM `users` WHERE u_id = $id";
            $result = mysqli_query($db, $loginquery);
            $row = mysqli_fetch_array($result);
            $s_id = $row['s_id'];

            $sql_cart = "SELECT * FROM `cart` WHERE u_id = $userId AND  s_id = '".$s_id."'";
            $res_cart = mysqli_query($db, $sql_cart);
            if (mysqli_num_rows($res_cart) > 0) {
                $sql_cart = "SELECT * FROM `cart` WHERE s_id = '".$s_id."' AND u_id = $userId";
                $res_cart = mysqli_query($db, $sql_cart);
                if (mysqli_num_rows($res_cart) > 0) {
            ?>
                    <div class="row" style="padding: 20px; border-bottom: solid 25px #eee;">
                        <div class="col-lg-12">
                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <?php
                                $res1 = mysqli_query($db, "select * from student WHERE s_id = 1");
                                ?>
                                <table id="table">
                                    <tr style="background-color: #000;
            width: 100%; padding: 40px; background: #0C0A4A; 
            background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); 
            background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); 
            background: linear-gradient(to top right, #0C0A4A, #592F95); color: #fff; font-size: 1.2em; height: 50px;">
                                        <?php
                                        $sql_canteen1 = "SELECT * FROM `canteen` WHERE s_id = 1";
                                        $res_canteen1 = mysqli_query($db, $sql_canteen1);
                                        $canteen1 = mysqli_fetch_array($res_canteen1);
                                        ?>
                                        <th width="25%">
                                            <center><?php echo $canteen1['school_name']; ?></center>
                                        </th>
                                        <th width="25%">
                                            <center>Product</center>
                                        </th>
                                        <th width="25%">
                                            <center>Quantity</center>
                                        </th>
                                        <th width="25%">
                                            <center>Cost</center>
                                        </th>
                                        <th width="25%">
                                            <center>REMOVE</center>
                                        </th>
                                    </tr>


                                    <?php
                                    session_start();
                                    $userId = $_SESSION['user_id'];
                                    $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 1 AND d.stock > 0
ORDER BY c.crt_id DESC";

                                    $items = mysqli_query($db, $query);
                                    foreach ($items as $citem) {
                                    ?>
                                        <tr id="box<?php echo $row1['id']; ?>" style="padding: 30px; border-bottom: solid 2px #eee;">
                                            <td width="25%">
                                                <center><input type="checkbox" id="<?php echo $row1['crtid']; ?>" name="chck1[]" value="<?php echo $citem['dishes_name']; ?>" /></center> <b></b>
                                            </td>

                                            <td width="25%">
                                                <center><img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm"></center>
                                                <center><?= $citem['dishes_name']; ?></center>
                                            </td>
                                            <td width="25%" class=" product_data border-0 align-middle">
                                                <center>
                                                    <button class="decrement-btn" style="width:20px; font-size: 1rem;">
                                                        <center>-</center>
                                                    </button>
                                                    <input type="text" name="prod_qty1[]" class="input-qty bg-white" style="width:60px; font-size:1rem;" value="<?= $citem['d_qty'] ?>" readonly>
                                                    <button class="increment-btn" style="width:20px; font-size: 1rem;">
                                                        <center>+</center>
                                                    </button>

                                                    <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                                </center>
                                                <!-- <input type="text" name="qnty" value="<?= $citem['d_qty'] ?>"></center></td> -->
                                            <td width="25%">
                                                <center>P<?php echo $citem['selling_price']; ?></center>
                                            </td>
                                            <td width="25%">
                                                <center><a class="btn btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $citem['crtid']; ?>">DELETE</a></center>
                                                <input type="hidden" name="prodid1[]" value="<?= $citem['d_id']; ?>">
                                                <input type="hidden" name="prodname1[]" value="<?= $citem['dishes_name']; ?>">
                                                <input type="hidden" name="prod_price1[]" value="<?= $citem['selling_price']; ?>">
                                                <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                <?php } else {
                    echo '';
                } ?>


                <?php

                $userId = $_SESSION['user_id'];
                $sql_cart = "SELECT * FROM `cart` WHERE s_id = 2 AND u_id = $userId";
                $res_cart = mysqli_query($db, $sql_cart);
                if (mysqli_num_rows($res_cart) > 0) {
                ?>
                    <div class="row" style="padding: 20px; border-bottom: solid 25px #eee;">
                        <div class="col-lg-12">
                            <!-- Shopping cart table -->
                            <div class="table-responsive">

                                <table id="table">
                                    <tr style="background-color: #000;
                                    width: 100%; padding: 40px; background: #0C0A4A; 
                                    background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); 
                                    background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); 
                                    background: linear-gradient(to top right, #0C0A4A, #592F95); color: #fff; font-size: 1.2em; height: 50px;">
                                        <?php
                                        $sql_canteen1 = "SELECT * FROM `canteen` WHERE s_id = 2";
                                        $res_canteen1 = mysqli_query($db, $sql_canteen1);
                                        $canteen1 = mysqli_fetch_array($res_canteen1);
                                        ?>
                                        <th width="25%">
                                            <center><?php echo $canteen1['school_name']; ?></center>
                                        </th>
                                        <th width="25%">
                                            <center>Product</center>
                                        </th>
                                        <th width="25%">
                                            <center>Quantity</center>
                                        </th>
                                        <th width="25%">
                                            <center>Cost</center>
                                        </th>
                                        <th width="25%">
                                            <center>REMOVE</center>
                                        </th>
                                    </tr>


                                    <?php
                                    session_start();
                                    $userId = $_SESSION['user_id'];
                                    $query = "SELECT c.crt_id as crtid, c.d_id, c.d_qty, d.d_id as did, d.dishes_name, d.c_name, d.d_image, d.original_price, d.selling_price, d.stock  
FROM cart c, dishes d WHERE c.d_id = d.d_id AND c.u_id = '$userId' AND c.s_id = 2 AND d.stock > 0
ORDER BY c.crt_id DESC";


                                    $items = mysqli_query($db, $query);
                                    foreach ($items as $citem) {
                                    ?>
                                        <tr id="box<?php echo $citem['crtid']; ?>" style="padding: 30px; border-bottom: solid 2px #eee;">
                                            <td width="25%">
                                                <center><input type="checkbox" id="<?php echo $citem['crtid']; ?>" name="chck2[]" value="<?php echo $citem['dishes_name']; ?>" /></center>

                                            </td>

                                            <td width="25%">
                                                <center><img src="images/dishes/<?= $citem['d_image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm"></center>
                                                <center><?= $citem['dishes_name']; ?></center>
                                            </td>
                                            <td width="25%" class=" product_data border-0 align-middle">
                                                <center>
                                                    <button class="decrement-btn" style="width:20px; font-size: 1rem;">
                                                        <center>-</center>
                                                    </button>
                                                    <input type="text" name="prod_qty2[]" class="input-qty bg-white" style="width:60px; font-size:1rem;" value="<?= $citem['d_qty'] ?>" readonly>
                                                    <button class="increment-btn" style="width:20px; font-size: 1rem;">
                                                        <center>+</center>
                                                    </button>

                                                    <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                                </center>
                                                <!-- <input type="text" name="qnty" value="<?= $citem['d_qty'] ?>"></center></td> -->
                                            <td width="25%">
                                                <center>P<?php echo $citem['selling_price']; ?></center>
                                            </td>
                                            <td width="25%">
                                                <center><a class="btn btn-sm m-b-10 menu_delete button2" data-role="update" id="<?php echo $citem['crtid']; ?>">DELETE</a></center>
                                                <input type="hidden" name="prodid2[]" value="<?= $citem['d_id']; ?>">
                                                <input type="hidden" name="prodname2[]" value="<?= $citem['dishes_name']; ?>">
                                                <input type="hidden" name="prod_price2[]" value="<?= $citem['selling_price']; ?>">
                                                <input type="hidden" class="form-control text-center input-stock bg-white" style="width:50px; font-size:1.5rem;" value="<?= $citem['stock'] ?>" disabled>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                <?php } else {
                    echo '';
                }
            } else { ?>
                <div style="align-items:center; display:flex; margin-top:7%; justify-content: center;">
                    <div class="row">
                        <img src="images/background/checkout.svg" alt="" style="width:500px; height: 500px; align-items:center;">
                    </div><br>
                    <div class="row">
                        Your shopping cart is empty..
                        <a href="menu.php" class=" .button_1">Go Shopping now</a>
                    </div>

                </div>
            <?php  }
            ?>

            <section id="bottom" style="background-color: #000;
                    width: 100%; padding: 40px; background: #0C0A4A; 
                    background: -webkit-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: -moz-linear-gradient(bottom left, #0C0A4A, #592F95); 
                    background: linear-gradient(to top right, #0C0A4A, #592F95); " class="fixed-bottom">
                <div class="row">

                    <div class="col-sm-10">

                        <p>Total: $<input type="text" name="price" id="price" disabled /></p>
                    </div>


                    <div class="col-sm-2">
                        <input type="submit" name="submit" id="button_1" class="btn button_1" style="border:none; " value="Check Out">
                    </div>
                </div>


            </section>


        </form>
    </main>



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
                        var $Cost = parseInt($columns.next('td').html().split('P')[1]);
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