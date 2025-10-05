<div class="top-navbar">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none">
                <i class='bx bx-menu'></i>
            </button>


            <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-icons">more_vert</span>
            </button>

            <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                   
                    <?php
                    $id = $_SESSION['adm_id'];
                    $loginquery = "SELECT * FROM `admin` WHERE adm_id = $id";
                    $result = mysqli_query($db, $loginquery);
                    $row = mysqli_fetch_array($result);
                    if (is_array($row)) { ?>

                        <li class="nav-item dropdown" style="display:inline-block;">

                            <?php if (empty($row['image'])) { ?>
                                <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="bx bx-user" style="padding-right: 1rem;border-radius:100%; font-size:32px;  height: fit-content;"></i></a>
                            <?php  } else { ?>
                                <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/profile/<?php echo $row['image']; ?>" alt="user" class="profile-pic" style="object-fit:cover; margin-right: 1rem; border-radius:100%; width: 50px; height:50px;" /></a>
                            <?php } ?>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user" style="font-size:5.2rem;">
                                    <li><a href="../admin/admin_profile_view2.php"><i class="fa fa-power-off"></i> Profile Setting</a></li>
                                    <li><a href="../admin/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>