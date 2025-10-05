<?php include '../config/config.php';

error_reporting(0);
session_start();

include '../include/teacher_meta_data.php';
?>

<title>LIS | Profile Settiings</title>

<style>
  .upload {
    width: 125px;
    position: relative;
    margin: auto;
  }

  .upload img {
    border-radius: 50%;
    border: 0px solid #4a6cf7;
    object-fit: cover;
    height: 160px;
    width: 160px;
  }

  .upload .round {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #4a6cf7;
    width: 42px;
    height: 42px;
    line-height: 43px;
    text-align: center;
    border-radius: 50%;
    overflow: hidden;
  }

  .upload .round input[type="file"] {
    position: absolute;
    transform: scale(2);
    opacity: 0;
  }

  input[type=file]::-webkit-file-upload-button {
    cursor: pointer;
  }
</style>

<?php
include '../include/teacher_top.php';
include '../include/teacher_sidebar.php';

$id = $_SESSION['tch_id'];
$loginquery = "SELECT * FROM `user_list` WHERE tch_id = '" . $id . "'";
$result = mysqli_query($db, $loginquery);
$user = mysqli_fetch_array($result);
?>


<!-- ======== main-wrapper start =========== -->
<main class="main-wrapper">

  <?php
  include '../include/teacher_header.php';
  ?>






  <!-- ========== section start ========== -->
  <section class="section">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="titlemb-30">
              <h2>Settings</h2>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#0">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Profile Settings
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- ========== title-wrapper end ========== -->

      <div class="row">
        <div class="col-lg-6">
          <div class="card-style settings-card-1 mb-30">
            <div class="
                    title
                    mb-12
                    d-flex
                    justify-content-between
                    align-items-center
                  ">
              <h6>My Profile</h6>
              <button class="border-0 bg-transparent">
                <i class="lni lni-pencil-alt"></i>
              </button>
            </div>
            <div class="profile-info">
              <div class="d-flex align-items-center mb-50">
                <div class="profile-image">
                  <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
                    <div class="upload">
                      <?php
                      $id = $user["tch_id"];
                      $name = $user["firstname"];
                      $image = $user["image"];

                      if (is_array($user)) { ?>
                        <?php if (empty($user['image'])) { ?>
                          <img src="../images/school-logo/profile.png" width=125 height=125 title="profile">
                        <?php } else { ?>
                          <img src="../images/teacher-profile/<?php echo $image; ?>" width=125 height=125 title="<?php echo $image; ?>">
                      <?php }
                      } ?>
                      <div class="round">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .svg">
                        <i class="fa fa-camera" style="color: #fff;"></i>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="profile-meta p-5 mt-5">
                  <h5 class="text-bold text-dark mb-10"><?php echo $user['firstname'] . " " . $user['suffix'] . " " . $user['middlename'] . " " . $user['lastname']; ?></h5>
                  <p class="text-sm text-gray"><?php echo $user['username']; ?></p>
                </div>
              </div>

              <form id="changePassword">

                <div class="mt-50">
                  <div class="input-style-1">
                    <input type="hidden" name="id" id="id" value="<?php echo $user['tch_id'] ?>">
                  </div>

                  <div class="input-style-1">
                    <label>Enter Current Password</label>
                    <input type="password" name="password" placeholder="Enter Current Password" />
                  </div>

                  <div class="input-style-1">
                    <label>Enter New Password</label>
                    <input type="password" name="newpassword1" placeholder="Enter New Password" />
                  </div>

                  <div class="input-style-1">
                    <label>Confirm New Password</label>
                    <input type="text" name="newpassword2" placeholder="Confirm New Password" />
                  </div>

                  <button type="submit" name="submit" class="main-btn primary-btn btn-hover">
                    Change Password
                  </button>
                </div>

              </form>


            </div>
          </div>
          <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6">
          <div class="card-style settings-card-2 mb-30">
            <div class="title mb-30">
              <h6>My Other Information</h6>
            </div>
            <form id="editInfo">
              <div class="row">

                <div class="input-style-1">
                  <input type="hidden" name="id" id="id" value="<?php echo $user['tch_id'] ?>">
                </div>
                <div class="col-12">
                  <div class="input-style-1">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="First Name" value="<?php echo $user['firstname']; ?>" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Middle Name</label>
                    <input type="text" name="middlename" placeholder="Middle Name" value="<?php echo $user['middle_name']; ?>" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $user['lastname']; ?>" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-style-1">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" readonly/>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-style-1">
                    <label>Enter Your</label>
                    <input type="text" name="phone1" placeholder="+639" value="+639" readonly />
                  </div>
                </div>
                <div class="col-9">
                  <div class="input-style-1">
                    <label>Phone Number</label>
                    <input type="text" name="phone2" placeholder="123.." pattern="[0-9]+" maxlength="9" value="<?php echo $user['phone'] = substr_replace($user['phone'], "", 0, 4); ?>" />
                  </div>
                </div>
                <div class="col-xxl-4">
                  <div class="select-style-1">
                    <label>City</label>
                    <div class="select-position">
                      <select name="city" id="city" class="light-bg" onchange="FetchUpdateBarangay(this.value)">
                        <?php
                        $sql_c1 = "SELECT * FROM city_list WHERE c_id = '" . $user['city'] . "'";
                        $res_c1 = mysqli_query($db, $sql_c1);
                        $res1 = $res_c1->fetch_assoc();
                        echo '<option value=' . $res1['c_id'] . '>' . $res1['c_name'] . '</option>';
                        ?>
                        <?php
                        $query = "SELECT * FROM city_list";
                        $result = mysqli_query($db, $query);

                        while ($res = $result->fetch_assoc()) {
                          echo '<option id="city" value=' . $res['c_id'] . '>' . $res['c_name'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-4">
                  <div class="select-style-1">
                    <label>Barangay</label>
                    <div class="select-position">
                      <select name="barangay" id="barangay" class="light-bg">
                        <?php
                        $sql_b = "SELECT * FROM barangay_list WHERE b_id = '" . $user['barangay'] . "'";
                        $res_b = mysqli_query($db, $sql_b);
                        $res1 = $res_b->fetch_assoc();
                        echo '<option value=' . $res1['b_id'] . '>' . $res1['b_name'] . '</option>';
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-xxl-4">
                  <div class="input-style-1">
                    <label>Street</label>
                    <input type="text" name="street" placeholder="Steet Number & Name" value="<?php echo $user['street']; ?>" />
                  </div>
                </div>

                <div class="col-12">
                  <button type="submit" name="submit" class="main-btn primary-btn btn-hover">
                    Update Information
                  </button>
                </div>

              </div>
            </form>
          </div>
          <!-- end card -->
        </div>
        <!-- end col -->

      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- ========== section end ========== -->

  <?php include '../include/footer.php'; ?>

</main>
<!-- ======== main-wrapper end =========== -->



<?php include '../include/teacher_bottom.php'; ?>


<script type="text/javascript">
  $(document).ready(function() {
    // new form update
    $(document).on('submit', '#editInfo', function(e) {
      e.preventDefault();
      // alert("äw");
      var formData = new FormData(this);
      formData.append("update_account", true);
      Swal.fire({
        title: 'Do you want to update your details?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Update',
        denyButtonText: `Don't Update`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "profile_setting_process.php", //action
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
                Swal.fire({
                  icon: 'success',
                  title: 'SUCCESS',
                  text: res.msg,
                  timer: 2000
                }).then(function() {
                  location.reload();
                });
              }
            }
          })
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info').then(function() {
            location.reload();
          });
        }
      })

    });

  });

  $(document).ready(function() {
    // new form update
    $(document).on('submit', '#changePassword', function(e) {
      e.preventDefault();
      // alert("äw");
      var formData = new FormData(this);
      formData.append("update_password", true);
      Swal.fire({
        title: 'Do you want to update your password',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Update',
        denyButtonText: `Don't Update`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "profile_setting_process.php", //action
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
                Swal.fire({
                  icon: 'success',
                  title: 'SUCCESS',
                  text: res.msg,
                  timer: 2000
                }).then(function() {
                  location.reload();
                });
              }
            }
          })
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info').then(function() {
            location.reload();
          });
        }
      })

    });

  });


  function FetchUpdateBarangay(c_id) {
    $('#barangay').html('');
    $.ajax({
      type: 'post',
      url: 'Address_update_data.php',
      data: {
        city_id: c_id
      },
      success: function(data) {
        $('#barangay').html(data);
      }
    })
  }

  document.getElementById("image").onchange = function() {
    document.getElementById("form").submit();
  };
