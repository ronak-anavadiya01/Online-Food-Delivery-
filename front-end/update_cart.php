<?php
include('../db_connect/connection.php');

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'delete') {
    $cart_id = $data['cart_id'];
    $query = "DELETE FROM user_carts WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    echo json_encode(['success' => $stmt->affected_rows > 0]);
}

if ($data['action'] === 'update_subcategory') {
    $cart_id = $data['cart_id'];
    $subcategory_id = $data['subcategory_id'];
    
    // Get the new price
    $price_query = "SELECT fs.price 
                   FROM user_carts uc
                   JOIN food_subcategories fs ON fs.id = ?
                   WHERE uc.id = ?";
    $stmt = $con->prepare($price_query);
    $stmt->bind_param("ii", $subcategory_id, $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_price = $row['price'];
        
        // Update both subcategory and price
        $update_query = "UPDATE user_carts 
                        SET subcategory_id = ?, price = ? 
                        WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("idi", $subcategory_id, $new_price, $cart_id);
        $update_stmt->execute();
        echo json_encode(['success' => true, 'new_price' => $new_price]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid subcategory']);
    }
}

if ($data['action'] === 'update_quantity') {
    $cart_id = $data['cart_id'];
    $quantity = $data['quantity'];
    
    $query = "UPDATE user_carts SET quantity = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $quantity, $cart_id);
    $stmt->execute();
    echo json_encode(['success' => $stmt->affected_rows > 0]);
}
?>