<?php
require '../conn_iet.php';
$id = $_POST['student_id'];
$sch_id = $_POST['id'];

$result1 = mysqli_query($conn,"select * from schedule_table where id=$sch_id");
if(mysqli_num_rows($result1) > 0) {
	$sch = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	asort($sch);
	$i=1;
	$cols = '';
	foreach($sch as $key=>$value) {
		if($value == null)
			continue;
		if($key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') {
			$sh[$key] = $value;
			continue;
		}
		$sh['l'.$i] = $value;
		$cols .= $key." as 'l".$i."',";
		$i++;
	}
	$array[] = $sh;
	$cols = substr($cols,0,strlen($cols)-1);
	
	$result2 = mysqli_query($conn,"select $cols,present_no from attendance_table where schedule_id=$sch_id and student_id=$id");
	if(mysqli_num_rows($result2) > 0) 
		$array[] = mysqli_fetch_array($result2, MYSQLI_ASSOC);
	header('Content-Type:Application/json');
	echo json_encode($array);
}
else echo "No data found!!";
?>