<?php
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
	header('Location: ../../login.php');
	exit;
}
