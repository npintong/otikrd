<?php

session_start();

if(isset($_POST)){

	require_once('config.inc.php');
	require_once('common.class.php');

	$id = $_REQUEST['id'];
	$mode = $_REQUEST['mode'];

	switch ($mode) {
		case "disable":
				$tSQL = "DELETE FROM tbl_master_radcheck WHERE username='".$id."';";				
				$tSQL2 = "DELETE FROM tbl_master_radusergroup WHERE username='".$id."';";
				$utSQL = "UPDATE tbl_trans_account SET acStatus='0' WHERE acUser='".$id."';";
		break;
		case "enable":				
				$tSQL =	"INSERT INTO tbl_master_radcheck(username,attribute,op,value) SELECT (acUser) username,('Cleartext-Password') attribute,(':=') op,(acPasswd) value FROM tbl_trans_account WHERE acUser = '$id';";				
				$tSQL2 = "INSERT INTO tbl_master_radusergroup(username,groupname,priority) SELECT (acUser) as username, (pfID) as groupname,('8') as priority FROM tbl_trans_account WHERE acUser = '$id';";
				$utSQL = "UPDATE tbl_trans_account SET acStatus='1' WHERE acUser='".$id."';";
		break;
	}

	if($mcon->query($tSQL)){		
		$mcon->query($tSQL2);
		$mcon->query($utSQL);


		echo "<script>\n";
		echo "    alert(\"ดำเนินการสำเร็จ\");\n";
		echo "</script>\n";

	}

	$mcon->close();

}
?>