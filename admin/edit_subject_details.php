<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
?>
<!doctype html>
<html>
<head>
<title>Edit Subject</title>
<meta charset="utf-8">
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
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




<!--nav-->


<div class="container">

		
        <div class="table-responsive">
        <div class="col-md-12">
        <br><h4>SUBJECT EDIT</h4><br>
		
		<form method="POST" action="edit_script.php" onsubmit="return checkSub(this);">
		<input type="hidden" name="edit_type" value="subject">
		<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
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
				<input class="form-control  input-lg" id="subject_code" type="text" name="subject_code" value="<?php echo $_POST['subject_code']; ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Subject Name</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="subject_name" type="text" name="subject_name" value="<?php echo $_POST['subject_name']; ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label class="control-label" for="date">Semester</label>
			</div>
			<div class="col-md-4">
				<input class="form-control input-lg" id="semester" type="number" name="semester" value="<?php echo $_POST['semester']; ?>">
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
</div></div></div>




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