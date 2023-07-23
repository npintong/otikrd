<?php

session_start();

if(isset($_POST)){

	require_once('config.inc.php');
	require_once('common.class.php');

	if($mcon->query("delete from tbl_trans_account where acUser='".$_REQUEST['id']."';")){
		$mcon->query("delete from tbl_master_radusergroup where username='".$_REQUEST['id']."';");
		echo "<script>\n";
		echo "    alert(\"ลบรายการเรียบร้อย\");\n";
		echo "</script>\n";
	}else{
		echo "<script>\n";
		echo "    alert(\"ไม่สามารถลบรายการได้\");\n";
		echo "</script>\n";
	}
}
?>