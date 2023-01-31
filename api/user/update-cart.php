<?php
session_start();
require_once 'check-user.php';
// 包含数据库操作类
require_once '../../includes/Db.php';
require_once '../../includes/functions.php';

// 创建数据库操作对象
$db = new Db();

// 获取请求数据
$item_id = $_GET['itemId'];
$quantity = intval($_GET['quantity']);
if ($quantity < 1) {
	exit;
}

$sql = "SELECT user_id FROM cart WHERE id = $item_id";
$user_id = $db->fetch_row($sql)[0];
if ($user_id != $_SESSION["user"]["id"]) {
	print_error("用户不匹配");
	exit;
}

$sql = "UPDATE cart SET quantity = $quantity WHERE id = $item_id";
$db->query($sql);
$sql = "SELECT c.id AS id, p.name, p.price, c.quantity
FROM cart AS c LEFT JOIN products AS p
ON c.product_id = p.id
WHERE user_id = $user_id";

$cart = $db->fetch_list($sql);

foreach ($cart as &$item) {
	if ($item['id'] == $item_id) {
		$item['quantity'] = $quantity;
		break;
	}
}

// 返回json字符串
echo json_encode($cart);
