<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
else {
require '../conn_iet.php';
$id = $_POST['class_id'];
$sem = "";
$result=mysqli_query($conn,"select * from student_table where class_id=$id order by roll_no");
$res = mysqli_query($conn,"select * from class_table where id=$id");
$row = mysqli_fetch_assoc($res);
$course = $row['course'];
$branch = $row['branch'];
$section = $row['section'];
$year = $row['year'];
switch($year) {
	case 1:
		$sem = '<option>1</option><option>2</option>';
		break;
	case 2:
		$sem = '<option>3</option><option>4</option>';
		break;
	case 3:
		$sem = '<option>5</option><option>6</option>';
		break;
	case 4:
		$sem = '<option>7</option><option>8</option>';
		break;
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Students</title>
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	
  function checkForm(form)
  {
    if(form.year.value == "Select Semester") {
      alert("Error: Please select Semester!");
      form.year.focus();
      return false;
    }
    if(form.upload_type.value == "bulk" && !form.file.value){
      alert("Error: Please select CSV File!");
      return false;
    }
    if(form.upload_type.value == "single" && (!form.name.value || !form.rollno.value || !form.enrollno.value)){
      alert("Error: Please fill all data!");
      return false;
    }
    if(form.upload_type.value == "single" && form.batch_roll_single.value == "Select Batch"){
      alert("Error: Please select Batch!");
      form.batch_roll_single.focus();
      return false;
    }
    return true;
  }
</script>
<script type="text/javascript">

$(document).ready(function(){		

	$(document).ready(function(){	
		$("#section1").show();
   		$("#section2").hide();
		}); 

	 $('input[type=radio][name=upload_type]').change(function() {
        if (this.value == 'bulk') {
            $("#section1").show();
    		$("#section2").hide();
        }
        else if (this.value == 'single') {
            $("#section1").hide();
    		$("#section2").show();
        }
    });

 });

</script>
<script type="text/javascript">
function del_confirm() {
	if(confirm("Want to delete?"))
		return true;
	else return false;
}
</script>
</head>
<body>
<center>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="col-4">
  <img src="davv.png" width="100" height="100" class="d-inline-block align-center" alt="iet-davv">
  
  <a class="navbar-brand" href="#"><h2 style="color:aliceblue" >OnlineIET</h2></a>
  <br><p style="color: aliceblue"></p>
  </div>
  <div class="col-4">
</div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
       <div class="col-2"> <a class="nav-link" href="logout_admin.php" style="color: aliceblue">Logout<span class="sr-only">(current)</span></a></div>
      </li>
      
      <li class="nav-item">
       <div class="col-1"> <a class="nav-link" href="../about.php" style="color: aliceblue">About</a></div>
      </li>
     
     <!--<li class="nav-item">
      <div class="col-3">  <a class="nav-link" href="#" style="color: aliceblue">Sign up</a></div>
      </li>-->
    </ul>
    </div>
    
</nav>


<br><h4>Upload students</h4>
	<?php echo $course.' '.$branch.' '.$section.' '.$year.'-Year'; ?>
<br>
  <div class="card card-block">
  <span class="align-middle">
  <div class="col-lg-4">
<div>
<form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return checkForm(this);">
	<input type="hidden" name="class_id" value="<?php echo $id; ?>">
			<br>
	<input type="radio" id="upload_type" name="upload_type" value="bulk" checked="true">Bulk</input>
	<input type="radio" id="upload_type" name="upload_type" value="single" style="margin-left:20px">Single</input>
	<br><br>
</div>

<div id="section1">
	<div class="form-group">
	CSV file:
	<input type="file" id="file" name="file"  class="form-control-file" />
	 </div>
	 <br>
		<div class="form-group">
		Starting Roll No. for Batch <?php echo $section.'2'; ?>:
		<input type="text" class="form-control" name="batch_roll" id="batch_roll">
		(Keep blank if there is no 2nd batch)
		</div>
		<br>
</div>
<div id="section2">
		<div class="form-group">
		Full name:
		<input type="text" class="form-control" name="name" id="name">
		</div>

		<div class="form-group">
		Roll number:
		<input type="text" class="form-control" name="rollno" id="rollno">
		</div>

		<div class="form-group">
		Enrollment number:
		<input type="text" class="form-control" name="enrollno" id="enrollno">
		</div>

		<div class="form-group">
		<br>
		<select class="form-control" name="batch_roll_single" id="batch_roll_single">
			<option>Select Batch</option>
			<option value="1"><?php echo $section.'1'; ?></option>
			<option value="2"><?php echo $section.'2'; ?></option>
		</select>
		<br>
		</div>
		
</div>
		<div class="form-group">
		  <input type="submit" class="btn btn-success"> 
		</div>
<br>
<br>

</form>
  </div>
  </div>

        <div class="container">
        <div class="col-md-12">
        <div class="table-responsive">
	
            <?php if(mysqli_num_rows($result) == 0)
				echo "NO Students to show!!";
			else { ?>
		
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                    <th>Roll no</th>
                     <th>Enroll no</th>
					 <th>Name</th>
					 <th>Batch</th>
                     <th>Edit</th>
                      <th>Delete</th>
                   </thead>
    <tbody>
	
	<?php while($row=mysqli_fetch_assoc($result)) { ?>
    <tr>
    <td><?php echo $row['roll_no']; ?></td>
    <td><?php echo $row['enroll_no']; ?></td>
	<td><?php echo $row['name']; ?></td>
	<td><?php echo $row['batch']; ?></td>
	<form method="POST" action="edit_single_student.php">
	<input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
	<input type="hidden" name="roll_no" value="<?php echo $row['roll_no']; ?>">
	<input type="hidden" name="enrol" value="<?php echo $row['enroll_no']; ?>">
	<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
	<input type="hidden" name="section" value="<?php echo $section; ?>">
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" type="submit"><span >EDIT</span></button></p></td>
    </form>
	<form method="POST" action="delete_student.php" onsubmit="return del_confirm(this);">
	<input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
	<input type="hidden" name="type" value="single">
	<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" type="submit"><span>DELETE</span></button></p></td>
	</form>
	</tr>
	<?php } ?>
	
    </tbody>
        
</table>
	<form method="POST" action="delete_student.php" onsubmit="return del_confirm(this);">
	<input type="hidden" name="class_id" value="<?php echo $id; ?>">
	<input type="hidden" name="type" value="all">
	<button type="submit" class="btn btn-danger">DELETE ALL</button>
	</form>
			<?php } ?>
</div>

</div></div>

<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ">
                     <h3> Online IET</h3>
                   <p>Website managed by OnlineIET Group
                   for any queries contact at: 15bcs157@ietdavv.edu.in 
                   
                   </p>
                </div>
                
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3>IET DAVV </h3>
                  
                         <a href="http://www.ietdavv.edu.in/"> www.ietdavv.edu.in </a> 
                      
                 
                </div>
               
            </div>
            <!--/.row--> 
			
			
        </div>
        <!--/.container--> 
           <div id="bottom">
            <p class="pull-right"> Copyright © 2017 IET DAVV. All right reserved. </p>
           
        </div>
    </div>
    <!--/.footer-->
    
    
    <!--/.footer-bottom--> 
</footer>



</body>
</html>