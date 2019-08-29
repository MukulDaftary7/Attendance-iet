<?php 

session_start();
 
if(!isset($_SESSION["userid"]) || !isset($_POST['classdetail']))

  header('Location: index.php');

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
$class = $_POST['classdetail'];
$subject = $_POST['subjectdetail'];

$batch = $_POST['batch'];
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
        
        // end of changes

if($result->num_rows >0)

    { 
      while($row =$result->fetch_assoc())
    
      { 
       $lecture_no= $row["last_lecture_no"];
      
       for($i=1;$i<=$lecture_no;$i++)
      
          {    $l='l'.$i;  
               $dl=$row[$l];
               $sdate[$l]=$dl;
          }
                asort($sdate);
                $session = substr($dl,0,4);  

               
       if(($_POST['relative']==1))
          {   
              $date_val=$_POST['date1'];
              $date_val = array_search($date_val, array_keys($sdate));
              $start=$date_val;
          }
       else{$start=1;}    
      
      
          if($limit>0 && $limit<=$lecture_no)
             { $lecture_no=$limit+$start;
             }
           else
            {$lecture_no= $row["last_lecture_no"];}
      
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

          }
    
    }
  }
    

$col="";
$str_count=0;
foreach($sdate as $key => $x_value) {
 if ($str_count >= $start && $str_count<=$lecture_no)
 {
               $col.="attendance_table.".$key.",";
               
                       $dl=substr($x_value,8,2)."-".substr($x_value,5,2);
               $date.='<td>'.$dl.'<br><b>('.$T_present.')</b>'.'<div class="radio"><input type="radio" id="date" name="date1" value='.$key.'></div></td>';
       
                }
   $str_count++; 
                 }
  $col = substr($col,0,strlen($col)-1);

switch($_POST['view_type'])
{
    case 0:
        if($batch>0)
        $query="SELECT $col,schedule_id,student_id,present_no from attendance_table,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch and student_table.batch=$batch;";
        else
        $query="SELECT $col,schedule_id,student_id,present_no,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch;";
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
                       
                
                                                foreach($sdate as $x => $x_value) {
                                                
                                            
                                                           $li=$x;
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
                                                
                $num="";$count=0;$str_count=0;
                                              foreach($sdate as $x => $x_value) {
                                                        
                                                 if ($str_count >= $start && $str_count<=$lecture_no){


                                                    $li=$x;
                                                
                                                    $num.='<td id="status">'.$row["$li"].'</td>';
                                                    
                                                    if($row["$li"]=="P")
                                                        $count++;
                                            
                                                    }
                                                  $str_count++;  
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

?>

<head><title>View attendance</title>
<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="admin/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="admin/css/fixedColumns.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<style>

    
 th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
   
</style>

<!-- ********************************************test boundar*********************************************************************-->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php include("header.php"); ?>

<script src="admin/js/jquery.dataTables.min.js"></script>
<script src="admin/js/dataTables.buttons.min.js"></script>
<script src="admin/js/buttons.flash.min.js"></script>
<script src="admin/js/jszip.min.js"></script>
<script src="admin/js/pdfmake.min.js"></script>
<script src="admin/js/vfs_fonts.js"></script>
<script src="admin/js/buttons.html5.min.js"></script>
<script src="admin/js/buttons.print.min.js"></script>
<script src="admin/js/dataTables.fixedColumns.min.js"></script>
<script>
$(document).ready(function() {

    var table = $('#scroll').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [ { orderable: false,  width: '20%',targets: [<?php for ($i=2;$i<=($divider+1);$i++){echo $i.',' ;}?>] } ],
        <?php if($divider>6){
        echo"
        fixedColumns:   true,
        fixedColumns:   {
            leftColumns: 2,
            rightColumns: 1
        },";}?>
        responsive: true,
        ordering : true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 
        ],
    } );
    
} );
</script>
<script>
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var per = parseFloat( data[<?php echo $divider+3;?>] ) || 0; // use data for the percentage column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && per <= max ) ||
             ( min <= per   && isNaN( max ) ) ||
             ( min <= per   && per <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#scroll').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
    
</script>
<script>
    function dateCheck(){
        if(!document.edit.date1.value)
        {
            alert("Please select a date");
            return false;
        }
        
        return true;
        
    }
 $( document ).ready(function() {
    $('td.status').each(function( index ) {
          if($( this ).text()== 'A'){
             $(this).css("background-color","#FF6947");
             //$(this).addClass('bg-warning');  
          }
          else if($( this ).text()== 'P'){
             $(this).css("background-color","#66ED44");
             //$(this).addClass('bg-success');
          }
    });
});

//$("#relative").click(function() {
//    location.reload(true);
//});

</script>
<script>
    $(document).ready(
    function(){          
            
            $("#edit").hide();
            $("#relative").hide();
            //$("#pdf").hide();   
            $("#relbox").hide();
            $("#percentage").hide();
            
        $("#test").click(function () {
            $("#edit").toggle();
            $("#relative").toggle();
           // $("#pdf").toggle();   
            $("#relbox").toggle();
            $("#percentage").toggle();
            if($("#test").text()=="Show Features"){$("#test").text("Hide Features");}
             else{$("#test").text("Show Features");}  });
        
         $('html, body').animate({
        scrollTop: $('#tabshow').offset().top
                                 }, 'fast');  
                                 

    });
</script>

<script>
function ajaxrequest() {
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object

  // create pairs index=value with data that must be sent to server
  var  the_data = 'name='+document.getElementById('max').value;
    alert(the_data);
  request.open("POST", './test.php', true);      // set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);    // calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById('sometg').innerHTML = request.responseText;
    }
  }
}</script> 

