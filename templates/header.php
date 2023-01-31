<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/includes/header.css">
	<link rel="stylesheet" href="assets/css/includes/footer.css">
</head>
<header>
	<nav>
		<a href="index.php" class="logo-box"><img src="assets/images/logo.png" alt="首页" height="100%"></a>
		<a href="product-list.php">全部商品</a>
		<?php
		if (isset($_SESSION["is_logged_in"])) {
			if ($_SESSION["user"]["is_admin"]) {
				echo '<a href="admin/index.php">后台管理</a>';
			}
			echo '<a href="cart.php">购物车</a>';
			echo '<span>欢迎你：' . $_SESSION["user"]["username"] . "</span>";
			echo '<a href="api/logout.php">注销</a>';
		} else {
			echo '<a href="login.php">登录</a>';
		}
		?>
	</nav>
</header>