<?php
	header("Content-type: text/javascript");
	$classid=$_GET["class_id"];
	require_once 'conn_db.php';
	$classinfo=array();
	$query_select_class_name="select class_name from class where class_id=".$classid;
	$result_select_class_name=$GLOBALS['db']->query($query_select_class_name);
	if(mysqli_num_rows($result_select_class_name)==1){
		while ($row=mysqli_fetch_assoc($result_select_class_name)) {
			$classname=$row["class_name"];
			$classinfo[]=["classname"=>$classname];
		}
		echo json_encode($classinfo);
	}

?>