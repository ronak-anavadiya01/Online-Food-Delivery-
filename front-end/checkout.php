<?php
include 'header.php';
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];

// Updated query to fetch all necessary fields, matching the current cart system
$query = "SELECT 
            foods.name AS food_name,
            food_subcategories.name AS subcategory_name,
            COALESCE(food_subcategories.price, user_carts.price) AS price,
            user_carts.quantity
          FROM user_carts
          LEFT JOIN foods ON user_carts.food_id = foods.id
          LEFT JOIN food_subcategories ON user_carts.subcategory_id = food_subcategories.id
          WHERE user_carts.user_id = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$totalPrice = 0;
?>

<div class="container-fluid pt-5 mt-5">
    <div class="container py-5">
        <div class="text-center py-5">
            <h1>Checkout</h1>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <h4 class="mb-4 text-center">Order Summary</h4>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>Food Name</th>
                        <th>Subcategory</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $result->fetch_assoc()): 
                        $itemTotal = $item['price'] * $item['quantity'];
                        $totalPrice += $itemTotal;
                    ?>
                        <tr class="text-center">
                            <td class="text-start"><?= htmlspecialchars($item['food_name']) ?></td>
                            <td><?= htmlspecialchars($item['subcategory_name'] ?? 'Base Price') ?></td>
                            <td>₹ <?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₹ <?= number_format($itemTotal, 2) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="text-end">
                <h4 class="mt-3">Total: ₹ <?= number_format($totalPrice, 2) ?></h4>
            </div>

            <h4 class="mt-5 mb-3">Delivery Address</h4>
            <form action="place_order.php" method="POST">
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your delivery address" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required pattern="^\d{10}$">
                </div>
                <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                <button type="submit" class="btn btn-success w-100">Place Order</button>
            </form>
        <?php else: ?>
            <div class="text-center">
                <h4>Your cart is empty!</h4>
                <a href="index.php" class="btn btn-primary mt-3">Browse Menu</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
