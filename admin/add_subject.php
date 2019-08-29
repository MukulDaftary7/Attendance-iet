<?php
require '../conn_iet.php';
$course = $_POST['course'];
$branch = $_POST['branch_sub'];
$subject_code = $_POST['subject_code'];
$subject_name = $_POST['subject_name'];
$semester = $_POST['semester'];
$class_type = $_POST['class_type'];

$result = mysqli_query($conn,"insert into subject_table (course,branch,subject_code,subject_name,semester,type) values ('$course','$branch','$subject_code',
			'$subject_name',$semester,$class_type)");
if($result)
	$msg = "Details saved successfully!!";
else $msg = "Error! Please try again";

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