<?php
require '../conn_iet.php';
$edit_type = $_POST['edit_type'];
$msg = "";

if($edit_type == 'faculty') {
	$subject_id = $_POST['subject_id'];
	$class_id = $_POST['class_id'];
	$faculty_id = $_POST['faculty_id'];
	$result = mysqli_query($conn,"update faculty_subject_table set faculty_id=$faculty_id where subject_id=$subject_id and class_id=$class_id");
	if($result)
		$msg = "Data updated";
	else $msg = "Error! Please try again";
}

if($edit_type == 'faculty_details') {
	$id = $_POST['id'];
	$name = $_POST['faculty_name'];
	$branch = $_POST['branch_fac'];
	$designation = $_POST['designation'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$result = mysqli_query($conn,"update faculty_table set name='$name',branch='$branch',designation='$designation',email='$email' where id=$id");
	if($result) {
		$res = mysqli_query($conn,"update faculty_login_table set username='$username',password='$password' where id=$id");
		if($res)
			$msg = "Data updated";
		else $msg = "Error! Please try again";
	}
	else $msg = "Error! Please try again";
}

if($edit_type == 'subject') {
	$id = $_POST['id'];
	$course = $_POST['course'];
	$subject_code = $_POST['subject_code'];
	$branch = $_POST['branch_sub'];
	$subject_name = $_POST['subject_name'];
	$semester = $_POST['semester'];
	$type = $_POST['class_type'];
	$result = mysqli_query($conn,"update subject_table set course='$course',branch='$branch',subject_code='$subject_code',subject_name='$subject_name',
				semester=$semester,type=$type where id=$id");
	if($result)
		$msg = "Data updated";
	else $msg = "Error! Please try again";
}

if($edit_type == 'student') {
	$id = $_POST['id'];
	$roll_no = $_POST['rollno'];
	$enroll_no = $_POST['enrollno'];
	$name = $_POST['name'];
	$batch = $_POST['batch'];
	$result = mysqli_query($conn,"update student_table set roll_no='$roll_no',enroll_no='$enroll_no',name='$name',batch=$batch where id=$id");
	if($result)
		$msg = "Data updated";
	else $msg = "Error! Please try again";
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