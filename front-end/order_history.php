<?php
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$swal = "";

// Cancel order handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancel_order_id = intval($_POST['cancel_order_id']);

    $checkQuery = "SELECT * FROM orders WHERE id = $cancel_order_id AND user_id = $user_id AND status = 'pending'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $cancelQuery = "UPDATE orders SET status = 'cancelled' WHERE id = $cancel_order_id";
        if (mysqli_query($con, $cancelQuery)) {
            $swal = "swal('Success!', 'Order #$cancel_order_id has been cancelled.', 'success');";
        } else {
            $swal = "swal('Error!', 'Failed to cancel the order.', 'error');";
        }
    } else {
        $swal = "swal('Oops!', 'Invalid request or order already processed.', 'warning');";
    }
}

// Get all orders
$query = "SELECT id AS order_id, address, phone, total_price, order_date, status
          FROM orders
          WHERE user_id = $user_id
          ORDER BY order_date DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order History</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/all.min.css">  
  <link rel="stylesheet" href="css/style.min.css"> 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Your Order History</h1>
    </div>

    <div class="section-body">
      <div class="row mb-2">
        <div class="col-12 text-right mb-2"> 
          <a href="index.php" class="btn btn-primary">Back to Profile</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Recent Orders</h4>
            </div>
            <div class="card-body">
              <?php if(mysqli_num_rows($result) > 0): ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Status / Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($order = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td>
                      <?php echo $order['order_id']; ?>
                      <br>
                      <?php
                        // Fetch food names
                        $oid = $order['order_id'];
                        $foodQuery = "SELECT f.name FROM order_items oi 
                                      JOIN foods f ON f.id = oi.food_id 
                                      WHERE oi.order_id = $oid";
                        $foodResult = mysqli_query($con, $foodQuery);
                        $foodNames = [];
                        while ($food = mysqli_fetch_assoc($foodResult)) {
                            $foodNames[] = $food['name'];
                        }
                        echo "<small><strong>Items:</strong> " . implode(", ", $foodNames) . "</small>";
                      ?>
                    </td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td>₹<?php echo number_format($order['total_price'], 2); ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>
                      <?php 
                      if ($order['status'] == 'pending') {
                          echo "<span class='badge badge-warning'>Pending</span>";
                          ?>
                          <form method="POST" style="display:inline;" id="cancelForm_<?php echo $order['order_id']; ?>">
                              <input type="hidden" name="cancel_order_id" value="<?php echo $order['order_id']; ?>">
                              <button type="button" class="btn btn-sm btn-danger ml-2" 
                                onclick="confirmCancel(<?php echo $order['order_id']; ?>)">Cancel</button>
                          </form>
                          <?php
                      } elseif ($order['status'] == 'delivered') {
                          echo "<span class='badge badge-success'>Delivered</span>";
                          ?>
                          <a href="bill.php?order_id=<?php echo $order['order_id']; ?>&user_id=<?php echo $user_id; ?>" 
                             class="btn btn-info btn-sm mt-1">View Bill</a>
                          <?php
                      } elseif ($order['status'] == 'cancelled') {
                          echo "<span class='badge badge-danger'>Cancelled</span>";
                      }
                      ?>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
              <?php else: ?>
              <p>You have no order history.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
// SweetAlert cancel confirmation
function confirmCancel(orderId) {
    swal({
        title: "Are you sure?",
        text: "Once cancelled, you will not be able to recover this order!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willCancel) => {
        if (willCancel) {
            document.getElementById('cancelForm_' + orderId).submit();
        }
    });
}
<?php if(!empty($swal)) echo $swal; ?>
</script>
</body>
</html>
