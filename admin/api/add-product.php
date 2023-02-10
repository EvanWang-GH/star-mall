<?php
session_start();
// require_once('check-admin.php');
require_once('../../includes/functions.php');
require_once "../../includes/Db.php";
$db = new Db();
$sql = "SELECT MAX(id) FROM products";
$id = intval($db->fetch_row($sql)[0]);


// 接收表单数据
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

// 上传图片
$image_path = 'assets/images/products/product';
if (is_uploaded_file($_FILES['image']['tmp_name'])) {
	$image_path .= "$id.jpg";
	move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $image_path);
}

// 插入数据
$query = "INSERT INTO products (name, price, description, category_id, image_path) VALUES ('$name', '$price', '$description', '$category_id', '$image_path')";
if (!$db->query($query)) {
	die('插入失败：' . $db->error);
}

// 关闭数据库连接
$db->close();

redirect_to("../index.php");
