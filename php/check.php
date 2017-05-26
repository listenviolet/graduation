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
		$classid=$_GET["classid"];
		$code=$_GET["code"];
		checkCode($code);
	}
	else {
		$url="../pages/index.html";
		echo "<script type='text/javascript'>";
		echo "alert('Please login first.');";
		echo "window.location.href='$url'";
		echo "</script>";
	}

	//Search in the table certification to check whether the homework has been uploaded or not
	function checkCode($code){
		$check_result=array();
		$student_id="";
		$student_email="";
		$hw_path="";
		$query="select * from certification where code_id='".$code."'";
		$result=$GLOBALS['db']->query($query);
		if(mysqli_num_rows($result)==1){
			while($row=mysqli_fetch_assoc($result)){
				$student_id=$row["student_id"];
				$query_stu_email="select email from student where stu_id=".$student_id;
				$result_stu_email=$GLOBALS['db']->query($query_stu_email);
				if(mysqli_num_rows($result)==1){
					while($row_email=mysqli_fetch_assoc($result_stu_email)){
						$student_email=$row_email["email"];
					}
				}
				$hw_path=$row["hw_path"];
				$flag=1;
			}	
		}
		else $flag=0;
		$check_result[]=["student_id"=>$student_id,"student_email"=>$student_email,"hw_path"=>$hw_path,"flag"=>$flag];
		echo json_encode($check_result);
	}
?>