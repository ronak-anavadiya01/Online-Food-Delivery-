<?php
    include '../db_connect/connection.php';
    session_start();
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css">
  
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Change Password</h2>
                <a href="index.php" class="btn btn-primary mb-3">Back Home</a>
                <div class="card">
                    <div class="card-body">
                        <form method="post" novalidate>
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="newPassword" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="conPassword" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-block">Change Password</button>
                        </form>
                        <?php
                            if (isset($_POST['submit'])) {
                                $password = $_POST['password'];
                                $newPassword = $_POST['newPassword'];
                                $conPassword = $_POST['conPassword'];

                                $result = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
                                $data = mysqli_fetch_assoc($result);

                                if ($password != $data['password']) {
                                    echo "<div class='text-danger text-center mt-3'>Current password is incorrect!</div>";
                                } elseif ($newPassword != $conPassword) {
                                    echo "<div class='text-danger text-center mt-3'>New passwords do not match!</div>";
                                } else {
                                    mysqli_query($con, "UPDATE users SET password='$newPassword' WHERE id='$id'");
                                    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
                                    echo "<script>
                                        swal({
                                            title: 'Success!',
                                            text: 'Password changed successfully!',
                                            icon: 'success',
                                            button: 'OK'
                                        }).then(() => {
                                            window.location.href = 'index.php';
                                        });
                                    </script>";
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
