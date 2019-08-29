<?php session_start(); #if session exist then session error variable will be set to null

if(!isset($_SESSION["username"]))

	header('Location: index.php');

$_SESSION["error"] = "";
$username = $_SESSION['user'];
$password = $_SESSION['password'];
?>




<script>

	$('#myModal').on('shown.bs.modal', function () {

  $('#myInput').focus()

})

</script>

<style>

	h3{color: #042c4f}

	</style>
<head><title>Teachers panel</title></head>
<?php include("header.php"); ?>

<body>



<!--

<img src="iet.jpg" style="width: 100%;"/>

-->

<br>

<center>

<div class="row">

  <div class="col-sm-12 col-md-12">

    <div class="card card-inverse card-info mb-3" style="margin-bottom:70px; margin-top:90px;background-color: #7abd7a">

      <div class="card-block">

        <h3 class="card-title"><h3 class="text-primary"><?php echo "Welcome ".$_SESSION['username']; /*display username welcome message*/ ?></h3></h3>  

        <div class="icon">

        <div class="row">

        <div class="col-1">

        </div>

   <div class="col-md-2 col-xs-12 col-sm-12">    

  <a class="icon-wrapper" href="attendance.php"><i class="fa fa-calendar-check-o fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a>

    <a href="attendance.php"><h3>Attendance</h3></a> 

  </div>

<div class="col-md-2 col-xs-12 col-sm-12">   

<a class="icon-wrapper" href="#"><i class="fa fa-calendar fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a><br>

<a href="#"><h3>Schedule</h3></a>

</div>

<div class="col-md-2 col-xs-12 col-sm-12">   

<form method="post" action="http://feedback.ietdavv.edu.in/LoginServlet" id="feedback_form">
<input type="hidden" name="login_type" value="faculty">
<input type="hidden" name="username" value="<?php echo $username; ?>">
<input type="hidden" name="password" value="<?php echo $password; ?>">
<a class="icon-wrapper" href="#" onclick="document.getElementById('feedback_form').submit();"><i class="fa fa-comments-o fa-4x  custom-icon"><span class="fix-editor">&nbsp;</span></i></a>

    <a href="#" onclick="document.getElementById('feedback_form').submit();"><h3>Feedback</h3></a>
</form>

</div>

<div class="col-md-2 col-xs-12 col-sm-12">   

<a class="icon-wrapper" href="searchf.php"><i class="fa fa-pencil-square-o fa-4x  custom-icon"><span class="fix-editor">&nbsp;</span></i></a><br>

 <a href="searchf.php"><h3>Search</h3></a>

 </div>

  <div class="col-md-2 col-xs-12 col-sm-12">   
  <form method="post" action="http://exam.ietdavv.edu.in:8080/verifyfaculty" id="marks_form">
<input type="hidden" name="flag" value="faculty">
<input type="hidden" name="t1" value="<?php echo $username; ?>">
<input type="hidden" name="t2" value="<?php echo $password; ?>">

<a class="icon-wrapper" href="#"  onclick="document.getElementById('marks_form').submit();"><i class="fa fa-users fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a>

       <a href="#"  onclick="document.getElementById('marks_form').submit();"><h3>Marks</h3></a>
</form>
       </div> 

        <div class="col-1">

        </div>

        </div>

        </div>

  </div>

</div>

</div>

	</div>

</center>

<?php include("footer.php"); ?>
    

</body>

</html>
