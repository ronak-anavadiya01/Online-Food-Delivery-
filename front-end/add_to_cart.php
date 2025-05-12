<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['id'])) {
    $product = $_GET['id']; // Example: organic-1

    if (isset($_SESSION['cart'][$product])) {
        $_SESSION['cart'][$product]++;
    } else {
        $_SESSION['cart'][$product] = 1;
    }

    header("Location: mycartr.php"); // Redirect to cart page
    exit();
} else {
    echo "Invalid product.";
}
?>
