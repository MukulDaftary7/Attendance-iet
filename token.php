<?php
$token=base64_encode(base64_encode(base64_encode($_POST['password'])));
$result2=mysqli_query($conn,"update faculty_login_table set password='$token' where id=$id;");
?>