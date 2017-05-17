drop table class;
drop table prof;
drop table student;
drop table certification;

create table class(
	class_id int primary key AUTO_INCREMENT,
	class_name varchar(50),
	class_csv varchar(200),
	class_xml varchar(200),
	class_hw varchar(200),
	class_active int default 1
);

create table prof(
	prof_id int primary key AUTO_INCREMENT,
	email varchar(50) unique not null,
	name  varchar(50) not null,
	password char(60) not null,
	classes_id varchar(200),
	prof_active int default 1
);

create table student(
	stu_id int primary key AUTO_INCREMENT,
	email varchar(50) unique not null,
	name  varchar(50) not null,
	password char(60) not null,
	classes_id varchar(20),
	stu_actiive int default 1
);

create table certification(
	code_id char(15) primary key,
	student_id int not null,
	hw_path varchar(100) not null
);