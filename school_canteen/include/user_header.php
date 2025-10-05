    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container-fluid">

            <div class="row justify-content-center align-items-center">
                <div class="col-xl-11 d-flex align-items-center justify-content-between">
                    <h1 class="logo"><a href="index.php" style="text-decoration:none"> <img src="images/logo/cfoss.png" alt="cfos" style="width: 40px;height:40px;radius:50%;"> CFOS</a></h1>

                    <div class="order-lg-2 nav-btns">
                        <?php
                        if (empty($_SESSION["user_id"])) // if user is not login
                        {
                            echo '<button type="button" class="btn position-relative" style="padding: 0; margin: 0;">
                                    <a href="start.php"><i class="fa fa-shopping-cart"></i></a></button>';
                        } else {

                            $userId = $_SESSION["user_id"];
                            $sql = "SELECT u_id, COUNT(*) as name_count  FROM `cart` WHERE `u_id` = '" . $userId . "'";
                            $result = mysqli_query($db, $sql);
                            $row = mysqli_fetch_array($result);

                            echo '<button type="button" class="btn position-relative">
                                    <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>';

                            if ($row['name_count'] == 0) {
                                echo '';
                            } else {
                                echo '<span class="position-absolute top-0 start-100 translate-middle badge bg-primary" style="color:#fff; font-size: 12;">';
                                echo $row['name_count'] . '</span></button>';
                            }
                        } ?>
                    </div>

                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
                            <li><a class="nav-link scrollto" href="menu.php">Menu</a></li>
                            <!-- <li><a class="nav-link scrollto" href="all_canteen.php">Canteen</a></li> -->

                            <?php
                            error_reporting(0);
                            session_start();
                            if (empty($_SESSION["user_id"])) // if user is not login
                            { ?>
                                <li><a class="nav-link  " href="start.php">Login</a></li>
                            <?php } else { ?>
                                <li><a class="nav-link scrollto" href="order_waiting.php">Activity</a></li>

                                <?php
                                $id = $_SESSION['user_id'];
                                $profile_query = "SELECT * FROM `users` WHERE u_id = $id";
                                $result = mysqli_query($db, $profile_query);
                                $row = mysqli_fetch_array($result);
                                if (is_array($row)) {
                                    if (empty($row['image'])) { ?>
                                        <li class="dropdown"><a href="#"><span><i class="bx bx-user" style="border-radius:100%; font-size: 1.5em; color: #fff;"></i></span></i></a>
                                        <?php  } else { ?>
                                        <li class="dropdown"><a href="#"><span><img class="rounded-circle"  src="images/user_profile/<?php echo $row['image']; ?>" style=" font-size: 1.5em; height: 40px; width: 40px;" alt="profile"></span></a>
                                    <?php }
                                } ?>

                                    <ul>
                                        <li><a href="user_profile.php">Profile Setting</a></li>
                                        <li><a href="logout.php">logout</a></li>
                                    </ul>
                                        </li>
                                    <?php } ?>

                        </ul>

                        <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->

                </div>
            </div>

        </div>
    </header><!-- End Header -->