<?php
require_once "../includes/functions.php";
session_start();
session_unset();
redirect_to("../index.php");
exit;
