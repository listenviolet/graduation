<?php
	session_start();
	require_once 'conn_db.php';
	$username=$_SESSION['username'];
	$query_select_classes="select classes_id from prof where email='".$username."'";
	echo $query_select_classes."<br>";
	$result_select_classes=$db->query($query_select_classes);
	if(mysqli_num_rows($result_select_classes)){
		while ($row=mysqli_fetch_assoc($result_select_classes)) {
			$classes=$row["classes_id"];
		}
		$classes_array=explode(",", $classes);
		$json_classes=json_encode($classes_array);
	}
?>