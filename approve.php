<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
$current_time = date("Y-m-d H:i:s");
require_once("config.inc.php");

$tSQL = "
	INSERT INTO tbl_trans_account(
	pfID,acUser,acPassWd,tNote,acStatus,WhoCreate,DateCreate,WhoUpdate,DateUpdate
	)
	SELECT pfID,acUser,acPassWd,tNote,('1')acStatus,('system')WhoCreate,(NOW())DateCreate,('system')WhoUpdate,(NOW())DateUpdate 
	FROM tbl_temp_account WHERE acUser <> ''
";

$mcon->query($tSQL);

$tSQL = "
	INSERT INTO tbl_master_radcheck(
	username,attribute,op,value
	)
	SELECT (acUser)username,('Cleartext-Password')attribute,(':=')op,(acPassWd)value
	FROM tbl_temp_account WHERE acUser <> ''
";
$mcon->query($tSQL);

$tSQL = "
	INSERT INTO tbl_master_radusergroup(
	username,groupname,priority
	)
	SELECT (acUser)username,(pfID)groupname,(8)priority 
	FROM tbl_temp_account WHERE acUser <> ''
";
$mcon->query($tSQL);

$mcon->close();
