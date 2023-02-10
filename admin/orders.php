<?php
require_once "../includes/Db.php";
$db = new Db();

$sql = "SELECT o.*, u.username, o.status_id status FROM orders o LEFT JOIN users u ON o.user_id = u.id";
$order_list = $db->fetch_list($sql);

$sql = "SELECT * FROM order_status";
$status_list = $db->fetch_list($sql);
$db->close();

$option_str = "";
foreach ($status_list as $status) {
	$status_id = $status["id"];
	$status_name = $status["name"];
	$option_str .= "<option value='$status_id'>$status_name</option>";
}
?>
<!-- 订单管理模块 -->
<h2>订单管理</h2>
<!-- 订单列表 -->
<table>
	<thead>
		<tr>
			<th>订单号</th>
			<th>用户</th>
			<th>金额</th>
			<th>状态</th>
		</tr>
		<?php
		foreach ($order_list as $order) {
			$id = $order["id"];
			$name = $order["username"];
			$total_price = $order["total_price"];
			$status = $order["status"];
			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$name</td>";
			echo "<td>$total_price</td>";
			echo "<td><select name='status' class='status-box' data-status='$status' data-id='$id'>$option_str</select></td>";
			echo "</tr>";
		}
		?>
	</thead>
</table>