<?php
session_start();
require_once('check-admin.php');
require_once('../../includes/functions.php');
require_once "../../includes/Db.php";
$db = new Db();
$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];
$sql = "UPDATE products SET name = '$name', price = $price, description = '$description' WHERE id = $id";
$db->query($sql);
redirect_to("../index.php");
