<?php
	session_start();
	require_once 'conn_db.php';
	require('../fpdf181/fpdf.php');
	class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial','B',20);
            $this->Cell(80);
            $this->Cell(30,20,'Certificaion',0,0,'C');
            $this->Ln(20);
        }
    }

	function getClassName($hwclass){
		$query_select_class_name="select class_name from class where class_id=".$hwclass;
		$result_select_class_name=$GLOBALS['db']->query($query_select_class_name);
		if(mysqli_num_rows($result_select_class_name)==1){
			while ($row=mysqli_fetch_assoc($result_select_class_name)) {
				$classname=$row["class_name"];
			}
			return $classname;
		}
	}
	
	function upload_hw($j,$hwclass,$hwid,$username,$classname,$hwname){
		$target_dir="../homework/".$hwclass."/".$hwid."/".$username."/";
		//echo $target_dir;
		$target_file=$target_dir.basename($_FILES["upload".$j]["name"]);
		if(move_uploaded_file($_FILES["upload".$j]["tmp_name"], $target_file)){
			$GLOBALS['flag']=1;
			$code=generateCode();
			$userid=$_SESSION["userid"];
			echo "userid:".$userid."<br>";
			certificate($code,$userid,$target_dir);
		}
		else {
			$GLOBALS['flag']=0;
		}
	}

	function generateCode(){
		$milliseconds = round(microtime(true) * 1000);
		$rand_fr=rand(0,9);
		$rand_se=rand(0,9);
		$code=$rand_fr.$rand_se.$milliseconds;
		return $code;
	}

	function certificate($code,$userid,$hw_path){
		$query_certificate="insert into certification values('".$code."','".$userid."','".$hw_path."')";
		echo $query_certificate."<br>";
		$result_certificate=$GLOBALS['db']->query($query_certificate);
		$_SESSION["code"]=$code;
	}

	$username=$_SESSION["username"];
	$hwclass=$_POST["hw_class"];
	$hwid=$_POST["hw_id"];
	$hwname=$_POST["hw_name_hid"];
	$hwfilesnum=$_POST["hw_files_num"];
	$classname=getClassName($hwclass);
	$flag=1;

	if(!file_exists("../homework/".$hwclass."/")){
		mkdir("../homework/".$hwclass."/");
	}
	chmod("../homework/".$hwclass."/",0777);
	if(!file_exists("../homework/".$hwclass."/".$hwid."/")){
		mkdir("../homework/".$hwclass."/".$hwid."/");
	}
	chmod("../homework/".$hwclass."/".$hwid."/", 0777);
	if(!file_exists("../homework/".$hwclass."/".$hwid."/".$username."/")){
		mkdir("../homework/".$hwclass."/".$hwid."/".$username."/");
	}
	chmod("../homework/".$hwclass."/".$hwid."/".$username."/",0777);

	for($i=0;$i<$hwfilesnum;$i++){
		upload_hw($i,$hwclass,$hwid,$username);
	}

	if($flag==1){
	    $_SESSION["classname"]=$classname;
	    $_SESSION["hwname"]=$hwname;
	    $url="../pages/certification.php";
		echo "<script type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
?>