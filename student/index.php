<!doctype html>

<html>

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="css/maincss.css" rel="stylesheet" type="text/css">

<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"--> 

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

<link href="css/index.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="acss/bootstrap-grid.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap-reboot.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">

<link href="css/footer.css" rel="stylesheet" type="text/css">

<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<style type="text/css">
  @media screen and (min-width: 768px){
   .rwd-break { display: none; }
}
</style>
 <style>
    input[type=text] 
    {
        width: 40%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 1px solid skyblue;
        border-radius: 4px;
    }
    
    .box-align
    {
        margin:3%;
    }

    </style>
    
   
        <title>Student panel</title>

</head>

<body>

<center>

<? php

if(isset($_SESSION["error"])) 

{ echo $message;} 

?>


<nav class="navbar navbar-toggleable-md navbar-light bg-faded">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <img class="col-xs-12" src="../davv.png" width="100" height="100" class="d-inline-block align-center" alt="iet-davv">

 
    <a class="navbar-brand col-md-5 col-xs-12 " href="#"><h2 style="color:aliceblue" ><b>Institute of <br class="rwd-break">Engineering & <br class="rwd-break"> Technology 
    <h6 class="col-md-12 col-xs-12 text-right" style="color:aliceblue;margin-top: auto;margin-left: 90px ">Student Information System</h6></b></h2></a>

  <br><p style="color: aliceblue"></p>

  <br>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
<br><br>
  
  <div class="col-md-5"></div>

    <ul class="navbar-nav mr-auto">

      

      <li class="nav-item">

       <div class="col-md-2"> <a class="nav-link" href="../about.php" style="color: aliceblue">About</a></div>

      </li>

     

      
    </ul>

    </div>

    

</nav>

<form action="student_verify.php" method="post">   
<div class="container box-align">
    <div class="card text-center">
        
        <div class="card-header">
        <h3 class="text-primary">Student Login</h3>
        </div>
        <div class="card-body">
            <br>
            <h5 class="card-title">Enrollment Number </h5>
            <div class="form-group">
                <p class="card-text form-group">
                    <input type="text" name="enroll" id="enroll" placeholder="Enroll no">
                </p>
            </div>    
            <button class="btn btn-primary">Log In</button> 
        </div>
        <br>
        <div class="card-footer text-muted"  style="background:lightgreen;">
            <h6 style="color:black">Student Information System</h6>
        </div>
        
    </div>
</div>    
</form>
</body>

<?php include("../footer.php"); ?>


</html>