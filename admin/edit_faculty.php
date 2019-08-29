<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
else {
require '../conn_iet.php';
$branch = $_POST['branch'];
$subject_name = $_POST['subject_name'];
$faculty="";
$result=mysqli_query($conn,"select id,name from faculty_table order by name");
while($row = mysqli_fetch_assoc($result)) {
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
<title>Edit Subject Faculty</title>
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
    if(form.faculty_id.value == "Select Faculty") {
      alert("Error: Please select Faculty!");
      form.faculty_id.focus();
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
<!--nav--><br><br>
<center>

<br><h4>Edit Subject Faculty</h4><br>
<h6><?php echo $branch; ?></h6><br>
<div class="col-sm-3">
</div>
<div class="col-sm-4" >
<div class="form-group">
  <label for="sel1">Subject - <?php echo $subject_name; ?></label>
  <form method="POST" action="edit_script.php" onsubmit="return checkForm(this);">
  <input type="hidden" name="subject_id" value="<?php echo $_POST['subject_id']; ?>">
  <input type="hidden" name="class_id" value="<?php echo $_POST['class_id']; ?>">
  <input type="hidden" name="edit_type" value="faculty">
  <select class="form-control" id="faculty_id" name="faculty_id">
    <option>Select Faculty</option>
	<?php echo $faculty; ?>
  </select>
</div>
<br>
<button type="submit" class="btn btn-success">Submit</button>
</div>

</form>

</center><br><br><br>
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