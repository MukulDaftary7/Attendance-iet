<?php
require '../conn_iet.php';
$delete_type = $_POST['delete_type'];
$msg = "";

if($delete_type == 'faculty') {
	$id = $_POST['id'];
	$res1 = mysqli_query($conn,"delete from faculty_table where id=$id");
	if($res1) {
		$res2 = mysqli_query($conn,"delete from faculty_login_table where id=$id");
		$conf = mysqli_connect('10.82.190.5', 'attendance', 'attendance', 'feedback_system', '3306');
		$feed2 = mysqli_query($conf,"delete from login_table where faculty_id=$id");
		$feed1 = mysqli_query($conf,"delete from faculty_table where id=$id");
		$conm = mysqli_connect('10.82.190.3', 'attendance', 'attendance', 'finaldb', '3306');
		$mark2 = mysqli_query($conm,"delete from login_table where faculty_id=$id");
		$mark1 = mysqli_query($conm,"delete from faculty_table where id=$id");
		$msg = "Data deleted";
	}
	else $msg = "Error! Please try again";
}

if($delete_type == 'subject') {
	$id = $_POST['subject_id'];
	$result = mysqli_query($conn,"delete from subject_table where id=$id");
	if($result) 
		$msg = "Data deleted";
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