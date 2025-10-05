<?php
include("../config/config.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($_POST["submit"])) {
    $loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . md5($password) . "'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION["adm_id"] = $row['adm_id'];
      header("refresh:1;url=dashboard.php");
    } else {
      echo "<script>alert('Invalid Username or Password!');</script>";
    }
  }
}

?>


<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" sizes="20x20" href="images/cfoslogo.png">
  <title>CFOS - ADMIN LOGIN</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="container">
    <div class="info">
      <h1>Administration </h1><span> login Account</span>
    </div>
  </div>
  <div class="form">
    <div class="thumbnail"><img src="images/manager.png" /></div>

    <form class="register-form" id="signupadmin">
      <input type="text" placeholder="username" name="username" />
      <input type="text" placeholder="email address" name="email" />
      <input type="password" placeholder="password" name="pass" />
      <input type="password" placeholder="Confirm password" name="cpass" />
      <input type="password" placeholder="Unique-Code" name="code" />
      <button type="submit" name="submit" class="btn btn-primary">Create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>

    <form class="login-form" action="index.php" method="post">
      <input type="text" placeholder="username" name="username" />
      <input type="password" placeholder="password" name="password" />
      <input type="submit" name="submit" value="login" />
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='js/index.js'></script>
  <script>
    $(document).on('submit', '#signupadmin', function(e) {
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
                    location.href = '/admin/admin/index.php';
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

    // $(document).on('submit', '#loginuser', function(e) {
    //   e.preventDefault();
    //   var formData = new FormData(this);
    //   formData.append("valid_login", true); {
    //     Swal.fire({
    //       title: 'Do you want to Login?',
    //       showDenyButton: true,  
    //       confirmButtonText: 'Sign in',
    //     }).then((result) => {
    //       /* Read more about isConfirmed, isDenied below */
    //       if (result.isConfirmed) {
    //         $.ajax({
    //           type: "POST",
    //           url: "login_process.php", //action
    //           data: formData,
    //           processData: false,
    //           contentType: false,
    //           success: function(response) {
    //             var res = jQuery.parseJSON(response);
    //             if (res.status == 400) {
    //               Swal.fire({
    //                 icon: 'warning',
    //                 title: 'Something Went Wrong.',
    //                 text: res.msg,
    //                 timer: 3000
    //               })
    //             } else if (res.status == 500) {
    //               Swal.fire({
    //                 icon: 'warning',
    //                 title: 'Something Went Wrong.',
    //                 text: res.msg,
    //                 timer: 3000
    //               })
    //             } else if (res.status == 200) {
    //               Swal.fire({
    //                 icon: 'success',
    //                 title: 'SUCCESS',
    //                 text: res.msg,
    //                 timer: 3000,
    //               }).then(function(){

    //                 window.location.reload();
    //               });
    //             }
    //           }
    //         })
    //       } else if (result.isDenied) {
    //         Swal.fire('Changes are not saved', '', 'info').then(function() {
    //           location.reload();
    //         });
    //       }
    //     })
    //   }
    // });
  </script>
  <?php include '../include/admin_bottom.php'; ?>