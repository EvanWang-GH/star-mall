<?php
$title = "首页";
require_once "templates/header.php";
require_once "includes/Db.php";
?>
<link rel="stylesheet" href="assets/css/index.css">
<!-- 轮播图 -->
<?php
$sql = "SELECT * FROM products ORDER BY sales DESC";
$db = new Db();
$products = $db->fetch_list($sql);
?>
<main>
	<h2>热销商品</h2>
	<div id="carousel">
		<a href="product.php?id=<?= $products[0]["id"] ?>"><img src="<?= $products[0]["image_path"] ?>" alt="<?= $products[0]["name"] ?>" class="active"> </a>
		<a href="product.php?id=<?= $products[1]["id"] ?>"><img src="<?= $products[1]["image_path"] ?>" alt="<?= $products[1]["name"] ?>"> </a>
		<a href="product.php?id=<?= $products[2]["id"] ?>"><img src="<?= $products[2]["image_path"] ?>" alt="<?= $products[2]["name"] ?>"> </a>
	</div>

	<!-- 优惠公告列表 -->
	<div id="promotions">
		<h2>公告列表</h2>
		<ul></ul>
		<!-- 翻页按钮 -->
		<div class="pagination">
			<button id="prev-page">上一页</button>
			<button id="next-page">下一页</button>
		</div>
	</div>
</main>
<script src="assets/js/index.js"></script>
<?php
require_once "templates/footer.php";
