<?php
	$servername="localhost";
	$username=$_POST["username"];
	$password=$_POST["password"];

	//Create connection
	$conn = new mysqli($servername,$username,$password);
	//Check connection
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	//Create database
	$sql_createDB = "create database if not exists collectHW";
	if($conn->query($sql_createDB) == TRUE){
		echo "Database create successfully"."<br>";
	}else{
		echo "Error creating database: " . $conn->error."<br>";
	}

	$sql_useDB="use collectHW";
	if($conn->query($sql_useDB)==TRUE){
		echo "Use DB successfully.<br>";
	}else{
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
		echo "Table class create successfully.<br>";
	}else {
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
		echo "Table prof create successfully.<br>";
	}else {
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
		echo "Table student create successfully.<br>";
	}else {
		echo "Error creating table student: ".$conn->error."<br>";
	}

	//Create table certification
	$sql_table_certification="create table if not exists certification(
		code_id char(15) primary key,
		student_id int not null,
		hw_path varchar(100) not null
	)";
	if($conn->query($sql_table_certification)==TRUE){
		echo "Table certification create successfully.<br>";
	}else {
		echo "Error creating table certification: ".$conn->error."<br>";
	}

	$conn->close;
?>