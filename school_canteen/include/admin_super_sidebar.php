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
        <h3><img src="../images/logo/<?php echo $show['image']; ?>" style="with:45px; height:45px;border-radius:100%;" /> <img src="../images/logo/cfoss.png" alt="cfos" style="width: 45px;height:45px;radius:50%;"><span> CFOS</span></h3>
    </div>

    <ul class="list-unstyled components">

        <li class="nav-devider"></li>
        <li class="nav-label">Home</li>
        <li>
            <a href="dashboard.php" class="dashboard"><i class="bx bxs-grid-alt icon" style="font-size:22px;"></i><span>Dashboard</span></a>
        </li>


        <li class="nav-devider"></li>
        <li class="nav-label">school</li>

        <li>
            <a href="announcement_view.php" class="announcement"><i class="bx bx-image-add icon" style="font-size:22px;"></i><span>Announcement Slide</span></a>
        </li>

        <li>
            <a href="canteen_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>School Canteen</a>
        </li>


        <li class="nav-devider"></li>
        <li class="nav-label">Admin</li>

        <li class="dropdown">
            <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bx bx-user icon" style="font-size:22px;"></i><span>Admin</span></a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu1">

                <li>
                    <a href="admin_view.php"><i class="bx bxs-user icon" style="font-size:22px;"></i>Admin Information</a>
                </li>
                <li>
                    <a href="admin_codes_view.php"><i class="bx bx-dice-3 icon" style="font-size:22px;"></i>Generate Code</a>
                </li>
            </ul>
        </li>


        <li class="nav-devider"></li>
        <li class="nav-label">Section</li>

        <li class="dropdown">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bx bx-user icon" style="font-size:22px;"></i><span>Section</span></a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu2">
                <li>
                    <a href="grade7_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 7 Section</a>
                </li>
                <li>
                    <a href="grade8_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 8 Section</a>
                </li>
                <li>
                    <a href="grade9_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 9 Section</a>
                </li>
                <li>
                    <a href="grade10_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 10 Section</a>
                </li>
                <li>
                    <a href="grade11_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 11 Section</a>
                </li>
                <li>
                    <a href="grade12_section_view.php"><i class="bx bx-home icon" style="font-size:22px;"></i>Grade 12 Section</a>
                </li>

            </ul>
        </li>





        <li class="nav-devider"></li>
        <li class="nav-label">Users</li>


        <li>
            <a href="user_view.php"><i class="bx bxs-user icon" style="font-size:22px;"></i>Username Information</a>
        </li>


        <li class="dropdown">
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bx bx-user icon" style="font-size:22px;"></i><span>Teachers</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu2">

                <li>
                    <a href="teacher_view.php"><i class="bx bxs-user icon" style="font-size:22px;"></i>Teacher Information</a>
                </li>

            </ul>
        </li>

        <li class="dropdown">
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bx bx-user icon" style="font-size:22px;"></i><span>Students</span></a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu3">

                <li>
                    <a href="grade7_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 7 Information</a>
                </li>

                <li>
                    <a href="grade8_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 8 Information</a>
                </li>

                <li>
                    <a href="grade9_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 9 Information</a>
                </li>

                <li>
                    <a href="grade10_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 10 Information</a>
                </li>

                <li>
                    <a href="grade11_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 11 Information</a>
                </li>

                <li>
                    <a href="grade12_info_view.php"><i class="bx bxs-box icon" style="font-size:22px;"></i>Grade 12 Information</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="admin_profile_view2.php"><i class="bx bx-user icon" style="font-size:22px;"></i>Profile Setting</a>
        </li>
        <!-- <li>
            <a href="logout.php"><i class="bx bx-exit icon" style="font-size:22px;"></i>Logout</a>
        </li> -->
    </ul>
</nav>