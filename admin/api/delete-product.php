<?php
session_start();
require_once('check-admin.php');
require_once('../../includes/functions.php');
require_once "../../includes/Db.php";
$db = new Db();
$id = $_GET["id"];
$sql = "DELETE FROM products WHERE id= $id";
$db->query($sql);
redirect_to("../index.php");
