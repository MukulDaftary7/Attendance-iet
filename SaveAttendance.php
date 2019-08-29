<?php

session_start();

require_once 'conn_iet.php';

$x=$_SESSION['schedule'];

$name=$_POST['present'];
$class=$_SESSION['class'];
$batch=$_SESSION['batch'];


//echo $x;

$date = date('Ymd', strtotime($_POST['date-input'])); #convert html date format to php string



$result1=mysqli_query($conn,"select last_lecture_no from schedule_table where id='$x'");

if ($result1->num_rows > 0) {

    while($row = $result1->fetch_assoc()) {

         $y= $row["last_lecture_no"];

         $z=$y+1;                                                                             # increment value of last lecture number so that we know the current number of lectures 

$result3=mysqli_query($conn,"update schedule_table set last_lecture_no=$z where id='$x'");

    }

} else {

    //echo "0 results";

}

$t='l'.$z; # t represents the name of column where attendance is stored

/*if($z>40)

{

$result5=mysqli_query($conn,"ALTER TABLE lecture_schedule_theory ADD $t int(8)"); 

$result6==mysqli_query($conn,"ALTER TABLE $x ADD $t int(8)");

                    if lecture number exceed than 40 then dynamically add column in the table

}*/

if(sizeof($name) == 0) {
    if($batch==0 || $batch==null)
    	$result=mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $x,id from student_table where class_id=$class"); 
    else
	    $result=mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $x,id from student_table where class_id=$class and batch=$batch"); 
}

foreach ($name as $present)

{


//echo $t.' '.$present.' '.$date;
$result = mysqli_query($conn,"select * from attendance_table where schedule_id=$x");
if(mysqli_num_rows($result) == 0) {
    if($batch==0 || $batch==null)
    	$result=mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $x,id from student_table where class_id=$class"); 
    else
	    $result=mysqli_query($conn,"insert ignore into attendance_table (schedule_id,student_id) select $x,id from student_table where class_id=$class and batch=$batch"); 
}
$query=mysqli_query($conn,"update attendance_table set $t=1,present_no=present_no+1 where student_id=$present and schedule_id=$x"); 
	          /*add attendance where roll number is present in the column t*/

}



$result3=mysqli_query($conn,"update schedule_table set $t=$date where id='$x'");# add the date when lecture is taken in lecture schedule at column t

$result4=mysqli_query($conn,"update schedule_table set last_lecture_date='$date' where id='$x' and (last_lecture_date<'$date' or last_lecture_date is null)"); #add last lecture date


//echo $result3."*".$result4;
if($result3==true&&$result4==true)

 $saved="Records Saved Successfully"; #if all queries executed succesfully then success message

else

$saved="Records Not Saved";

?>

<html>

<head>

<title>Save Attendance</title>

</head>

<body>

<script>

alert("<?php echo $saved; ?>");

window.location.href = "attendance.php";

</script>

</body>

</html>