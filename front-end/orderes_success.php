<?php
include('header.php');
$order_id = $_GET['order_id'] ?? 0;
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    swal({
        title: "Order Placed Successfully!",
        text: "Your order ID is #<?= $order_id ?>. Thank you for ordering 😊",
        icon: "success",
        button: "Continue Shopping",
    }).then(() => {
        window.location = "shop.php";
    });
</script>
