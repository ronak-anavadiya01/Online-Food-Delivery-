<?php
session_start();
include('../db_connect/connection.php');
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$newPassword = ($_POST['newPassword']);
	$confirmPassword = ($_POST['confirmPassword']);
	

	if ($newPassword !=$confirmPassword) {
        echo "<script>alert('Password does not match');</script>";
		return;
    }

		$conn = "UPDATE users SET Password='$newPassword' WHERE Email='$email'";
		$chnPwd1 = $con->query($conn);

		if ($chnPwd1 > 0) {
		echo "<script>alert('Your Password successfully changed');</script>";
	} else {
		echo "<script>alert('Please try again');</script>";

	}
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Online Food Delivery | Reset Password</title>
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
						<h1 class="text-center text-bold text-light mt-4x">Online Food Delivery Reset Password</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form action="" method="post">

									<label for="" class="text-uppercase text-sm">New Password</label>
									<input class="form-control mb" type="password" name="newPassword" placeholder="New Password" required="true" />

									<label for="" class="text-uppercase text-sm">Confirm Password</label>
									<input class="form-control mb" type="password" name="confirmPassword" placeholder="Confirm Password" required="true" />

									<button class="btn btn-primary btn-block" name="submit" type="submit">Reset Password</button>
									<a href="login.php">SignIn</a>
								</form>
								<div class="card-footer text-center" style="padding-top: 30px;">
									<div class="small"><a href="../front-end/index.php" class="btn btn-primary">Back to Home</a></div>
								</div>
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
