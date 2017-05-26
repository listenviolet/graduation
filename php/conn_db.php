<?php 
	define("DB_SERVER", "localhost");
	define("DB_USERNAME", "adminv1");   
	define("DB_PASSWORD", "123");
	define("DB_DATABASE", "uploadhwv4");

	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	if (!$db)
	{
		echo DB_SERVER;
		die('Could not connect: ' . mysqli_connect_error());

	}
?>