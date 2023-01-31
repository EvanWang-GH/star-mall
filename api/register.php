<?php
require_once "../includes/functions.php";
require_once "../includes/Db.php";

// 获取表单中提交的数据
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_captcha = $_POST["captcha"];

// 检查用户输入的数据是否为空
if (empty($username) || empty($email) || empty($password)) {
	print_error("请输入用户名、邮箱和密码！");
	exit;
}

check_captcha();

// 构造 SQL 查询语句，检查是否已经有相同的用户名或邮箱
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";

// 实例化数据库操作类
$db = new Db();

// 执行 SQL 查询
$result = $db->query($sql);

// 检查查询是否成功
if (!$result) {
	print_error("SQL 查询失败：" . mysqli_error($conn));
	exit;
}

// 如果查询结果不为空，说明已经有相同的用户名或邮箱
if (mysqli_num_rows($result) > 0) {
	print_error("用户名或邮箱已存在！");
	exit;
}

// 构造 SQL 插入语句，将新用户的信息保存到数据库中
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

// 执行 SQL 插入
$result = $db->query($sql);

// 检查插入是否成功
if (!$result) {
	print_error("SQL 插入失败：" . $db->error());
	exit;
}

// 注册成功，输出成功消息
print_success("注册成功！");

// 关闭数据库连接
$db->close();

// 跳转回登录页面
redirect_to("../login.php");
exit;
