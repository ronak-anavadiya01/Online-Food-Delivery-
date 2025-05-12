<?php
include '../../db_connect/connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM categories WHERE id = $id";

    if (mysqli_query($con, $query)) {
        header("Location:list.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid ID.";
}
?>
