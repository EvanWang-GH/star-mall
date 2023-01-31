<?php
session_start();
require_once 'check-user.php';
// 包含数据库操作类
require_once '../../includes/Db.php';
require_once '../../includes/functions.php';

// 创建数据库操作对象
$db = new Db();

// 获取请求数据
$productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$user_id = $_SESSION["user"]["id"];
// 检查商品是否存在
$sql = "SELECT COUNT(*) FROM products WHERE id = $productId";
$count = $db->fetch_row($sql)['COUNT(*)'];
if ($count == 0) {
	header('HTTP/1.1 400 Bad Request');
	print_error('商品不存在');
	exit;
}

// 检查购物车是否已经有该商品
$sql = "SELECT COUNT(*) FROM cart WHERE user_id = $user_id AND product_id = $productId";
$count = $db->fetch_row($sql)['COUNT(*)'];
if ($count > 0) {
	// 如果已经有该商品，则更新数量
	$sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $productId";
	$db->query($sql);
} else {
	// 如果购物车中没有该商品，则插入一条新记录
	$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $productId, 1)";
	$db->query($sql);
}
$db->close();
redirect_to("../../cart.php");
