<?php
require '../conn_iet.php';
$error = false;
$msg = '';

$result = mysqli_query($conn,"select id from class_table");
while($row = mysqli_fetch_assoc($result)) {
	$class_id = $row['id'];
	if($_POST['roll'.$class_id] == '')
		continue;
	$res = mysqli_query($conn,"select roll_no from student_table where class_id=$class_id order by roll_no");
	if(mysqli_num_rows($res) > 0) {
		$batch = 1;
		while($rw = mysqli_fetch_assoc($res)) {
			$roll_no = $rw['roll_no'];
			if($roll_no == strtoupper($_POST['roll'.$class_id]))
				$batch = 2;
			$r = mysqli_query($conn,"update student_table set batch=$batch where roll_no='$roll_no'");
			if(!$r) {
				$error = true;
				break;
			}
		}
	}
	else continue;
	if($error)
		break;
}

if($error)
	$msg="Error! Please try again";
else $msg="Details saved successfully";
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