<?php
include '../../db_connect/connection.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$user_id = $_SESSION["full_name"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; Foodie</title>

  
  <link rel="stylesheet" href="../../front-end/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../front-end/css/all.min.css">
  <link rel="stylesheet" href="../../front-end/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
    <div class="navbar-bg">
      <nav class="navbar navbar-expand-lg main-navbar"><br><br>
        <form class="form-inline mr-auto">     
        </form>
        <ul class="navbar-nav navbar-right">
    
          <li class="dropdown"><a href="profile.php" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo $user_id; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right"> 
              <a href="../../admin/admin_layout/profile.php" class="dropdown-item has-icon">
              <i class="fa-solid fa-user"></i> Profile
              </a>
              <a href="../admin_layout/change-password.php" class="dropdown-item has-icon">
              <i class="fa-solid fa-lock"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="../../login-admin/logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
</body>
