<?php
require '../config/config1.php';
require CL_SESSION_PATH;
require CONNECT_PATH;
include GLOBAL_FUNC;
include 'login_link.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>LIS | Teacher Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<?php
	$school_query = "SELECT * FROM `school_information`";
	$school_result = mysqli_query($db_connect, $school_query);
	$school = mysqli_fetch_array($school_result);
	?>
	<link rel="shortcut icon" href="../images/school-logo/<?php echo $school["school_logo"]; ?>" type="image/x-icon" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../images/school-background/school_picture.jpg');">
			<div class="wrap-login100">
				<form id="login_form" class="login100-form validate-form">
					<span class="login100-form-logo mt-5">

						<?php
						$school_query = "SELECT * FROM `school_information`";
						$school_result = mysqli_query($db_connect, $school_query);
						$school = mysqli_fetch_array($school_result);

						if (is_array($school)) { ?>
							<?php if (empty($school['school_logo'])) { ?>
								<img src="../images/school-logo/looc_logo.png" alt="" width="150%" height="150" style="background:#fff;padding:10px;border-radius: 50%;">
							<?php } else { ?>
								<img src="../images/school-logo/<?php echo  $school["school_logo"]; ?>" width="150%" height="150" style="background:#fff;padding:10px;border-radius: 50%;" title="<?php echo $school["school_logo"]; ?>">
						<?php }
						} ?>
						
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
						<div id="error_msg"></div>

					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="reset-page.php">
							Reset Password/Forgot Password
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<?php include '../include/teacher_bottom.php'; ?>


	<script>
		$(document).ready(function() {

			$(document).on('submit', '#login_form', function(e) {
				e.preventDefault();

				var formData = new FormData(this);
				formData.append("login", true);

				$.ajax({
					url: 'login_authenticator.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						var res = jQuery.parseJSON(response);
						if (res.success == 200) {
							Swal.fire({
								// position: 'top-end',
								icon: 'success',
								showConfirmButton: false,
								title: res.title,
								text: res.message,
								timer: 1000,
							}).then(function() {
								location.href = '/LIS_CORE/teacher-page/student_information_enrolled.php';
							})
						} else if (res.success == 400) {
							Swal.fire({
								icon: 'warning',
								title: res.title,
								text: res.message
							})
						}
					}
				})
			});
		})
	</script>

</body>

</html>