<?php
require '../conn_iet.php';
$msg = '';

$result = mysqli_query($conn,"select id from class_table");
while($row = mysqli_fetch_assoc($result)) {
	$class_id = $row['id'];
	if($_POST['faculty'.$class_id] == '')
		continue;
	$fid = $_POST['faculty'.$class_id];
	$res = mysqli_query($conn,"update class_table set coordinator_id=$fid where id=$class_id");
}

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