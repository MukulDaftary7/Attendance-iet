
<!doctype html>
<html>
<head>
<?php include('header.php');?>

<script>
 
function fill(Value) {
   $('#search').val(Value);
   $('#display').hide();
 
}
 
$(document).ready(function() {
   $("#view").click(function() {
       var name = $('#search').val();
        
         $("#loading").show();
       if (name == "") {
 
           $("#display").html("");
 
       }
       else {
           $.ajax({
               type: "POST",

               url: "searchb.php",
 
               data: {
                   search: name
               },

               success: function(html) {
                   $("#display").html(html).show();
                     $("#loading").hide();  
               }
 
           });
       }
   });
});
</script>
 <script>
 
function get_detail(enrol) {
  $.post("student/student_profile.php",{
          enroll:enrol
        }, function(data){
            console.log(data);
            $( "#modal-body" ).html( data );
            $('#myModal').modal('show');
        });
}
 
 </script>   
 <style type="text/css">
   a:link {
    text-decoration: none;
    color:black;
}
 </style>
<body>
 
<div class="container">
<br>   
<!-- Search box. --> 
<!--<form action="student/student_profile.php" method="post" target="_blank">
-->
<div class="row mx-auto"> 
<div class="col-md-2"></div>
<div class="col-md-8">
  <label for="search">Search:</label>
  <input type="text" class="form-control" id="search" 
        placeholder="Enter Name , Enrollment Number or Roll Number of student" name="enroll">
</div> 
<div class="col-md-2">
    <br>
    <button id="view" type="submit" class="btn btn-primary" align="center">Search</button>
</div>
 </div>
   <!-- Suggestions will be displayed in below div. -->

<div class="col-md-10 mx-auto" style="position:absolute;z-index:15;">
    <div id="loading" style="display:none;">
         <img src="img/Loading_icon.gif" width=20%>
    </div>
</div>
    <div class="mx-auto col-md-8" id="display"></div>
<!--</form>-->
</div> 

<div class="modal" id="myModal" style="border-radius:25px;" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Student Detail</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="modal-body">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>


