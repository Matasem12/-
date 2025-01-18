<?php
session_start();
require("db_connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$stmt = $con->prepare("SELECT products.id, products.name, products.price, cart.quantity 
                       FROM cart 
                       JOIN products ON cart.product_id = products.id 
                       WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total_amount = 0;
foreach ($cart_items as $item) {
    $total_amount += $item["price"] * $item["quantity"];
}
?>

<h2>عربة التسوق</h2>
<table>
    <tr>
        <th>المنتج</th>
        <th>السعر</th>
        <th>الكمية</th>
        <th>الإجمالي</th>
    </tr>
    <?php foreach ($cart_items as $item): ?>
    <tr>
        <td><?= $item["name"] ?></td>
        <td><?= $item["price"] ?> ر.س</td>
        <td><?= $item["quantity"] ?></td>
        <td><?= $item["price"] * $item["quantity"] ?> ر.س</td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3">المجموع الكلي</td>
        <td><?= $total_amount ?> ر.س</td>
    </tr>
</table>

<a href="checkout.php">الدفع</a>