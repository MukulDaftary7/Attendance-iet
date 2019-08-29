<?php
require "../conn_iet.php";
require '../admin/conn_firebase.php';
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$message = json_decode($_REQUEST['message'],true);
$error = false;
//echo json_encode($message);

for($i=0;$i<sizeof($message)&&!$error;$i++) {
	$msg = $message[$i];
	$class_id = $msg['class_id'];
	$m = $msg['message'];
	$date = $msg['date'];
	
	if($class_id == 0) {
		$result = mysqli_query($conn,"select class_id from faculty_subject_table where faculty_id=$id;");
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_assoc($result)) {
				$c_id = $row['class_id'];
				$res = mysqli_query($conn,"select token from firebase_tokens_student t,student_table s where t.id=s.id and class_id=$c_id;");
				if(mysqli_num_rows($res)>0) {
					while($rw = mysqli_fetch_assoc($res))
						$tokens[] = $rw['token'];
				}
			}
		}
		else $error = true;
	}
	else {
		$result = mysqli_query($conn,"select token from firebase_tokens_student t,student_table s where t.id=s.id and class_id=$class_id;");
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_assoc($result))
				$tokens[] = $row['token'];
		}
		else $error = true;
	}
	
	$mssg = array('type'=>'broadcast','message'=>$m,'date'=>$date,'name'=>$name);
//	echo json_encode($tokens);
	send_notification($tokens,$mssg);
}
if($error)
	echo 'Message Not Delivered';
else echo 'Message Delivered';
?>