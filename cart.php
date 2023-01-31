<?php
$title = "购物车";
require_once "templates/header.php";
require_once "api/user/check-user.php";
require_once "includes/Db.php";

$db = new Db();

$user_id = $_SESSION["user"]["id"];
$sql = "SELECT c.id AS item_id, c.quantity AS q, p.*
FROM cart AS c LEFT JOIN products AS p
ON c.product_id
WHERE c.user_id = $user_id
AND c.product_id = p.id";

$list = $db->fetch_list($sql);
?>
<link rel="stylesheet" href="assets/css/cart.css">
<main class="cart">
	<h1>购物车</h1>
	<table>
		<thead>
			<tr>
				<th>商品图片</th>
				<th>商品名称</th>
				<th>单价</th>
				<th>数量</th>
				<th>小计</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<!-- 遍历每个商品 -->
			<?php
			$sum = 0;
			foreach ($list as $key => $item) {
			?>
				<tr data-item-id="<?= $item["item_id"] ?>">
					<td>
						<img src="<?= $item["image_path"] ?>" alt="<?= $item["name"] ?>">
					</td>
					<td>
						<p><?= $item["name"] ?></p>
					</td>
					<td>¥<?= $item["price"] ?></td>
					<td class="quantity">
						<input type="number" value="<?= $item["q"] ?>" min="1">
					</td>
					<td class="subtotal">¥<?= $item["q"] * $item["price"] ?></td>
					<td>
						<button class="delete">删除</button>
					</td>
				</tr>
			<?php
				$sum += $item["q"] * $item["price"];
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">总价：¥<span id="total-price"><?= $sum ?></span></td>
				<td>
					<button class="checkout" onclick="location.href='api/user/checkout.php'">结算</button>
				</td>
			</tr>
		</tfoot>
	</table>
</main>
<script src="assets/js/cart.js"></script>
<?php require_once "templates/footer.php" ?>