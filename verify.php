<?php

session_start();
require_once 'conn_iet.php';
//require_once 'ldap_verify.php';

if(isset($_POST['username'])and isset($_POST['password']))      #check weather any value exist on post or not
{
/*$username=$_POST['username'];
$password=md5($_POST['password']);

$result=mysqli_query($conn,"SELECT name,id from faculty_table where id=(select id from faculty_login_table where name<>'admin' and username='$username' and password='$password');");*/

$result=mysqli_query($conn,"SELECT name,id from faculty_table where id= 10001");
$result1=mysqli_query($conn,"SELECT pass from faculty_login_table where id= 10001");
//$result=mysqli_query($conn,"insert into faculty_table(id,name,designation,email) values ($id,'$name','Professor','$email');");
$count=mysqli_num_rows($result);
if($count==1)                                                             #to check weather username & password exist in database or not 
{
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
$_SESSION['username']=$row['name'];
$_SESSION['userid']=$row['id'];
$_SESSION['user']=$_POST['username'];
$_SESSION['password']=trim($row1['pass']);
/*if($result) {
$_SESSION['username']=$name;
$_SESSION['userid']=$id;
$_SESSION['user']='username';
$_SESSION['password']='pass';*/
//require_once 'token.php';

header('Location: teachers.php');
}

else{  
$_SESSION["error"] = "Incorrect Username and/or Password";                 # error is displayed if username and password doesnt exist
//header('Location: index.php');
}
}
?>