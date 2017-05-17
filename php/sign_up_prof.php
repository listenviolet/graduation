<?php 
	session_start(); 
	require_once 'conn_db.php';

	$email=$_POST["email"];
	$name=$_POST["name"];
	$password=$_POST["password"];
	$rp_password=$_POST["rp_password"];

	if($password==$rp_password){
		$hash=password_hash($password,PASSWORD_DEFAULT);
		$query_insert_prof="insert into prof(email,name,password) values ('".$email."','".$name."','".$hash."')";
		$result_insert_prof=$GLOBALS['db'] ->query($query_insert_prof);
		if(isset($result_insert_prof)){
			$_SESSION["username"]=$email;
			$_SESSION["userid"]=mysqli_insert_id($GLOBALS['db']);
			$url="../pages/set_collect.php";
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
	else {
		echo "not equal.<br>";
		$url="../pages/index.html";
		echo "<script type='text/javascript'>";
		echo "alert('The passwords you entered must be the same.');";
		echo "window.location.href='$url'";
		echo "</script>";
	}
	
?>
