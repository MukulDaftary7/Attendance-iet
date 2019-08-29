<?php 
session_start(); #if session exist then session error variable will be set to null
require_once 'conn_iet.php';

$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
//echo $ua;
if(!isset($_SESSION["student_id"]))
    {
        if(stripos($ua,'android') != false && isset($_POST['student_id']) && isset($_POST['class_id'])) { 
            
        $sid= $_POST["student_id"];
        $class_id=$_POST['class_id'];
        }
        else
        header('Location:student_login.php');
    }  
else{
    $sid= $_SESSION["student_id"];
    $class_id=$_SESSION['class_id'];
}    


$_SESSION["error"] = "";
$list="";
$per;
$schedule_id;

$result=mysqli_query($conn,"SELECT id,subject_id,batch,id,last_lecture_no from schedule_table where class_id=$class_id and batch=0");

if (($result->num_rows)>0) {

    while($row = $result->fetch_assoc())
          {
              $pre="";
            $lastlec=$row['last_lecture_no']."<br>";
            $schedule=$row['id'];
            $subject_id=$row['subject_id'];
            $batch=$row['batch'];
            $schedule_id=$row['id'];
    
            $pre.="Total Classes: ".$lastlec;
            
             $result1=mysqli_query($conn,"SELECT present_no from attendance_table where schedule_id=$schedule_id and student_id=$sid");
             if (($result1->num_rows)>=1) {
            while($row = $result1->fetch_assoc())
                 {
                 $present_no=$row['present_no'];
                 $pre.="Present no: ".$row['present_no']."<br>";
                 }
                 }
           
             if($lastlec!=0)    
             $percentage=$present_no*100/$lastlec;
             if($lastlec==0)
              $percentage=0;
             $pre.="Percentage:".intval($percentage)."%";
             
             $per=intval($percentage-($percentage%5));

            
                        //echo $subject_id;
$result1=mysqli_query($conn,"SELECT * from subject_table where id=$subject_id");

if (($result1->num_rows)>=1) {
    
    while($row = $result1->fetch_assoc())
          {    if(intval($percentage)<25)
                    {$color="dark";}
                else if(intval($percentage)<50 && intval($percentage)>25)
                    {$color="orange";}
                else if(intval($percentage)>50 && intval($percentage)<75)
                    {$color="blue";}
                else if(intval($percentage)<100 && intval($percentage)>75)
                    {$color="green";}    
              $list.='<div class=" col-xs-3 col-sm-3 col-md-2">
              <div class="inner-content-text-center"><div class="clearfix">

                <div class="c100 p'.$per.' big '.$color.'">
                    <span>'.intval($percentage).'%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <p><b> '.$row['subject_name'].'</b><br>';
            

          }
          }
            $list.=$pre.'</p></div></div><form action="view.php" method="post">';
            if(stripos($ua,'android') != false)
                $list.='<input type="hidden" name="student_id" value="'.$_POST['student_id'].'">';
            $list.='<br><span class="bottomleft"><button type="submit" name="schedule_id" class="btn btn-primary" value="'.$schedule_id.'">View</button></span></form></div>';
            
             
          }
} else {

    $list="<h1>No Subjects Assigned</h1>";
}

?>

<head><title>Teachers panel</title>
<link href="css/circle.css" rel="stylesheet" type="text/css">
<link href="sass/circle.scss" rel="stylesheet" type="text/css">






<style>



	h3{color: #042c4f}


            body{
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .page {
                margin: 40px;
            }

            h1{
                margin: 40px 0 60px 0;
            }

            .dark-area {
                background-color: #666;
                padding: 40px;
                margin: 0 -40px 20px -40px;
                clear: both;
            }

            .clearfix:before,.clearfix:after {content: " "; display: table;}
            .clearfix:after {clear: both;}
            .clearfix {*zoom: 1;}
            .bottomleft {position:absolute; bottom:0;  margin-bottom:7px; left: 100px;} 

.tstyle{
	text-align:center; 
	color:aliceblue;
}

	</style>
</head>

<?php include("header.php"); ?>

<body>



<!--
body{
  background-color: #f0f0f0;
}
<img src="iet.jpg" style="width: 100%;"/>

-->

<br>

<center>

<div class="row col-sm-12">



<?php echo $list;?>


</div>
</center>

<?php include("../footer.php"); ?>
    

</body>

<script>
$(document).ready(function(){
    var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
    if (isAndroid)
    {   $("#navigate").remove();
        $("#footer").remove();
        $("body").css("background-image", "url('../background.png')");
          //$("body").css("background-color", "gray");
    }
});

</script>
</html>
