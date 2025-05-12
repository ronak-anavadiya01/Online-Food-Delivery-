<?php 
include "../../db_connect/connection.php";
include './../admin_layout/header.php';
include './../admin_layout/sidebar.php';
?>

<?php
session_start();
include '../../db_connect/connection.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start(); // Start output buffering

    $name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

    echo '<!DOCTYPE html><html><head>';
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '</head><body>';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            swal('Error', 'Invalid email format', 'error').then(() => {
                window.location.href = 'profile.php';
            });
        </script>";
        echo '</body></html>';
        exit();
    }

    // Validate mobile number (10 digits)
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "<script>
            swal('Error', 'Mobile number must be 10 digits', 'error').then(() => {
                window.location.href = 'profile.php';
            });
        </script>";
        echo '</body></html>';
        exit();
    }

    // Update profile
    $stmt = $con->prepare("UPDATE users SET full_name=?, email=?, mobile=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $mobile, $id);

    if ($stmt->execute()) {
        $_SESSION['full_name'] = $name;
        echo "<script>
            swal({
                title: 'Success!',
                text: 'Profile updated successfully',
                icon: 'success',
                button: 'OK'
            }).then(() => {
                window.location.href = 'profile.php';
            });
        </script>";
    } else {
        echo "<script>
            swal('Error', 'Failed to update profile: " . addslashes($stmt->error) . "', 'error').then(() => {
                window.location.href = 'profile.php';
            });
        </script>";
    }

    $stmt->close();
    $con->close();
    echo '</body></html>';
    ob_end_flush();
} else {
    header("Location: profile.php");
    exit();
}
?>