</script>
<?php
if (isset($_FILES["image"]["name"])) {

  $id = $_POST["id"];
  $name = $_POST["name"];

  $imageName = $_FILES["image"]["name"];
  $imageSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  // Image validation
  $validImageExtension = ['jpg', 'jpeg', 'png', 'svg'];
  $imageExtension = explode('.', $imageName);
  $imageExtension = strtolower(end($imageExtension));
  if (!in_array($imageExtension, $validImageExtension)) {
    echo
    "
        <script>
        Swal.fire({
          icon: 'warning',
          title: 'Something Went Wrong.',
          text: 'Invalid Extensions, Use: JPG, JPEG, PNG, SVG',
          timer: 3000
      })
          document.location.href = '../teacher-page/profile_setting.php';
        </script>
        ";
  } elseif ($imageSize > 1200000) {
    echo
    "
        <script>
        Swal.fire({
          icon: 'warning',
          title: 'Something Went Wrong.',
          text: 'Please Don't Use High Image Size',
          timer: 3000
      })
          document.location.href = '../teacher-page/profile_setting.php';
        </script>
        ";
  } else {
    $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
    $newImageName .= '.' . $imageExtension;
    $query = "UPDATE `user_list` SET `image` = '$newImageName' WHERE tch_id = $id";
    mysqli_query($db, $query);
    move_uploaded_file($tmpName, '../images/teacher-profile/' . $newImageName);
    echo
    "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          text: 'Successfully Change Profile',
          timer: 9000
      })
        document.location.href = '../teacher-page/profile_setting.php';
        </script>
        ";
  }
}
?>