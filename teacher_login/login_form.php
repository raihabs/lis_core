<?php
include 'login_link.php';
require '../config/config.php';
require CONNECT_PATH;
include ADMIN_TOP_PATH;
include ADMIN_BOTTOM_PATH;
?>
<div class="container">
    <div class="letters">
        <!-- Declare all the characters of text 
          one-by-one, inside span tags -->
        <span class="part1">C</span>
        <span class="part2">B</span>
        <span class="part3">I</span>
        <span class="part4">S</span>
        <span class="part5"></span>

        <span class="part6">W</span>
        <span class="part7">E</span>
        <span class="part8">B</span>
        <span class="part9">S</span>
        <span class="part10">I</span>
        <span class="part11">T</span>
        <span class="part12">E</span>
    </div>
</div>

<div class="form" id="sign-in-form">

<div class="thumbnail"><img src="../images/page_img/CBIS_logo.jpg"/></div>

<h3 style="font-size: 18; font-weight:600">LOG IN</h3>
<div class='sign-in-container'>

<form>
    <div  id="input-group" class='sign-in-container form-outline mb-4'>
        <i class='fas fa-user'></i>
        <input type='text' name='user' placeholder='Username'  
        class="form-control" id='username' 
        >
    </div>

    <div  id="input-group" class='sign-in-container form-outline mb-4'>
        <i class='fas fa-lock'></i>
        
        <input type='password' id='password' name='pass' placeholder='Password'  
        class="form-control" minlength="8"
        title="Password must contain: Minimum 8 characters atleast 1 Alphabet and 1 Number"   pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$">
          
    </div>
    
    <div class="row mb-4">
      <div class="col"  style="text-align: left; margin-left: 10px; color: blue;">
          <!-- Simple link -->
          <i class="fas fa-question-circle"></i>
          <a href="#" id="forgot_action" data-toggle="tooltip" data-html="true" ata-original-title="To reset your password, please click this link to process your reset."  style="font-size: 12" >
          RESET PASSWORD/FORGOT PASSWORD?</a>
      </div>
    </div>      
  
    <input type="button" name="submit" id="login" value="LOGIN"/>
  </form>
</div>
</div>


<script>
	// PARA DI NALABAS YUNG RESUBMIT SA TAAS
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
	$(document).ready(function() {
		$('#login').on('click', function() {
			// var formdata = new FormData(user_login);
			var username = $('#username').val();
			var password = $('#password').val();
			// alert(username + password);
			if (username == '' || password == '') {
				Swal.fire({
					icon: 'warning',
					title: 'Something Went Wrong!',
					text: 'Please fill all fields.'
				})
			}

			$.ajax({
				url: 'login_authenticator.php',
				type: 'POST',
				data: {
					u_name: username,
					pass: password
				},
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
						}).then(function(){
							window.location.href = '../admin-page/admin_home.php';
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