<?php
function check_captcha()
{
	global $user_captcha;
	$captcha = $_SESSION["captcha"];
	if (strtolower($user_captcha) != $captcha) {
		print_error("验证码错误！");
		exit;
	}
}

/**
 * 检查用户是否已登录
 *
 * @return bool 用户是否已登录
 */
function is_logged_in()
{
	if ($_SESSION["logged_in"]) {
		return true;
	} else {
		return false;
	}
}

/**
 * 跳转到指定页面
 *
 * @param string $page 要跳转到的页面的 URL
 */
function redirect_to($page)
{
	header("Location: $page");
	exit;
}

/**
 * 输出错误消息
 *
 * @param string $message 要输出的错误消息
 */
function print_error($message)
{
	echo "<div style='color: red;'>$message</div>";
}

/**
 * 输出成功消息
 *
 * @param string $message 要输出的成功消息
 */
function print_success($message)
{
	echo "<div style='color: green;'>$message</div>";
}
