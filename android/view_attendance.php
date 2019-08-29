<?php
/*ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);*/
require "../conn_iet.php";
$class_type = $_POST["type"];
if($class_type == 'theory')
	$id = $_POST["id"];
else {
	$id1 = $_POST['id1'];
	$id2 = $_POST['id2'];
}

if($class_type == 'theory')
	$mysql_qry1 = "select * from schedule_table where id=$id";
else {
	$mysql_qry1 = "select * from schedule_table where id = $id1";
	$mysql_qry12 = "select * from schedule_table where id = $id2";
}
$result1 = mysqli_query($conn, $mysql_qry1);
if(mysqli_num_rows($result1) > 0) {
	$sch[] = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	asort($sch[0]);
	$i=1;
	$cols = '';
	foreach($sch[0] as $key=>$value) {
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
	$array[] = array($sh);
	$cols = substr($cols,0,strlen($cols)-1);
	if($class_type == 'lab') {
		$result12 = mysqli_query($conn, $mysql_qry12);
		$sch[] = mysqli_fetch_array($result12, MYSQLI_ASSOC);
		asort($sch[1]);
		$i=1;
		$cols1 = '';
		$sh = null;
		foreach($sch[1] as $key=>$value) {
			if($value == null)
				continue;
			if($key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') {
				$sh[$key] = $value;
				continue;
			}
			$sh['l'.$i] = $value;
			$cols1 .= $key." as 'l".$i."',";
			$i++;
		}
		$temp[] = $array[0][0];
		$temp[] = $sh;
		$array = null;
		$array[] = $temp;
		$cols1 = substr($cols1,0,strlen($cols1)-1);
	}
	if($class_type == 'theory') {
		$mysql_qry2 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id=$id and id=student_id order by roll_no";
		$result2 = mysqli_query($conn, $mysql_qry2);
		if(mysqli_num_rows($result2) > 0) {
			while($row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
				$normal[] = $row1;
			$array[] = $normal;
			$mysql_qry3 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id=$id and id=student_id order by present_no,roll_no";
			$result3 = mysqli_query($conn, $mysql_qry3);
			while($row2 = mysqli_fetch_array($result3, MYSQLI_ASSOC))
				$ascend[] = $row2;
			$array[] = $ascend;
			$mysql_qry4 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id=$id and id=student_id order by present_no desc,roll_no";
			$result4 = mysqli_query($conn, $mysql_qry4);
			while($row3 = mysqli_fetch_array($result4, MYSQLI_ASSOC))
				$descend[] = $row3;
			$array[] = $descend;
		}
	}
	else {
		$mysql_qry21 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id = $id1 and id=student_id order by roll_no";
		$mysql_qry22 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols1 from attendance_table,student_table where schedule_id = $id2 and id=student_id order by roll_no";
		$result21 = mysqli_query($conn, $mysql_qry21);
		$result22 = mysqli_query($conn, $mysql_qry22);
		if(mysqli_num_rows($result21) > 0 || mysqli_num_rows($result22) > 0) {
			while($row1 = mysqli_fetch_array($result21, MYSQLI_ASSOC))
				$normal[] = $row1;
			while($row1 = mysqli_fetch_array($result22, MYSQLI_ASSOC))
				$normal[] = $row1;
			$array[] = $normal;
			$mysql_qry31 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id = $id1 and id=student_id order by present_no,roll_no";
			$mysql_qry32 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols1 from attendance_table,student_table where schedule_id = $id2 and id=student_id order by present_no,roll_no";
			$result31 = mysqli_query($conn, $mysql_qry31);
			$result32 = mysqli_query($conn, $mysql_qry32);
			while($row2 = mysqli_fetch_array($result31, MYSQLI_ASSOC))
				$ascend[] = $row2;
			while($row2 = mysqli_fetch_array($result32, MYSQLI_ASSOC))
				$ascend[] = $row2;
			$array[] = $ascend;
			$mysql_qry41 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols from attendance_table,student_table where schedule_id = $id1 and id=student_id order by present_no desc,roll_no";
			$mysql_qry42 = "select id,roll_no,name,batch,schedule_id,student_id,present_no,$cols1 from attendance_table,student_table where schedule_id = $id2 and id=student_id order by present_no desc,roll_no";
			$result41 = mysqli_query($conn, $mysql_qry41);
			$result42 = mysqli_query($conn, $mysql_qry42);
			while($row3 = mysqli_fetch_array($result41, MYSQLI_ASSOC))
				$descend[] = $row3;
			while($row3 = mysqli_fetch_array($result42, MYSQLI_ASSOC))
				$descend[] = $row3;
			$array[] = $descend;
		}
	}
	header('Content-Type:Application/json');
	echo json_encode($array);
	//else echo "No data found!!";
}
else echo "No data found!!";
?>