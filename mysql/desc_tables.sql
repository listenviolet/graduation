+--------------+--------------+------+-----+---------+----------------+
| Field        | Type         | Null | Key | Default | Extra          |
+--------------+--------------+------+-----+---------+----------------+
| class_id     | int(11)      | NO   | PRI | NULL    | auto_increment |
| class_name   | varchar(50)  | YES  |     | NULL    |                |
| class_csv    | varchar(200) | YES  |     | NULL    |                |
| class_xml    | varchar(200) | YES  |     | NULL    |                |
| class_hw     | varchar(200) | YES  |     | NULL    |                |
| class_active | int(11)      | YES  |     | 1       |                |
+--------------+--------------+------+-----+---------+----------------+

+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| prof_id     | int(11)      | NO   | PRI | NULL    | auto_increment |
| email       | varchar(50)  | NO   | UNI | NULL    |                |
| name        | varchar(50)  | NO   |     | NULL    |                |
| password    | varchar(50)  | NO   |     | NULL    |                |
| classes_id  | varchar(200) | YES  |     | NULL    |                |
| prof_active | int(11)      | YES  |     | 1       |                |
+-------------+--------------+------+-----+---------+----------------+

+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| stu_id      | int(11)     | NO   | PRI | NULL    | auto_increment |
| email       | varchar(50) | NO   | UNI | NULL    |                |
| name        | varchar(50) | NO   |     | NULL    |                |
| password    | varchar(50) | NO   |     | NULL    |                |
| classes_id  | varchar(20) | YES  |     | NULL    |                |
| stu_actiive | int(11)     | YES  |     | 1       |                |
+-------------+-------------+------+-----+---------+----------------+

+------------+--------------+------+-----+---------+-------+
| Field      | Type         | Null | Key | Default | Extra |
+------------+--------------+------+-----+---------+-------+
| code_id    | char(15)     | NO   | PRI | NULL    |       |
| student_id | int(11)      | NO   |     | NULL    |       |
| hw_path    | varchar(100) | NO   |     | NULL    |       |
+------------+--------------+------+-----+---------+-------+
