<?php
include('../db_connect/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $feedback = trim($_POST['feedback']);

    // Check if this order already has feedback
    $checkQuery = $con->prepare("SELECT * FROM order_feedback WHERE order_id = ? AND user_id = ?");
    $checkQuery->bind_param("ii", $order_id, $user_id);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        header("Location: order_success.php?order_id=$order_id&feedback=exists");
        exit();
    }

    $insertQuery = $con->prepare("INSERT INTO order_feedback (order_id, user_id, rating, feedback) VALUES (?, ?, ?, ?)");
    $insertQuery->bind_param("iiis", $order_id, $user_id, $rating, $feedback);

    if ($insertQuery->execute()) {
        header("Location: order_success.php?order_id=$order_id&feedback=1");
    } else {
        echo "Failed to save feedback.";
    }
} else {
    header("Location: index.php");
    exit();
}
