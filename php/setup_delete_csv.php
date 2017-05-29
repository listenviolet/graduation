<?php
	header("Content-type: text/javascript");
	session_start(); 
	require_once 'conn_db.php';
	function isLoggedIn(){
		if(isset($_SESSION['username'])){
			return ture;
		}
		else{
			return false;
		}
	}
	
	if(isLoggedIn()){
		$username=$_SESSION['username'];
		$userid=$_SESSION['userid'];
		$classid=$_GET["class_id"];
		$email=$_GET['email'];
		$name=$_GET['name'];
		deleteCSV($classid,$email,$name);
	}

	function deleteStu($classid,$email,$name){
		$flag=1;
		
		$query_csv_path="select class_csv from class where class_id=".$classid;
		$result_csv_path=$GLOABLS['db']->query($query_csv_path);
		if(mysqli_num_rows($result_csv_path)==1){
			$class_csv=$result_csv_path->fetch_object()->class_csv;
		}
		else{
			$flag=0;
		}
		echo json_encode($flag);
	}

?>
	