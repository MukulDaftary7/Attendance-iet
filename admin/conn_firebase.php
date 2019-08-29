<?php

function send_notification($tokens,$message) {
	$url = "https://fcm.googleapis.com/fcm/send";
	$fields = array('registration_ids'=>$tokens,'data'=>$message);
	$headers = array('Authorization: key=AAAAPXVRt0k:APA91bFyB-5w6vMvnh7cSW6kbn404OYDJ8x30RDwdMIg8wTJLJI25tLrDr-48DNj2m49y7srxXqf8QBAG2qjfXratAC9KWmM9a9b3y0EaiaHjOJRjhEhUdf5aI_UkcKJLk2MPtQgyWqt'
					,'Content-Type: application/json');
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
	$r = curl_exec($ch);
	if($r === FALSE)
		die('Curl failed: '.curl_error($ch));
	curl_close($ch);
	//echo $r;
}

?>