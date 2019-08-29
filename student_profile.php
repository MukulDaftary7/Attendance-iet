<?php

session_start();
$list="";
require_once '../conn_iet.php';
if(isset($_POST['enroll']))      #check weather any value exist on post or not
    {
    $enroll=$_POST['enroll'];
    
    $query="SELECT * from student_table where enroll_no='$enroll';";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count==1)
        {
        $result=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $id=$result['id'];
        $query="SELECT * from student_profile where student_id='$id';";
        $result2=mysqli_query($conn,$query);
        $count=mysqli_num_rows($result);
        if($count>0)
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
echo "<table>";
foreach($result as $key => $value){
        echo '<tr><td>'. $key.'</td><td>'.$value.'</td></tr>';
        
}

foreach($result2 as $key => $value){
        echo '<tr><td>'. $key.'</td><td>'.$value.'</td></tr>';
}
echo "</table>";
?>

