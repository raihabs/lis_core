<footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <?php

                    session_start();
                    $userId = $_SESSION['user_id'];
                    $sql = "SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($result);
                    $sql1 = "SELECT * FROM `canteen` WHERE `s_id` = '" . $row['s_id'] . "'";
                    $result1 = mysqli_query($db, $sql1);
                    $row1 = mysqli_fetch_array($result1);
                    
                    ?>
                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3> <img src="images/logo/cfoss.png" alt="cfos" style="width: 50px;height:50px;radius:50%;">
                            CFOS</h3>
                        <h4>OUR CLIENT:</h4>
                        <p><?php echo $row1['school_name']?></p><br>
                        <h4>ABOUT:</h4>
                        <p>
                        <p><?php echo $row1['about_us']?></p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="index.php">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="canteen.php?canteen=<?php echo $row1["s_id"]; ?>">canteen</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="menu.php">menu</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="order.php">view your orders</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                        <?php echo $row1["address"]; ?><br>
                            Philippines <br>
                            <strong>Phone:</strong><?php echo $row1["phone"]; ?><br>
                            <strong>Telehone:</strong><?php echo $row1["telephone"]; ?><br>
                            <strong>Email:</strong><?php echo $row1["email"]; ?><br>
                        </p>

                        <div class="social-links">
                            <a href="<?php echo $row1["url"]; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-newsletter">
                        <h4><?php echo $row1['school_name']?></h4>
                        <img src="images/logo/cfoss.png" alt="cfos" style="width: 150px;height:150px; radius:50%; margin:20px;">
                        
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>CFOS</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
                Designed by <a href="#">CFOS TEAM</a>
            </div>
        </div>
    </footer><!-- End Footer -->
