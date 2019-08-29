

<style>

	h3{color: #042c4f}

</style>
<head><title>Student panel</title></head>
<?php include("header.php"); ?>

<body>

<br>

<div id="fullscreen_bg" class="fullscreen_bg"/>
<div id="regContainer" class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Login</a>
              </div>
              <div class="col-xs-6">
               
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="student_verify.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <label for="username">Enrollment number</label>
                    <input type="text" name="enroll" id="enroll" tabindex="1" class="form-control" placeholder="Enroll no" value="">
                  </div>
                 
                  
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-primary" value="Log In">
                      </div>
                    </div>
                  </div>
                </form>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<br><br><br><br><br><br><br><br><br>
<?php include("../footer.php"); ?>
    

</body>

</html>