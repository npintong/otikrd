<?php
	session_start();
	
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Print Vouchers</title>
<style>
@media print {
.noprint {
display: none;
}
.pagebreak {
page-break-after: always;
}
}
</style></head>
<body>

<?php

include_once('function.php');


if(isset($_POST['data'])){

	$cnt = count($_POST['data']);
	
	$_SESSION['pdata'] = array();
	
	for($i=0; $i<$cnt;$i++){
		$a = $_POST['data'][$i];
	
		array_push($_SESSION['pdata'],$a);
	}
	
}

if(isset($_SESSION['pdata'])){
	
	$cnt_ar = is_array($_SESSION['pdata']) ? count($_SESSION['pdata']) : 0;
	$condition = "";

	for($i=0;$i<$cnt_ar;$i++){

		if($i <> $cnt_ar-1){
			$condition .= "'".$_SESSION['pdata'][$i]."',";
		}else{
			$condition .= "'".$_SESSION['pdata'][$i]."'";
		}
	}
		require_once('config.inc.php');
		
		$tSQL = "SELECT a.acUser,a.acPassWd,b.pfName,b.pfSpeedLimitUp,b.pfSpeedLimitDown,b.pfPrice,b.pfValidity,b.pfUptime FROM tbl_trans_account as a inner join tbl_master_profiles b on a.pfID=b.pfID WHERE a.acUser IN(".$condition.");";
		$rs = $mcon->query($tSQL);
		
		while($row = $rs->fetch_assoc()){

			echo "<table style=\"display: inline-block; width: 250px; border: 1px solid #ccc; line-height: 110%; font-family: arial; font-size: 12px; margin: 1px;\">\n"; 
			echo "<tbody>\n"; 
			echo "<tr>\n"; 
			echo "<td style=\"text-align: center; color: red; font-size: 13px; border-bottom: 1px #ccc solid;\"><b>+BIG CO-WORKING+</b></td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td>\n"; 
			echo "<table style=\" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 11px;\">\n"; 
			echo "<tbody>\n"; 
			echo "<tr style=\"background-color: #eee;\">\n"; 
			echo "<td style=\"background-color: #fff; width: 33%\"><b>PLAN</b></td>\n"; 
			echo "<td style=\"width: 33%\">Up</td>\n"; 
			echo "<td style=\"width: 33%\">Down</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td ><b>".$row['pfName']."</b></td>\n"; 
			echo "<td style=\"color: #fff;\">".$row['pfSpeedLimitUp']."</td>\n"; 
			echo "<td style=\"color: #fff;\">".$row['pfSpeedLimitDown']."</td>\n"; 
			echo "</tr>\n"; 
			echo "</tbody>\n"; 
			echo "</table>\n"; 
			echo "</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td>\n"; 
			echo "<table style=\" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 11px;\">\n"; 
			echo "<tbody>\n"; 
			echo "<tr style=\"background-color: #eee;\">\n"; 
			echo "<td style=\"width: 33%\">Time Limit</td>\n"; 
			echo "<td style=\"width: 33%\">Uptime</td>\n"; 
			echo "<td style=\"width: 33%\">Price</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td>".UpTime($row['pfUptime'])."</td>\n"; 
			echo "<td>".dValidity($row['pfValidity'])."</td>\n"; 
			echo "<td>".$row['pfPrice']."</td>\n"; 
			echo "</tr>\n"; 
			echo "</tbody>\n"; 
			echo "</table>\n"; 
			echo "</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td>\n"; 
			echo "<table style=\" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 12px; border-top: 1px solid #ccc;\">\n"; 
			echo "<tbody>\n"; 
			echo "<tr style=\"color: red; font-size: 11px;\">\n"; 
			echo "<td style=\"width: 50%\">Username</td>\n"; 
			echo "<td>Password</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr style=\"background-color: #fff;\">\n"; 
			echo "<td style=\"color: #888eee; border: 1px #ccc solid;\">".$row['acUser']."</td>\n"; 
			echo "<td style=\"color: #888; border: 1px #ccc solid;\">".$row['acPassWd']."</td>\n"; 
			echo "</tr>\n"; 
			echo "</tbody>\n"; 
			echo "</table>\n"; 
			echo "</td>\n"; 
			echo "</tr>\n"; 
			echo "<tr>\n"; 
			echo "<td style=\"text-align: center; font-size:11px;\">www.bigcoworking.space</td>\n"; 
			echo "</tr>\n"; 
			echo "</tbody>\n"; 
			echo "</table>\n";
		
		}

}

?>

</body></html>