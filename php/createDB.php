<?php
	$servername="localhost";
	$username=$_POST["username"];
	$password=$_POST["password"];
	$success=1;

	//Create connection
	$conn = new mysqli($servername,$username,$password);
	//Check connection
	if($conn->connect_error){
		$success=0;
		die("Connection failed: " . $conn->connect_error);
	}

	//Create database
	$sql_createDB = "create database if not exists collectHW";
	if($conn->query($sql_createDB) == TRUE){
		echo "Database created successfully"."<br>";
	}else{
		echo "Error creating database: " . $conn->error."<br>";
		$success=0;
	}

	$sql_useDB="use collectHW";
	if($conn->query($sql_useDB)==TRUE){
		echo "Use DB successfully.<br>";
	}else{
		$success=0;
		echo "Error use DB: ". $conn->error."<br>";
	}

	//Create table class
	$sql_table_class="create table if not exists class(
		class_id int primary key AUTO_INCREMENT,
		class_name varchar(50),
		class_csv varchar(200),
		class_xml varchar(200),
		class_hw varchar(200),
		class_active int default 1
	)";
	if($conn->query($sql_table_class)==TRUE){
		echo "Table class created successfully.<br>";
	}else {
		$success=0;
		echo "Error creating table class: ".$conn->error."<br>";
	}

	//Create table prof
	$sql_table_prof="create table if not exists prof(
		prof_id int primary key AUTO_INCREMENT,
		email varchar(50) unique not null,
		name  varchar(50) not null,
		password char(60) not null,
		classes_id varchar(200),
		prof_active int default 1
	)";
	if($conn->query($sql_table_prof)==TRUE){
		echo "Table prof created successfully.<br>";
	}else {
		$success=0;
		echo "Error creating table prof: ".$conn->error."<br>";
	}

	//Create table student
	$sql_table_student="create table if not exists student(
		stu_id int primary key AUTO_INCREMENT,
		email varchar(50) unique not null,
		name  varchar(50) not null,
		password char(60) not null,
		classes_id varchar(20),
		stu_actiive int default 1
	)";
	if($conn->query($sql_table_student)==TRUE){
		echo "Table student created successfully.<br>";
	}else {
		$success=0;
		echo "Error creating table student: ".$conn->error."<br>";
	}

	//Create table certification
	$sql_table_certification="create table if not exists certification(
		code_id char(15) primary key,
		student_id int not null,
		hw_path varchar(100) not null
	)";
	if($conn->query($sql_table_certification)==TRUE){
		echo "Table certification created successfully.<br>";
	}else {
		$success=0;
		echo "Error creating table certification: ".$conn->error."<br>";
	}

	
	if($success==1){
		//Create user
		$sql_create_user="create user if not exists admin";
		if($conn->query($sql_create_user)==TRUE){
			echo "User created successfully.<br>";
		}else {
			$success=0;
			echo "Error creating user: ".$conn->error."<br>";
		}

		//Grant priviledges
		$sql_grant_db="grant all on collectHW to 'admin'@'localhost' identified by '123'";
		if($conn->query($sql_grant_db)==TRUE){
			echo "Grant DB priviledges successfully.<br>";
		}else {
			$success=0;
			echo "Error granting DB priviledges: ".$conn->error."<br>";
		}

		//Grant all on collectHW.class
		$sql_grant_class="grant all on collectHW.class to 'admin'@'localhost' identified by '123'";
		if($conn->query($sql_grant_class)==TRUE){
			echo "Grant table class priviledges successfully.<br>";
		}else {
			$success=0;
			echo "Error granting table class priviledges: ".$conn->error."<br>";
		}

		//Grant all on collectHW.prof
		$sql_grant_prof="grant all on collectHW.prof to 'admin'@'localhost' identified by '123'";
		if($conn->query($sql_grant_prof)==TRUE){
			echo "Grant table prof priviledges successfully.<br>";
		}else {
			$success=0;
			echo "Error granting table prof priviledges: ".$conn->error."<br>";
		}

		//Grant all on collectHW.student
		$sql_grant_student="grant all on collectHW.student to 'admin'@'localhost' identified by '123'";
		if($conn->query($sql_grant_student)==TRUE){
			echo "Grant table student priviledges successfully.<br>";
		}else {
			$success=0;
			echo "Error granting table student priviledges: ".$conn->error."<br>";
		}

		//Grant all on collectHW.certification
		$sql_grant_certification="grant all on collectHW.certification to 'admin'@'localhost' identified by '123'";
		if($conn->query($sql_grant_certification)==TRUE){
			echo "Grant table certification priviledges successfully.<br>";
		}else {
			$success=0;
			echo "Error granting table certification priviledges: ".$conn->error."<br>";
		}
	}
	

	$conn->close;
?>