<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$db_name = "demo_db";

$mysql_username = "root";

$mysql_password = "lostworld";

$server_name = "localhost";

$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
require 'conn_firebase.php';
$msg='';
if(is_uploaded_file($_FILES['file']['tmp_name']))
{
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
			$branch = '';
			$val = '';
			$file = fopen("/var/lib/mysql-files/temp_storage/temp.csv",'w');
            while(($line = fgetcsv($csvFile)) !== FALSE){
				if($line[0] == 'Course' || $line[0] == 'Name' || $line[0] == 'Roll_no' || $line[0] == 'Enroll_no' || $line[0] == 'Branch' || $line[0] == 'Semester'
					|| $line[0] == 'Section')
					$flag = false;
				if(!$flag) {
					for($i=0;$i<7;$i++) {
						switch($line[$i]) {
							case 'Name':
								$col[3] = $i;
								break;
							case 'Enroll_no':
								$col[2] = $i;
								break;
							case 'Roll_no':
								$col[1] = $i;
								break;
							case 'Course':
								$col[0] = $i;
								break;
							case 'Branch':
								$j = $i;
								break;
							case 'Semester':
								$k = $i;
								break;
							case 'Section':
								$col[4] = $i;
								break;
						}
					}
					$flag = true;
				}
				else {
					switch($line[$j]) {
						case 'CIVIENG_FT':
							$branch = 'Civil Engineering';
							break;
						case 'COMPENG_FT':
							$branch = 'Computer Engineering';
							break;
						case 'ECIENG_FT':
							$branch = 'Electronics & Instrumentation';
							break;
						case 'ECTELEG_FT':
							$branch = 'Electronics & Telecommunications';
							break;
						case 'ITENG_FT':
							$branch = 'Information Technology';
							break;
						case 'MECHENG_FT':
							$branch = 'Mechanical Engineering';
							break;
						case 'CESPSE':
							$branch = 'Computer Engineering SE';
							break;
						case 'EESPDC':
							$branch = 'Electronics & Telecommunications DC';
							break;
						case 'IEM':
							$branch = 'Mechanical Engineering IEM';
							break;
						case 'ITSPIS':
							$branch = 'Information Technology nanoscience IS';
							break;
						case 'MESPTDE':
							$branch = 'Mechanical Engineering TM';
							break;
						case 'EESPDI':
							$branch = 'Electronics & Instrumentation DI';
							break;
						case 'AM':
							$branch = 'Applied Science';
							break;
					}
					switch($line[$k]) {
						case '1SEM':
						case '2SEM':
							$year = 1;
							break;
						case '3SEM':
						case '4SEM':
							$year = 2;
							break;
						case '5SEM':
						case '6SEM':
							$year = 3;
							break;
						case '7SEM':
						case '8SEM':
							$year = 4;
							break;
					}
					if(!$line[$col[4]]) {
						if(strpos($line[$col[0]],"SC") > 0)
							$array = substr($line[$col[0]],0,3).','.$branch.','.$year.',,'.$line[$col[1]].','.$line[$col[2]].','.$line[$col[3]].',';
						else
							$array = substr($line[$col[0]],0,2).','.$branch.','.$year.',,'.$line[$col[1]].','.$line[$col[2]].','.$line[$col[3]].',';
					}
					else {
						if(strpos($line[$col[0]],"SC") > 0)
							$array = substr($line[$col[0]],0,3).','.$branch.','.$year.','.$line[$col[4]].','.$line[$col[1]].','.$line[$col[2]].','.$line[$col[3]].',';
						else
							$array = substr($line[$col[0]],0,2).','.$branch.','.$year.','.$line[$col[4]].','.$line[$col[1]].','.$line[$col[2]].','.$line[$col[3]].',';
					}
					fwrite($file,$array);
					fwrite($file,PHP_EOL);
					//echo $query.'\n';
				}
			}
			//$res = fputcsv($file,$array,',');
			$result = mysqli_query($conn,"LOAD DATA INFILE '/var/lib/mysql-files/temp_storage/temp.csv' IGNORE INTO TABLE temp_student_table COLUMNS TERMINATED BY ',';");
			if($result) {
				$res = mysqli_query($conn,"INSERT INTO student_table (class_id,roll_no,enroll_no,name) select id,roll_no,enroll_no,name from temp_student_table t,class_table c where t.course=c.course and t.branch=c.branch and t.year=c.year and t.section=c.section ON duplicate key update roll_no=VALUES(roll_no);");
				if($res) {
					$r = mysqli_query($conn,"INSERT IGNORE INTO attendance_table (schedule_id,student_id) SELECT h.id,s.id FROM student_table s,schedule_table h,class_table c WHERE c.id=h.class_id AND h.id=s.class_id AND h.batch=s.batch;");
					if($r)
						$msg="Details saved successfully";
						$c = mysqli_query($conn,"delete from temp_student_table");
				}
			}
	if($msg == '')
		$msg="Error! Please try again";
	else {
		$rs = mysqli_query($conn,"select token from firebase_tokens;");
		$tokens = array();
		if(mysqli_num_rows($rs) > 0) {
			while($rw = mysqli_fetch_assoc($rs))
				$tokens[] = $rw['token'];
		}
		$message = array('message'=>'Student list updated. Please sync!!');
		send_notification($tokens,$message);
		//echo $msg;
	}
}
else $msg = "No file uploaded!!";
?>


<html>
<head>
<title>Admin</title>
</head>
<body>
<script>
alert("<?php echo $msg; ?>");
window.location.href = "admin_panel.php";
</script>
</body>
</html>