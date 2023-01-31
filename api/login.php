<?php
session_start();
require_once "../includes/functions.php";
require_once "../includes/Db.php";

// 获取表单中提交的数据
$email = $_POST['email'];
$password = $_POST['password'];
$user_captcha = $_POST["captcha"];

// 检查用户输入的数据是否为空
if (empty($email) || empty($password)) {
	print_error("请输入邮箱和密码！");
	exit;
}

check_captcha();

// 构造 SQL 查询语句
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

// 实例化数据库操作类
$db = new Db();

// 如果查询结果不为空，说明找到了匹配的用户
if ($row = $db->fetch_row($sql)) {
	// 将用户信息保存到 session 中
	$_SESSION['is_logged_in'] = true;
	$_SESSION['user'] = $row;

	// 输出登录成功的消息
	print_success("登录成功！");

	redirect_to("../index.php");
} else {
	// 构造 SQL 查询语句
	$sql = "SELECT * FROM users WHERE email='$email'";

	// 如果查询结果不为空，说明找到了匹配的用户
	if ($db->fetch_row($sql)) {
		print_error("密码错误！");
	} else {
		print_error("邮箱未注册！");
	}
}

// 关闭数据库连接
$db->close();
exit;
