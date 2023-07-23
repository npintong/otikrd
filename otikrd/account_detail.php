<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>OTIKRD - ระบบศูนย์กลางผู้ใช้งาน</title>
    <meta charset="UTF-8" />
  </head>
  <body>
<?php


if(isset($_REQUEST['id'])){
	require_once('config.inc.php');
	$tSQL = "select * from tbl_master_radacct where username='".$_REQUEST['id']."' order by acctstarttime asc;";
	$rs = $mcon->query($tSQL);
	$numrows = $rs->num_rows;

	echo "<strong>User Name :" . $_REQUEST['id'] . "Date Time : ".date("Y-m-d H:i:s")."</strong>";
?>

<table width="100%" border="1px">
	<tr style="background-color: yellow;">
		<td>NO</td>
		<td>Start Time Access</td>
		<td>Stop Time Access</td>
		<td>IP Address</td>
		<td>Type Access</td>
		<td>Station</td>
		<td>Macc Address</td>
		<td>Time Usage</td>
	</tr>

<?php 

	if($numrows==0){
?>

	<tr>
		<td colspan="8" style="text-align:center;">Not found</td>
	</tr>


<?php
	}

	$no = 1;
	while($rows = $rs->fetch_assoc()){
		$StartTimeAccess = $rows['acctstarttime'];
		$StopTimeAccess = $rows['acctstoptime'];
		$IPAddress = $rows['nasipaddress'];
		$TypeAccess = $rows['nasporttype'];
		$Station = $rows['calledstationid'];
		$MacAddress = $rows['callingstationid'];
		$TimeUsage = $rows['acctsessiontime'];

?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $StartTimeAccess; ?></td>
		<td><?php echo $StopTimeAccess; ?></td>
		<td><?php echo $IPAddress; ?></td>
		<td><?php echo $TypeAccess; ?></td>
		<td><?php echo $Station; ?></td>
		<td><?php echo $MacAddress; ?></td>
		<td><?php echo $TimeUsage; ?></td>
	</tr>

<?php	
}
?>
<table>
<?php

}else{
	echo "not found";
}

$mcon->close();