<!DOCTYPE html>
<html lang="en">

<?php include 'config/config.php'; ?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/start.css" />
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />

  <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

  <!-- Stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- sweetalert message -->
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <title>CFOS</title>
    <link href="images/logo/cfoss.png" rel="icon">
    
</head>

<body>
  <div class="folder">
    <div class="forms-container">
      <div class="signin-signup">

        <form id="loginuser" class="sign-in-form">
          <h2 class="title">Sign in</h2>

          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username" class="form-control" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" class="form-control" />
          </div>
          <input type="submit" value="Login" class="butn solid" />
          <!-- <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
        </form>


        <form class="sign-up-form" id="signupuser">
          <h2 class="title">Sign up</h2>

          <div class="row">
            <div class="col-md-6">
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username" name="username" />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Email" name="email" />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="firstname" name="firstname" />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="lastname" name="lastname" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="input-field">
                <i class="fas fa-vcvc"></i>
                <input type="email" placeholder="+639" name="phone1" readonly />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="input-field">
                <i class="fas fa-ba"></i>
                <input type="text" name="phone2" id="phone2" placeholder="123.." pattern="[0-9]+" maxlength="9" />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="password" />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirm Password" name="cpassword" />
              </div>
            </div>

            <!-- <label for="exampleInputPassword1">School</label>
            <div class="col-md-12">
              <div class="input-field">
                <i class="fas fa-asdsa"></i>
                <select name="school" id="school" class="form-control" style="border:none; background: transparent;">
                  <?php
                  $sql_b = "SELECT * FROM canteen";
                  $res_b = mysqli_query($db, $sql_b);

                  while ($res = $res_b->fetch_assoc()) {
                    echo '<option value=' . $res['s_id'] . '>' . $res['school_name'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div> -->

            <!-- <label for="exampleTextarea">Grade-Section and Room # for the food delivery location</label>
            <div class="col-sm-12">
              <div class="input-field" style="height:100px;">

                <i class="fas fa-home"></i>
                <textarea class="form-control" id="location" name="location" rows="3"></textarea>
              </div>
            </div> -->

            <div class="text-center col-sm-12">
              <button type="submit" name="submit" class="butn">Register</button>
            </div>
          </div>

          <!-- <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Don't have account? Welcome to our new Canteen Food Ordering System, you can now build your own account.
          </p>
          <button class="butn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="images/background/lunch.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Thank you for joining us, enjoy your meal for the next level of ordering in our website.
          </p>
          <button class="butn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="images/background/school.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {

      $(document).on('submit', '#loginuser', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("login", true);

        $.ajax({
          url: 'login_process.php',
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
                    location.href = '/index.php';
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


    $(document).on('submit', '#signupuser', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("valid_sign_up", true);
      {
        Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Yes',
          denyButtonText: `No`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "sign_up_process.php", //action
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
                  let timerInterval
                  Swal.fire({
                    html: 'I will close in <b></b> milliseconds.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      const b = Swal.getHtmlContainer().querySelector('b')
                      timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    /* Read more about handling dismissals below */
                    location.href = '/start.php';
                  })
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
</body>

</html>