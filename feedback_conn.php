<?php
$user = $_POST['username'];
$pass = $_POST['password'];
$url = "http://feedback.ietdavv.edu.in/LoginServlet";
	$fields = 'login_type=faculty&username='.$user.'&password='.$pass;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$r = curl_exec($ch);
	if($r === FALSE)
		die('Curl failed: '.curl_error($ch));
	curl_close($ch);
	//echo $r;
?>