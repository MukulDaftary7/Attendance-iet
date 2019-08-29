
<?php 
session_start();

if(!isset($_SESSION["userid"]))

	header('Location: index.php');

require_once 'conn_iet.php';

$userid=$_SESSION['userid'];
$domain_name="Attendance System";
$r = mysqli_query($conn,"select * from class_table where coordinator_id=$userid");
if(mysqli_num_rows($r) > 0)
	$coordinator = true;
else $coordinator = false;

$x=$_SESSION['username'];
$list="";  
$listlab="";
$list1lab="";
$list2lab="";
$list1="";
$list2="";




$result=mysqli_query($conn,"SELECT class_table.id,class_table.course,class_table.section,class_table.branch,class_table.year,class_table.section,subject_table.subject_code,subject_table.subject_name,subject_table.id as id1 FROM faculty_subject_table INNER JOIN subject_table ON subject_table.id=faculty_subject_table.subject_id INNER JOIN class_table ON class_table.id=faculty_subject_table.class_id WHERE faculty_subject_table.faculty_id=$userid and subject_table.type in(0,2)");



/* it contains 3 nested queries the inner most query will fetch id of the faculty where username exist in session

then the mid query will fetch subject code from faculty subject table on the basis of id then it 

the outer most query uses subject code to find all the details from attendance lookup table*/







if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

         $list.='<option value='.$row["id"].'>'.$row["course"]." ".$row["branch"]." ".$row["year"]." ".$row["section"].'</option>';

         $list1.='<option value='.$row["id1"].'>'.$row["subject_code"]." ".$row["subject_name"].'</option>';
          $list2.='<option value='.$row["id"].'>'.$row["id1"].'</option>';

    }/*this piece of code will display details of all the classes of that teacher the while loop will append all the classes in option element while its value will be table code*/

} else {

    //echo "0 results";

}

/*same functionality from above will be used for lab portion*/





$result=mysqli_query($conn,"SELECT class_table.id,class_table.course,class_table.section,class_table.branch,class_table.year,class_table.section,subject_table.subject_code,subject_table.subject_name,subject_table.id as id1 FROM faculty_subject_table INNER JOIN subject_table ON subject_table.id=faculty_subject_table.subject_id INNER JOIN class_table ON class_table.id=faculty_subject_table.class_id WHERE faculty_subject_table.faculty_id=$userid and subject_table.type in(1,2)");



/* it contains 3 nested queries the inner most query will fetch id of the faculty where username exist in session

then the mid query will fetch subject code from faculty subject table on the basis of id then it 

the outer most query uses subject code to find all the details from attendance lookup table*/



if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

         $listlab.='<option value='.$row["id"].'>'.$row["course"]." ".$row["branch"]." ".$row["year"]." ".$row["section"].'</option>';

         $list1lab.='<option value='.$row["id1"].'>'.$row["subject_code"]." ".$row["subject_name"].'</option>';
          $list2lab.='<option value='.$row["id"].'>'.$row["id1"].'</option>';

    }/*this piece of code will display details of all the classes of that teacher the while loop will append all the classes in option element while its value will be table code*/

} else {

    //echo "0 results";

}



?>

<?php include("header.php"); ?>

<head><title>Attendance</title>
<style type="text/css">
  @media screen and (min-width: 768px){
   .rwd-break { display: none; }
}
</style>
</head>






<script type="text/javascript">
function SetSubTh() {
  var subject=document.getElementById("subjectdetailth");
  var hidden_sub=document.getElementById("hidden_subth");
  var hidden=document.getElementById("hiddenth");
  while(subject.options.length)
     subject.remove(0);
  for(i=0;i<hidden.options.length;i++) {
    if(hidden.options[i].value == document.selectclass.classdetail.value) {
    for(j=0;j<hidden_sub.options.length;j++){
        if(hidden.options[i].text == hidden_sub.options[j].value) {
        var op=document.createElement("OPTION");
        op.value=hidden_sub.options[j].value;
        op.text=hidden_sub.options[j].text;
        subject.options.add(op);
        break;
        
            
      }
    }
  }
  }
}
</script>
<script type="text/javascript">
function SetSubLb() {
  var subject=document.getElementById("subjectdetaillb");
  var hidden_sub=document.getElementById("hidden_sublb");
  var hidden=document.getElementById("hiddenlb");
  while(subject.options.length)
     subject.remove(0);
  for(i=0;i<hidden.options.length;i++) {
    if(hidden.options[i].value == document.selectlab.classdetail.value) {
    for(j=0;j<hidden_sub.options.length;j++){
        if(hidden.options[i].text == hidden_sub.options[j].value) {
        var op=document.createElement("OPTION");
        op.value=hidden_sub.options[j].value;
        op.text=hidden_sub.options[j].text;
        subject.options.add(op);
        break;
      }
    }
  }
  }
}
</script>

