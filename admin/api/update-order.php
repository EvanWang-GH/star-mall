<?php
session_start();
require_once("check-admin.php");
require_once("../../includes/Db.php");
$db = new Db();

$o_id = $_GET["o_id"];
$s_id = $_GET["s_id"];

$sql = "UPDATE orders SET status_id = $s_id WHERE id = $o_id";
$db->query($sql);
