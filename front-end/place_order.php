<?php
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total_price = $_POST['total_price'];

    // Step 1: Get food, category, subcategory names, and total quantity
    $cartQuery = "SELECT foods.name AS food_name, categories.name AS category_name,
                         food_subcategories.name AS subcategory_name, user_carts.quantity
                  FROM user_carts
                  LEFT JOIN foods ON user_carts.food_id = foods.id
                  LEFT JOIN food_subcategories ON user_carts.subcategory_id = food_subcategories.id
                  LEFT JOIN categories ON foods.category_id = categories.id
                  WHERE user_carts.user_id = ?";
    $cartStmt = $con->prepare($cartQuery);
    $cartStmt->bind_param("i", $user_id);
    $cartStmt->execute();
    $cartResult = $cartStmt->get_result();

    $food_names = [];
    $category_names = [];
    $subcategory_names = [];
    $total_quantity = 0;

    while ($row = $cartResult->fetch_assoc()) {
        $food_names[] = $row['food_name'];
        $category_names[] = $row['category_name'];
        $subcategory_names[] = $row['subcategory_name'];
        $total_quantity += $row['quantity'];
    }

    $food_names_str = implode(', ', $food_names);
    $category_names_str = implode(', ', $category_names);
    $subcategory_names_str = implode(', ', $subcategory_names);

    // Step 2: Insert into orders table
    $orderQuery = "INSERT INTO orders (user_id, address, phone, total_price, quantity, food_name, category, subcategory, order_date)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $con->prepare($orderQuery);
    $stmt->bind_param("issdisss", $user_id, $address, $phone, $total_price, $total_quantity,
                      $food_names_str, $category_names_str, $subcategory_names_str);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Step 3: Insert individual order items
        $cartQuery = "SELECT food_id, subcategory_id, quantity
                      FROM user_carts
                      WHERE user_id = ?";
        $cartStmt = $con->prepare($cartQuery);
        $cartStmt->bind_param("i", $user_id);
        $cartStmt->execute();
        $cartResult = $cartStmt->get_result();

        while ($item = $cartResult->fetch_assoc()) {
            // Check if subcategory_id exists and is valid
            $subcategory_id = isset($item['subcategory_id']) ? $item['subcategory_id'] : 0;

            // If subcategory_id is invalid or 0, skip this item or set a default price
            if ($subcategory_id == 0) {
                // Log or handle the case when there is no valid subcategory
                error_log("Invalid subcategory_id, skipping item with food_id: " . $item['food_id']);
                continue; // Skip this item and move to the next iteration
            }

            $food_id = $item['food_id'];
            $quantity = $item['quantity'];

            // Get subcategory price
            $priceQuery = "SELECT price FROM food_subcategories WHERE id = ?";
            $priceStmt = $con->prepare($priceQuery);
            $priceStmt->bind_param("i", $subcategory_id);
            $priceStmt->execute();
            $priceResult = $priceStmt->get_result();

            // Check if the price was found
            if ($priceRow = $priceResult->fetch_assoc()) {
                $price = $priceRow['price'];
            } else {
                // Log an error if no price is found for the subcategory
                error_log("Price not found for subcategory_id: " . $subcategory_id . " for food_id: " . $food_id);

                // Set a default price or skip the insertion (e.g., set to a fixed default price)
                $price = 0; // Or skip the item by continuing the loop
                continue; // If you want to skip items with no price
            }

            $total_item_price = $price * $quantity;

            // Insert into order_items
            $orderItemQuery = "INSERT INTO order_items (order_id, food_id, subcategory_id, quantity, price)
                               VALUES (?, ?, ?, ?, ?)";
            $orderItemStmt = $con->prepare($orderItemQuery);
            $orderItemStmt->bind_param("iiidd", $order_id, $food_id, $subcategory_id, $quantity, $price);

            if (!$orderItemStmt->execute()) {
                // Log any errors if the insert fails
                error_log("Error inserting order item: " . $orderItemStmt->error);
            }
        }

        // Step 4: Clear cart
        $clearCart = $con->prepare("DELETE FROM user_carts WHERE user_id = ?");
        $clearCart->bind_param("i", $user_id);
        $clearCart->execute();

        header("Location: order_success.php?order_id=$order_id");
        exit();
    } else {
        echo "Error placing order.";
    }
} else {
    header('Location: checkout.php');
    exit();
}
?>
