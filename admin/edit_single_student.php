<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
?>
<!doctype html>
<html>
<head>
<title>Edit Student</title>
<meta charset="utf-8">
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	jQuery(document).ready(function($) {
		if(window.history&&window.history.pushState) {
			$(window).on('popstate',function() {
				var hashLocation=location.hash;
				var hashSplit=hashLocation.split("#!/");
				var hashName=hashSplit[1];
				if(hashName!=='') {
					var hash=window.location.hash;
					if(hash==='') {
						window.location.href="admin_panel.php";
						return false;
					}
				}
			});
			window.history.pushState('forward',null,'./#forward');
		}
	});
</script>
<script type="text/javascript">
	
  function checkForm(form)
  {
    if(!form.rollno.value){
      alert("Error: Please enter Roll No.!");
      form.rollno.focus();
      return false;
    }
    if(!form.enrollno.value){
      alert("Error: Please enter Enrollment No.!");
      form.enrollno.focus();
      return false;
    }
    if(!form.name.value){
      alert("Error: Please enter Name!");
      form.name.focus();
      return false;
    }
    if(form.batch.value == "Select Batch"){
      alert("Error: Please select Batch!");
      form.batch.focus();
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
        <br><h4>STUDENT EDIT</h4><br>
		
		<form method="POST" action="edit_script.php" onSubmit="return checkForm(this);">
		<input type="hidden" name="id" value="<?php echo $_POST['student_id']; ?>">
		<input type="hidden" name="edit_type" value="student">
        <div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Roll No.</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="rollno" type="text" name="rollno" value="<?php echo $_POST['roll_no']; ?>">
			</div>
		</div>			
        
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Enrollment No.</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="enrollno" type="text" name="enrollno" value="<?php echo $_POST['enrol']; ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Name</label>
			</div>
			<div class="col-md-4">
				<input class="form-control  input-lg" id="name" type="text" name="name" value="<?php echo $_POST['name']; ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="inputdefault">Batch</label>
			</div>
			<div class="col-md-4">
		<select class="form-control" name="batch" id="batch">
			<option>Select Batch</option>
			<option value="1"><?php echo $_POST['section'].'1'; ?></option>
			<option value="2"><?php echo $_POST['section'].'2'; ?></option>
		</select>
			</div>
		</div>
		
		<div class="form-group row  text-center center-block">
		<!-- Submit button -->
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<button class="btn btn-success" name="submit" type="submit">Submit</button>
			</div>
		</div>
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