<?php
session_start();
include '../../db_connect/connection.php';
include './../admin_layout/header.php';
include './../admin_layout/sidebar.php';

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$fname = $_SESSION['full_name'];

// Fetch user details
$query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
$row = mysqli_fetch_array($query);

// Alert setup
$alert = null;

// Handle form submission
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert = [
            'title' => 'Error',
            'message' => 'Invalid email format',
            'type' => 'error',
            'redirect' => ''
        ];
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $alert = [
            'title' => 'Error',
            'message' => 'Mobile number must be 10 digits',
            'type' => 'error',
            'redirect' => ''
        ];
    } else {
        $stmt = $con->prepare("UPDATE users SET full_name=?, email=?, mobile=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $mobile, $id);

        if ($stmt->execute()) {
            $_SESSION['full_name'] = $name;
            $alert = [
                'title' => 'Success!',
                'message' => 'Profile updated successfully',
                'type' => 'success',
                'redirect' => 'profile.php'
            ];
        } else {
            $alert = [
                'title' => 'Error',
                'message' => 'Failed to update profile: ' . $stmt->error,
                'type' => 'error',
                'redirect' => ''
            ];
        }

        $stmt->close();
    }
}
?>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Your Profile</h1>
        </div>
        <div class="section-body">
            <div class="row mb-2">
              
                <div class="col-12 col-md-12 col-lg-12 text-right mb-2">
                    <a href="dashboard.php" class="btn btn-primary">Back Home</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="margin-left: 220px;">
                                <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($fname); ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="full_name"
                                           value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="tel" class="form-control" name="mobile"
                                           pattern="[0-9]{10}" title="10 digit mobile number"
                                           value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" name="submit" style="width: 150px;">
                                        Update
                                    </button>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './../admin_layout/footer.php'; ?>

<?php if ($alert): ?>
<script>
    swal(<?= json_encode($alert['title']) ?>, <?= json_encode($alert['message']) ?>, <?= json_encode($alert['type']) ?>)
        .then(() => {
            <?php if (!empty($alert['redirect'])): ?>
            window.location.href = <?= json_encode($alert['redirect']) ?>;
            <?php endif; ?>
        });
</script>
<?php endif; ?>
