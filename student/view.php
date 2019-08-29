<?php 
session_start(); #if session exist then session error variable will be set to null
require_once '../conn_iet.php';
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(!isset($_SESSION["student_id"]))
    {
        if(stripos($ua,'android') != false && isset($_POST['student_id'])) { 
        $sid= $_POST["student_id"];
        }
        else
        header('Location:index.php');
    }  
else{
    $sid= $_SESSION["student_id"];
}    
$list="";
$lln;
$pno;
$schedule=$_POST['schedule_id'];



$result=mysqli_query($conn,"SELECT * from attendance_table where student_id=$sid and schedule_id=$schedule");


                $result1=mysqli_query($conn,"SELECT last_lecture_no from schedule_table where id=$schedule");
                if (($result1->num_rows)==1) {
             while($row1 = $result1->fetch_assoc())
              {
                  $lln=$row1["last_lecture_no"];
              }
                }
                
$pen=0;
//$headval=' <th>LECTURE DATE</th><th>ATTENDANCE</th><th>LECTURE DATE</th><th>ATTENDANCE</th>'.$headval; 
if (($result->num_rows)==1) {

    while($row = $result->fetch_assoc())
          {
            $pno= $row['present_no'];
            for($i=1;$i<=$lln;$i++)
            {
                $l="l".$i;
                
                
                
                $preabs;
                if($row["$l"]==0)
                  {$preabs='Absent'; $class="bg-warning";}
                else if($row["$l"]==1)
                {$preabs='Present';$class="bg-success";}
                
                $result1=mysqli_query($conn,"SELECT $l,last_lecture_no from schedule_table where id=$schedule");
               

                if (($result1->num_rows)==1) {
             while($row1 = $result1->fetch_assoc())
              {
                  $date=$row1["$l"];
                  $date = strtotime( $date );
                  $date = date( 'd-m-Y', $date );
                  $lln=$row1["last_lecture_no"];
              }
              }
              
         $list.='<tr>
      <td class="mobile">'.$date.'</td>
      <td class="'.$class.'">'.$preabs.'</td>
        </tr>';
    
    $pen++;

        if($pen==1){
            $list1.=$list;

            $list="";
                                
            }  
        else if($pen==2){
            $list2.=$list;

            $list="";

            $pen=0;
            
            }
        }
            
    if($pen>0) {
            $list1.=$list;
     }
                         
           
    }
}
            
?>

<head><title>Teachers panel</title>


<style>

body{
  background-color: #f0f0f0;
  background-repeat: no-repeat;
  background-attachment: fixed;
}

h3{color: #042c4f}
	
.table td {
   text-align: center;   
}

.table th {
   text-align: center;   
}
	</style>
</head>
<?php include("header.php"); ?>

<body>



<br>

<center>


<?php if ($lln != 0 && $lln != null) {?>
    <div class="col-sm-12" id="stats">
      present no : <?php echo $pno; ?><br>
      total lectures : <?php echo $lln; ?><br>
      percentage : <?php echo intval($pno*100/$lln); ?>%<br>
    </div>

<div class="row">    
    <div class="col-md-6" style="padding:0px">
        <table class="table table-striped  ">
          <thead class="thead-inverse">
            <tr>
                <th>Lecture Date</th>
                <th>Attendance</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $list1; ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6" style="padding:0px">
        <table class="table table-striped ">
          <thead class="thead-inverse">
            <tr>
                <th>Lecture Date</th>
                <th>Attendance</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $list2; ?>
            </tbody>
        </table>
    </div>
<?php } else {?>
<h1 class="col-md-12" style="height:300px;"><p  align="center"> No attendance to show !</p><h1>

<?php }?>
</div>

</center>

<?php include("../footer.php"); ?>
    

</body>
<script>
$(document).ready(function(){
    var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
    if (isAndroid)
    {   $("#navigate").remove();
        $("#stats").remove();
        $("#footer").remove();
        $("body").css("background-image", "url('../background.png')");
          //$("body").css("background-color", "gray");
    }
});

</script>
</html>