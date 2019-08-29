<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="admin/css/maincss.css" rel="stylesheet" type="text/css">
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link href="admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="admin/css/bootstrap-reboot.css" rel="stylesheet" type="text/css">
<link href="admin/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
-->

<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
<link href="admin/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="admin/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
<link href="admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="admin/css/footer.css" rel="stylesheet" type="text/css"
<link href="admin/css/font-awesome.css" rel="stylesheet" type="text/css">
<script src="admin/js/jquery-3.3.1.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
<link rel="stylesheet" href="admin/css/flip-card.css"> 

<link rel="stylesheet" href="admin/css/tline.css"> 
<link rel="shortcut icon" href="davv.ico" />
<title>About Us</title>
<script>
    
    $(function() {
  AOS.init();
});
</script>
</head>
<body>
<style type="text/css">
  @media screen and (min-width: 768px){
   .rwd-break { display: none; }
}

.bg-faded{
background-color:#00000000;
}

time {color : #007b5e;}

#tline{padding-top:140px;}
#team{padding-top:80px;}

.img-round{
    height:100%;
    width:100%;
}
.prev{
    margin-top:200px;
    z-index:500;
    position:absolute;
}

.next{
    margin-top:200px;
    z-index:500;
    position:absolute;
    right:0;
}

</style>
<center>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
 
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#defaultNavbar1" aria-controls="defaultNavbar1" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>
<!--
<div class="col-md-12 col-xs-12 row">
  
<div class="col-md-6 col-xs-12"> -->
 <img class="col-xs-12 " src="davv.png" width="60" height="60" class="d-inline-block align-center" alt="iet-davv">

 
  <a class="navbar-brand col-md-5 col-xs-12 " href="index.php"><h2 style="color:#464a4c" ><b>Institute of <br class="rwd-break">Engineering & <br class="rwd-break"> Technology </b></h2></a>

 
  </div>
 
  
  <br>
  <!--
<div class="col-md-6 col-xs-12">  -->
  <div class="collapse navbar-collapse " id="defaultNavbar1">

<br><br>

<div class=" col-md-3 col-xs-12 mr-auto"></div>
  
     <ul class="navbar-nav mr-auto">

    
        <li class="nav-item">
           <div class="col-md-3 "> <a class="nav-link" href="#tline" style="color: #464a4c">About</a></div>
        </li>
    
        <li class="nav-item">
          <div class="col-md-3 ">  <a class="nav-link" href="#team" style="color: #464a4c">Team</a></div>
        </li>
      
    </ul>
  
    </div>
</div>
</div>
    

</nav>
</center>


<!--******************************************timeline***************************************-->
<section id="main">
<section class="timeline" id="tline">
    <div class="arrows">
    <button class="arrow arrow__prev disabled prev" disabled> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_prev.svg" alt="prev timeline arrow"> 
    </button>
    <button class="arrow arrow__next next"> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_next.svg" alt="next timeline arrow"> 
    </button>
  </div>
  <ol>
    <li>
      <div>
        <time>Feedback System</time>
        IET Feedback System is the feedback system where students can give online feedback to faculties and which can be viewed by faculties in an organised format.</div>
    </li>
    <li>
      <div>
        <time>Attendance System</time>
        IET Attendance System is an attendance panel for both teachers and students where teachers can save attendance online and students can view their attendance online in order to satisfy the minumum criteria for attendance.</div>
    </li>
    <li>
      <div>
        <time>Online-IET App</time>
        Android app for faculties and students including features like taking/viewing attendance, broadcasts, viewing schedule and many more to come....</div>
    </li>
    <li>
      <div>
        <time>Marks System</time>
        IET Marks System is a marks panel for both teachers and students where teachers can save and keep online record of marks of MST and final exams and students can view their MST marks.</div>
    </li>
    <li>
      <div>
        <time>Faculty Portal</time>
        A combined system to access Feedback, Attendance and Marks system by faculties of IET with only one login.</div>
    </li>
    <li>
      <div>
        <time>Student Portal</time>
        A combined system to view attendance, marks, schedule by students of IET with only one login.<br><b>Coming Soon...</b></div>
    </li>
    <li>
      <div>
        <time>Schedule</time>
        System for viewing and adjusting schedules by faculties and students.<br><b>Coming Soon...</b></div>
    </li>
    <li></li>
  </ol>

</section>


<!--******************************************timeline***************************************-->
<!-- Team -->
<section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">OUR TEAMS</h5>
        <h5 align="center" class="h5"><cite>All systems are developed under the guidance of Vaibhav Jain Sir.</cite></h5>
        <br>
        <div class="row">
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="fade-right">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><i class="fa fa-comments-o fa-4x "></i></p>
                                    <h4 class="card-title">Feedback System</h4>
                                    <p class="card-text">Sapan Tanted<br>
                                                        Anuj Bansal<br>
                                                        Sahil Jain
                                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                   <div class="card-body text-center">
                                    <p class="card-text"><img class=" img-fluid img-round" src="/img/feedback_team.png" usemap="#feedback">
                                    <map name="feedback">
                                      <area shape="rect" coords="0,90,95,280" alt="Anuj" title="Anuj Bansal">
                                      <area shape="rect" coords="96,15,180,150" alt="Sapan" title="Sapan Tanted" >
                                      <area shape="rect" coords="180,15,220,215" alt="Sahil" title="Sahil Jain">
                                    </map>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="zoom-out-down">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><i class="fa fa-calendar-check-o fa-4x "></i></p>
                                    <h4 class="card-title">Attendance System</h4>
                                    <p class="card-text">Taikhoom Rajodwala<br>
                                                         Anuj Singh<BR>
                                                         Devyani Lambhate</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                   <div class="card-body text-center">
                                    <p class="card-text"><img class=" img-fluid img-round" src="/img/attendance_team.png" usemap="#attendance">
                                    <map name="attendance">
                                      <area shape="rect" coords="0,18,62,220" alt="Taikhoom" title="Taikhoom Rajodwala">
                                      <area shape="rect" coords="62,52,128,220" alt="Devyani" title="Devyani Lambhate" >
                                      <area shape="rect" coords="128,34,200,220" alt="Anuj" title="Anuj Singh Koli">
                                    </map>
				</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="fade-left">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><i class="fa fa-users fa-4x "></i></p>
                                    <h4 class="card-title">Marks System</h4>
                                    <p class="card-text">Rasesh Tongia<br>
                                                         Punya Mathew<BR>
                                                         Kavish Mehta</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p class="card-text"><img class=" img-fluid img-round" src="/img/marks_team.png" usemap="#marks">
                                    <map name="marks">
                                      <area shape="rect" coords="0,30,80,275" alt="Kavish" title="Kavish Mehta">
                                      <area shape="rect" coords="80,35,150,275" alt="Punya" title="Punya Mathew" >
                                      <area shape="rect" coords="150,45,220,275" alt="Rasesh" title="Rasesh Tongia">
                                    </map></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
          
        </div>
    </div>
</section>
</section>
</body>
<!-- Team -->
<?php include("footer.php"); ?>

<script src="admin/js/tline.js"></script>
<script src="admin/js/timeline.min.js"></script>
<script>
    
    jQuery('.timeline').timeline({
        verticalStartPosition: 'left',
        mode: 'horizontal',
        visibleItems: 4
});

$(document).ready(function(){
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
        window.location.hash = hash;
      });
    } 
  });
});
</script>

</html>
