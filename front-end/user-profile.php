<?php
    include('../db_connect/connection.php');
    session_start();

    // Ensure the session is active and the user ID is set
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }    

    // Retrieve user ID from session
    $id = $_SESSION['id'];  
    $fname = $_SESSION['full_name']; 

    // Fetch the user data from the database
    $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the input data from the form
        $name = mysqli_real_escape_string($con, $_POST['full_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

        // Update query
        $query = "UPDATE users SET full_name = '$name', email = '$email', mobile = '$mobile' WHERE id = '$id'";

        // Execute the update query
        if (mysqli_query($con, $query)) {
            // Update session variable
            $_SESSION['full_name'] = $name;
            
            // Redirect to avoid form resubmission
            header("Location: user-profile.php?success=1");
            exit();
        } else {
            header("Location: user-profile.php?error=1");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- SweetAlert JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>Your Profile</h1>
    </div>
    <div class="section-body">
      <div class="row mb-2">
        <div class="col-12 text-right mb-2"> 
           <a href="index.php" class="btn btn-primary">Back Home</a>
           <a href="order_history.php" class="btn btn-primary">Order History</a>
        </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6 col-lg-6">
              <div class="card">
                  <div class="card-header">
                    <h4 style="text-align: center;"><i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($fname); ?></h4>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="number" class="form-control" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" style="width: 150px; margin-left: 200px;">Update</button>
                    </form>
                  </div>
                </div>
          </div>
       </div>
    </div>
  </section>
</div>

<?php if (isset($_GET['success'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        swal('Profile Updated!', 'Your profile has been updated successfully.', 'success');
    });
</script>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        swal('Error!', 'Please try again.', 'error');
    });
</script>
<?php endif; ?>

</body>
</html>