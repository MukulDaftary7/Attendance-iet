<?php
require('mysql_table_full.php');
require('../conn_iet.php');
$class_id=$_POST['id'];
$from=$_POST['from'];
$to=$_POST['to'];

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetLineWidth(0.4);
	$this->Rect(2,2,$this->GetPageWidth()-4,$this->GetPageHeight()-4);
	$this->Rect(2.7,2.7,$this->GetPageWidth()-5.4,$this->GetPageHeight()-5.4);
	$this->SetLineWidth(0.2);
	if($this->PageNo()>1)
		$this->Ln();
	//Ensure table header is output
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

$result=mysqli_query($conn,"select * from class_table where id=$class_id");
$row=mysqli_fetch_assoc($result);
$course=$row['course'];
$branch=$row['branch'];
$yr=$row['year'];
$section=$row['section'];
$fac_id=$row['coordinator_id'];
$result=mysqli_query($conn,"select * from schedule_table where class_id=$class_id and batch=0");
$r=mysqli_fetch_assoc($result);
$col='';
$n=0;
do {
	$sub_id=$r['subject_id'];
	$sch_id=$r['id'];
	$res=mysqli_query($conn,"select subject_code from subject_table where id=$sub_id");
	$rw=mysqli_fetch_assoc($res);
	$col.="$n,";
	$lec=null;
	$l=1;
	while($l<=$r['last_lecture_no']) {
		$month=substr($r['last_lecture_date'],5,2);
		$year=substr($r['last_lecture_date'],0,4);
		if($r['l'.$l]>=$from && $r['l'.$l]<=$to)
			$lec[]=$l;
		$l++;
	}
	$lec_no=sizeof($lec);
	$cols[]=$rw['subject_code'].'('.$lec_no.')';
	$res=mysqli_query($conn,"select * from attendance_table,student_table where schedule_id=$sch_id and student_id=id and class_id=$class_id order by roll_no");
	while($rw=mysqli_fetch_assoc($res)) {
		$pr=0;
		for($k=0;$k<sizeof($lec);$k++) {
			if($rw['l'.$lec[$k]]==1)
				$pr++;
		}
	$p[]=$pr;
	}
	$present[]=$p;
	$p=null;
	$n++;
}while($r=mysqli_fetch_assoc($result));
$col=substr($col,0,sizeof($col)-1);
$result=mysqli_query($conn,"select name from faculty_table where id=$fac_id");
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$sem='';

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetMargins(3,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,4,$course.' '.$branch.' '.$yr.'-Year '.$section,0,1,'C');
$pdf->Ln();
if($month<='06') {
	$pdf->Cell(0,4,'Session : Jan-Apr '.$year,0,1,'C');
	$sem='e';
}
else {
	$pdf->Cell(0,4,'Session : Jul-Nov '.$year,0,1,'C');
	$sem='o';
}
switch($yr) {
	case 1:
	if($sem == 'o')
		$s=1;
	else $s=2;
	break;
	case 2:
	if($sem == 'o')
		$s=3;
	else $s=4;
	break;
	case 3:
	if($sem == 'o')
		$s=5;
	else $s=6;
	break;
	case 4:
	if($sem == 'o')
		$s=7;
	else $s=8;
	break;
}

$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,4,'Class Coordinator : '.$name,0,1,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->AddCol('roll_no',15,'Roll No','C');
$pdf->AddCol('name',35,'Name','C');
for($i=0,$j=1;$i<sizeof($cols);$i++,$j++)
	$pdf->AddCol("$j",18,$cols[$i],'C');
//First table: put all columns automatically
$pdf->Table("select roll_no,name,'$col' from student_table where class_id=$class_id order by roll_no",$conn,$present);
//Second table: specify 3 columns
$pdf->Ln(10);
$pdf->AddCol('subject_code',20,'Subject Code','C');
$pdf->AddCol('subject_name',80,'Subject Name','C');
$pdf->Table("select subject_code,subject_name from subject_table where course='$course' and branch='$branch' and semester=$s",$conn,null);
$pdf->Output();
?>
