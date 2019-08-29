<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/src/Exception.php';
require '../mail/src/PHPMailer.php';
require '../mail/src/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';
require_once '../conn_iet.php';

$message = $_REQUEST['message'];
$id = $_REQUEST['id'];
$type = $_REQUEST['type'];
if ($type == 'Faculty' )
	{ $result=mysqli_query($conn,"select name from faculty_table where id=$id");
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $name=$row['name'];
           $result->close();
	$message= $name."  ".$message." ".$id;  
	}
else if ($type == 'Student')
	{ $result=mysqli_query($conn,"select name from student_table where id=$id");
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $name=$row['name'];
           $result->close();
	 $message = $name."  ".$message." ".$id;	
	}

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
  	 							 //$message='tested succesfully';	
    $id='aanuj111@gmail.com';
   
    $mail->SMTPDebug = 0;                                	 // Enable verbose debug output
    $mail->isSMTP();                                     	 // Set mailer to use SMTP
    $mail->Host = 'smtp.elasticemail.com';  			 // Specify main and backup SMTP servers                            	 // Enable SMTP authentication
    $mail->Username = $id;                   // SMTP username
    $mail->Password = '888de78d-e4a9-48f4-a542-765ce3c521c4';    // SMTP password
    $mail->Port = 2525;                                 	// TCP port to connect to 465 ssl  587 tls
    $mail->SMTPSecure = 'tls';								// $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    // $mail->SMTPSecure = false;


    //Recipients
    $mail->setFrom($id, 'Feedback Report');
    $mail->addAddress('15bcs157@ietdavv.edu.in', 'anuj');     // Add a recipient
    // $mail->addAddress('aanuj111@gmail.com');               // Name is optional
    $mail->addReplyTo($id, 'feedback');
   // $mail->addCC('cc example.com');
   // $mail->addBCC('bcc example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Feedback Report';
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    echo 'Feedback Submitted Succesfully';
} catch (Exception $e) {
    echo 'Feedback cannot be submitted ', $mail->ErrorInfo;
}
