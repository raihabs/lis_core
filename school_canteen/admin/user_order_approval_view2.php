<!DOCTYPE html>
<html>
<?php
// include '../include/admin_meta_data.php';
// include '../include/admin_top.php';
include '../config/config.php';

error_reporting(0);
session_start();
if (!isset($_SESSION['adm_id'])) {
    header("Location: ../admin/start.php");
} else
?>

<head>
   
   
<title>CFOS</title>
    <link href="../images/logo/cfoss.png" rel="icon">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="page.css">

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!----css3---->
    <link rel="stylesheet" href="../css/admin_sidebar_header.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- sweetalert message -->
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="page.css"> -->

</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        <?php
        $user_id = $_SESSION['adm_id'];
        $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
        $res_creator = mysqli_query($db, $sel_user);
        $show = mysqli_fetch_array($res_creator);
        $adm_id = $show['s_id'];
        if ($show['user_role'] == 'super-admin') {
            include '../include/admin_super_sidebar.php';
        } else if ($show['user_role'] == 'admin') {
            include '../include/admin_sidebar.php';
        }
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
        $user_id = $_SESSION['adm_id'];
        $sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
        $res_creator = mysqli_query($db, $sel_user);
        $show = mysqli_fetch_array($res_creator);
        $adm_id = $show['s_id'];
        if ($show['user_role'] == 'super-admin') {
            include '../include/admin_header_super.php';
        } else if ($show['user_role'] == 'admin') {
            include '../include/admin_header.php';
        }
        ?>
            <div class="main-content">
                <!-- Bread crumb -->
                <div class="row" style=" padding: 1rem 0; background-color: #fff;">
                    <div class="col-5 align-self-center">
                        <h3 class="text-primary">Dashboard</h3>
                    </div>


                </div>
                <!-- End Bread crumb -->

                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Available Foods Data</h4>
                                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                    <div class="table-responsive m-t-40">

                                        <div class="product_container">


                                            <!-- method="post" action="checkbox-db.php" -->
                                            <form id="UpdateOrder">




                                                <?php
                                                // PHP program to count number of
                                                // words in a string 

                                                $string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua";

                                                // Using str_word_count() function to
                                                // count number of words in a string

                                                $count = 0;
                                                $length = strlen($string);

                                                for ($i = 0; $i < $length; $i++) {
                                                    if (ctype_alpha($string[$i])) {
                                                        $count++;
                                                    }
                                                }

                                                // Printing the result
                                                $count1 = $count;
                                                $right_side = $count1  - 25;



                                                ?>
                                                <div class="page">
                                                    <div class="display-content" style="display: none">

                                                        <?php


                                                        $sql_order = "SELECT * FROM `users_orders` WHERE s_id = '" . $adm_id . "' AND status = 'Cancelled' ";
                                                        $res_order = mysqli_query($db, $sql_order);
                                                        if (mysqli_num_rows($res_order) > 0) {
                                                            $query_code = "SELECT o_id, order_code, s_id, school_name, u_id, d_id, day_arrival, time_arrival, date, COUNT(*) as name_count FROM `users_orders` 
                                                    WHERE s_id = '" . $adm_id . "' AND status = 'Cancelled' GROUP BY order_code
                                                    ORDER BY `name_count` DESC";
                                                            $items_code = mysqli_query($db, $query_code);
                                                            foreach ($items_code as $code) {

                                                                $sql_product = "SELECT *  FROM `users_orders` WHERE s_id = '" . $adm_id . "' AND status = 'Cancelled' AND order_code = '" . $code['order_code'] . "' ";
                                                                $items_product = mysqli_query($db, $sql_product);
                                                                foreach ($items_product as $product) {

                                                                    $query_dishes = "SELECT * FROM `dishes` WHERE d_id = '" . $product['d_id'] . "'";
                                                                    $res_dishes = mysqli_query($db, $query_dishes);
                                                                    $row = mysqli_fetch_array($res_dishes);

                                                                    $query_users = "SELECT * FROM `users` WHERE u_id = '" . $product['u_id'] . "'";
                                                                    $res_users = mysqli_query($db, $query_users);
                                                                    $users = mysqli_fetch_array($res_users);
                                                        ?>

                                                                        <div class="display">
                                                                            <!-- <input type="checkbox" name="prodid[]" value="Car"> -->

                                                                            <div class="row" style="height: 300px;">
                                                                                <div class="display-image" style=" max-height: 200px;"><img src="../images/dishes/<?php echo $row['d_image']; ?>" style=" max-width: 100%;  height: auto; " alt=""></div>
                                                                            </div>
                                                                            <div class="display-info">
                                                                                <div class="row">
                                                                                    <div class="card bg-white justify-content-between top">
                                                                                        <div class="d-flex">
                                                                                            <h5>
                                                                                                ORDER
                                                                                                <spanclass="font-weight-bold">SUMMARY</span>
                                                                                            </h5>
                                                                                        </div>
                                                                                        <div class="flex">
                                                                                            <h4  style=" color: #8f00ff;" ><b><?php echo $product["order_code"]; ?></b></h4>
                                                                                            <h5><b>Fullname: </b><?php echo $product['firstname'] . " " . $product['lastname']; ?></h5>

                                                                                            <h5><b>Username: </b><?php echo $users['username']; ?></h5>
                                                                                            <h5><i class="bx bxs-phone"></i><?php echo $users['phone']; ?></h5>
                                                                                            <h5><i class="bx bxs-map"></i><?php echo $users['location']; ?></h5>
                                                                                            <h5><?php echo $users['usertype']; ?></h5>
                                                                                            <h5><b>Time:</b> <?php echo $product['time_arrival']; ?></h5>
                                                                                            <h5><b>Status:</b> <?php echo $product['status']; ?></h5>
                                                                                            
                                                                                            <a class="btn btn-success category_edit button1" data-bs-toggle="modal" data-bs-target="#viewOrder" value="<?= $row['c_id']; ?>" data-role="update" id="<?php echo $row['c_id']; ?>">View Order</a>

                                                                                        </div>
                                                                                    </div>


                                                                                </div>
                                                                                <?php
                                                                                date_default_timezone_set('Asia/Manila');
                                                                                $created_date = date("Y-m-d H:i:s");
                                                                                ?>
                                                                                <input type="checkbox" name="prodid[]"  value="<?php echo $product['order_code']; ?>">  CHECK THE BOX IF YOU WANT TO CONTINUE THE DELIVERY OF THIS ORDER
                                                                                <input type="text" name="prodname[]" class="form-control" value="<?php echo $product['order_code']; ?>">
                                                                                <input type="text" name="order_id[]" class="form-control" value="<?php echo $product['o_id']; ?>">
                                                                                <input type="text" name="order_date[]" class="form-control" value="<?php echo $created_date; ?>">
                                                                                <input type="text" name="status[]" class="form-control" value="<?php echo $status_in_process = "On The Way"; ?>">
                                                                                <input type="text" name="admin[]" class="form-control" value="<?php echo $user_id; ?>">
                                                                            </div>
                                                                        </div>
                                                                        
                                                            <?php }
                                                            }
                                                        } else { ?> 
                                                                <div class="display">
                                                                    <!-- <input type="checkbox" name="prodid[]" value="Car"> -->

                                                                    <div class="display-image" style=" max-height: 200px;"><img src="../images/dishes/<?php echo $row['d_image']; ?>" style=" max-width: 100%;  height: auto; " alt=""></div>
                                                                    <div class="display-info">
                                                                        <div style="align-items:center; display:flex; margin-top:7%; justify-content: center;">
                                                                            <div class="row">
                                                                                <img src="../images/background/checkout.svg" alt="" style="width:500px; height: 500px; align-items:center;">
                                                                            </div><br><br>
                                                                        </div>
                                                                        <div style="align-items:center; display:flex; margin-top:7%; padding: 20px;justify-content: center;">

                                                                            <div class="row">
                                                                                All CANCELLED order data in your DATABASE is empty..
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="part">
                                                            <li class="sections-item previous-section disable"><a class="sections-link" href="#">Prev</a></li>
                                                            <li class="sections-item current-section purple"><a class="sections-link" href="#">1</a></li>
                                                            <li class="sections-item dots"><a class="sections-link" href="#">...</a></li>
                                                            <li class="sections-item current-section"><a class="sections-link" href="#">5</a></li>
                                                            <li class="sections-item current-section"><a class="sections-link" href="#">6</a></li>
                                                            <li class="sections-item dots"><a class="sections-link" href="#">...</a></li>
                                                            <li class="sections-item current-section"><a class="sections-link" href="#">10</a></li>
                                                            <li class="sections-item next-section"><a class="sections-link" href="#">Next</a></li>
                                                        </div>


                                                    </div>
                                                </div>

                                                <?php if (mysqli_num_rows($res_order) > 0) { ?>
                                                <div class="text-center">
                                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                                </div>
                                                <?php } else{ ?>
                                                    
                                               <?php }?>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End PAge Content -->
                </div>
                <!-- End Container fluid  -->


            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true" style=" background-color: rgba(0,0,0,0.7);">
        <div class="modal-dialog">
            <div class="modal-content" style="width:700px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Orders #<?php echo $product["order_code"]; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="row p-t-20">
                        <?php

                        $query_items = "SELECT * FROM `users_orders` WHERE u_id = '" . $users["u_id"] . "' AND order_code = '" . $product["order_code"] . "' ORDER BY o_id DESC";

                        $res_items = mysqli_query($db, $query_items);
                        foreach ($res_items as $o_items) {
                            $d_id = $o_items['d_id'];
                            $sql_dishes = "SELECT *  FROM `dishes` WHERE d_id = '" . $d_id . "' ";

                            // $sql_orders = "SELECT * FROM `users_orders` WHERE o_id = '" . $o_id . "'";
                            $res_dishes = mysqli_query($db, $sql_dishes);
                            $dishes = mysqli_fetch_array($res_dishes);

                        ?>



                            <div class="container">
                                <div class="d-flex">
                                    <div class="col-sm-12">


                                        <div class="row p-2 bg-white border rounded">
                                            <div class="col-md-3 mt-1"><img src="../images/dishes/<?= $dishes['d_image']; ?>" alt="Green tomatoes" class="product-img" style="width: 100px; height: 100px;" /></div>
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
                <?php
                // $sql_users = "SELECT *  FROM `users` WHERE u_id = '" . $users["u_id"] . "' ";
                // $res_users = mysqli_query($db, $sql_users);
                // $users = mysqli_fetch_array($res_users);
                // if ($users['s_id'] == 1) {
                //     if ($product["s_id"] == 1) {
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
                //     if ($product["s_id"] == 2) {
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
                //     if ($product["s_id"] == 1) {
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
                //     if ($product["s_id"] == 1) {
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
                //     }

                //     $tax = $tax1 + $tax2;
                // }
                ?><div class="row p-t-20">

                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="d-flex">
                            <div class="card bg-white justify-content-between top">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <h5>
                                                Subtotal
                                            </h5><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <h5>
                                                <span style=" color: #000; text-align:right;"" class="font-weight-bold"><?php echo "P " . $subtotal . ".00"; ?></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="text-align:right;">
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <h5>
                                                Delivery Fee
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="d-flex">
                                            <?php
                                            if ($product['cash'] == 0) {
                                                $cash = "EXACT AMOUNT";
                                            } else {
                                                $cash = $orders['change'];
                                            }
                                            ?>
                                            <span style=" color: #000;" class="font-weight-bold"><?php echo $cash;  ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <h5>
                                                CHANGE
                                            </h5><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <h5>
                                                <?php
                                                if ($product['change'] == 0) {
                                                    $change = "No Change";
                                                } else {
                                                    $change = $orders['change'];
                                                }
                                                ?>
                                                <span style=" color: #000;" class="font-weight-bold"><?php echo $change; ?></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>






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


    <script src="js/jquery.slimscroll.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $('.more-button,.body-overlay').on('click', function() {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });

        });
    </script>
    <!-- <script src="js/jquery-3.3.1.slim.min.js"></script> -->
    <!-- <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> -->

