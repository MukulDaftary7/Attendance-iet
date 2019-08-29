
<?php
session_start();

if(!isset($_SESSION["username"]))
    header('Location: ../index.php');
$_SESSION["error"] = "";
$user = $_SESSION['username'];
$pass = $_SESSION['password'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Admin Login</title>
    <title>Teachers panel</title>
<style type="text/css">

    .sec-effect 
    {
        height: 40%;
        padding: 6%;
        margin-left: 8%;
    }

    .div-effect
    {
        margin: 1%;
        height: 100%;
        border-radius: 25px;
    }

    .card-effect
    {
        background: #D4EFDF ;
        transition: font-size .5s, transform .5s; 
        color: limegreen;
        padding: 20px;
        text-align: center;
        width: 22rem;
        border-radius: 25px;
        z-index: 2;
        position: relative;
    }
    .card-effect:hover 
    {
        background:#4CAF50  ;  
        font-size: large;
        transform: scale(1.25); 
        color: #EEEEEE;
        z-index: 5;
    }

</style>
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

    <div class="col-4"></div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <div class="col-1">  <a class="nav-link" href="../index.php" style="color: aliceblue">Home</a></div>
            </li>
            <li class="nav-item">
                <div class="col-1"> <a class="nav-link" href="../about.php" style="color: aliceblue">About</a></div>
            </li>
            <li class="nav-item">
                <div class="col-md-3 ">  <a class="nav-link" href="../logout.php" style="color: aliceblue">Logout</a></div>
             </li>
        </ul>
    </div>
    
</nav>
</center>
<div class="row sec-effect" style="position: relative;">
    <div class="card div-effect" >
        <form method="post" action="http://10.82.190.3:8080/verifyfaculty" id="marks_admin">
                <input type="hidden" name="flag" value="admin">
                <input type="hidden" name="t1" value="<?php echo $user; ?>">
                <input type="hidden" name="t2" value="<?php echo $pass; ?>">
            <a href="#" onclick="document.getElementById('marks_admin').submit();">
            <div class="card-body card-effect">
    	      <h1>MARKS</h1><i class="fa fa-list-alt fa-5x"></i>
            </div>
            </a>  
        </form> 
    </div>
    <div class="card div-effect">
        <a href="admin_panel.php">
            <div class="card-body card-effect">
                <h1>ATTENDANCE</h1><i class="fa fa-calendar fa-5x"></i>
            </div>
        </a>
    </div>
    <div class="card div-effect">
        <form action="http://feedback.ietdavv.edu.in/LoginServlet" method="post" id="feedback_admin">
                <input type="hidden" name="username" value="<?php echo $user; ?>">
                <input type="hidden" name="password" value="<?php echo $pass; ?>">
                <input type="hidden" name="login_type" value="faculty">
            <a href="#" onclick="document.getElementById('feedback_admin').submit();">
                <div class="card-body card-effect"> 
	               <h1>FEEDBACK</h1><i class="fa fa-comment fa-5x"></i>
                </div> 
            </a> 
        </form>   
    </div>
</div>

<?php include("../footer.php"); ?>


</body>

</html>
