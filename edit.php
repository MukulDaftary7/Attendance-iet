<?php
session_start();
require_once 'conn_iet.php';
$schedule=$_SESSION['schedule'];
$name=$_POST['present'];
$t=$_SESSION['lecture'];
$result= mysqli_query($conn,"select last_lecture_no from schedule_table where id=$schedule");
if($result->num_rows >0)
{ while($row =$result->fetch_assoc())
  {
     $lln=$row['last_lecture_no'];
  }
}
//echo $lln;
$result=mysqli_query($conn,"select roll_no,$t, present_no from attendance_table join student_table where attendance_table.student_id=student_table.id and schedule_id=$schedule");
if($result->num_rows >0)
{ while($row =$result->fetch_assoc())
  {  
        $roll_no1=$row['roll_no'];
        if($row[$t]==1)
        {
         mysqli_query($conn,"update attendance_table set present_no=present_no-1 where schedule_id=$schedule and attendance_table.student_id=(SELECT id from student_table where roll_no='$roll_no1')");
        }
        
        mysqli_query($conn,"update attendance_table set $t=0 where schedule_id=$schedule and attendance_table.student_id=(select id from student_table where roll_no='$roll_no1')");
       // echo $row['present_no'];
       // mysqli_query($conn,"update $x set present_no=present_no-1 where roll_no='$roll_no1'");
   }
}

foreach ($name as $present)
{
$result=mysqli_query($conn,"update attendance_table set $t=1 where schedule_id=$schedule and attendance_table.student_id=(select id from student_table where roll_no='$present')");          /*add attendance where roll number is present in the column t*/
$result1=mysqli_query($conn,"select present_no from attendance_table where schedule_id=$schedule and attendance_table.student_id=(select id from student_table where roll_no='$present')");
if($result1->num_rows==1)
{
    while($row=$result1->fetch_assoc())
    {
    
          $result2=mysqli_query($conn,"update attendance_table set present_no=present_no+1 where schedule_id=$schedule and attendance_table.student_id=(select id from student_table where roll_no='$present')"); 
  
        
        
    }
}
//$result2=mysqli_query($conn,"update $x set present_no=present_no+2 where roll_no='$present'"); 


/*increment the value of present number*/

}
$date=$_POST['date-input'];
$result3=mysqli_query($conn,"update schedule_table set $t='$date' where id=$schedule");
$result4=mysqli_query($conn,"update schedule_table set last_lecture_date='$date' where id=$schedule and (last_lecture_date<'$date' or last_lecture_date is null)"); #add last lecture date
echo '<script>alert("Attendance updated sucessfully");window.location.replace("attendance.php");</script>';
?>