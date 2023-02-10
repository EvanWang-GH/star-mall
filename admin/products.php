<?php
require_once "../includes/Db.php";
$sql = "SELECT p.id, p.name p_name, p.price, p.sales, p.description, c.name c_name FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.id";
$db = new Db();
$product_list = $db->fetch_list($sql);
?>
<!-- 商品管理模块 -->
<h2>商品管理</h2>
<!-- 商品列表 -->
<table>
	<thead>
		<tr>
			<th>商品名称</th>
			<th>价格</th>
			<th>销量</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($product_list as $product) {
			$id = $product["id"];
			$p_name = $product["p_name"];
			$price = $product["price"];
			$sales = $product["sales"];
			$c_name = $product["c_name"];
			$description = $product["description"];
		?>
			<tr>
				<td><?= $p_name ?></td>
				<td>¥<?= $price ?></td>
				<td><?= $sales ?></td>
				<td>
					<button class="edit-button">编辑</button>
					<button class="delete-button" onclick="location.href='api/delete-product.php?id=<?= $id ?>'">删除</button>
					<form class="edit-form" style="display: none;" action="api/update-product.php" method="POST">
						<label>
							商品名称：
							<input type="text" name="name" value="<?= $p_name ?>">
						</label>
						<label>
							商品价格：
							<input type="number" name="price" value="<?= $price ?>">
						</label>
						<label>
							商品描述：
							<textarea name="description"><?= $description ?></textarea>
						</label>
						<input type="hidden" name="id" value="<?= $id ?>">
						<button type="submit">提交</button>
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<!-- 添加商品表单 -->
<form action="#" method="post" action="api/add-product.php" enctype="multipart/form-data">
	<label for="name">商品名称</label>
	<input type="text" id="name" name="name" />
	<label for="price">价格</label>
	<input type="number" id="price" name="price" min="0" />
	<label for="description">描述</label>
	<input type="text" id="description" name="description" />
	<label for="image">商品图片</label>
	<input type="file" id="image" name="image" />
	<label for="category_id">类别</label>
	<select name="category_id" id="category_id">
		<?php
		$db = new Db();
		$sql = "SELECT * FROM categories";
		$categories = $db->fetch_list($sql);
		for ($i = 0; $i < count($categories); $i++) {
			$id = $categories[$i]["id"];
			$name = $categories[$i]["name"];
			echo "	<option value='$id'>$name</option>";
		}
		?>
	</select>
	<button type="submit" formaction="api/add-product.php">添加商品</button>
</form>