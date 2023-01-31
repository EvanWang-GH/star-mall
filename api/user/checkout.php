<?php
session_start();
require_once "check-user.php";
include_once '../../includes/Db.php';
include_once '../../includes/functions.php';

// 创建数据库操作对象
$db = new Db();

// 获取当前用户的购物车信息
$user_id = $_SESSION["user"]["id"];
$sql = "SELECT p.id, c.quantity, p.price, c.quantity * p.price AS total
        FROM cart c
        INNER JOIN products p ON c.product_id = p.id
        WHERE c.user_id = $user_id";
$cart = $db->fetch_list($sql);

// 计算购物车中商品的总价
$totalPrice = 0;
foreach ($cart as $item) {
	$totalPrice += $item['total'];
}

$sql = "INSERT INTO orders(user_id, total_price) VALUES($user_id, $totalPrice)";
$db->query($sql);
$order_id = $db->conn->insert_id;
for ($i = 0; $i < count($cart); $i++) {
	$item = $cart[$i];
	$product_id = $item["id"];
	$quantity = $item["quantity"];
	$price = $item["price"];
	$sql = "INSERT INTO order_items(order_id, product_id, quantity, price) VALUES($order_id, $product_id, $quantity, $price)";
	$db->query($sql);
	$sql = "UPDATE products SET sales = sales + $quantity WHERE id = $product_id";
	$db->query($sql);
}

$sql = "DELETE FROM cart WHERE user_id = $user_id";
$db->query($sql);
$db->close();

print_success("结算成功，消费 $totalPrice 元");
?>
<script>
	setTimeout(() => {
		location.href = "../../index.php";
	}, 3000);
</script>