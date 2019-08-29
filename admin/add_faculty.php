<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require '../conn_iet.php';
$name = $_POST['faculty_name'];
$branch = $_POST['branch_fac'];
$designation = $_POST['designation'];
$type = $_POST['fac_type'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($conn,"select max(id) as id from faculty_table;");
$rw = mysqli_fetch_assoc($data);
$id = $rw['id'] + 1;

$ds = ldap_connect("117.239.195.151");  // assuming the LDAP server is on this host

if ($ds) {
    ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
    ldap_set_option($ds,LDAP_OPT_REFERRALS,0);
    // bind with appropriate dn to give update access
    $r = @ldap_bind($ds, "cn=admin,dc=ietdavv,dc=edu,dc=in", "lostworld");
    /*if($r)
        echo "binded";
    else echo "try again";*/
    // prepare data
    $info["cn"] = $username;
    $info["sn"] = $name;
    $info["objectclass"][0] = "inetOrgPerson";
    $info["objectclass"][1] = "top";
    $info["objectclass"][2] = "pwmUser";
    $info["employeenumber"] = $id;
    $info["mail"] = $email;
    $info["uid"] = $username;
    $info["userpassword"] = $password;

    $dname = "uid=".$username.",ou=users,dc=ietdavv,dc=edu,dc=in";

    // add data to directory
    $r = ldap_add($ds, $dname, $info);
    if($r) {
    	if($type == 'Permanent'){
        	$dn = "cn=faculty,dc=ietdavv,dc=edu,dc=in";
        	$entry['member'] = $dname;
    	}
        else if($type == 'Guest') {
        	$dn = "cn=guestfaculty,dc=ietdavv,dc=edu,dc=in";
        	$entry['memberUid'] = $username;
        }

        if(ldap_mod_add($ds, $dn, $entry)) {
        	$result = mysqli_query($conn,"insert into faculty_table (id,name,branch,designation,email) values ($id,'$name','$branch','$designation','$email')");
			
			if($result) {
				$res = mysqli_query($conn,"insert into faculty_login_table(id,username,password,pass) select id,'$username','$password','$password' from faculty_table where name='$name' and branch='$branch' and 
						designation='$designation' and email='$email'");
				if($res) {
					$conf = mysqli_connect('10.82.190.5', 'attendance', 'attendance', 'feedback_system', '3307');
					if(!$conf) {
						$msg = "Error! Please try again";
					}
					else {
						$name = trim($name);
						$first_name = substr($name, 0, strpos($name,' '));
						$last_name = substr($name, strpos($name, ' ')+1, strlen($name));
						$feedback = mysqli_query($conf,"insert into faculty_table(id,first_name,last_name,designation,email,department_id) values($id,'$first_name','$last_name','$designation','$email',2);");
						$login = mysqli_query($conf,"insert into login_table(username,password,type,faculty_id) values('$username','$password','faculty',$id);");
						mysqli_close($conf);
						$conm = mysqli_connect('10.82.190.3', 'attendance', 'attendance', 'finaldb', '3307');
						if(!$conm) {
							$msg = "Error! Please try again";
						}
						else {
							$marks = mysqli_query($conm,"insert into faculty_table(id,first_name,last_name,designation,email) values($id,'$first_name','$last_name','$designation','$email');");
							$login = mysqli_query($conm,"insert into login_table(username,password,type,faculty_id) values('$username','$password','faculty',$id);");
							$msg = "Details saved successfully!!";
							mysqli_close($conm);
						}
					}
				}
				else $msg = "Error! Please try again";
			}
			else $msg = "Error! Please try again";
        }
        else $msg = "Error! Please try again";
    }
    else $msg = "Error! Please try again";

    ldap_close($ds);
} else {
    echo "Unable to connect to LDAP server";
}

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