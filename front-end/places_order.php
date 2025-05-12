<?php
session_start();
include('../db_connect/connection.php');

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];
$order_date = date("Y-m-d H:i:s");

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $qty) {
        list($table, $id) = explode("-", $key);
        $id = intval($id);

        $res = mysqli_query($con, "SELECT * FROM `$table` WHERE id = $id");
        if ($row = mysqli_fetch_assoc($res)) {
            $name = $row['name'];
            $price = $row['price'];
            $total = $qty * $price;

            $insert = "INSERT INTO orders (user_id, food_name, quantity, total_price, total, order_date, category)
                       VALUES ('$user_id', '$name', '$qty', '$price', '$total', '$order_date', '$table')";
            mysqli_query($con, $insert);
        }
    }

    unset($_SESSION['cart']);
    header('Location: orderes_success.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $total_price = $_POST['total_price'] ?? 0;

    if (empty($address) || empty($phone)) {
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>swal('Error', 'Address and phone number are required!', 'error').then(() => window.history.back());</script>";
        exit();
    }

    $cartQuery = "SELECT foods.name AS food_name, categories.name AS category_name,
                         food_subcategories.name AS subcategory_name, user_carts.quantity
                  FROM user_carts
                  LEFT JOIN foods ON user_carts.food_id = foods.id
                  LEFT JOIN food_subcategories ON user_carts.subcategory_id = food_subcategories.id
                  LEFT JOIN categories ON foods.category_id = categories.id
                  WHERE user_carts.user_id = ?";
    $stmt = $con->prepare($cartQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $food_names = $category_names = $subcategory_names = [];
    $total_quantity = 0;

    while ($row = $result->fetch_assoc()) {
        $food_names[] = $row['food_name'];
        $category_names[] = $row['category_name'];
        $subcategory_names[] = $row['subcategory_name'];
        $total_quantity += $row['quantity'];
    }

    if ($total_quantity == 0) {
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>swal('Cart Empty', 'You have no items to order.', 'info').then(() => window.location='shop.php');</script>";
        exit();
    }

    $stmt = $con->prepare("INSERT INTO orders (user_id, address, phone, total_price, quantity, food_name, category, subcategory, order_date)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param(
        "issdisss",
        $user_id,
        $address,
        $phone,
        $total_price,
        $total_quantity,
        implode(', ', $food_names),
        implode(', ', $category_names),
        implode(', ', $subcategory_names)
    );

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        $itemQuery = "SELECT food_id, subcategory_id, quantity FROM user_carts WHERE user_id = ?";
        $itemStmt = $con->prepare($itemQuery);
        $itemStmt->bind_param("i", $user_id);
        $itemStmt->execute();
        $items = $itemStmt->get_result();

        while ($item = $items->fetch_assoc()) {
            $subcategory_id = $item['subcategory_id'];
            $food_id = $item['food_id'];
            $quantity = $item['quantity'];

            $priceQ = $con->prepare("SELECT price FROM food_subcategories WHERE id = ?");
            $priceQ->bind_param("i", $subcategory_id);
            $priceQ->execute();
            $priceResult = $priceQ->get_result();

            if ($priceRow = $priceResult->fetch_assoc()) {
                $price = $priceRow['price'];
                $orderItem = $con->prepare("INSERT INTO order_items (order_id, food_id, subcategory_id, quantity, price)
                                            VALUES (?, ?, ?, ?, ?)");
                $orderItem->bind_param("iiidd", $order_id, $food_id, $subcategory_id, $quantity, $price);
                $orderItem->execute();
            }
        }

        $clearCart = $con->prepare("DELETE FROM user_carts WHERE user_id = ?");
        $clearCart->bind_param("i", $user_id);
        $clearCart->execute();

        header("Location: orderes_success.php?order_id=$order_id");
        exit();
    } else {
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>swal('Error', 'Could not place order. Try again!', 'error');</script>";
    }
} else {
    header("Location: checkoutes.php");
    exit();
}
?>
