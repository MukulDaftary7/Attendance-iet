<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
?>
<!doctype html>
<html>
<head>
<title>Edit Faculty</title>
<meta charset="utf-8">
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
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
        <br><h4>FACULTY EDIT</h4><br>
		
		<form method="POST" action="edit_script.php" onsubmit="return checkFac(this);">
		<input type="hidden" name="edit_type" value="faculty_details">
		<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
        <div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Name</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="faculty_name" type="text" name="faculty_name" value="<?php echo $_POST['name']; ?>">
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
					<option>Mechanical</option>
					<option>Civil</option>
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
				<label for="inputdefault">Email</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="email" type="text" name="email" value="<?php echo $_POST['email']; ?>">
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