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
		getClasses($username);
	}

	function getClasses($username){
		$classes_info=array();
		$query_prof_select_existed_classes="select classes_id from prof where email='".$username."'";
		$result_prof_select_existed_classes = $GLOBALS['db']->query($query_prof_select_existed_classes);
		if(mysqli_num_rows($result_prof_select_existed_classes)==1){
			while($row_prof_classes=mysqli_fetch_assoc($result_prof_select_existed_classes)){
				$classes_id=$row_prof_classes["classes_id"];
			}
			$classes_id_array=explode(",", $classes_id);
			$classes_num=count($classes_id_array)-1;
			for($i=0;$i<$classes_num;$i++){
				$class_id=$classes_id_array[$i];
				$query_select_class_name="select class_name from class where class_id=".$class_id;
				$result_select_class_name= $GLOBALS['db']->query($query_select_class_name);
				if(mysqli_num_rows($result_select_class_name)==1){
					while($row_class_name=mysqli_fetch_assoc($result_select_class_name)){
						$class_name=$row_class_name["class_name"];
					}
				}
				$classes_info[]=["class_id"=>$class_id,"class_name"=>$class_name];
			}
		}
		echo json_encode($classes_info);
	}
?>