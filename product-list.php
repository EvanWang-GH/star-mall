<?php
$title = "商品列表";
require_once "templates/header.php";
require_once "includes/Db.php";
$db = new Db();
$sql = "SELECT * FROM categories";
$categories = $db->fetch_list($sql);
?>
<link rel="stylesheet" href="assets/css/product-list.css">
<div class="container">
	<div class="categories">
		<ul>
			<?php
			for ($i = 0; $i < count($categories); $i++) {
				$category = $categories[$i];
				echo	'<li data-category-id="' . $category["id"] . '">' . $category["name"] . '</li>';
			}
			?>
		</ul>
	</div>
	<div class="items">
		<ul></ul>
	</div>
</div>
<script src="assets/js/product-list.js"></script>
<?php
require_once "templates/footer.php";
