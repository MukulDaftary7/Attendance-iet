<?php
require '../conn_iet.php';
if(isset($_POST['token'])) {
	$token = $_POST['token'];
	$id = $_POST['id'];
	$type = $_POST['type'];
	if($type == 'Faculty')
		$result = mysqli_query($conn,"insert into firebase_tokens values ($id,'$token') on duplicate key update token='$token';");
	else
		$result = mysqli_query($conn,"insert into firebase_tokens_student values ($id,'$token') on duplicate key update token='$token';");
	mysqli_close($conn);
}
?>