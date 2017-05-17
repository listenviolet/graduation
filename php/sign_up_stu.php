<?php 
	session_start(); 
	require_once 'conn_db.php';

	$email=$_POST["email"];
	$name=$_POST["name"];
	$password=$_POST["password"];
	$rp_password=$_POST["rp_password"];

	if($password==$rp_password){
		$hash=password_hash($password,PASSWORD_DEFAULT);
		$query_insert_stu="insert into student(email,name,password) values ('".$email."','".$name."','".$hash."')";
		$result_insert_stu=$GLOBALS['db'] ->query($query_insert_stu);
		if(isset($result_insert_stu)){
			$_SESSION["username"]=$email;
			$_SESSION["userid"]=mysqli_insert_id($GLOBALS['db']);
			echo $_SESSION["userid"];
			$url="../pages/stu_classes.php";
			echo "<script type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
		}
		else{
			$url="../pages/index.html";
			echo "<script type='text/javascript'>";
			echo "alert('Failed to sign up.');";
			echo "window.location.href='$url'";
			echo "</script>";
		}
	}
	else{
		$url="../pages/index.html";
		echo "<script type='text/javascript'>";
		echo "alert('Failed to sign up.');";
		echo "window.location.href='$url'";
		echo "</script>";
	}

	
?>
