<?php
include 'header.php';
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$order_id = $_GET['order_id'] ?? 0;
$user_id = $_SESSION['id'];

// Verify order belongs to user
$orderQuery = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $con->prepare($orderQuery);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$orderResult = $stmt->get_result();

if ($orderResult->num_rows === 0) {
    echo "Order not found or access denied.";
    exit();
}

$order = $orderResult->fetch_assoc();

// Check if feedback already exists for this order
$feedbackCheck = $con->prepare("SELECT * FROM order_feedback WHERE order_id = ?");
$feedbackCheck->bind_param("i", $order_id);
$feedbackCheck->execute();
$feedbackResult = $feedbackCheck->get_result();
$hasFeedback = $feedbackResult->num_rows > 0;
?>

<div class="container-fluid pt-5 mt-5">
    <div class="container py-5">
        <div class="text-center py-5">
            <h1>Order Successful!</h1>
            <div class="alert alert-success">
                <p>Your order has been placed successfully.</p>
                <p>Order ID: <strong>#<?= $order['id'] ?></strong></p>
                <p>Total Amount: <strong>₹<?= number_format($order['total_price'], 2) ?></strong></p>
                <p>Status: <span class="badge bg-primary"><?= ucfirst($order['status']) ?></span></p>
            </div>

            <?php if (isset($_GET['feedback']) && $_GET['feedback'] == 1): ?>
                <div class="alert alert-success">Thank you for your feedback!</div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="order_history.php?id=<?= $order_id ?>" class="btn btn-primary">
                    View Order Details
                </a>
                <a href="index.php" class="btn btn-outline-secondary">
                    Continue Shopping
                </a>
            </div>

            <?php if (!$hasFeedback): ?>
                <div class="mt-5">
                    <h4>Rate Your Experience</h4>
                    <form method="POST" action="submit_feedback.php">
                        <input type="hidden" name="order_id" value="<?= $order_id ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">

                        <div class="mb-3">
                            <label class="form-label">Your Rating:</label><br>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                                <label for="star<?= $i ?>">⭐</label>
                            <?php endfor; ?>
                        </div>

                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback:</label>
                            <textarea class="form-control" name="feedback" id="feedback" rows="3" ></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Submit Feedback</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">You have already submitted feedback for this order.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
