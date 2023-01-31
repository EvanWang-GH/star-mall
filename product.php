<?php
require_once "includes/Db.php";
$db = new Db();

$productId = $_GET['id'];
$sql = "SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = $productId";
$product = $db->fetch_row($sql);

$db->close();
$title = $product['name'];
require_once "templates/header.php";
?>
<link rel="stylesheet" href="assets/css/product.css">
<main>
	<form action="api/user/add-to-cart.php" method="post">
		<input type="hidden" name="product_id" value="<?= $productId ?>">
		<div class="product-detail">
			<img src="<?= $product["image_path"] ?>" alt="商品图片">
			<h1><?= $product["name"] ?></h1>
			<p>类别：<?= $product["category_name"] ?></p>
			<p>价格：¥<?= $product["price"] ?></p>
			<p>销量：<?= $product["sales"] ?>件</p>
			<p>描述：<?= $product["description"] ?></p>
			<button>加入购物车</button>
		</div>
	</form>
</main>
<?php
require_once "templates/footer.php";
