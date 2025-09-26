<?php
include '../includes/connect.php';

if (isset($_POST['name'], $_POST['price']) && is_numeric($_POST['price'])) {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image = isset($_POST['image']) ? trim($_POST['image']) : 'default-food.jpg';

    $stmt = $con->prepare("INSERT INTO items (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);
    $stmt->execute();
    $stmt->close();

    header("Location: ../admin-page.php?success=1");
    exit();
} else {
    header("Location: ../admin-page.php?error=1");
    exit();
}
?>