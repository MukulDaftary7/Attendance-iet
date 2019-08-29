<?php
/*ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);*/
require '../conn_iet.php';
require 'conn_firebase.php';
$class_id = $_POST['class_id'];
$type = $_POST['upload_type'];
$error=false;
$msg='';
			
if($type=='bulk' && is_uploaded_file($_FILES['file']['tmp_name']))
{
            $batch_roll = $_POST['batch_roll'];
			$batch = 1;
			//open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            while(($line = fgetcsv($csvFile)) !== FALSE){
				if($line[0] == 'Course' || $line[0] == 'Name' || $line[0] == 'Roll_no' || $line[0] == 'Enroll_no' || $line[0] == 'Branch' || $line[0] == 'Semester'
					|| $line[0] == 'Section')
					$flag = false;
				if(!$flag) {
					for($i=0;$i<7;$i++) {
						switch($line[$i]) {
							case 'Name':
								$col[2] = $i;
								break;
							case 'Enroll_no':
								$col[1] = $i;
								break;
							case 'Roll_no':
								$col[0] = $i;
								break;
						}
					}
					$flag = true;
				}
				else {
					if($line[$col[0]] == strtoupper($batch_roll))
						$batch = 2;
					$result = mysqli_query($conn,"insert ignore into student_table (class_id,roll_no,enroll_no,name,batch) values ($class_id,'".$line[$col[0]].
								"','".$line[$col[1]]."','".$line[$col[2]]."',$batch)");
					if($result==false) {
						$error = true;
						break;
					}
					else {
						$res = mysqli_query($conn,"select id from schedule_table where class_id=$class_id");
						if(mysqli_num_rows($res) > 0) {
							$r = mysqli_query($conn,"select id from student_table where roll_no='".$line[$col[0]]."' and name='".$line[$col[2]]."' and batch=$batch");
							$rw = mysqli_fetch_assoc($r);
							$stu_id = $rw['id'];
							while($row = mysqli_fetch_assoc($res)) {
								$sch_id = $row['id'];
								$bat = $row['batch'];
								if($bat == 0 || $bat == $batch)
									$r = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) values ($sch_id,$stu_id)");
							}
						}
					}
					//echo $query.'\n';
				}
			}
}
else if($type=='single') {
	$roll_no = strtoupper($_POST['rollno']);
	$enroll_no = strtoupper($_POST['enrollno']);
	$name = strtoupper($_POST['name']);
	$batch = $_POST['batch_roll_single'];
	$result = mysqli_query($conn,"insert ignore into student_table (class_id,roll_no,enroll_no,name,batch) values ($class_id,'$roll_no','$enroll_no','$name',$batch)");
	if(!$result)
		$error = true;
	else {
		$res = mysqli_query($conn,"select id from schedule_table where class_id=$class_id");
		if(mysqli_num_rows($res) > 0) {
			$r = mysqli_query($conn,"select id from student_table where roll_no='$roll_no' and name='$name' and batch=$batch");
			$rw = mysqli_fetch_assoc($r);
			$stu_id = $rw['id'];
			while($row = mysqli_fetch_assoc($res)) {
				$sch_id = $row['id'];
				$r = mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) values ($sch_id,$stu_id)");
			}
		}
	}
}
else $msg="Error! Please try again";
if($error)
	$msg="Error! Please try again";
else if($msg=='') {
	$msg="Details saved successfully";
	$rs = mysqli_query($conn,"select distinct token from firebase_tokens t,faculty_subject_table s where t.faculty_id=s.faculty_id and s.class_id=$class_id;");
	$tokens = array();
	if(mysqli_num_rows($rs) > 0) {
		while($rw = mysqli_fetch_assoc($rs))
			$tokens[] = $rw['token'];
	}
	$message = array('message'=>'Student list updated. Please sync!!');
	send_notification($tokens,$message);
}
?>


<html>
<head>
<title>Admin</title>
</head>
<body>
<script>
alert("<?php echo $msg; ?>");
window.location.href = "admin_panel.php";
</script>
</body>
</html>


