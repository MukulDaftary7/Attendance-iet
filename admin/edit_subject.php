<?php
session_start();
$_SESSION["error"] = "";
if(!isset($_SESSION['adminid']))
	header('Location: admin.php');
else {
require '../conn_iet.php';
$sem="";
$query = "";
$query1 = "";
$id = $_POST['class_id'];
$result = mysqli_query($conn,"select * from class_table where id=$id");
$row = mysqli_fetch_assoc($result);
$year = $row['year'];
$section = $row['section'];
$branch = $row['branch'];
$course = $row['course'];

switch ($branch) {
	case 'Computer Engineering SE':
		# code...
		$br='Computer Engineering';
		break;
	case 'Information Technology nanoscience IS':
		# code...
		$br='Information Technology';
		break;
	case 'Mechanical Engineering TM':
	case 'Mechanical Engineering IEM':
		# code...
		break;
		# code...
		$br='Mechanical Engineering';
		break;
	case 'Electronics & Instrumentation DI':
		# code...
		$br='Electronics & Instrumentation';
		break;
	case 'Electronics & Telecommunications DC':
		# code...
		$br='Electronics & Telecommunication';
		break;
	default:
		# code...
		$br=$branch;
		break;
}

switch($year) {
	case 1:
		$sem = '<option>1</option><option>2</option>';
		$query = "select distinct(s.id),subject_code,subject_name,name,fs.faculty_id from subject_table s,class_table c,faculty_subject_table fs,faculty_table f where s.course=c.course and 
					s.branch=c.branch and (s.semester=1 or s.semester=2) and fs.faculty_id=f.id and s.id=fs.subject_id and fs.class_id=$id";
		$query1 = "select * from subject_table where (semester=1 or semester=2) and course='$course' and branch='$br'";
		break;
	case 2:
		$sem = '<option>3</option><option>4</option>';
		$query = "select distinct(s.id),subject_code,subject_name,name,fs.faculty_id from subject_table s,class_table c,faculty_subject_table fs,faculty_table f where s.course=c.course and 
					s.branch=c.branch and (s.semester=3 or s.semester=4) and fs.faculty_id=f.id and s.id=fs.subject_id and fs.class_id=$id";
		$query1 = "select * from subject_table where (semester=3 or semester=4) and course='$course' and branch='$br'";
		break;
	case 3:
		$sem = '<option>5</option><option>6</option>';
		$query = "select distinct(s.id),subject_code,subject_name,name,fs.faculty_id from subject_table s,class_table c,faculty_subject_table fs,faculty_table f where s.course=c.course and 
					s.branch=c.branch and (s.semester=5 or s.semester=6) and fs.faculty_id=f.id and s.id=fs.subject_id and fs.class_id=$id";
		$query1 = "select * from subject_table where (semester=5 or semester=6) and course='$course' and branch='$br'";
		break;
	case 4:
		$sem = '<option>7</option><option>8</option>';
		$query = "select distinct(s.id),subject_code,subject_name,name,fs.faculty_id from subject_table s,class_table c,faculty_subject_table fs,faculty_table f where s.course=c.course and 
					s.branch=c.branch and (s.semester=7 or s.semester=8) and fs.faculty_id=f.id and s.id=fs.subject_id and fs.class_id=$id";
		$query1 = "select * from subject_table where (semester=7 or semester=8) and course='$course' and branch='$br'";
		break;
}
$subjects_odd="";
$subjects_even="";
$result=mysqli_query($conn,$query1);
while($row = mysqli_fetch_assoc($result)) {
	$subject_id = $row['id'];
	if($row['semester']%2 == 0)
		$subjects_even.="<option value=\"$subject_id\">".$row['subject_name']."</option>";
	else $subjects_odd.="<option value=\"$subject_id\">".$row['subject_name']."</option>";
}
$faculty="";
$result=mysqli_query($conn,"select id,name from faculty_table order by name");
while($row = mysqli_fetch_assoc($result)) {
	if($row['name'] == 'admin')
		continue;
	$fac_id = $row['id'];
	$faculty.="<option value=\"$fac_id\">".$row['name']."</option>";
}

$res = mysqli_query($conn,$query);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Subjects</title>
<link href="css/maincss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/home.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	
  function checkForm(form)
  {
    if(form.year.value == "Select Semester") {
      alert("Error: Please select Semester!");
      form.year.focus();
      return false;
    }
    if(((form.subject_id1.value == "Select Subject")||(form.faculty_id1.value == "Select Faculty")) && 
			((form.subject_id2.value == "Select Subject")||(form.faculty_id2.value == "Select Faculty")) &&
			((form.subject_id3.value == "Select Subject")||(form.faculty_id3.value == "Select Faculty")) &&
			((form.subject_id4.value == "Select Subject")||(form.faculty_id4.value == "Select Faculty")) &&
			((form.subject_id5.value == "Select Subject")||(form.faculty_id5.value == "Select Faculty")) &&
			((form.subject_id6.value == "Select Subject")||(form.faculty_id6.value == "Select Faculty")) &&
			((form.subject_id7.value == "Select Subject")||(form.faculty_id7.value == "Select Faculty")) &&
			((form.subject_id8.value == "Select Subject")||(form.faculty_id8.value == "Select Faculty"))){
      alert("Error: Please select atleast one Subject & Faculty!");
      return false;
    }
    return true;
  }
</script>
<script type="text/javascript">
function SetSub() {
	var sel=[document.getElementById("subject_id1"),
				document.getElementById("subject_id2"),
				document.getElementById("subject_id3"),
				document.getElementById("subject_id4"),
				document.getElementById("subject_id5"),
	document.getElementById("subject_id6"),
				document.getElementById("subject_id7"),
	document.getElementById("subject_id8")];
	if(document.addsub.year.value%2 == 0)
		var ref=document.getElementById("even");
	else
		var ref=document.getElementById("odd");
	for(i=0;i<8;i++) {
		while(sel[i].options.length)
			sel[i].remove(0);
	}
	for(i=0;i<8;i++) { 
		var op=document.createElement("OPTION");
		op.text="Select Subject";
		sel[i].options.add(op,0);
		for(j=0;j<ref.options.length;j++){
			var op=document.createElement("OPTION");
			op.value=ref.options[j].value;
			op.text=ref.options[j].text;
			sel[i].options.add(op);
		}
	}
}
</script>
<script type="text/javascript">
function del_confirm() {
	if(confirm("Want to delete?"))
		return true;
	else return false;
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

	<h4>ADD SUBJECTS</h4>
	<?php echo $course.' '.$branch.' '.$section.' '.$year.'-Year'; ?>
    <br>
    <div class="col-md-12">
	<form method="POST" action="addnewsubject.php" name="addsub" onsubmit="return checkForm(this);">
	<input type="hidden" name="class_id" value="<?php echo $id; ?>">
	<table id="mytable" class="table table-bordred table-striped">
		<tr>
			<td>
			<select class="form-control" id="year" name="year" onChange="SetSub(this)">
			<option>Select Semester</option>
			<?php echo $sem; ?>
			</select>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id1" name="subject_id1">
			<option>Select Subject</option>
			</select>
			<select id="even" hidden><?php echo $subjects_even; ?></select>
			<select id="odd" hidden><?php echo $subjects_odd; ?></select>
			</td>
			<td>
			    <input class="form-control" list="name1" name="faculty_id1" value="Select Faculty">
                <datalist  id="name1" name="name1">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id2" name="subject_id2">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name2" name="faculty_id2" value="Select Faculty">
                <datalist  id="name2" name="name2">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id3" name="subject_id3">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name3" name="faculty_id3" value="Select Faculty">
                <datalist  id="name3" name="name3">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id4" name="subject_id4">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name4" name="faculty_id4" value="Select Faculty">
                <datalist  id="name4" name="name4">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id5" name="subject_id5">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name5" name="faculty_id5" value="Select Faculty">
                <datalist  id="name5" name="name5">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id6" name="subject_id6">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name6" name="faculty_id6" value="Select Faculty">
                <datalist  id="name6" name="name6">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id7" name="subject_id7">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name7" name="faculty_id7" value="Select Faculty">
                <datalist  id="name7" name="name7">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr>
		<tr>
			<td>
			<select class="form-control" id="subject_id8" name="subject_id8">
			<option>Select Subject</option>
			</select>
			</td>
			<td>
			    <input class="form-control" list="name8" name="faculty_id8" value="Select Faculty">
                <datalist  id="name8" name="name8">
                <?php echo $faculty; ?>
                </datalist>
			</td>
		</tr></table>
		<br>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
		<br>
		<br>
		<br>
        <div class="table-responsive">
	
            <?php if(mysqli_num_rows($res) == 0)
				echo "NO Subjects to show!!";
			else { ?>
			
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
					<th>Faculty</th>
                    <th>Edit</th>
                    <th>Delete</th>
                     
                   </thead>
				<tbody> 
				
				<?php while($row=mysqli_fetch_assoc($res)) { ?>
				<tr>
					<td><?php echo $row['subject_code']; ?></td>
					<td><?php echo $row['subject_name']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<form method="POST" action="edit_faculty.php">
						<input type="hidden" name="class_id" value="<?php echo $id; ?>">
						<input type="hidden" name="subject_id" value="<?php echo $row['id']; ?>">
						<input type="hidden" name="branch" value="<?php echo $branch; ?>">
						<input type="hidden" name="subject_name" value="<?php echo $row['subject_name']; ?>">
						<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" type="submit"><span >EDIT</span></button></p></td>
					</form>
					<form method="POST" action="delete_subject.php" onsubmit="return del_confirm(this);">
						<input type="hidden" name="class_id" value="<?php echo $id; ?>">
						<input type="hidden" name="subject_id" value="<?php echo $row['id']; ?>">
						<input type="hidden" name="faculty_id" value="<?php echo $row['faculty_id']; ?>">
						<input type="hidden" name="type" value="single">
					<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span>DELETE</span></button></p></td>
					</form>
				</tr>
				<?php } ?>
				
				</tbody>
				</table>
		<br>
					<form method="POST" action="delete_subject.php" onsubmit="return del_confirm(this);">
						<input type="hidden" name="class_id" value="<?php echo $id; ?>">
						<input type="hidden" name="type" value="all">
						<button type="submit" class="btn btn-danger">DELETE ALL</button>
					</form>
		<br>
			<?php } ?>
		</div>
	</div>
</div>
	



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
