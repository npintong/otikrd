<?php

	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}
	
	if(isset($_REQUEST['id'])){
		
		require_once('config.inc.php');
		
		$tSQL = "DELETE FROM tbl_master_administrator WHERE uUserName='".$_REQUEST['id']."';";
		
		if($mcon->query($tSQL)){
			
			echo '<meta http-equiv="refresh" content="0; url=configure.php?r=1" />';
			
		}else{
			echo '<meta http-equiv="refresh" content="0; url=configure.php?r=2" />';
		}
		
	}
	
?>
