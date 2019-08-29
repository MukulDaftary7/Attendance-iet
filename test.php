<?php 

session_start();
 


require_once 'conn_iet.php';


/*if( isset($_COOKIE["classdetail"])&&isset($_COOKIE["subjectdetail"]))
{
 $class=$_COOKIE["classdetail"];
 $subject=$_COOKIE["subjectdetail"];
}
else{
$class = $_POST['classdetail'];
$subject = $_POST['subjectdetail'];
 setcookie("classdetail", $class, time()+3600);
 setcookie("subjectdetail", $subject, time()+3600);
}*/
$class = 6;
$subject = 254;

$batch = 0;
$_SESSION["batch"]=$batch;
$limit=$_POST['limit'];
$session="";




$result=mysqli_query($conn,"select id from schedule_table where class_id=$class and subject_id=$subject and batch=$batch");



$count=mysqli_num_rows($result);

        if($count==1)                                               
        
        {
        
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        
         $_SESSION['schedule']=$row['id'];
        $S_id=$row['id'];
        
        
        }





$result=mysqli_query($conn,"SELECT * FROM schedule_table WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch;");

        //setting up relative date
        if(($_POST['relative']==1))
        {   $date_val=$_POST['date1'];
            $date_val = preg_replace('/\D/', '', $date_val);
            $start=$date_val;
        }
        else{$start=1;}
        // end of changes

if($result->num_rows >0)

{ while($row =$result->fetch_assoc())

  {  $lecture_no= $row["last_lecture_no"];

    if($limit>0 && $limit<=$lecture_no)
        $lecture_no=$limit+$start;
     else
      $lecture_no= $row["last_lecture_no"];

     $date="";

    // $_SESSION['class_name'] = $row['id'];     

for($i=$start;$i<=$lecture_no;$i++)

    {

     $l='l'.$i;
    $P_Query=mysqli_query($conn,"SELECT COUNT($l) as Pno FROM attendance_table WHERE $l=1 AND schedule_id=$S_id;");
    
    if ($P_Query->num_rows==1)
    {

    while($val = $P_Query->fetch_assoc()) 
        {
        $T_present=$val["Pno"];
        }
    }
    


     $dl=$row[$l];
       $sdate[$l]=$dl;
       asort($sdate);
          $session = substr($dl,0,4);
           $dl=substr($dl,8,2)."-".substr($dl,5,2);

    $date.='<td>'.$dl.'<br><b>('.$T_present.')</b>'.'<div class="radio"><input type="radio" id="date" name="date1" value='.$l.'></div></td>';

 
   


    }

}

}

switch($_POST['view_type'])
{
    case 0:
        if($batch>0)
        $query="SELECT attendance_table.*,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch and student_table.batch=$batch;";
        else
        $query="SELECT attendance_table.*,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch;";
    break;  
}    

$result=mysqli_query($conn,$query);
if($_POST['less_than'])
{
    echo $_POST['less_than'];
}

$list="";



if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {
                       
                
                                                for($i=1;$i<=45;$i++) { 
                                                
                                                    $li='l'.$i;   
                                                
                                                        if($row["$li"]==1)
                                                
                                                            { $row["$li"]='P';}
                                                
                                                        elseif($row["$li"]==0)
                                                
                                                            { $row["$li"]='A';}
                                                
                                                }
                
                
                
                                                if($row["present_no"]==NULL)
                                                
                                                {   $n=1;
                                                
                                                    $m=0;}
                                                
                                                else $m=$lecture_no;
                                                
                                                                                
                                                //setting up division factor
                                                if($_POST['relative']==1)
                                                {
                                                   $divider=$lecture_no-$start+1;
                                                }
                                                else{   $divider=$lecture_no;}
                                                //end of changes
                                                
                $num="";$count=0;
                
                                                for($i=$start;$i<=$m;$i++)
                                                
                                                {
                                                
                                                    $l='l'.$i;
                                                
                                                    $num.='<td id="status">'.$row["$l"].'</td>';
                                                    
                                                    if($row["$l"]=="P")
                                                        $count++;
                                            
                                    
                                                }
                $row["present_no"]=$count;
                $count=0;
                
                      $list.='<tr>
                      <td>'.$row["roll_no"].'</td>
                      <td>'.$row["name"].'</td>'.$num
                
                      .' <td>'.$row["present_no"].'</td>
                
                        <td>'.(int)($row["present_no"]*100/$divider).'%</td>
                
                     
                
                    </tr>';
                
                  
                
                
                
                        }

}



else {

    //echo "0 results";

}


foreach($sdate as $x => $x_value) {
   echo "<br>Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
    $date.='<td>'.$x_value.'<br><b>('.$T_present.')</b>'.'<div class="radio"><input type="radio" id="date" name="date1" value='.$x.'></div></td>';
    
    
        if($batch>0)
        $query="SELECT attendance_table.$x,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch and student_table.batch=$batch;";
        $result=mysqli_query($conn,$query);


$list="";

if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
                       echo '<td>'.$row["$x"].'</td>';
                                      }
}
}


?>



