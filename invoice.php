<?php
session_start();
require("db_connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$order_id = $_GET["order_id"];
$stmt = $con->prepare("SELECT orders.*, users.username, users.email 
                       FROM orders 
                       JOIN users ON orders.user_id = users.id 
                       WHERE orders.id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch();

$stmt = $con->prepare("SELECT products.name, order_items.quantity, order_items.price 
                       FROM order_items 
                       JOIN products ON order_items.product_id = products.id 
                       WHERE order_items.order_id = ?");
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll();
?>

<h2>فاتورة الشراء</h2>
<p>رقم الطلب: <?= $order["id"] ?></p>
<p>العميل: <?= $order["username"] ?></p>
<p>البريد الإلكتروني: <?= $order["email"] ?></p>
<p>تاريخ الطلب: <?= $order["created_at"] ?></p>

<table>
    <tr>
        <th>المنتج</th>
        <th>الكمية</th>
        <th>السعر</th>
        <th>الإجمالي</th>
    </tr>
    <?php foreach ($order_items as $item): ?>
    <tr>
        <td><?= $item["name"] ?></td>
        <td><?= $item["quantity"] ?></td>
        <td><?= $item["price"] ?> ر.س</td>
        <td><?= $item["price"] * $item["quantity"] ?> ر.س</td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3">المجموع الكلي</td>
        <td><?= $order["total_amount"] ?> ر.س</td>
    </tr>
</table>

<button onclick="window.print()">طباعة الفاتورة</button>