<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
else {
require '../conn_iet.php';
$result = mysqli_query($conn,"select * from class_table");
$result2 = mysqli_query($conn,"select * from faculty_table where name<>'admin'");
$result3 = mysqli_query($conn,"select * from subject_table order by course,semester");
$result4 = mysqli_query($conn,"select * from class_table");
$result5 = mysqli_query($conn,"select * from class_table");
$faculty="";
$result6=mysqli_query($conn,"select id,name from faculty_table order by name");
while($row = mysqli_fetch_assoc($result6)) {
	if($row['name'] == 'admin')
		continue;
	$fac_id = $row['id'];
	$faculty.="<option value=\"$fac_id\">".$row['name']."</option>";
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel</title>
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
  $(document).on('click', '.nav li', function() {
       $(".nav li").removeClass("active bg-success");
       $(this).addClass("active bg-success");

   });
</script>
<script type="text/javascript">

$(document).ready(function(){	

	$(document).ready(function(){	
		$("#section1").show();
   		$("#section2").hide();
    	$("#section3").hide();
   		$("#section4").hide();
    	$("#section5").hide();
    	$("#section6").hide();
		}); 

	$("#header1").click(function () {

    $("#section1").show();
    $("#section2").hide();
    $("#section3").hide();
   		$("#section4").hide();
    	$("#section5").hide();
    	$("#section6").hide();
	}); 

	$("#header2").click(function () {

    $("#section2").show();
    $("#section1").hide();
    $("#section3").hide();
   		$("#section4").hide();
    	$("#section5").hide();
    	$("#section6").hide();
	});

	$("#header3").click(function () {

    $("#section3").show();
    $("#section1").hide();
    $("#section2").hide();
   		$("#section4").hide();
    	$("#section5").hide();
    	$("#section6").hide();
	});

	$("#header4").click(function () {

    $("#section4").show();
    $("#section1").hide();
    $("#section2").hide();
   		$("#section3").hide();
    	$("#section5").hide();
    	$("#section6").hide();
	});

	$("#header5").click(function () {

    $("#section5").show();
    $("#section1").hide();
    $("#section2").hide();
   		$("#section4").hide();
    	$("#section3").hide();
    	$("#section6").hide();
	});

	$("#header6").click(function () {

    $("#section6").show();
    $("#section1").hide();
    $("#section2").hide();
   		$("#section4").hide();
    	$("#section3").hide();
    	$("#section5").hide();
	});

 });

</script>
<script type="text/javascript">
	
  function checkFac(form)
  {
    if(!form.faculty_name.value) {
      alert("Error: Please enter Faculty Name!");
      form.faculty_name.focus();
      return false;
    }
    if(form.branch_fac.value == "Select Branch") {
      alert("Error: Please select Branch!");
      form.branch_fac.focus();
      return false;
    }
    if(form.designation.value == "Select Designation") {
      alert("Error: Please select Designation!");
      form.designation.focus();
      return false;
    }
    if(form.fac_type.value == "Select Type") {
      alert("Error: Please select Faculty Type!");
      form.fac_type.focus();
      return false;
    }
    if(!form.email.value) {
      alert("Error: Please enter Email!");
      form.email.focus();
      return false;
    }
    if(!form.username.value) {
      alert("Error: Please enter Username!");
      form.username.focus();
      return false;
    }
    if(!form.password.value) {
      alert("Error: Please enter Password!");
      form.password.focus();
      return false;
    } 
      if(form.password.value == form.username.value) {
        alert("Error: Password must be different from Username!");
        form.password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.password.focus();
        return false;
      }
    return true;
  }
</script>
<script type="text/javascript">
	
	function checkSub(form)
  {
    if(form.course.value == "Select Course") {
      alert("Error: Please select Course!");
      form.course.focus();
      return false;
    }
    if(form.branch_sub.value == "Select Branch") {
      alert("Error: Please select Branch!");
      form.branch_sub.focus();
      return false;
    }
    if(!form.subject_code.value) {
      alert("Error: Please enter Subject Code!");
      form.subject_code.focus();
      return false;
    }
    if(!form.subject_name.value) {
      alert("Error: Please enter Subject Name!");
      form.subject_name.focus();
      return false;
    }
    if(!form.semester.value) {
      alert("Error: Please enter Semester!");
      form.semester.focus();
      return false;
    }
    if(form.semester.value < 1 || form.semester.value > 8) {
      alert("Error: Please enter valid Semester!");
      form.semester.focus();
      return false;
    }
    if(form.class_type.value == "Select Type") {
      alert("Error: Please select Class Type!");
      form.class_type.focus();
      return false;
    }
    return true;
  }
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
       <div class="col-1"> <a class="nav-link" href="logout_admin.php" style="color: aliceblue">Logout</a></div>
      </li>
     
     <li class="nav-item">
      <div class="col-1">  <a class="nav-link" href="#" style="color: aliceblue">New Session</a></div>
      </li>
      
      <li class="nav-item">
       <div class="col-1"> <a class="nav-link" href="../about.php" style="color: aliceblue">About</a></div>
      </li>
    </ul>
    </div>
    
</nav>


<!--nav-->

<div>
<div class="row justify-content-md">	


<nav class="col-sm-auto col-offset-4" id="myScrollspy" style="margin-left:80px;margin-right:50px">
<br><br>
      <ul class="nav nav-pills flex-column sticky-top  navbar-default">
        <li id="header1" class="active bg-success nav-link nav-item"><a href="#section1" style="color: black"><b>CLASSES</b></a></li>
        <li id="header2" class="nav-link nav-item"><a href="#section2" style="color: black"><b>FACULTIES</b></a></li>
        <li id="header3" class="nav-link nav-item"><a href="#section3" style="color: black"><b>SUBJECTS</b></a></li> 
        <li id="header4" class="nav-link nav-item"><a href="#section4" style="color: black"><b>STUDENTS</b></a></li>    
        <li id="header5" class="nav-link nav-item"><a href="#section5" style="color: black"><b>BATCHES</b></a></li>  
        <li id="header6" class="nav-link nav-item"><a href="#section5" style="color: black"><b>CLASS<br>COORDINATORS</b></a></li>                    
      </ul>
    </nav> 
        
        
		<div class="col-md-9" id="section1">
        <div class="table-responsive">

            <?php if(mysqli_num_rows($result) == 0)
				echo "<br><br>NO Classes to show!!";
			else { ?>
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   
                   <th>Class ID</th>
                    <th>Course</th>
                     <th>Branch</th>
					 <th>Year</th>
					 <th>Section</th>
                     <!-- <th>Class code</th> -->
                      <th>Edit Subjects</th>
                      
                       <th>Edit Students</th>
                   </thead>
    <tbody>
    
	<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['branch']; ?></td>
	<td><?php echo $row['year']; ?></td>
	<td><?php echo $row['section']; ?></td>
	<form method="POST" action="edit_subject.php">
    <td><p data-placement="top" data-toggle="tooltip" title="EDIT"><button class="btn btn-danger btn-xs" data-title="EDIT" data-toggle="modal" data-target="#delete" type="submit"><span>EDIT SUBJECTS</span></button></p></td>
	<input type="hidden" name="class_id" value="<?php echo $row['id'] ?>" >
	</form>
	<form method="POST" action="edit_student.php">
	<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" type="submit"><span>EDIT STUDENTS</span></button></p></td>
    <input type="hidden" name="class_id" value="<?php echo $row['id'] ?>" >
	</form>
	</tr>
	<?php } ?>
 
    </tbody>
        
</table>
			<?php } ?>
</div></div>


		<div class="col-md-9" id="section2">
		<br><h4>ADD FACULTY</h4><br>
		
		<form method="POST" action="add_faculty.php" onsubmit="return checkFac(this);">
        <div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Name</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="faculty_name" type="text" name="faculty_name">
			</div>
		</div>			
        
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Branch</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="branch_fac" id="branch_fac">
					<option>Select Branch</option>
					<option>Computer Engineering</option>
					<option>Information Technology</option>
					<option>Electronics & Telecommunication</option>
					<option>Electronics & Instrumentation</option>
					<option>Mechanical Engineering</option>
					<option>Civil Engineering</option>
					<option>Applied Science</option>
				</select>
			</div>
		</div>		
        
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Designation</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="designation" id="designation">
					<option>Select Designation</option>
					<option>Director</option>
					<option>HOD</option>
					<option>Professor</option>
					<option>Associate Professor</option>
					<option>Assistant Professor</option>
					<option>Lecturer</option>
				</select>
			</div>
		</div>		
        
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Faculty Type</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="fac_type" id="fac_type">
					<option>Select Type</option>
					<option>Permanent</option>
					<option>Guest</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Email</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="email" type="email" name="email">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Username</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="username" type="text" name="username">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Password</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="password" type="password" name="password">
				(Password must be different from username and must contain atleast one number(0-9))
			</div>
		</div>
		
		<div class="form-group row  text-center center-block">
		<!-- Submit button -->
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
				<br><br>
			</div>
		</div>
		</form>
		
        <div class="table-responsive">

            <?php if(mysqli_num_rows($result2) == 0)
				echo "<br><br>NO Faculty to show!!";
			else { ?>
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   
                   <th>Faculty ID</th>
                    <th>Name</th>
                     <th>Branch</th>
                     <th>Designation</th>
                     <!-- <th>Class code</th> -->
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
    
	<?php while($row = mysqli_fetch_assoc($result2)) { ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['branch']; ?></td>
	<td><?php echo $row['designation']; ?></td>
	<form method="POST" action="edit_faculty_details.php">
    <td><p data-placement="top" data-toggle="tooltip" title="EDIT"><button class="btn btn-primary btn-xs" data-title="EDIT" data-toggle="modal" data-target="#delete" type="submit"><span>EDIT</span></button></p></td>
	<input type="hidden" name="name" value="<?php echo $row['name'] ?>" >
	<input type="hidden" name="email" value="<?php echo $row['email'] ?>" >
	<input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
	</form>
	<form method="POST" action="delete_script.php" onsubmit="return del_confirm(this);">
	<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-danger btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" type="submit"><span>DELETE</span></button></p></td>
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
	<input type="hidden" name="delete_type" value="faculty" >
	</form>
	</tr>
	<?php } ?>
 
    </tbody>
        
</table>
			<?php } ?>
</div></div>


		<div class="col-md-9" id="section3">
		<br><h4>ADD SUBJECT</h4><br>
		
		<form method="POST" action="add_subject.php" onsubmit="return checkSub(this);">
        <div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Course</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="course" id="course">
					<option>Select Course</option>
					<option>BE</option>
					<option>ME</option>
					<option>MSC</option>
				</select>
			</div>
		</div>			
        
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Branch</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="branch_sub" id="branch_sub">
					<option>Select Branch</option>
					<option>Computer Engineering</option>
					<option>Information Technology</option>
					<option>Electronics & Telecommunication</option>
					<option>Electronics & Instrumentation</option>
					<option>Mechanical Engineering</option>
					<option>Civil Engineering</option>
					<option>Applied Science</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Subject Code</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="subject_code" type="text" name="subject_code">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Subject Name</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="subject_name" type="text" name="subject_name">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label class="control-label" for="date">Semester</label>
			</div>
			<div class="col-md-4">
				<input class="form-control input-lg" id="semester" type="number" name="semester"/>
			</div>
		</div>
		
        <div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Class Type</label>
			</div>
			<div class="col-md-4">
				<select class="form-control  input-lg" name="class_type" id="class_type">
					<option>Select Type</option>
					<option value="0">Theory</option>
					<option value="1">Lab</option>
					<option value="2">Theory+Lab</option>
				</select>
			</div>
		</div>	
		
		<div class="form-group row  text-center center-block">
		<!-- Submit button -->
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
				<br><br>
			</div>
		</div>
		</form>
	
        <div class="table-responsive">
            <?php if(mysqli_num_rows($result3) == 0)
				echo "<br><br>NO Subjects to show!!";
			else { ?>
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th>Subject Id</th>
                   <th>Course</th>
                    <th>Subject Code</th>
                     <th>Subject Name</th>
                     <th>Branch</th>
					 <th>Semester</th>
                     <!-- <th>Class code</th> -->
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
    
	<?php while($row = mysqli_fetch_assoc($result3)) { ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['subject_code']; ?></td>
    <td><?php echo $row['subject_name']; ?></td>
	<td><?php echo $row['branch']; ?></td>
	<td><?php echo $row['semester']; ?></td>
	<form method="POST" action="edit_subject_details.php">
    <td><p data-placement="top" data-toggle="tooltip" title="EDIT"><button class="btn btn-primary btn-xs" data-title="EDIT" data-toggle="modal" data-target="#delete" type="submit"><span>EDIT</span></button></p></td>
	<input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
	<input type="hidden" name="subject_code" value="<?php echo $row['subject_code'] ?>" >
	<input type="hidden" name="subject_name" value="<?php echo $row['subject_name'] ?>" >
	<input type="hidden" name="semester" value="<?php echo $row['semester'] ?>" >
	</form>
	<form method="POST" action="delete_script.php" onsubmit="return del_confirm(this);">
	<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-danger btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" type="submit"><span>DELETE</span></button></p></td>
    <input type="hidden" name="delete_type" value="subject" >
	<input type="hidden" name="subject_id" value="<?php echo $row['id'] ?>" >
	</form>
	</tr>
	<?php } ?>
 
    </tbody>
        
</table>
			<?php } ?>
</div></div>

<div class="col-md-9" id="section4">
<br><h4>Upload students</h4><br>
<h6>All Classes</h6>
<br>
  <span class="align-middle">
  <div class="col-lg-4">
<div>
<form action="upload_all.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
	CSV file:
	<input type="file" id="file" name="file"  class="form-control-file" />
	 </div>
	 <br>
		<div class="form-group">
		  <input type="submit" class="btn btn-success"> 
		</div>
<br>
<br>

</form>
  </div>
  </div>
</div>

<div class="col-md-9" id="section5">
<br><h4>Specify Batches for Labs</h4><br>
<h6>Specify starting Roll No. for Batch 2<br>(Enter 0 if there is no 2nd batch)</h6>
<div class="table-responsive">

            <?php if(mysqli_num_rows($result4) == 0)
				echo "<br><br>NO Classes to show!!";
			else { ?>
	<form method="POST" action="add_batches.php">
              <table id="mytable" class="table table-bordred table-striped">
			  <thead>
                    <th>Course</th>
                     <th>Branch</th>
					 <th>Year</th>
					 <th>Section</th>
					 <th>Roll No.</th>
                   </thead>
    <tbody>
			  <?php while($row = mysqli_fetch_assoc($result4)) { ?>
    <tr>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['branch']; ?></td>
	<td><?php echo $row['year']; ?></td>
	<td><?php echo $row['section']; ?></td>
    <td><input type="text" class="form-control" name="<?php echo 'roll'.$row['id'] ?>"></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
</div>
		<div class="form-group row  text-center center-block">
		<!-- Submit button -->
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
				<br><br>
			</div>
		</div>
	</form>
			<?php } ?>
</div>
<div class="col-md-9" id="section6">
<br><h4>Specify Class Coordinators</h4><br>
<div class="table-responsive">

            <?php if(mysqli_num_rows($result5) == 0)
				echo "<br><br>NO Classes to show!!";
			else { ?>
	<form method="POST" action="coordinator.php">
              <table id="mytable" class="table table-bordred table-striped">
			  <thead>
                    <th>Course</th>
                     <th>Branch</th>
					 <th>Year</th>
					 <th>Section</th>
					 <th>Faculty</th>
                   </thead>
    <tbody>
			  <?php while($row = mysqli_fetch_assoc($result5)) { ?>
    <tr>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['branch']; ?></td>
	<td><?php echo $row['year']; ?></td>
	<td><?php echo $row['section']; ?></td>
    <td><input class="form-control" list="name" name="<?php echo 'faculty'.$row['id'] ?>" placeholder="Select Faculty">
                <datalist  id="name" name="<?php echo 'faculty'.$row['id'] ?>">
                <?php echo $faculty; ?>
                </datalist></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
</div>
		<div class="form-group row  text-center center-block">
		<!-- Submit button -->
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
				<br><br>
			</div>
		</div>
	</form>
			<?php } ?>
</div>
</div>
</div>



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