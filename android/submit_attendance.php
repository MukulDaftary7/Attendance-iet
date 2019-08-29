<?php
require "../conn_iet.php";
$attendance = $_POST["attendance"];
$pending = $_POST['pending_total'];
$roll_attend = json_decode($attendance,true);
if($pending == 1)
	$flag = false;
else $flag = true;

for($j=0;$j<sizeof($roll_attend);$j++) {
	if($flag)
		$class_t = $roll_attend[$j][0];
	else $class_t = $roll_attend[$j]; 
	$id = $class_t['id'];
	$date = $class_t['date'];
	
	$result = mysqli_query($conn,"select last_lecture_no,last_lecture_date from schedule_table where id=$id");
	$row = mysqli_fetch_assoc($result);
	$last = $row['last_lecture_no'];
	$last = $last+1;
	$l = 'l'.$last;
	if($date > $row['last_lecture_date'])
		$result = mysqli_query($conn,"update schedule_table set last_lecture_date='$date',last_lecture_no=last_lecture_no+1,$l='$date' where id=$id");
	else $result = mysqli_query($conn,"update schedule_table set last_lecture_no=last_lecture_no+1,$l='$date' where id=$id");
		
	$result = mysqli_query($conn,"select * from attendance_table where schedule_id=$id");
	if(mysqli_num_rows($result) == 0) {
		$res = mysqli_query($conn,"select class_id,batch from schedule_table where id=$id");
		$row = mysqli_fetch_assoc($res);
		$class_id = $row['class_id'];
		$batch = $row['batch'];
		if($batch == 0)
			$result = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $id,id from student_table where 
									class_id=$class_id");
		else $result = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $id,id from student_table where 
									class_id=$class_id and batch=$batch");
	}
	
	if($flag)
		for($i=1;$i<sizeof($roll_attend[$j]);$i++) {
			$s = $roll_attend[$j][$i];
			attendance($conn,$s,$id,$l);
		}
	else {
		$j++;
		while($j<sizeof($roll_attend)) {
			$s = $roll_attend[$j];
			attendance($conn,$s,$id,$l);
			$j++;
		}
	}
}

function attendance($conn,$s,$sch_id,$l) {
		$stu_id = $s['student_id'];
		$result = mysqli_query($conn,"select * from attendance_table where schedule_id=$sch_id and student_id=$stu_id");
		if(mysqli_num_rows($result) == 0) {
			$res = mysqli_query($conn,"select class_id from schedule_table where id=$sch_id");
			$row = mysqli_fetch_assoc($res);
			$class_id = $row['class_id'];
			$batch = $row['batch'];
			if($batch == 0)
				$result = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $id,id from student_table where 
										class_id=$class_id and id=$stu_id");
			else $result = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $id,id from student_table where 
										class_id=$class_id and batch=$batch and id=$stu_id");
		}
		$result = mysqli_query($conn,"update attendance_table set present_no=present_no+1,$l=1 where schedule_id=$sch_id and student_id=$stu_id");
}

echo "Attendance submitted";
?>