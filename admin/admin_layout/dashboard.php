<?php
include 'header.php';
include 'sidebar.php';

// Check for admin role
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit(); 
}

// Total Users
$query_total_users = "SELECT COUNT(*) AS total_users FROM users";
$result_total_users = mysqli_query($con, $query_total_users);
$row_total_users = mysqli_fetch_assoc($result_total_users);
$total_users = $row_total_users['total_users'];

// Cancelled Orders
$query_cancelled_orders = "SELECT COUNT(*) AS cancelled_orders FROM orders WHERE status = 'cancelled'";
$result_cancelled_orders = mysqli_query($con, $query_cancelled_orders);
$row_cancelled_orders = mysqli_fetch_assoc($result_cancelled_orders);
$cancelled_orders = $row_cancelled_orders['cancelled_orders'];

// Pending Orders
$query_pending_orders = "SELECT COUNT(*) AS pending_orders FROM orders WHERE status = 'pending'";
$result_pending_orders = mysqli_query($con, $query_pending_orders);
$row_pending_orders = mysqli_fetch_assoc($result_pending_orders);
$pending_orders = $row_pending_orders['pending_orders'];

// Delivered Orders
$query_delivered_orders = "SELECT COUNT(*) AS delivered_orders FROM orders WHERE status = 'delivered'";
$result_delivered_orders = mysqli_query($con, $query_delivered_orders);
$row_delivered_orders = mysqli_fetch_assoc($result_delivered_orders);
$delivered_orders = $row_delivered_orders['delivered_orders'];

// Feedback Count
$query_feedback = "SELECT COUNT(*) AS total_feedback FROM order_feedback";
$result_feedback = mysqli_query($con, $query_feedback);
$row_feedback = mysqli_fetch_assoc($result_feedback);
$total_feedback = $row_feedback['total_feedback'];

// Contact Messages Count
$query_contacts = "SELECT COUNT(*) AS total_contacts FROM contact_messages";
$result_contacts = mysqli_query($con, $query_contacts);
$row_contacts = mysqli_fetch_assoc($result_contacts);
$total_contacts = $row_contacts['total_contacts'];
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row  ">
            <!-- Total Users -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../order/order.php';" style="cursor: pointer;">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>Total Users</h4>
            </div>
            <div class="card-body">
                <?php echo $total_users; ?>
            </div>
        </div>
    </div>
</div>


            <!-- Cancelled Orders -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../order/order.php?status=cancelled';" style="cursor: pointer;">
        <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>Cancelled Orders</h4>
            </div>
            <div class="card-body">
                <?php echo $cancelled_orders; ?>
            </div>
        </div>
    </div>
</div>


            <!-- Pending Orders -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../order/order.php?status=Pending';" style="cursor: pointer;"">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pending Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $pending_orders; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivered Orders -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../order/order.php?status=Delivered';" style="cursor: pointer;"">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Delivered Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $delivered_orders; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Count -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-4">
                <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../feedback/rating.php';" style="cursor: pointer;"">
                    <div class="card-icon bg-info">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Feedback</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $total_feedback; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Messages Count -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-4">
                <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../contact/contact.php';" style="cursor: pointer;"">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Contact Messages</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $total_contacts; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reports Overview -->
<!-- Report Summary Card -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-4">
                <div class="card card-statistic-1 clickable-card" onclick="window.location.href='../report/report.php';" style="cursor: pointer;">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Report Summary</h4>
                        </div>
                        <div class="card-body">
                            View Report
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
include 'footer.php';
?>
