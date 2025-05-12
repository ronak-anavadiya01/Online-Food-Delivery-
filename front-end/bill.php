<?php
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);

if (!$order_id || !$user_id || $_SESSION['id'] != $user_id) {
    echo "<h3 class='alert alert-danger'>Invalid order access attempt.</h3>";
    exit();
}


$orderQuery = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $con->prepare($orderQuery);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$orderResult = $stmt->get_result();

if ($orderResult->num_rows == 0) {
    echo "<h3 class='alert alert-warning'>Order not found or unauthorized access.</h3>";
    exit();
}

$order = $orderResult->fetch_assoc();

// ✅ Get User Name
$userQuery = "SELECT full_name FROM users WHERE id = ?";
$userStmt = $con->prepare($userQuery);
$userStmt->bind_param("i", $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();

// ✅ Get Ordered Items
$itemsQuery = "
    SELECT 
        f.name AS food_name,
        c.name AS category,
        s.name AS subcategory,
        oi.quantity,
        oi.price
    FROM order_items oi
    JOIN foods f ON oi.food_id = f.id
    LEFT JOIN food_subcategories s ON oi.subcategory_id = s.id
    LEFT JOIN categories c ON f.category_id = c.id
    WHERE oi.order_id = ?
";

$itemsStmt = $con->prepare($itemsQuery);
$itemsStmt->bind_param("i", $order_id);
$itemsStmt->execute();
$itemsResult = $itemsStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt #<?= htmlspecialchars($order_id) ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .receipt-header { border-bottom: 2px solid #dee2e6; margin-bottom: 20px; }
        .receipt-title { color: #343a40; }
        .receipt-details { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .table th { background-color: #343a40; color: white; }
        .total-row { font-weight: bold; background-color: #f8f9fa; }
        .print-btn { margin-top: 20px; }
    </style>
</head>
<body class="container mt-4">
    <div class="receipt-header">
        <h2 class="receipt-title">Order Receipt</h2>
        <p class="text-muted">Thank you for your order!</p>
    </div>

    <div class="receipt-details">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Customer Name:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
                <p><strong>Order ID:</strong> #<?= htmlspecialchars($order_id) ?></p>
                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                <p><strong>Delivery Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                <p><strong>Contact Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Food Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                if ($itemsResult->num_rows > 0): 
                    while ($item = $itemsResult->fetch_assoc()): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $grand_total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['food_name']) ?></td>
                    <td><?= htmlspecialchars($item['category']) ?></td>
                    <td><?= htmlspecialchars($item['subcategory']) ?></td>
                    <td class="text-right">₹<?= number_format($item['price'], 2) ?></td>
                    <td class="text-right"><?= $item['quantity'] ?></td>
                    <td class="text-right">₹<?= number_format($subtotal, 2) ?></td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No items found in this order.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-right"><strong>Grand Total:</strong></td>
                    <td class="text-right"><strong>₹<?= number_format($grand_total, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="order_history.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
        <button onclick="window.print()" class="btn btn-primary print-btn">
            <i class="fas fa-print"></i> Print Receipt
        </button>
    </div>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
