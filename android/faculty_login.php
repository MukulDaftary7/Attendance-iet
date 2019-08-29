<?php
require "../conn_iet.php";
require_once '../ldap_verify.php';
/*$username = $_POST["username"];
$password = md5($_POST["password"]);*/
$mysql_qry1 = "select f.id,name,branch,designation from faculty_table f,faculty_login_table l where f.id=l.id and f.id=$id;";
$result1 = mysqli_query($conn, $mysql_qry1);
if(mysqli_num_rows($result1) > 0) {
	$array = null;
	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
		$faculty[] = $row1;
		//$id = $row1['id'];
	}
	$mysql_qry2 = "select f.class_id,c.course,c.branch,year,section,f.subject_id,subject_code,subject_name,type,h.id,last_lecture_date from faculty_subject_table f,class_table c,subject_table s,
					schedule_table h where f.faculty_id=$id and f.class_id=c.id and f.subject_id=s.id and f.class_id=h.class_id and f.subject_id=h.subject_id;";
	$result2 = mysqli_query($conn, $mysql_qry2);
	$array[] = $faculty;
	if(mysqli_num_rows($result2) > 0) {
		$count = 0;
		while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                        $student = null;
			$classes[] = $row2;
			if($count < $row2['type']) {
				$count++;
				continue;
			}
			else $count = 0;
			$class_id = $row2['class_id'];
			$mysql_qry3 = "select id,roll_no,name,batch from student_table where class_id=$class_id order by roll_no;";
			$result3 = mysqli_query($conn, $mysql_qry3);
			while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC))
				$student[] = $row3;
			//if($temp == null)
			if($student == null)
				$array[] = $classes;
			else $array[] = array_merge($classes,$student);
			$classes = null;
			//else $temp = array($temp,array_merge($classes,$student));
		}
		//$array = array($faculty,$temp);
	}
	header('Content-Type:Application/json');
	echo json_encode($array);
}
else
	echo "Incorrect username or password!!";
?>
