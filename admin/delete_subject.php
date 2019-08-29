<?php
require_once '../conn_iet.php';
$class_id = $_POST['class_id'];
$type = $_POST['type'];
$msg='';

if($type == 'all') {
	$result = mysqli_query($conn,"delete from faculty_subject_table where class_id=$class_id");
	if($result) {
		$res = mysqli_query($conn,"delete from schedule_table where class_id=$class_id");
		if(!$res)
			$msg = "Error! Please try again";
	}
	else $msg = "Error! Please try again";
}
if($type == 'single') {
	$subject_id = $_POST['subject_id'];
	$faculty_id = $_POST['faculty_id'];
	$r = mysqli_query($conn,"select faculty_id from faculty_subject_table where class_id=$class_id and subject_id=$subject_id");
	if(mysqli_num_rows($r)>1)
		$multiple = true;
	else $multiple = false;
	$result = mysqli_query($conn,"delete from faculty_subject_table where class_id=$class_id and subject_id=$subject_id and faculty_id=$faculty_id");
	if($result) {
		if(!$multiple) {
		$res = mysqli_query($conn,"delete from schedule_table where class_id=$class_id and subject_id=$subject_id");
		if(!$res)
			$msg = "Error! Please try again";
	}
	}
	else $msg = "Error! Please try again";
}

if($msg=='') 
	$msg="Details saved successfully";

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