<script type="text/javascript">

  

  function checkFormth(form)

  {

    if(form.classdetail.value == "Select Class") {

      alert("Error: Please Select Class!");

      form.classdetail.focus();

      return false;

    }

    if(form.subjectdetail.value=="Select Subject") {

      alert("Error: Please Select Subject!");

      form.subjectdetail.focus();

      return false;

    }



    

    return true;

  }

</script>

<script type="text/javascript">

  

  function checkFormlb(form)

  {

    if(form.classdetail.value == "Select Class") {

      alert("Error: Please Select Class!");

      form.classdetail.focus();

      return false;

    }

    if(form.subjectdetail.value=="Select Subject") {

      alert("Error: Please Select Subject!");

      form.subjectdetail.focus();

      return false;

    }



    

    return true;

  }

</script>









<body>

<center>

<!--form--><br><br>

<h1>SELECT CLASS/LAB TO CONTINUE</h1><br><br></center>
<?php if($list=="" && $listlab == "") {?>
<center><h4>No Subjects Added!! Contact Admin.</h4></center>
<?php }?>

<div class="col-md-12 row">

<?php if($list!="") {?>
<div class="col-md-6 col-xs-12">
<form  name="selectclass" action="AttendancePanel.php" method="post" onsubmit="return checkFormth(this);"><center>
<div class="form-group">
   <div class="col-md-3"></div>  <label for="example-date-input" class="col-col-form-label"><b>Class</b></label><br>
    <div class="col-md-8">
        <div class="row">
    <select class="form-control" id="classdetailth" name="classdetail" onChange="SetSubTh(this)">
    <option>Select Class</option>
   <?php echo $list;?>
    </select>
    <select class="form-control" id="subjectdetailth" name="subjectdetail" onChange="SetSubTh(this)">
    <option>Select Subject</option>
    </select>
    <select class="form-control" id="hiddenth" name="hiddenth" hidden>
   <?php echo $list2;?>
    </select>
    <select class="form-control" id="hidden_subth" name="hidden_subth" hidden>
   <?php echo $list1;?>
    </select>
<input type="hidden" name="batch" value='0'>
    </div>

    </div>

  </div>




<button type="submit" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;



<button type="submit" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="view.php">View Attendance</button>



</form>
</div>
<?php }?>
<br><br><br>

<hr>

<br class="rwd-break">
<?php if($listlab!="") { ?>
<div class="col-md-6 col-xs-12">
<form name="selectlab" action="AttendancePanel.php" method="post" onsubmit="return checkFormlb(this);"><center>
<div class="form-group">
   <div class="col-md-3"></div>  <label for="example-date-input" class="col-col-form-label"><b>Lab</b></label><br>
    <div class="col-md-8">
    <select class="form-control " id="classdetaillb" name="classdetail" onChange="SetSubLb(this)">
    <option>Select Lab</option>
   <?php echo $listlab;?>
    </select>
    <select class="form-control " id="subjectdetaillb" name="subjectdetail" onChange="SetSubLb(this)">
  <option>Select Subject</option>
    </select>
    <select class="form-control" id="hiddenlb" name="hiddenlb" hidden>
   <?php echo $list2lab;?>
    </select>
    <select class="form-control" id="hidden_sublb" name="hidden_sublb" hidden>
   <?php echo $list1lab;?>
    </select>

    </div>

<br>

<div class="form-group">

<div class="col-md-8">

Batch:

<select class="form-control" id="batch" name="batch">

<option>1</option>

<option>2</option>

</select>

</div>

</div>

  

  </div>





<button type="submit" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;



<button type="submit" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="view.php">View Attendance</button>


</form>
</div>
<?php } ?>


<br><br><br>



</div></div>
<br><br>
<?php if($coordinator) { ?>
<a href='date_select.php' ><p style="text-align:center">Click here for all subject attendance report</p></a>
<?php } ?>
</center>



<?php include("footer.php"); ?>



</body>

</html>
