<?php 
require "../conn_iet.php";
$search = $_POST['search'];
$result = mysqli_query($conn,"SELECT s.id,class_id,course,branch,year,section,roll_no,enroll_no,name,batch FROM student_table s,class_table c WHERE class_id=c.id AND (roll_no LIKE '%$search%' OR name LIKE '%$search%' OR enroll_no LIKE '%$search%')");
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$id = $row['id'];
		$res = mysqli_query($conn,"select mobile_no,email_id from student_profile where student_id=$id");
		if(mysqli_num_rows($res) > 0) {
			$rw = mysqli_fetch_assoc($res);
			$row['mobile_no'] = $rw['mobile_no'];
			$row['email_id'] = $rw['email_id'];
		}
		else {
			$row['mobile_no'] = 0;
			$row['email_id'] = '';
		}
		$name = strtolower($row['enroll_no']).'.jpg';
		$file = @file_get_contents('../student_photos/'.$name);
		if($file === FALSE)
			$row['photo'] = "";
		else $row['photo'] = base64_encode($file);
		$array[] = $row;
	}
	echo json_encode($array);
}
else
	echo 'No students found!!';
?>