<?php
/*ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);*/
require "../conn_iet.php";
$attendance_post = $_POST["attendance"];
/*$myfile = fopen("newfile.txt", "w");
fwrite($myfile, $attendance_post);
fclose($myfile);*/
$attendance = json_decode($attendance_post, true);
$edited = true;
for($i=0;$i<sizeof($attendance);$i++) {
	$temp = $attendance[$i];
	$id = $temp['student_id'];
	$l = $temp['lecture_num'];
	$att = $temp['attendance'];
	$sch_id = $temp['id'];
	$mysql_qry1 = "select * from schedule_table where id=$sch_id";
	$result1 = mysqli_query($conn, $mysql_qry1);
	$sch = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	asort($sch);
	$j=1;
	foreach($sch as $key=>$value) {
		if($value == null || $key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') {
			continue;
		}
		if('l'.$j == $l)
			$lec = $key;
		$j++;
	}
	if($att == 0)
		$mysql_qry = "update attendance_table set $lec = 1, present_no = present_no+1 where student_id = $id and schedule_id=$sch_id;";
	else $mysql_qry = "update attendance_table set $lec = 0, present_no = present_no-1 where student_id = $id and schedule_id=$sch_id;";
	if($conn->query($mysql_qry) === TRUE)
		continue;
	else {
		$edited = false;
		break;
	}
}
if($edited)
	echo "Attendance saved";
else echo "Attendance not saved!!";
?>