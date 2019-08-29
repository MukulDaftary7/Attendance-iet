<?php 
require '../conn_iet.php';
$type = $_POST['type'];
$msg='';

if($type == 'single') {
	$id = $_POST['student_id'];
	$result = mysqli_query($conn,"delete from student_table where id=$id");
	if(!$result)
		$msg = "Error! Please try again";
}


if($type == 'all') {
	$class_id = $_POST['class_id'];
	$result = mysqli_query($conn,"delete from student_table where class_id=$class_id");
	if(!$result)
		$msg = "Error! Please try again";
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