</body>

</html>
<script>
    // Add Modal
    $(document).on('submit', '#UpdateOrder', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("valid_info", true);
        {
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "user_order_process.php", //action
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
                                    location.href = '/CFOS/admin/user_order_delivered_view.php';
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



<script type="text/javascript">
    function getPageList(totalPages, page, maxLength) {
        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

        if (totalPages <= maxLength) {
            return range(1, totalPages);
        }

        if (page <= maxLength - sideWidth - 1 - rightWidth) {
            return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
        }

        if (page >= totalPages - sideWidth - 1 - rightWidth) {
            return range(1, sideWidth).concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
        }

        return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
    }

    $(function() {
        var numberOfItems = $(".display-content .display").length;
        var limitPerPage = 12; //How many card items visible per a page
        var totalPages = Math.ceil(numberOfItems / limitPerPage);
        var paginationSize = 7; //How many page elements visible in the pagination
        var currentPage;

        function showPage(whichPage) {
            if (whichPage < 1 || whichPage > totalPages) return false;

            currentPage = whichPage;

            $(".display-content .display").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

            $(".part li").slice(1, -1).remove();

            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                $("<li>").addClass("sections-item").addClass(item ? "current-section" : "dots")
                    .toggleClass("purple", item === currentPage).append($("<a>").addClass("sections-link")
                        .attr({
                            href: "javascript:void(0)"
                        }).text(item || "...")).insertBefore(".next-section");
            });

            $(".previous-section").toggleClass("disable", currentPage === 1);
            $(".next-section").toggleClass("disable", currentPage === totalPages);
            return true;
        }

        $(".part").append(
            $("<li>").addClass("sections-item").addClass("previous-section").append($("<a>").addClass("sections-link").attr({
                href: "javascript:void(0)"
            }).text("Prev")),
            $("<li>").addClass("sections-item").addClass("next-section").append($("<a>").addClass("sections-link").attr({
                href: "javascript:void(0)"
            }).text("Next"))
        );

        $(".display-content").show();
        showPage(1);

        $(document).on("click", ".part li.current-section:not(.purple)", function() {
            return showPage(+$(this).text());
        });

        $(".next-section").on("click", function() {
            return showPage(currentPage + 1);
        });

        $(".previous-section").on("click", function() {
            return showPage(currentPage - 1);
        });
    });
</script>