</head>

<!-- ********************************************test boundary*********************************************************************-->

<body>



<center>


<?php if(!$list=="") { ?>
<br>

<h4>Total Lectures: <?php echo $divider;?></h4>
<div class="row">
<div class="col-md-5"></div>
 
 <br>
<button type="button" class="btn btn-info col-md-2" id="test" data-toggle="collapse" data-target="#demo">Show Features</button>

<p align="right" class="col-md-5">
<?php echo 'Academic Session - '.$session;?>
</p>


</div>
<!--    <button id="sometg" onclick="ajaxrequest()"> sometg</button>-->

<table align="center" border="0" cellspacing="5" cellpadding="5">
        <tbody><!--<tr>
            <td>Percentage>=</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>-->
        <tr id="percentage">
            <td><b>Percentage <=</b></td>
            <td><input class="col-md-12" type="text" id="max" name="max"></td>
         
        </tr>
</tbody>
</table>


<form class="btn-sm" action="edit_panel.php" method="post" name="edit" onsubmit="return dateCheck(this);">
   
<button type="submit" name='relative' id="relative" class="btn btn-primary" value="1" formaction="view.php" >Relative</button>
<input class="col-md-2" type="number" id="relbox" name="limit">    
<p> </p>
<div class="row ">
<div class="col-md-1 ml-auto">
<a href="admin/generate_pdf.php?schedule=<?php echo $S_id;?>">
<input type="button"  id="pdf" name="schedule" style="align-content: left; border: black; "  class="btn btn-warning" value="PDF"></a>
</div>
<div class="col-sm-3 col-md-11 mx-auto"><input type="submit" id="edit" title="First check a button on any date to edit" value="EDIT" class="btn-sm btn-success btn-block" style="float: center; width: 20%;"></div>
<br>
</div>
<!-- self form submission-->
<form  method="post">
<input type="hidden" name="classdetail" value="<?php echo $class;?>">
<input type="hidden" name="subjectdetail" value="<?php echo $subject;?>">
<input type="hidden" name="batch" value="<?php echo $batch;?>">


<!-- self form submission-->
<div id="tabshow">
<div  style="margin-left: 20px;margin-right: 20px;" >  
  <table id="scroll" class="table table-bordered hover stripe row-border order-column">

  <thead class="thead-dark">
   
    <tr>

      <th>Roll No.</th>

      <th>Name</th>

      <?php echo $date;?>

      <th>Present No.</th>

      <th>Percentage</th>

    </tr>  

  </thead>
</form>
</form>
  <tbody id="changeOrder">
<?php echo $list; ?>
  </tbody>

</table>
</section>
</div>
</div>
  <div class="card-block">

    <blockquote class="card-blockquote">

    <div class="col-4">

  </div>

<div class="row">



</div>

</blockquote>



  </div>

</div>

</form>

</div>
<?php } else echo "<br><br><br><br><div class=\"col-xs-12\" style=\"height:200px;\"><h4>No Attendance To Show!!</h4></div>"; ?>

</center>



<?php include("footer.php"); ?>

</body>

</html>

