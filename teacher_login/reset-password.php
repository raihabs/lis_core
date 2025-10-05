<?php
session_start();
require '../config/config1.php';
require CONNECT_PATH;
include GLOBAL_FUNC;
include DOMAIN_PATH . '/call_func/session_alert.php';
include 'login_link.php';
if (isset($_SESSION['code']) && isset($_SESSION['email']) == TRUE) {
	$info = isset($_SESSION['info']) ? $_SESSION['info'] : '';
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Login V3</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
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
					<form method="post" action="<?php echo BASE_URL; ?>teacher_login/resetprocess.php" class="login100-form validate-form">
						<span class="login100-form-logo mt-5">

							<?php
							$school_query = "SELECT * FROM `school_information`";
							$school_result = mysqli_query($db_connect, $school_query);
							$school = mysqli_fetch_array($school_result);

							if (is_array($school)) { ?>
								<?php if (empty($school['school_logo'])) { ?>
									<img src="<?= BASE_URL ?>images/school-logo/looc_logo.png" alt="" width="150%" height="150" style="background:#fff;padding:10px;border-radius: 50%;">
								<?php } else { ?>
									<img src="<?= BASE_URL ?>images/school-logo/<?php echo  $school["school_logo"]; ?>" width="150%" height="150" style="background:#fff;padding:10px;border-radius: 50%;" title="<?php echo $school["school_logo"]; ?>">
							<?php }
							} ?>

						</span>

						<span class="login100-form-title">
							RESET PASSWORD
							<div id="error_msg"></div>
						</span>

						<div class="wrap-input100 validate-input" data-validate="Must contain at least one number, one uppercase and lowercase letter, and at least 7 to 14 characters.">
							<input class="input100" type="password" name="newpass" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,14}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 7 to 14 characters.">
							<span class="focus-input100" data-placeholder="&#xf191;"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate="Confirm password">
							<input class="input100" type="password" name="verifypass" placeholder="Confirm your password">
							<span class="focus-input100" data-placeholder="&#xf191;"></span>
						</div>
						<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
						<div class="container-login100-form-btn">
							<button type="submit" name="reset-pass" class="login100-form-btn">
								Change Password
							</button>
						</div>
					</form>
					<!-- <div class="text-center p-t-90">
						<a class="txt1" href="login.php">
							Back to Login
						</a>
					</div> -->
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
		<?php
		include ADMIN_BOTTOM_PATH;
		?>
		<?php
		if (isset($_SESSION['reset_status'])) {
			$title = $_SESSION['reset_status'];
			$icon = $_SESSION['reset_icon'];
			if ($icon != 'success') { ?>
				<script>
					document.getElementById('error_msg').innerHTML = '<div class="alert alert-danger" role="alert" style="font-size:12px;"><?php echo $title ?></div>';
				</script>
			<?php } else { ?>
				<script>
					document.getElementById('error_msg').innerHTML = '<div class="alert alert-success" role="alert" style="font-size:12px;"><?php echo $title ?></div>';
				</script>
		<?php }
		}
		unset($_SESSION['reset_status']);
		unset($_SESSION['reset_icon']);
		?>

	</body>

	</html>
<?php
} else {
	header('location:' . BASE_URL . 'teacher_login/login.php');
}
?>