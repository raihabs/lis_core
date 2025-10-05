<?php

$user_id = $_SESSION['adm_id'];
$sel_user = "SELECT * FROM `admin` WHERE adm_id = '" . $user_id . "'";
$res_creator = mysqli_query($db, $sel_user);
$row = mysqli_fetch_array($res_creator);

$sel_canteen = "SELECT * FROM `canteen` WHERE s_id = '" . $row['s_id'] . "'";
$res_canteen = mysqli_query($db, $sel_canteen);
$show = mysqli_fetch_array($res_canteen);

?>

<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3><img src="../images/logo/cfoss.png" alt="cfos" style="width: 45px;height:45px;radius:50%;"><span> CFOS</span></h3>
    </div>

    <ul class="list-unstyled components">
        <li class="nav-devider"></li>
        <li class="nav-label">Home</li>
        <li>
            <a href="dashboard.php" class="dashboard"><i class="bx bxs-grid-alt icon" style="font-size:22px;"></i><span>Dashboard</span></a>
        </li>

        <li class="nav-devider"></li>
        <li class="nav-label">set</li>

        <li>
            <a href="category_view.php" class="dashboard"><i class="bx bx-archive-in icon" style="font-size:22px;"></i><span>Categories</span></a>
        </li>
        <li>
            <a href="dishes_view.php" class="dashboard"><i class="bx bxs-food-menu icon" style="font-size:22px;"></i><span>Menu</span></a>
        </li>

        <li class="nav-devider"></li>
        <li class="nav-label">orders</li>

        <li>
            <a href="user_order_view.php" class="dashboard"><i class="bx bx-list-ul icon" style="font-size:22px;"></i><span>Order History</span></a>
        </li>

        <li>
            <a href="user_order_checkout_view.php" class="dashboard"><i class="bx bxs-cart icon" style="font-size:22px;"></i><span>Check Out</span></a>
        </li>
        <li>
            <a href="user_order_inprocess_view.php" class="dashboard"><i class="bx bxs-dish icon" style="font-size:22px;"></i><span>In Process</span></a>
        </li>
        <li>
            <a href="user_order_ontheway_view.php" class="dashboard"><i class="bx bxs-backpack icon" style="font-size:22px;"></i><span>On The Way</span></a>
        </li>
        <li>
            <a href="user_order_delivered_view.php" class="dashboard"><i class="bx bxs-home-alt-2 icon" style="font-size:22px;"></i><span>Delivered</span></a>
        </li>
        <li>
            <a href="user_order_cancelled_view.php" class="dashboard"><i class="bx bx-x icon" style="font-size:22px;"></i><span>Cancelled</span></a>
        </li>

        <li>
            <a href="admin_profile_view.php"><i class="bx bx-user icon" style="font-size:22px;"></i>Profile Setting</a>
        </li>
    </ul>
</nav>