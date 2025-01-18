<?php
session_start();
require("db_connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// إنشاء طلب جديد
$stmt = $con->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
$stmt->execute([$user_id, $total_amount]);
$order_id = $con->lastInsertId();

// نقل العناصر من عربة التسوق إلى تفاصيل الطلب
$stmt = $con->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

foreach ($cart_items as $item) {
    $stmt = $con->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $item["product_id"], $item["quantity"], $item["price"]]);
}

// تفريغ عربة التسوق
$stmt = $con->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);

header("Location: invoice.php?order_id=" . $order_id);
exit();
?>