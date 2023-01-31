<?php
session_start();
require_once('api/check-admin.php');
require_once('../includes/functions.php');
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>后台管理</title>
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
	<div class="container">
		<div class="header">
			<h1>欢迎来到后台管理</h1>
			<a href="../index.php">回到前台</a>
		</div>
		<div class="main">
			<div class="sidebar">
				<ul>
					<li><a href="#" class="active" data-module="products">商品管理</a></li>
					<li><a href="#" data-module="orders">订单管理</a></li>
				</ul>
			</div>
			<div class="module"></div>
		</div>
	</div>
	<script src="assets/js/index.js"></script>
</body>

</html>