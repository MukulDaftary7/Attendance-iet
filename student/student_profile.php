<?php

session_start();
$list="";
require_once '../conn_iet.php';
if(isset($_POST['enroll']))      #check weather any value exist on post or not
    {
    $enroll=$_POST['enroll'];
    
    $query="SELECT id,enroll_no as 'Enroll no',roll_no as 'Roll no',name as 'Name',batch as'Batch' from student_table where enroll_no='$enroll';";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count==1)
        {
        $result=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $id=$result['id'];
        $rollno=$result['Roll no'];
        $query="SELECT mobile_no as 'Mobile no.',email_id as 'Email ID' from student_profile where student_id='$id';";
        $result2=mysqli_query($conn,$query);
        $count=mysqli_num_rows($result2);
        if($count==1)
            $result2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
        else
            $count=array();
    }
    else
        echo "error";
}
else{  
    $_SESSION["error"] = "Incorrect Username and/or Password";                 # error is displayed if username and password doesnt exist
    header('Location: ../index.php');
}
$enroll= strtolower((string)$enroll);
$file_path="student_photos/".$enroll.".jpg";
if(file_exists($file_path) == 1)
    echo '<img src="student_photos/'.$enroll.'.jpg" width="20%">';
else
   echo '<img src="student_photos/no_image.png" width="20%">';
 
echo "<table>";
foreach($result as $key => $value){
        if($key != 'id')
            echo '<tr><td>'. $key.' : </td><td> '.$value.'</td></tr>';
        
}

foreach($result2 as $key => $value){
        echo '<tr><td>'. $key.' : </td><td> '.$value.'</td></tr>';
}
echo "</table>";
?>

