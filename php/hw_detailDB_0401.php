<?php 
	session_start();
	require_once 'conn_db.php';
	$username=$_SESSION["username"];
	$classid=$_GET["class_id"];
	$hwid=$_GET["hw_id"];//hw_id1
	$hwnumber=str_replace("hw_id", "", $hwid);
	$hwname=$_GET["hw_name"];
	$hwstarttime=$_GET["hw_starttime"];
	$hwdeadline=$_GET["hw_deadline"];
	$files_info=$_GET["files_info"];
	$filesarray=json_decode($files_info);
	$numfile=count($filesarray);

	$domtree = new DOMDocument('1.0','UTF-8');
	$xmlRoot = $domtree->createElement("homework");
	$xmlRoot = $domtree->appendChild($xmlRoot);

	$hw_name = $domtree->createElement("hwname","$hwname");
	$hw_name = $xmlRoot->appendChild($hw_name);
	
	$hw_time = $domtree->createElement("hwtime");
	$hw_time = $xmlRoot->appendChild($hw_time);
	$hw_time->appendChild($domtree->createElement("hwstarttime","$hwstarttime"));
	$hw_time->appendChild($domtree->createElement("hwdeadline","$hwdeadline"));

	$files = $domtree->createElement("files");
	$files = $xmlRoot->appendChild($files);

	for($i=0;$i<$numfile;$i++){
		$fileid=$filesarray[$i][0];
		$file_type=$filesarray[$i][1];
		$file_size=$filesarray[$i][2];

		$filenumber=str_replace($hwnumber."file", "", $fileid);
		$filename="file".$filenumber;

		$file = $domtree->createElement($filename);
		$file = $files->appendChild($file);

		$file->appendChild($domtree->createElement("file-type","$file_type"));
		$file->appendChild($domtree->createElement("file-size","$file_size"));
	}

	mkdir("../xml/".$classid);
	$domtree->save("../xml/".$classid."/".$hwid.".xml");
		
	$query_update_class_xml="update class set class_xml='../xml/".$classid."' where class_id='".$classid."'";
	echo $query_update_class_xml;
	$result_update_class_xml=$db->query($query_update_class_xml);

	mkdir("../homework/".$classid,'0777');
	$query_update_class_hw="update class set class_hw='../homework/".$classid."' where class_id='".$classid."'";
	echo $query_update_class_hw;
	$result_update_class_hw=$db->query($query_update_class_hw);

?>