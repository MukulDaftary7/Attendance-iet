<?php 
require "../conn_iet.php";
$id = $_POST['id'];
$mobile_no = $_POST['mobile_no'];
$email_id = $_POST['email_id'];
$photo = $_POST['photo'];

$result = mysqli_query($conn,"select enroll_no from student_table where id=$id");
$row = mysqli_fetch_assoc($result);
$enroll_no = strtolower($row['enroll_no']);

$name = $enroll_no.'.jpg';
if(strlen($photo) > 0) {
	$file = @fopen('../student_photos/'.$name,'wb');
	$decode = base64_decode($photo);
	$write = fwrite($file,$decode);
	fclose($file);
} 
else {
	@unlink('../student_photos/'.$name);
	$write = true;
}

if($write)
{
	$result = mysqli_query($conn,"insert into student_profile values ($id,$mobile_no,'$email_id') on duplicate key update mobile_no=$mobile_no,email_id='$email_id'");
	if($result)
		echo 'Profile Updated!!';
	else echo 'Unable to update!! Please try again.';
}
else echo 'Unable to update!! Please try again.';
?>