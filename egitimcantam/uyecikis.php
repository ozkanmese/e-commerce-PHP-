<?php
	unset($_SESSION["Kullanici"]);
	session_destroy();
	header('location:index.php');
	exit();
?>
