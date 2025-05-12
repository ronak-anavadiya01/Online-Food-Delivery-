<?php
session_start();
include '../../db_connect/connection.php';
include 'header.php';
include 'sidebar.php';

$id = $_SESSION['id'];
$alert = null;

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $comPassword = $_POST['conPassword'];

    // Check if new passwords match
    if ($newPassword !== $comPassword) {
        $alert = ['type' => 'error', 'title' => 'Error', 'message' => 'Passwords do not match!'];
    } else {
        $result = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
        $data = mysqli_fetch_assoc($result);

        // Compare current password (assuming plain text for now, NOT RECOMMENDED!)
        if ($password !== $data['password']) {
            $alert = ['type' => 'error', 'title' => 'Error', 'message' => 'Your old password is incorrect!'];
        } else {
            // Update password
            $sql = mysqli_query($con, "UPDATE users SET password='$newPassword' WHERE id='$id'");
            if ($sql) {
                $alert = ['type' => 'success', 'title' => 'Password Changed!', 'message' => 'Your password has been updated successfully.'];
            } else {
                $alert = ['type' => 'error', 'title' => 'Error', 'message' => 'Failed to update password.'];
            }
        }
    }
}
?>

<!-- Sweetalert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Change Password</h1>
    </div>
    <div class="section-body">
      <div class="row mb-2">
        <div class="col-12 text-right mb-2"> 
          <a href="dashboard.php" class="btn btn-primary">Back Home</a>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-body">
              <form action="" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group">
                  <label>Current Password</label>
                  <input type="password" class="form-control" name="password" required>
                  <div class="invalid-feedback">Please fill in current password</div>
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" name="newPassword" required>
                  <div class="invalid-feedback">Please fill in new password</div>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" name="conPassword" required>
                  <div class="invalid-feedback">Please confirm your password</div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" style="width: 150px; margin-left: 200px;">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>

<?php if ($alert): ?>
<script>
  swal(<?= json_encode($alert['title']) ?>, <?= json_encode($alert['message']) ?>, <?= json_encode($alert['type']) ?>);
</script>
<?php endif; ?>
