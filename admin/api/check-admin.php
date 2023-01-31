<?php
if (!$_SESSION["user"]["is_admin"]) {
	redirect_to("../index.php");
}
