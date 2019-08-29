<?php

session_start();
require_once '../conn_iet.php';
if(isset($_POST['username'])and isset($_POST['password']))      #check weather any value exist on post or not
{
$username=$_POST['username'];
$password=$_POST['password'];

$_SESSION['username']=$_POST['username'];
$_SESSION['password']=$_POST['password'];

$result=mysqli_query($conn,"select f.id from faculty_table f,faculty_login_table l where f.id=l.id and name='admin' and username='$username' and password='$password'");
$count=mysqli_num_rows($result);
if($count==1)                                                             #to check weather username & password exist in database or not 
{
$_SESSION['adminid']='admin';
header('Location: admin_all.php');
}
else{  
$_SESSION["error"] = "Incorrect Username and/or Password";                 # error is displayed if username and password doesnt exist
header('Location: admin.php');
}
}
else{                 # error is displayed if username and password doesnt exist
header('Location: admin.php');
}
?>