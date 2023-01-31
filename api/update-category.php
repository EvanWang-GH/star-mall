<?php
// 包含数据库操作类
require_once '../includes/Db.php';

$category_id = $_GET["category_id"];
$sql = "SELECT * FROM products WHERE category_id = $category_id";
// 创建数据库操作对象
$db = new Db();
$result = $db->fetch_list($sql);

header('Content-Type: application/json');
echo json_encode($result);
