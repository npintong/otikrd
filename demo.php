<?php

session_start();

 
	
if(isset($_POST['data'])){
	require_once('config.inc.php');
	
	$cnt = count($_POST['data']);
	$condition = "";
	
	for ($i=0 ;$i<$cnt;$i++){
		if($i != $cnt-1){
			$condition .= "'".$_POST['data'][$i]."',";
		}else{
			$condition .= "'".$_POST['data'][$i]."'";
		}
		
	}
	
	 	 
	//acUser
	$tSQL = "SELECT * FROM tbl_trans_account WHERE acUser IN(".$condition.");"; 
 
	$rs = $mcon->query($tSQL);
	 $_SESSION["tbl_trans_account"] = null;
	$i=0;
		while($row = $rs->fetch_assoc())
	{
		
		 $_SESSION['tbl_trans_account']['acUser'][$i]=$row['acUser'];
		  $_SESSION['tbl_trans_account']['acPassWd'][$i]=$row['acPassWd'];
		 $i=$i+1;
		  
	}
	 

	//while($row = $rs->fetch_assoc())
	//{
	//	echo $row['acUser'];
	//	echo "</br/>";
	//}
	echo '1';
	$mcon->close();
}else{
	
	if(isset($_SESSION['tbl_trans_account'])){
	print_r($_SESSION['tbl_trans_account']);
	 unset($_SESSION['tbl_trans_account']);
}
}
 

	 
 
 
 
?>