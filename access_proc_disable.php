<?php

session_start();

if(isset($_POST)){

	require_once('config.inc.php');
	require_once('common.class.php');

	$id = $_REQUEST['id'];
	$mode = $_REQUEST['mode'];

	switch ($mode) {
		case "enable":
		$tSQL = "INSERT INTO tabl_master_radcheck(username,attribute,op,value)VALUES('".$id."','Auth-Type',':=','Reject');";
		break;
		case "disable":
		$tSQL = "DELETE FROM tabl_master_radcheck WHERE username='".$id."' AND attribute='Auth-Type' AND value='Reject';";
		break;
	}

	if($mcon->query($tSQL)){
		echo "<script>\n";
		echo "    alert(\"บันทึกรายการเรียบร้อย\");\n";
		echo "</script>\n";
	}

	$mcon->close();

}
?>