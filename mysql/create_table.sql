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
	email varchar(50) not null,
	name  varchar(50) not null,
	password varchar(50) not null,
	classes_id varchar(200),
	prof_active int default 1
);

insert into prof(email,name,password) values
 ("1479536064@qq.com","Sara","123");

create table student(
	stu_id int primary key AUTO_INCREMENT,
	email varchar(50) not null,
	name  varchar(50) not null,
	password varchar(50) not null,
	classes_id varchar(20),
	stu_actiive int default 1
);

insert into student(email,name,password) values
 ("listenviolet@163.com","Sally","123");

insert into student(email,name,password) values
 ("listenviolet@gmail.com","Violet","123");


drop table class;
drop table prof;
drop table student;
drop table certification;

grant all on uploadhw.prof to 'admin'@'localhost';

grant all on uploadhwv1.prof to 'adminv1'@'localhost';
grant all on uploadhwv1.class to 'adminv1'@'localhost';
grant all on uploadhwv1.student to 'adminv1'@'localhost';

grant all on uploadhwv3.prof to 'adminv1'@'localhost';
grant all on uploadhwv3.class to 'adminv1'@'localhost';
grant all on uploadhwv3.student to 'adminv1'@'localhost';

create table certification(
	code_id char(15) primary key,
	student_id int not null,
	hw_path varchar(100) not null
)

mysql -uroot -p;
mysql -uadminv1 -p;
use uploadhwv3;

----------------uploadhwv4------------
////////////////////////////////////////////////

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


insert into prof(email,name,password) values
 ("1479536064@qq.com","Sara","123");

create table student(
	stu_id int primary key AUTO_INCREMENT,
	email varchar(50) unique not null,
	name  varchar(50) not null,
	password char(60) not null,
	classes_id varchar(20),
	stu_actiive int default 1
);

drop table class;
drop table prof;
drop table student;
drop table certification;

grant all on uploadhw.prof to 'admin'@'localhost';

grant all on uploadhwv1.prof to 'adminv1'@'localhost';
grant all on uploadhwv1.class to 'adminv1'@'localhost';
grant all on uploadhwv1.student to 'adminv1'@'localhost';

grant all on uploadhwv4.prof to 'adminv1'@'localhost';
grant all on uploadhwv4.class to 'adminv1'@'localhost';
grant all on uploadhwv4.student to 'adminv1'@'localhost';
grant all on uploadhwv4.certification to 'adminv1'@'localhost';

create table certification(
	code_id char(15) primary key,
	student_id int not null,
	hw_path varchar(100) not null
);

mysql -uroot -p;
mysql -uadminv1 -p;