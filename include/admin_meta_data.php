<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['adm_id'])) {
  header("Location: ../admin_login/login.php");
} else
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
    $school_query = "SELECT * FROM `school_information`";
    $school_result = mysqli_query($db, $school_query);
    $school = mysqli_fetch_array($school_result);
  ?>
  <link rel="shortcut icon" href="../images/school-logo/<?php echo  $school["school_logo"]; ?>" type="image/x-icon" />