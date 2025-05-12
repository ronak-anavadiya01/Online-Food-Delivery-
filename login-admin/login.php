<?php  
include '../db_connect/connection.php'; 
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update query to check for admin role (role_id = 1)
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role_id = 1"; 

    $result = $con->query($query); 

    if ($result && $result->num_rows > 0) {
   
        $row = $result->fetch_assoc();

        if ($row) {
            // Store session data
            $_SESSION['full_name'] = $row['full_name']; 
            $_SESSION['id'] = $row['id'];
            $_SESSION['role_id'] = $row['role_id']; // Store role_id in session

            header("Location: ../admin/admin_layout/dashboard.php");
            exit();
        }
    } else {
       
        echo "<h2 class='text-danger text-center mt-3'>Incorrect Email and Password </h2>";
    }
}
?>



<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="css/bootstrap-social.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <link rel="stylesheet" href="css/fileinput.min.css">
  <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <div class="login-page bk-img" style="background-image: url(food2.jpg);">
    <div class="form-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center text-bold text-light mt-4x">Online Food Delivery Sign In</h1>  
            <div class="well row pt-2x pb-3x bk-light">
              <div class="col-md-8 col-md-offset-2">
                <form action="" method="post">
                  <label for="" class="text-uppercase text-sm">Email </label>
                    <input type="text" placeholder="Email" name="email" class="form-control mb" required>

                  <label for="" class="text-uppercase text-sm">Password</label>
                    <input type="password" placeholder="Password" name="password" class="form-control mb" required>

                  <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
                    <a href="forgot-password.php">Forgot Password</a> 
                </form>
                <!-- <div class="card-footer text-center" style="padding-top: 30px;">
                  <div class="small"><a href="login.php" class="btn btn-primary">Back to Home</a></div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Loading Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/fileinput.js"></script>
  <script src="js/chartData.js"></script>
  <script src="js/main.js"></script>

</body>

</html>