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
		deleteStu($classid,$email);
	}

	function deleteStu($classid,$email){
		$flag=1;
		$replaced_string=$classid.",";
		$query_stu_classes="select classes_id from student where email='".$email."'";
		$result_stu_classes=$GLOBALS['db']->query($query_stu_classes);
		if(mysqli_num_rows($result_stu_classes)==1){
			$classes_id=$result_stu_classes->fetch_object()->classes_id;
			$new_classes_id=str_replace($replaced_string, "", $classes_id);
			$query_update_new="update student set classes_id='".$new_classes_id."' where email='".$email."'";
			$result_update_new=$GLOBALS['db']->query($query_update_new);
			if(!$result_update_new) {
				$flag=0;
			}

		}
		else{
			$flag=0;
		} 

		echo json_encode($flag);
	}

?>
	