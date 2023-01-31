<?php
// 开启 session
session_start();

// 生成随机字符串
$text = '';
for ($i = 0; $i < 4; $i++) {
	$char = [
		chr(rand(48, 57)),
		chr(rand(65, 90)),
		chr(rand(97, 122))
	];
	$text .= $char[rand(0, 2)];
}

// 将随机字符串保存到 session 中，用于验证
$_SESSION['captcha'] = strtolower($text);

// 创建图片，宽度为 100，高度为 30
$image = imagecreatetruecolor(100, 30);

// 背景色
$bgcolor = imagecolorallocate($image, 0xf2, 0xf2, 0xf2);

// 文本色
$textcolor = imagecolorallocate($image, 0, 0, 0);

// 填充背景色
imagefill($image, 0, 0, $bgcolor);

// 在图片中画 100 个噪点
for ($i = 0; $i < 100; $i++) {
	imagesetpixel($image, rand(0, 100), rand(0, 30), $textcolor);
}

// 在图片中画两条曲线
$color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
for ($i = 0; $i < 2; $i++) {
	imagearc($image, rand(-10, 110), rand(-10, 40), rand(80, 200), rand(80, 200), rand(0, 360), rand(0, 360), $color);
}

// 将随机字符串写入图片
for ($i = 0; $i < strlen($text); $i++) {
	$char = $text[$i];
	imagestring($image, 5, 7 + 25 * $i, 5, $char, $textcolor);
}

// 输出图片头
header('Content-Type: image/png');

// 输出图片
imagepng($image);

// 释放资源
imagedestroy($image);
