<?php

echo "<meta charset=\"UTF-8\" />";

if(isset($_POST['btnCreate'])){

require_once("config.inc.php");

$tSQL = "
		INSERT INTO tbl_master_nas 
		(				
			nasname,
			shortname,
			type,
			ports,
			secret,
			server,
			community,
			description,
			SiteName,
			Nasidentity,
			HotSpotName,
			CheckKickInterval,
			GPS1,
			GPS2,
			Contact,
			Phone,
			email,
			status
		)
		VALUES
		(				
			'".$mcon->real_escape_string($_POST['tSiteName'])."',
			'".$mcon->real_escape_string($_POST['tNasidentity'])."',
			'".$mcon->real_escape_string($_POST['tType'])."',
			'".$mcon->real_escape_string($_POST['tPorts'])."',
			'".$mcon->real_escape_string($_POST['tSecret'])."',
			'".$mcon->real_escape_string($_POST['tServer'])."',
			'".$mcon->real_escape_string($_POST['tDescription'])."',
			'".$mcon->real_escape_string($_POST['tDescription'])."',
			'".$mcon->real_escape_string($_POST['tSiteName'])."',
			'".$mcon->real_escape_string($_POST['tNasidentity'])."',
			'".$mcon->real_escape_string($_POST['tHotspotName'])."',
			'".$mcon->real_escape_string($_POST['tCheckKickInterval'])."',
			'".$mcon->real_escape_string($_POST['tGPS1'])."',
			'".$mcon->real_escape_string($_POST['tGPS2'])."',
			'".$mcon->real_escape_string($_POST['tContact'])."',
			'".$mcon->real_escape_string($_POST['tPhone'])."',
			'".$mcon->real_escape_string($_POST['tEmail'])."',
			'".$mcon->real_escape_string($_POST['tStatus'])."'
		)
		";

		
if($mcon->query($tSQL)){
	echo '<script language="javascript">';
	echo 'alert("บันทึกรายการเรียบร้อย")';
	echo '</script>';
	echo '<meta http-equiv="refresh" content="0;url=router.php">';
}else{
	echo '<script language="javascript">';
	echo 'alert("ไม่สามารถบันทึกรายการได้")';
	echo '</script>';
	echo '<meta http-equiv="refresh" content="0;url=router.php">';
}

$mcon->close();

}
?>