<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$username=$_POST['username'];
$password=$_POST['password'];
$id=-1;
	$ldap_host = "117.239.195.151";

	// active directory DN (base location of ldap search)
	$ldap_dn = "dc=ietdavv,dc=edu,dc=in";
    $user='uid='.$username.",ou=users,".$ldap_dn;

	// active directory user group name
	$ldap_user_group = "faculty";
	// active directory manager group name
	//$ldap_manager_group = "WebManagers";

	// domain, for purposes of constructing $user
	#$ldap_usr_dom = '@college.school.edu';

	// connect to active directory
	$ldap = ldap_connect($ldap_host);

	// configure ldap params
	ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
	ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);

	// verify user and password
	if($bind = @ldap_bind($ldap, $user, $password)) {
		// valid
		// check presence in groups
		$filter = "(member=".$user.")";
		$attr = array("member");
		$result = ldap_search($ldap, "cn=faculty,".$ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);

		foreach($entries[0]['member'] as $grps) {
			if($grps == $user) {
				$filter1 = "(sn=*)";
				$attr1 = array("sn","employeenumber","mail");
				$result1 = ldap_search($ldap, $user, $filter1, $attr1) or exit("Unable to search LDAP server");
				$entries1 = ldap_get_entries($ldap, $result1);
				$id = $entries1[0]['employeenumber'][0];
				$name = $entries1[0]['sn'][0];
				$email = $entries1[0]['mail'][0];
				//echo $name.$email;
				break;
				/*echo json_encode($entries1);
				echo $id;*/
			}
		}
		if($id == -1) {
			$filter = "(memberUid=".$username.")";
			$attr = array("memberUid");
			$result = ldap_search($ldap, "cn=guestfaculty,".$ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
			$entries = ldap_get_entries($ldap, $result);
			#echo json_encode($entries);
			foreach($entries[0]['memberuid'] as $grps) {
			if($grps == $username) {
				$filter1 = "(sn=*)";
				$attr1 = array("sn","employeenumber","mail");
				$result1 = ldap_search($ldap, $user, $filter1, $attr1) or exit("Unable to search LDAP server");
				$entries1 = ldap_get_entries($ldap, $result1);
				$id = $entries1[0]['employeenumber'][0];
				$name = $entries1[0]['sn'][0];
				$email = $entries1[0]['mail'][0];
				break;
				/*echo json_encode($entries1);
				echo $id;*/
			}
		}
		}
		ldap_unbind($ldap);

		/*foreach($entries1[0]['dn'] as $grps) {
			if($grps == $user)
				echo $grps;
		}*/

		// check groups
		//echo json_encode($entries1);
		//if($entries[0]['userPassword'][0]==$password)
		/*foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }

			// is user
			if(strpos($grps, $ldap_user_group)) $access = 1;
		}

		if($access != 0) {
			// establish session variables
			$_SESSION['user'] = $user;
			$_SESSION['access'] = $access;
		} else {
			// user has no rights
		}*/
		//echo "success";
		//else echo "failed";
	} /*else {
		//echo "error";
		$id = -1;
	}*/

?>
