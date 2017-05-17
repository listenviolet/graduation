<?php
	session_start();
	require_once 'conn_db.php';
	//upload file
	function upload_csv($class_csv){
		$ext = end(explode(".", $_FILES[$class_csv]["name"]));
		//echo "ext".$ext."<br>";
		$target_dir="../csv/";
		//echo "  target_dir ".$target_dir;
		$name=md5(rand());
		$target_file=$target_dir . $name.".".$ext;
		//echo "  target_file". $target_file;
		$uploadOk=1;
		$fileType=pathinfo($target_file,PATHINFO_EXTENSION);
		
		if(file_exists($target_file)){
			//echo " file already exists.";
			$uploadOk=0;
		}
		
		if($_FILES[$class_csv]["size"]>10000){
			//echo " your file is too large.";
			$uploadOk=0;
		}

		if($fileType!="csv"){
			//echo " not correct filetype.";
			$uploadOk=0;
		}

		if($uploadOk==0){
			//echo " your file was not uploaded.";
		}
		else{
			//echo " tmp_name: ".$_FILES[$class_csv]["tmp_name"];
			//echo "target_file: ".$target_file;
			if(move_uploaded_file($_FILES[$class_csv]["tmp_name"], $target_file)){
				//echo "The file". basename($_FILES[$class_csv]["name"]). "has been uploaded.";
				return $target_file;
			}
			else {
				//echo " there was an error uploading.";
				return false;
			}
		}
		
	}

	//select prof existed classes_id
	$username=$_SESSION["username"];
	$userid=$_SESSION["userid"];
	$query_prof_select_classesid="select classes_id from prof where prof_id=".$userid;
	$result_prof_select_classesid=$GLOBALS['db']->query($query_prof_select_classesid);
	if(mysqli_num_rows($result_prof_select_classesid)==1){
		while($row_prof_existed=mysqli_fetch_assoc($result_prof_select_classesid)){
			$prof_existed_classes=$row_prof_existed["classes_id"];
			//echo "prof_existed_classes: ".$prof_existed_classes."<br>";
		}
	}

	//echo $_POST["deletearray"]."<br>";
	$deletearray=explode(",", $_POST["deletearray"]);
	//echo "deletearray[0]: ".$deletearray[0]."<br>";
	if($deletearray[0]!=NULL){
		$delete_num=count($deletearray);
		for($i=0;$i<$delete_num;$i++){
			//replace prof classes_id
			$existed_class=$deletearray[$i].",";
			$prof_existed_classes=str_replace("$existed_class", "", $prof_existed_classes);
			//echo "after replace prof_existed_classes:".$prof_existed_classes."<br>";

			//select student existed classes_id--read csv file and delete stu class
			$query_select_class_csv="select class_csv from class where class_id=".$deletearray[$i];
			$result_select_class_csv=$GLOBALS['db']->query($query_select_class_csv);
			if(mysqli_num_rows($result_select_class_csv)==1){
				while($row_csv=mysqli_fetch_assoc($result_select_class_csv)){
					$class_csv_addr=$row_csv["class_csv"];
					//echo $class_csv_addr;
				}
				$fileHandle = fopen("$class_csv_addr","r");
				while (($row = fgetcsv($fileHandle,0,","))!=FALSE){
					$stu_email=$row[0];
					//echo "stu_email:".$stu_email."<br>";
					$query_student_classes_id="select classes_id from student where email='".$stu_email."'";
					//echo $query_student_classes_id."<br>";
					$result_student_classes_id=$GLOBALS['db']->query($query_student_classes_id);
					if(mysqli_num_rows($result_student_classes_id)==1){
						while($row_stu_classes=mysqli_fetch_assoc($result_student_classes_id)){
							$student_classes_id=$row_stu_classes["classes_id"];
							$student_classes_id=str_replace($existed_class, "", $student_classes_id);
							//echo "student_classes_id: ".$student_classes_id."<br>";
						}
						$query_update_stu_classes_id="update student set classes_id='".$student_classes_id."' where email='".$stu_email."'";
						$result_update_stu_classes_id=$GLOBALS['db']->query($query_update_stu_classes_id);
					}
				}
			}

			//set delete class active=0
			$query_class_set_active="update class set class_active=0 where class_id=".$deletearray[$i];
			$result_class_set_active=$GLOBALS['db']->query($query_class_set_active);
		}
		//update prof classes_id
		$query_prof_afdel_classes="update prof set classes_id='".$prof_existed_classes."' where prof_id=".$userid;
		$result_prof_afdel_classes=$GLOBALS['db']->query($query_prof_afdel_classes);
	}
	
	$classarray=explode(",",$_POST["classarray"]);
	if($classarray[0]!=NULL){
		//echo "count: ".count($classarray)."<br>";
		$class_num=count($classarray);
		$classes=$prof_existed_classes;
		//echo "////////////<br> classes befor insert: ".$classes;

		for($i=0;$i<$class_num;$i++){
			$classid=$classarray[$i];
			//echo "classid=".$classid."<br>";
			if($_POST[$classid]!=NULL){
				//$thisclass=$_POST[$classid];
				$class_csv=str_replace("class_id", "class_csv", $classid);
				//echo $class_csv."<br>";
				$class_csv_addr=upload_csv($class_csv);
				if($class_csv_addr){
					$query_insertclass="insert into class (class_name,class_csv) values ('".$_POST[$classid]."','".$class_csv_addr."')";
					$result_insertclass=$GLOBALS['db']->query($query_insertclass);
					$class_id=mysqli_insert_id($db);
					//echo "class_id: ".$class_id."<br>";
					$classes=$classes.$class_id.",";
				}
					
				////////////////////////
				
				$fileHandle = fopen("$class_csv_addr","r");
				while (($row = fgetcsv($fileHandle,0,","))!=FALSE){
					//echo '<br>';
					//echo 'email:'.$row[0].'<br>';
					//echo 'name:'.$row[1].'<br>';
					//echo '<br>';
					$stu_email=$row[0];
					$query_select_student="select * from student where email='".$stu_email."'";
					//echo $query_select_student;
					$result_select_student=$db->query($query_select_student);
					if(mysqli_num_rows($result_select_student)==1){
						while($row_stu=mysqli_fetch_assoc($result_select_student)){
							$stu_classes=$row_stu["classes_id"];
							if($stu_classes==NULL){ //classes is empty
								$stu_classes=$stu_classes.$class_id.",";
								//echo "stu_classes: ".$stu_classes."<br>";
							}
							else{ //already has so check if this class exists; if not add
								$stu_classes_array=explode(",", $stu_classes);
								//print_r($stu_classes_array);
								//echo $classes;
								if(in_array($class_id, $stu_classes_array)){
									//echo "this class already exists";
									//echo '<br>';
								}
								else {
									//echo "this class doesn't exists";
									//echo '<br>';
									$stu_classes=$stu_classes.$class_id.",";
								}
							}

							$query_update_stuclasses="update student set classes_id='".$stu_classes."' where email='".$stu_email."'";
							//echo '<br>';
							//echo $query_update_stuclasses;
							$result_update_stuclasses=$db->query($query_update_stuclasses);
						}
					}
				}
			}
		}
		$query_addClasses="update prof set classes_id="."'".$classes."'"." where prof_id=".$userid;
		//echo $query_addClasses;
		$result_addClasses=$db->query($query_addClasses);
	}

		//echo " Success addClasses.";
		$url="../pages/setup_hw.php";
		echo "<script type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
?>