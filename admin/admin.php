<?php 
session_start();

if(isset($_SESSION['adminid']))
{header('location: admin_panel.php');}
$message="";

if(isset($_SESSION["error"])) 
{ $message= $_SESSION["error"]; 
   $_SESSION["error"]="";
} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-grid.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-reboot.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/footer.css" rel="stylesheet" type="text/css">	
<script src="admin/js/jquery-3.3.1.min.js"></script>
</head>
<script type="text/javascript">
	
  function checkForm(form)
  {
    if(form.username.value == "") {
      alert("Error: Username cannot be blank!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }

    if(form.password.value != "" && form.password.value ) {
      if(form.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.password.focus();
        return false;
      }
      if(form.password.value == form.username.value) {
        alert("Error: Password must be different from Username!");
        form.password.focus();
        return false;
      }
      /*re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.password.focus();
        return false;
      }*/
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.password.focus();
        return false;
      }

     /*re = /[A-Z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.password.focus();
        return false;
      }*/
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.password.focus();
      return false;
    }
    return true;
  }
</script>
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
      <div class="col-1">  <a class="nav-link" href="../index.php" style="color: aliceblue">Home</a></div>
      </li>
      
      <li class="nav-item">
       <div class="col-1"> <a class="nav-link" href="../about.php" style="color: aliceblue">About</a></div>
      </li>
    </ul>
    </div>
    
</nav>

<div class="container">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
          <br>
			    	<h3 class="panel-title">Please sign in</h3>
				<?php echo $message; ?>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" action="admin_verify.php" method="post" onsubmit="return checkForm(this);">
                    <fieldset>
			    	  	<div class="form-group col-4">
			    		    <input class="form-control" placeholder="Username" name="username" id="username" type="text">
			    		</div>
			    		<div class="form-group col-4">
			    			<input class="form-control" placeholder="Password" name="password" id="password" type="password">
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block col-2" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
</div>
<br><br>

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
</center>
</body>
</html>