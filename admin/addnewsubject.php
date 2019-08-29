<?php
require_once '../conn_iet.php';
//require 'conn_firebase.php';
$class_id = $_POST['class_id'];
$msg='';
//$tokens = array();

for($i=1;$i<=8;$i++) {
	$faculty_id = $_POST['faculty_id'.$i];
	$subject_id = $_POST['subject_id'.$i];

	if($faculty_id == 'Select Faculty' && $subject_id == 'Select Subject')
		continue;

	$res = mysqli_query($conn,"select type from subject_table where id=$subject_id");
	$rw = mysqli_fetch_assoc($res);

	$result=mysqli_query($conn,"insert ignore into faculty_subject_table values ($faculty_id,$subject_id,$class_id)");
	if($result==false) {
	   $msg="Error! Please try again";
	   break;
	}

	$r=mysqli_query($conn,"select id from schedule_table where class_id=$class_id and subject_id=$subject_id");
	if(mysqli_num_rows($r) == 0) {

	if($rw['type'] == 0 || $rw['type'] == 2) {
		$result=mysqli_query($conn,"insert ignore into schedule_table(class_id,subject_id,batch) values($class_id,$subject_id,0)");
		if($result==false) {
		   $msg="Error! Please try again";
		   break;
		}
	}

	if($rw['type'] == 1 || $rw['type'] == 2) {
		$result=mysqli_query($conn,"insert ignore into schedule_table(class_id,subject_id,batch) values($class_id,$subject_id,1)");
		$result1=mysqli_query($conn,"insert ignore into schedule_table(class_id,subject_id,batch) values($class_id,$subject_id,2)");
		if($result==false || $result1==false) {
		   $msg="Error! Please try again";
		   break;
		}
	}
	/*$rs = mysqli_query($conn,"select token from firebase_tokens where faculty_id=$faculty_id;");
	if(mysqli_num_rows($rs) > 0) {
		while($rw = mysqli_fetch_assoc($rs))
			$tokens[] = $rw['token'];
	}*/
}
}

if($msg=='') {
	$msg="Details saved successfully";
	/*$message = array('message'=>'New subjects are assigned. Please sync!!');
	send_notification($tokens,$message);*/
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