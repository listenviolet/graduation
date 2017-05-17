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
		$stu_classid=$_GET["stu_classid"];
		//getHws($username,$stu_classid);
		getHws($stu_classid);
	}

	//function getHws($username,$stu_classid){
	function getHws($stu_classid){
		$filename_array=array();
		$dir="../xml/".$stu_classid."/";
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
		    if($currenttime >= $hwstarttime && $currenttime <= $hwdeadline){
		    	$filename_array[]=$value;
		    }
		}  
		echo json_encode($filename_array);
	}
?>