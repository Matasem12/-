<?php
session_start();
require("db_connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $user_id = $_SESSION["user_id"];

    // التحقق من وجود المنتج في عربة التسوق
    $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $existing_item = $stmt->fetch();

    if ($existing_item) {
        // زيادة الكمية إذا كان المنتج موجودًا
        $new_quantity = $existing_item["quantity"] + 1;
        $stmt = $con->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->execute([$new_quantity, $existing_item["id"]]);
    } else {
        // إضافة منتج جديد إلى عربة التسوق
        $stmt = $con->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $product_id]);
    }

    header("Location: cart.php");
    exit();
}
?>