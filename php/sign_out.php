<?php
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['userid']);
	$url="../pages/index.html";
	echo "<script type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
?>