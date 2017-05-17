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
		//getHws($username,$stu_classid);
		getHws($classid);
	}
	else {
		$url="../pages/index.html";
		echo "<script type='text/javascript'>";
		echo "alert('Please login first.');";
		echo "window.location.href='$url'";
		echo "</script>";
	}

	//function getHws($username,$stu_classid){
	function getHws($classid){
		$filename_array=array();
		$dir="../xml/".$classid."/";
		$handler = opendir($dir);  	
		while (($filename = readdir($handler)) !== false) {
	    	if ($filename != "." && $filename != "..") {  
	            $files[] = $filename ;  
	       	}  
	    }
	    closedir($handler);    
		$currenttime=date("Y-m-d");
		foreach ($files as $value) {  
		    $xml=simplexml_load_file($dir.$value);
		    $hwname=$xml->hwname;
		    $hwtime=$xml->hwtime;
		    $files=$xml->files;
		    $hwstarttime=$hwtime->hwstarttime;
		    $hwdeadline=$hwtime->hwdeadline;

		    $hwcollectend=date_create($hwdeadline);
	    	date_add($hwcollectend,date_interval_create_from_date_string("4 days"));

		    if($currenttime <= $hwcollectend && $currenttime > $hwdeadline){
	    	//if($currenttime >= $hwstarttime && $currenttime <= $hwdeadline){
		    	$filename_array[]=$value;
		    }
		}  
		echo json_encode($filename_array);
	}
?>