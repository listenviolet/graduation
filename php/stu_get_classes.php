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
		getClasses($username);
	}

	function getClasses($username){
		$classes_info=array();
		$query_select_stuclasses="select classes_id from student where email='".$username."'";
		$result_select_stuclasses=$GLOBALS['db']->query($query_select_stuclasses);
		if(mysqli_num_rows($result_select_stuclasses)){
			while ($row=mysqli_fetch_assoc($result_select_stuclasses)) {
				$stu_classes=$row["classes_id"];
			}
			$stu_classes_array=explode(",", $stu_classes);
			array_pop($stu_classes_array);
			$stu_class_num=count($stu_classes_array);
			for($i=0;$i<$stu_class_num;$i++){
				$class_id=$stu_classes_array[$i];
				$class_name=getClassName($class_id);
				$classes_info[]=["class_id"=>$class_id,"class_name"=>$class_name];
			}
			echo json_encode($classes_info);
		}
	}

	function getClassName($class_id){
		$query_select_classname="select class_name from class where class_id=".$class_id;
		$result_select_classname=$GLOBALS['db']->query($query_select_classname);
		if(mysqli_num_rows($result_select_classname)==1){
			while($row=mysqli_fetch_assoc($result_select_classname)){
				$class_name=$row["class_name"];
			}
			return $class_name;
		}
	}
?>