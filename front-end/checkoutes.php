<?php
include('header.php');
include('../db_connect/connection.php');

$user_id = $_SESSION['id'] ?? 0;

$sql = "SELECT uc.*, f.name AS food_name, f.image, fs.name AS subcategory_name, fs.price
        FROM user_carts uc
        LEFT JOIN foods f ON uc.food_id = f.id
        LEFT JOIN food_subcategories fs ON uc.subcategory_id = fs.id
        WHERE uc.user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="container py-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Food Name</th>
                    <th>Subcategory</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()):
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['food_name']) ?></td>
                        <td><?= htmlspecialchars($row['subcategory_name']) ?></td>
                        <td>₹<?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td>₹<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h4 class="text-right">Grand Total: ₹<?= number_format($total, 2) ?></h4>

        <form action="place_order.php" method="POST" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Mobile Number:</label>
                <input type="text" name="phone" id="phone" class="form-control" required pattern="[0-9]{10}" maxlength="10">
            </div>
            <input type="hidden" name="total_price" value="<?= $total ?>">
            <button type="submit" class="btn btn-success btn-block">Place Order</button>
        </form>
    <?php else: ?>
        <script>
            swal("Oops!", "Your cart is empty!", "info").then(() => {
                window.location = "shop.php";
            });
        </script>
    <?php endif; ?>
</div>

<script>
function validateForm() {
    const address = document.getElementById('address').value.trim();
    const phone = document.getElementById('phone').value.trim();
    if (!address || !phone) {
        swal("Please fill in all required fields.", "", "warning");
        return false;
    }
    return true;
}
</script>
