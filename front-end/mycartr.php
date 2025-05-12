<?php
ob_start(); 
session_start();
include 'header.php';
include('../db_connect/connection.php');


if (isset($_POST['ajax_update']) && isset($_POST['key']) && isset($_POST['qty'])) {
    $key = $_POST['key'];
    $qty = intval($_POST['qty']);
    if ($qty <= 0) {
        unset($_SESSION['cart'][$key]);
    } else {
        $_SESSION['cart'][$key] = $qty;
    }
    echo json_encode(['status' => 'success']);
    exit();
}


if (isset($_GET['delete'])) {
    $delKey = $_GET['delete'];
    unset($_SESSION['cart'][$delKey]);
    $_SESSION['deleted'] = true;
    header("Location: mycartr.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='text-center'><p>Your cart is empty.</p></div>";
    exit();
}

$total = 0;
?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    .btn-primary { background-color: rgb(86, 204, 39) !important; }
    .text-primary { color: rgb(86, 204, 39) !important; }
    .border-primary { border-color: rgb(86, 204, 39) !important; }
    .btn-custom {
        border: 1px solid rgb(204, 77, 39);
        color: rgb(86, 204, 39);
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: rgb(204, 141, 39);
        color: white;
    }
</style>

<div class="text-center py-5"><br><br><br><br><br>
    <h1>My Cart</h1>
    <a href="shop.php" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Add New Product
    </a>
</div>

<table class="table">
    <thead>
        <tr align="center">
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $key => $qty):
            list($table, $id) = explode("-", $key);
            $id = intval($id);
            $qty = intval($qty);

            $sql = "SELECT * FROM `$table` WHERE id = $id";
            $result = mysqli_query($con, $sql);

            if ($row = mysqli_fetch_assoc($result)):
                $name = $row['name'];
                $price = $row['price'];
                $subtotal = $price * $qty;
                $total += $subtotal;
        ?>
        <tr align="center">
            <td><?= htmlspecialchars($name) ?></td>
            <td>₹<?= number_format($price, 2) ?></td>
            <td>
                <input type="number" data-key="<?= $key ?>" value="<?= $qty ?>" min="1" class="form-control qty-input" style="width: 80px; margin: auto;">
            </td>
            <td>₹<?= number_format($subtotal, 2) ?></td>
            <td>
                <a href="mycartr.php?delete=<?= urlencode($key) ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endif; endforeach; ?>
    </tbody>
</table>

<div class="text-right pr-3">
    <h4>Total: ₹<?= number_format($total, 2) ?></h4>
</div>

<div class="text-center">
    <form method="POST" action="places_order.php">
        <button type="submit" class="btn btn-success  btn-lg btn-danger mt-3" style="margin-left:1350px;">Place Order</button>
    </form>
</div>

<script>

document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function () {
        const key = this.getAttribute('data-key');
        const qty = this.value;

        fetch('mycartr.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `ajax_update=1&key=${encodeURIComponent(key)}&qty=${qty}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                swal("Updated!", "Cart updated successfully!", "success")
                .then(() => location.reload());
            }
        });
    });
});
</script>

<?php

if (isset($_SESSION['deleted'])) {
    echo "<script>
        swal('Deleted!', 'Item removed from cart.', 'success');
    </script>";
    unset($_SESSION['deleted']);
}
?>

<?php ob_end_flush();
 ?>
