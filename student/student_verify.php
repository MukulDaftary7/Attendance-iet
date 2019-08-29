<?php

session_start();
require_once '../conn_iet.php';
if(isset($_POST['enroll']))      #check weather any value exist on post or not
{
$enroll=$_POST['enroll'];
#$course=$_POST['course'];$branch=$_POST['branch'];$year=$_POST['year'];$section=$_POST['section'];

$result=mysqli_query($conn,"SELECT * from student_table where enroll_no='$enroll'");
$count=mysqli_num_rows($result);
if($count==1)                                                             #to check weather username & password exist in database or not 
{
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$_SESSION['student_id']=$row['id'];
$_SESSION['class_id']=$row['class_id'];
$_SESSION['enroll']=$row['enroll_no'];
$_SESSION['student_name']=$row['name'];

//echo $_SESSION['student_id'];echo $_SESSION['class_id'];echo $_SESSION['enroll'];echo $_SESSION['student_name'];


header('Location: student.php');
}
    else{  
        $_SESSION["error"] = "Incorrect Username and/or Password";                 # error is displayed if username and password doesnt exist
        header('Location: student_login.php');
    }
}
?>