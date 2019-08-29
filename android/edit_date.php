<?php
require '../conn_iet.php';
$id = $_POST['id'];
$lec_num = $_POST['lecture_num'];
$date = $_POST['date'];

$mysql_qry1 = "select * from schedule_table where id=$id";
$result1 = mysqli_query($conn, $mysql_qry1);
if(mysqli_num_rows($result1) > 0) {
	$sch = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	asort($sch);
	$l = 'l'.$lec_num;
	$i = 1;
	foreach($sch as $key=>$value) {
		if($value == null || $key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') {
			continue;
		}
		if($l == 'l'.$i) {
			$lec = $key;
			break;
		}
		$i++;
	}
	$result = mysqli_query($conn,"select last_lecture_date,$lec from schedule_table where id=$id");
	$row = mysqli_fetch_assoc($result);
	if($row[$lec] == $row['last_lecture_date'])
		$result = mysqli_query($conn,"update schedule_table set last_lecture_date='$date',$lec='$date' where id=$id");
	else $result = mysqli_query($conn,"update schedule_table set $lec='$date' where id=$id");

	echo "Date Saved";
} else echo "Error!! Not Saved."
?>