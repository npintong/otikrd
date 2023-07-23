<?php

echo "<meta charset=\"UTF-8\" />";

//var_dump($_POST);

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
			NasIdentity,
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
			'".$mcon->real_escape_string($_POST['nasname'])."',
			'".$mcon->real_escape_string($_POST['shortname'])."',
			'".$mcon->real_escape_string($_POST['type'])."',
			'".$mcon->real_escape_string($_POST['ports'])."',
			'".$mcon->real_escape_string($_POST['secret'])."',
			'".$mcon->real_escape_string($_POST['tIPAddress'])."',
			'".$mcon->real_escape_string($_POST['community'])."',
			'".$mcon->real_escape_string($_POST['description'])."',
			'".$mcon->real_escape_string($_POST['tSiteName'])."',
			'".$mcon->real_escape_string($_POST['tNasIdentity'])."',
			'".$mcon->real_escape_string($_POST['tHotSpotName'])."',
			'".$mcon->real_escape_string($_POST['tCheckKickInterval'])."',
			'".$mcon->real_escape_string($_POST['tGPS1'])."',
			'".$mcon->real_escape_string($_POST['tGPS2'])."',
			'".$mcon->real_escape_string($_POST['tContact'])."',
			'".$mcon->real_escape_string($_POST['tPhone'])."',
			'".$mcon->real_escape_string($_POST['temail'])."',
			'".$mcon->real_escape_string($_POST['tstatus'])."'
		)
		";

echo $tSQL;
		
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

?>