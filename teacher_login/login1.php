<?php
require '../config/config.php';
require CL_SESSION_PATH;
require CONNECT_PATH;
include GLOBAL_FUNC;
include 'login_link.php';


$user_id = $session_class->getValue('id');

if (isset($user_id)) {

	$loginquery = "SELECT * FROM users WHERE id = '$user_id'  ";
	$result = mysqli_query($db_connect, $loginquery);
	$row = mysqli_fetch_array($result);
	$username = $row['firstname'] . " " . $row['surname'];
	$detect_device = $_SERVER['HTTP_USER_AGENT'];
	$status = "log in";
	date_default_timezone_set('Asia/Manila');
	$created_date = date("Y-m-d H:i:s");


	if (is_array($row)) {

		if ($row['role'] == 'super-admin') {
			$log_sql = "INSERT INTO log_history (`name`,`date`, `device`,`activity`) VALUES ('" . $username . "','" . $created_date . "','" . $detect_device . "','" . $status . "')";
			if ($result = mysqli_query($db_connect, $log_sql)) {
				if ($result) {
					header("Location: " . BASE_URL . "admin_super/admin_users.php");
					exit();
				}
			}
		} elseif ($row['role'] == 'admin1') {
			$log_sql = "INSERT INTO log_history (`name`,`date`, `device`,`activity`) VALUES ('" . $username . "','" . $created_date . "','" . $detect_device . "','" . $status . "')";
			if ($result = mysqli_query($db_connect, $log_sql)) {
				if ($result) {
					header("Location: " . BASE_URL . "admin-memo/memorandum.php");
					exit();
				}
			}
		} elseif ($row['role'] == 'admin2') {

			$log_sql = "INSERT INTO log_history (`name`,`date`, `device`,`activity`) VALUES ('" . $username . "','" . $created_date . "','" . $detect_device . "','" . $status . "')";
			if ($result = mysqli_query($db_connect, $log_sql)) {
				if ($result) {
					header("Location: " . BASE_URL . "admin-page/announcement.php");
					exit();
				}
			}
		}
	}
}
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
		<div class="container-login100" style="background-image: url('../images/school_info/school1.png');">
			<div class="wrap-login100">
				<form id="login_form" class="login100-form validate-form">
					<span class="login100-form-logo mt-5" >
						<img src="../images/page_img/CBIS_logo.png" alt=""   width="90%" height="110">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
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
	<?php
	include ADMIN_BOTTOM_PATH;

	?>
	<script>
		// PARA DI NALABAS YUNG RESUBMIT SA TAAS
		// if (window.history.replaceState) {
		// 	window.history.replaceState(null, null, window.location.href);
		// }
		$(document).ready(function() {
			// // var formdata = new FormData(user_login);
			// var username = $('#username').val();
			// var password = $('#password').val();
			// // alert(username + password);
			// if (username == '' || password == '') {
			//     Swal.fire({
			//         icon: 'warning',
			//         title: 'Something Went Wrong!',
			//         text: 'Please fill all fields.'
			//     })
			// }
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
								location.reload();
								// location.href = '<?php echo BASE_URL; ?>admin_super/admin_users.php';

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