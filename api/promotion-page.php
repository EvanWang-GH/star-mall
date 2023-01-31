<?php

// 包含数据库操作类
require_once '../includes/Db.php';

// 创建数据库操作对象
$db = new Db();

// 每页显示的记录数
$pageSize = 3;

// 获取当前页码
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 计算偏移量
$offset = ($page - 1) * $pageSize;

// 查询记录总数
$sql = "SELECT COUNT(*) FROM promotions";
$totalRows = $db->fetch_row($sql)[0];

// 计算总页数
$totalPages = ceil($totalRows / $pageSize);

// 查询当前页的记录
$sql = "SELECT * FROM promotions ORDER BY start_date DESC LIMIT $offset, $pageSize";
$promotions = $db->fetch_list($sql);

// 返回结果
$result = [
	'page' => $page,
	'totalPages' => $totalPages,
	'promotions' => $promotions,
];

header('Content-Type: application/json');
echo json_encode($result);
