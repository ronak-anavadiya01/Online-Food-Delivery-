<?php
include('../db_connect/connection.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid food ID.");
}

$food_id = (int)$_GET['id'];
$user_id = $_SESSION['id'];
$quantity = 1;
$subcategory_id = isset($_GET['subcategory_id']) && !empty($_GET['subcategory_id']) ? (int)$_GET['subcategory_id'] : null;

// Get the appropriate price
if ($subcategory_id) {
    // Get subcategory price if selected
    $price_query = "SELECT fs.price 
                   FROM food_subcategories fs
                   WHERE fs.id = ? AND fs.food_id = ?";
    $stmt = $con->prepare($price_query);
    $stmt->bind_param("ii", $subcategory_id, $food_id);
} else {
    // Get base food price if no subcategory
    $price_query = "SELECT price FROM foods WHERE id = ?";
    $stmt = $con->prepare($price_query);
    $stmt->bind_param("i", $food_id);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $price = $row['price'];

    // Check for existing cart item
    $check_query = "SELECT id FROM user_carts 
                   WHERE user_id = ? AND food_id = ? 
                   AND (subcategory_id " . ($subcategory_id ? "= ?" : "IS NULL") . ")";
    
    $check_stmt = $con->prepare($check_query);
    if ($subcategory_id) {
        $check_stmt->bind_param("ii", $user_id, $food_id, $subcategory_id);
    } else {
        $check_stmt->bind_param("ii", $user_id, $food_id);
    }
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Update quantity if exists
        $update_query = "UPDATE user_carts 
                        SET quantity = quantity + 1 
                        WHERE user_id = ? AND food_id = ? 
                        AND (subcategory_id " . ($subcategory_id ? "= ?" : "IS NULL") . ")";
        $update_stmt = $con->prepare($update_query);
        if ($subcategory_id) {
            $update_stmt->bind_param("ii", $user_id, $food_id, $subcategory_id);
        } else {
            $update_stmt->bind_param("ii", $user_id, $food_id);
        }
        $update_stmt->execute();
    } else {
        // Insert new cart item
        $insert_query = "INSERT INTO user_carts 
                        (user_id, food_id, subcategory_id, quantity, price) 
                        VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $con->prepare($insert_query);
        $insert_stmt->bind_param("iiiid", $user_id, $food_id, $subcategory_id, $quantity, $price);
        $insert_stmt->execute();
    }
    
    header('Location: mycart.php');
    exit();
} else {
    echo "<script>
        alert('Food item or subcategory not found!');
        window.location.href = 'index.php';
    </script>";
}
?>