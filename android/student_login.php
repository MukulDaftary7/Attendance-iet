<?php
require "../conn_iet.php";
$enrol = $_POST["enroll_no"];
$mysql_qry1 = "select s.id,roll_no,enroll_no,name,course,branch,year,section from student_table s,class_table c where enroll_no='$enrol' and c.id=class_id;";
$result1 = mysqli_query($conn, $mysql_qry1);
if(mysqli_num_rows($result1) > 0) {
	$array = null;	
	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
		$id = $row1['id'];
		$res = mysqli_query($conn,"select mobile_no,email_id from student_profile where student_id=$id");
		if(mysqli_num_rows($res) > 0) {
			$rw = mysqli_fetch_assoc($res);
			$row1['mobile_no'] = $rw['mobile_no'];
			$row1['email_id'] = $rw['email_id'];
		}
		else {
			$row1['mobile_no'] = 0;
			$row1['email_id'] = '';
		}
		$name = strtolower($row1['enroll_no']).'.jpg';
		$file = @file_get_contents('../student_photos/'.$name);
		if($file === FALSE)
			$row1['photo'] = "";
		else $row1['photo'] = base64_encode($file);
		$student[] = $row1;
		$id = $row1['id'];
	}
	$array[] = $student;
	$mysql_qry2 = "select subject_code,subject_name,h.id,last_lecture_no,present_no from subject_table t,class_table c,student_table s,faculty_subject_table f,schedule_table h,
					attendance_table a where s.id=$id and c.id=s.class_id and s.class_id=f.class_id and f.subject_id=t.id and h.class_id=f.class_id and h.subject_id=f.subject_id 
					and h.batch=0 and a.schedule_id=h.id and a.student_id=s.id;";
	$result2 = mysqli_query($conn, $mysql_qry2);
	if(mysqli_num_rows($result2) > 0) {
		while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
			$theory[] = $row2;
		}
		$array[] = $theory;
	}
	$mysql_qry3 = "select subject_code,subject_name,h.id,last_lecture_no,present_no from subject_table t,class_table c,student_table s,faculty_subject_table f,schedule_table h,
					attendance_table a where s.id=$id and c.id=s.class_id and s.class_id=f.class_id and f.subject_id=t.id and h.class_id=f.class_id and h.subject_id=f.subject_id 
					and h.batch>0 and a.schedule_id=h.id and a.student_id=s.id;";
	$result3 = mysqli_query($conn, $mysql_qry3);
	if(mysqli_num_rows($result3) > 0) {
		while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)) {
			$lab[] = $row3;
		}
		$array[] = $lab;
	}
	header('Content-Type:Application/json');
	echo json_encode($array);
}
else
	echo "Enrollment No. is not valid!!";
?>