<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>登录/注册</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
	<div id="navbar">
		<a href="#login" class="active">登录</a>
		<a href="index.php" class="logo-box"><img src="assets/images/logo.png" alt="首页" height="100%"></a>
		<a href="#signup">注册</a>
	</div>
	<div id="login" class="form-container active">
		<h1>登录</h1>
		<form action="api/login.php" method="POST">
			<label for="email">邮箱</label>
			<input type="email" id="email" name="email">
			<label for="password">密码</label>
			<input type="password" id="password" name="password">
			<label for="captcha">验证码</label>
			<div class="captcha-box">
				<input type="text" id="captcha" name="captcha" />
				<img src="api/captcha.php" alt="验证码" title="点击刷新" onclick="this.src='api/captcha.php'" />
			</div>
			<button type="submit">登录</button>
		</form>
	</div>
	<div id="signup" class="form-container">
		<h1>注册</h1>
		<form action="api/register.php" method="POST">
			<label for="username">用户名</label>
			<input type="text" id="username" name="username">
			<label for="email">邮箱</label>
			<input type="email" id="email" name="email">
			<label for="password">密码</label>
			<input type="password" id="password" name="password">
			<label for="captcha">验证码</label>
			<div class="captcha-box">
				<input type="text" id="captcha" name="captcha" />
				<img src="api/captcha.php" alt="验证码" title="点击刷新" onclick="this.src='api/captcha.php'" />
			</div>
			<button type="submit">注册</button>
		</form>
	</div>
	<script src="assets/js/login.js"></script>
</body>

</html>