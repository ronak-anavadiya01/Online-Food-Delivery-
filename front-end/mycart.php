<?php
include 'header.php';
include('../db_connect/connection.php');

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}    

$id = $_SESSION['id'];

$query = "SELECT 
            foods.*,
            user_carts.id AS cart_id,
            user_carts.quantity,
            user_carts.subcategory_id,
            user_carts.price AS cart_price,
            categories.name AS category_name,
            food_subcategories.price AS subcategory_price,
            food_subcategories.name AS subcategory_name
          FROM user_carts
          LEFT JOIN foods ON user_carts.food_id = foods.id
          LEFT JOIN categories ON foods.category_id = categories.id
          LEFT JOIN food_subcategories ON user_carts.subcategory_id = food_subcategories.id
          WHERE user_carts.user_id = ? 
          AND foods.status = 1";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    .btn-primary {
        background-color: rgb(86, 204, 39) !important;
    }
    .text-primary {
        color: rgb(86, 204, 39) !important;
    }
    .border-primary {
        border-color: rgb(86, 204, 39) !important;
    }
    .btn-custom {
        border: 1px solid rgb(204, 77, 39);
        color: rgb(86, 204, 39);
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: rgb(204, 141, 39);
        color: white;
    }
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="text-center py-5"><br><br><br><br><br>
    <h1>My Cart</h1>
    <a href="index.php" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Add New Product
    </a>
</div>

<table class="table">
    <thead>
        <tr align="center">
            <th>Food Name</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($userCart = $result->fetch_assoc()): ?>
                <?php
                    $price = !empty($userCart['subcategory_id']) ? $userCart['subcategory_price'] : $userCart['cart_price'];
                ?>
                <tr align="center">
                    <td align="left"><?= htmlspecialchars($userCart['name']) ?></td>
                    <td><?= htmlspecialchars($userCart['category_name']) ?></td>
                    <td>
                        <select class="form-select" data-cart-id="<?= $userCart['cart_id'] ?>" onchange="updateSubcategory(this)">
                            <option value="">Base Price (<?= number_format($userCart['cart_price'], 2) ?>)</option>
                            <?php
                            $subcategory_query = "SELECT * FROM food_subcategories WHERE food_id = ? AND status = 1";
                            $sub_stmt = $con->prepare($subcategory_query);
                            $sub_stmt->bind_param("i", $userCart['id']);
                            $sub_stmt->execute();
                            $subcategories = $sub_stmt->get_result();
                            while ($sub = $subcategories->fetch_assoc()):
                                $selected = $sub['id'] == $userCart['subcategory_id'] ? 'selected' : '';
                            ?>
                                <option value="<?= $sub['id'] ?>" data-price="<?= $sub['price'] ?>" <?= $selected ?>>
                                    <?= htmlspecialchars($sub['name']) ?> (<?= number_format($sub['price'], 2) ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                    <td data-price="<?= $price ?>"><?= number_format($price, 2) ?></td>
                    <td>
                        <input type="number" class="form-control quantity-input" 
                               value="<?= $userCart['quantity'] ?>" 
                               min="1" 
                               data-cart-id="<?= $userCart['cart_id'] ?>" 
                               onchange="updateQuantity(this)">
                    </td>
                    <td class="total"><?= number_format($price * $userCart['quantity'], 2) ?></td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteItem(<?= $userCart['cart_id'] ?>, this)">
                            <span class="delete-text">Delete</span>
                            <span class="loading d-none"></span>
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No items in cart</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if ($result->num_rows > 0): ?>
<div class="text-end mt-4">
    <h3 align="right">Total: <span id="grand-total"><?php 
        $grandTotal = 0;
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            $price = !empty($row['subcategory_id']) ? $row['subcategory_price'] : $row['cart_price'];
            $grandTotal += $price * $row['quantity'];
        }
        echo number_format($grandTotal, 2);
    ?></span></h3>
    <form action="checkout.php" method="POST" id="orderForm">
        <button type="submit" class="btn btn-lg btn-danger mt-2" style="margin-left:1350px;">
            Place Order
        </button>
    </form>
</div>
<?php endif; ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    updateGrandTotal();
});

function showLoading(button) {
    button.disabled = true;
    button.querySelector('.delete-text').classList.add('d-none');
    button.querySelector('.loading').classList.remove('d-none');
}

function hideLoading(button) {
    button.disabled = false;
    button.querySelector('.delete-text').classList.remove('d-none');
    button.querySelector('.loading').classList.add('d-none');
}

function updateSubcategory(select) {
    const cartId = select.dataset.cartId;
    const subcategoryId = select.value;
    const price = select.options[select.selectedIndex].dataset.price || select.closest('tr').querySelector('td[data-price]').dataset.price;

    fetch('update_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'update_subcategory',
            cart_id: cartId,
            subcategory_id: subcategoryId,
            price: price
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const row = select.closest('tr');
            row.querySelector('td[data-price]').textContent = parseFloat(price).toFixed(2);
            row.querySelector('td[data-price]').dataset.price = price;
            row.querySelector('.total').textContent = (price * row.querySelector('.quantity-input').value).toFixed(2);
            updateGrandTotal();
        } else {
            swal("Error", data.error || "Failed to update subcategory", "error");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        swal("Error", "An error occurred while updating. Please try again.", "error");
    });
}

function updateQuantity(input) {
    if (input.value < 1) {
        input.value = 1;
        return;
    }

    const cartId = input.dataset.cartId;
    const quantity = input.value;
    const row = input.closest('tr');
    const price = parseFloat(row.querySelector('td[data-price]').dataset.price) || 0;

    fetch('update_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'update_quantity',
            cart_id: cartId,
            quantity: quantity
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const totalCell = row.querySelector('.total');
            totalCell.textContent = (price * quantity).toFixed(2);
            updateGrandTotal();
        } else {
            swal("Error", data.error || "Failed to update quantity", "error");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        swal("Error", "An error occurred while updating. Please try again.", "error");
    });
}

function deleteItem(cartId, btn) {
    const button = btn.closest('button');
    // showLoading(button);

    swal({
        title: "Are you sure?",
        text: "Do you want to remove this item from your cart?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            fetch('update_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'delete', cart_id: cartId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    swal("Deleted!", "Item has been removed from your cart.", "success")
                        .then(() => location.reload());
                } else {
                    swal("Oops!", data.error || "Something went wrong. Please try again.", "error");
                    hideLoading(button);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal("Error", "An error occurred. Please try again.", "error");
                hideLoading(button);
            });
        } else {
            hideLoading(button);
        }
    });
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.total').forEach(td => {
        total += parseFloat(td.textContent) || 0;
    });
    document.getElementById('grand-total').textContent = total.toFixed(2);
}
</script>

<?php include 'footer.php'; ?>
