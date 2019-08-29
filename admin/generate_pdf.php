<?php

session_start();
require('mysql_table.php');
require('../conn_iet.php');
$sch_id=$_GET['schedule'];

class PDF extends PDF_mysql_Table
{
function Header()
{
	//Title
	//Ensure table header is output
	$this->SetLineWidth(0.4);
	$this->Rect(2,2,$this->GetPageWidth()-4,$this->GetPageHeight()-4);
	$this->Rect(2.7,2.7,$this->GetPageWidth()-5.4,$this->GetPageHeight()-5.4);
	$this->SetLineWidth(0.2);
	if($this->PageNo()>1)
		$this->Ln();
	parent::Header();
}
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',6);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}

//Connect to database
$result=mysqli_query($conn,"select * from schedule_table where id=$sch_id");
$r=mysqli_fetch_assoc($result);
$class_id=$r['class_id'];
$sub_id=$r['subject_id'];
$lec_no=$r['last_lecture_no'];
$month=substr($r['last_lecture_date'],5,2);
$year=substr($r['last_lecture_date'],0,4);
$result=mysqli_query($conn,"select * from class_table where id=$class_id");
$row=mysqli_fetch_assoc($result);
$course=$row['course'];
$branch=$row['branch'];
$yr=$row['year'];
$section=$row['section'];
$result=mysqli_query($conn,"select name from faculty_table,faculty_subject_table where id=faculty_id and subject_id=$sub_id and class_id=$class_id");
$row=mysqli_fetch_assoc($result);
$fac_name=$row['name'];
$result=mysqli_query($conn,"select * from subject_table where id=$sub_id");
$row=mysqli_fetch_assoc($result);
$sub_name=$row['subject_name'];
$code=$row['subject_code'];

asort($r);
$i=1;
$cols = '';
foreach($r as $key=>$value) {
	if($value == null || $key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') 
		continue;
	$sh['l'.$i] = $value;
	$cols .= $key." as 'l".$i."',";
	$i++;
}

if($lec_no>20){
	$pdf=new PDF('L','mm','A4');
	$w=6;
}
else {
	$pdf=new PDF('P','mm','A4');
	$w=7;
}
$pdf->AddPage();
$pdf->SetMargins(3,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,4,$course.' '.$branch.' '.$yr.'-Year '.$section,0,1,'C');
$pdf->Cell(0,4,'Faculty : '.$fac_name,0,1,'C');
$pdf->Cell(0,4,'Subject : '.$sub_name.'('.$code.')',0,1,'C');
if($month<='06')
	$pdf->Cell(0,4,'Session : Jan-Apr '.$year,0,1,'C');
else $pdf->Cell(0,4,'Session : Jul-Nov '.$year,0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,'Total Lectures : '.$lec_no,0,1,'C');
$pdf->Ln();
$pdf->AddCol('roll_no',10,'Roll No','C');
$pdf->AddCol('name',26,'','C');
for($i=1;$i<=$lec_no;$i++) 
	$pdf->AddCol('l'.$i,$w,substr($sh['l'.$i],8,2).'/'.substr($sh['l'.$i],5,2),'C');
$pdf->AddCol('present_no',7,'Total','C');
$pdf->AddCol('0',5,'%','C');
//First table: put all columns automatically
$pdf->Table("select roll_no,name,".$cols."present_no,0 from student_table s,attendance_table a where a.schedule_id=$sch_id and class_id=$class_id and s.id=a.student_id order by s.roll_no",$lec_no,$conn);
/*$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('id',10,'','C');
$pdf->AddCol('course',20,'','C');
$pdf->AddCol('branch',60,'');
$pdf->AddCol('year',20,'','C');
$pdf->AddCol('section',20,'C');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table('select * from class_table',$prop);*/
$pdf->Output();
?>
