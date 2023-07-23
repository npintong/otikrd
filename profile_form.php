<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}

	
	$active = "profile";
	$cmdbutton = "btnconfirm";

	date_default_timezone_set('Asia/Bangkok');
	$current_time = date("Y-m-d H:i:s");
	
	// edit mode get data
	if(isset($_REQUEST['mode']) and isset($_REQUEST['id'])){
		require_once("config.inc.php");
		$cmdbutton = "btnEdit";
		if($_REQUEST['mode']=='edit'){
			$tSQL = "SELECT * FROM tbl_master_profiles WHERE pfID='".$_REQUEST['id']."' LIMIT 0,1;";
			$rs = $mcon->query($tSQL);
			while($row = $rs->fetch_assoc()) {
					$pfID = $row['pfID'];
					$pfName = $row['pfName'];
					$pfSpeedLimitUp = $row['pfSpeedLimitUp']; 
					$pfSpeedLimitDown = $row['pfSpeedLimitDown'];
					$pfAddressList = $row['pfAddressList']; 
					$pfUrlRedirect = $row['pfUrlRedirect']; 
					$pfShareUsers = $row['pfShareUsers'];
					$pfSessionTimout = $row['pfSessionTimout'];
					$pfIdleTimeout = $row['pfIdleTimeout']; 
					$pfUptime = $row['pfUptime']; 
					$pfValidity = $row['pfValidity']; 
					$pfStatus = $row['pfStatus']; 
					$pfPriority = $row['pfPriority'];
					$pfPrice = $row['pfPrice'];
			}
		}
	}
	
	if(isset($_POST['btnEdit'])){
		require_once("config.inc.php");
		$tSQL = "UPDATE tbl_master_profiles SET 
					pfName = '".$_REQUEST['pfName']."', 
					pfSpeedLimitUp = '".$_REQUEST['pfSpeedLimitUp']."', 
					pfSpeedLimitDown = '".$_REQUEST['pfSpeedLimitDown']."', 
					pfAddressList = '".$_REQUEST['pfAddressList']."', 
					pfUrlRedirect = '".$_REQUEST['pfUrlRedirect']."', 
					pfShareUsers = '".$_REQUEST['pfShareUsers']."',
					pfSessionTimout = '".$_REQUEST['pfSessionTimout']."', 
					pfIdleTimeout = '".$_REQUEST['pfIdleTimeout']."', 
					pfUptime = '".$_REQUEST['pfUptime']."', 
					pfValidity = '".$_REQUEST['pfValidity']."', 
					pfStatus = '".$_REQUEST['pfStatus']."', 					
					DateUpdate = NOW(),
					pfPriority = '".$_REQUEST['pfPriority']."',
					pfPrice = '".$_REQUEST['pfPrice']."'
					WHERE pfID='".$_REQUEST['pfID']."';
				";

				if($mcon->query($tSQL)){
					$mcon->query("delete from tbl_master_radgroupcheck where groupname='".$_REQUEST['pfID']."';");
					$mcon->query("delete from tbl_master_radgroupreply where groupname='".$_REQUEST['pfID']."';");	

					if($_REQUEST['pfStatus']=='1'){

						if($_REQUEST['pfSpeedLimitUp'] <> '' or $_REQUEST['pfSpeedLimitDown'] <> ''){

							if($_REQUEST['pfSpeedLimitUp'] == ''){
								$rate_limit = "0/".$_REQUEST['pfSpeedLimitDown'];	
							}else if($_REQUEST['pfSpeedLimitDown']==''){
								$rate_limit = $_REQUEST['pfSpeedLimitDown']."/0";	
							}else{
								$rate_limit = $_REQUEST['pfSpeedLimitUp']."/".$_REQUEST['pfSpeedLimitDown'];
							}

							$tSQL1 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Mikrotik-Rate-Limit', ':=', '".$rate_limit."');";
							$mcon->query($tSQL1);
						}

						if($_REQUEST['pfAddressList']<>''){
							$tSQL2 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Mikrotik-Address-List', ':=', '".$_REQUEST['pfAddressList']."');";
							$mcon->query($tSQL2);
						}

						if($_REQUEST['pfUrlRedirect']<>''){
							$tSQL3 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'WISPr-Redirection-URL', ':=', '".$_REQUEST['pfUrlRedirect']."');";
							$mcon->query($tSQL3);
						}

						if($_REQUEST['pfShareUsers']<>''){
							$tSQL4 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Port-Limit', ':=', '".$_REQUEST['pfShareUsers']."');";
							$mcon->query($tSQL4);
						}

						if($_REQUEST['pfSessionTimout']<>''){
							$tSQL5 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Session-Timeout', ':=', '".$_REQUEST['pfSessionTimout']."');";
							$mcon->query($tSQL5);
						}

						if($_REQUEST['pfIdleTimeout']<>''){
							$tSQL6 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Idle-Timeout', ':=', '".$_REQUEST['pfIdleTimeout']."');";
							$mcon->query($tSQL6);
						}

						if($_REQUEST['pfUptime']<>''){
							$tSQL7 = "INSERT INTO tbl_master_radgroupcheck (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Max-All-Session', ':=', '".$_REQUEST['pfUptime']."');";
							$mcon->query($tSQL7);
						}

						if($_REQUEST['pfValidity']<>''){
							$tSQL8 = "INSERT INTO tbl_master_radgroupcheck (groupname,attribute,op,value) VALUES ('".$_REQUEST['pfID']."', 'Expire-After', ':=', '".$_REQUEST['pfValidity']."');";
							$mcon->query($tSQL8);
						}

					}

				}
		

		echo '<script language="javascript">';
		echo 'alert("บันทึกรายการเรียบร้อยแล้ว")';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0;url=profile.php">';

	}


	// save mode new
	if(isset($_POST['btnconfirm'])){

		require_once("config.inc.php");

		$tSQL = "	INSERT INTO tbl_master_profiles (
					pfName, 
					pfSpeedLimitUp, 
					pfSpeedLimitDown, 
					pfAddressList, 
					pfUrlRedirect, 
					pfShareUsers,
					pfSessionTimout, 
					pfIdleTimeout, 
					pfUptime, 
					pfValidity, 
					pfStatus, 
					WhoCreate, 
					DateCreate, 
					WhoUpdate, 
					DateUpdate,
					pfPriority,
					pfPrice
					) VALUES(
					'".$mcon->real_escape_string($_REQUEST['pfName'])."',
					'".$mcon->real_escape_string($_REQUEST['pfSpeedLimitUp'])."',
					'".$mcon->real_escape_string($_REQUEST['pfSpeedLimitDown'])."', 
					'".$mcon->real_escape_string($_REQUEST['pfAddressList'])."',
					'".$mcon->real_escape_string($_REQUEST['pfUrlRedirect'])."',
					'".$mcon->real_escape_string($_REQUEST['pfShareUsers'])."',
					'".$mcon->real_escape_string($_REQUEST['pfSessionTimout'])."', 
					'".$mcon->real_escape_string($_REQUEST['pfIdleTimeout'])."', 
					'".$mcon->real_escape_string($_REQUEST['pfUptime'])."', 
					'".$mcon->real_escape_string($_REQUEST['pfValidity'])."', 
					'".$mcon->real_escape_string($_REQUEST['pfStatus'])."',
					'".$mcon->real_escape_string($_REQUEST['WhoCreate'])."', 
					'".$mcon->real_escape_string($current_time)."',
					'".$mcon->real_escape_string($_REQUEST['WhoUpdate'])."',
					'".$mcon->real_escape_string($current_time)."',
					'".$mcon->real_escape_string($_REQUEST['pfPriority'])."',
					'".$mcon->real_escape_string($_REQUEST['pfPrice'])."'
					);";
					
		if($mcon->query($tSQL)){
			$record_id = $mcon->insert_id;

			if($_REQUEST['pfStatus']=='1'){
				
				if($_REQUEST['pfSpeedLimitUp'] <> '' or $_REQUEST['pfSpeedLimitDown'] <> ''){

					if($_REQUEST['pfSpeedLimitUp'] == ''){
						$rate_limit = "0/".$_REQUEST['pfSpeedLimitDown'];	
					}else if($_REQUEST['pfSpeedLimitDown']==''){
						$rate_limit = $_REQUEST['pfSpeedLimitDown']."/0";	
					}else{
						$rate_limit = $_REQUEST['pfSpeedLimitUp']."/".$_REQUEST['pfSpeedLimitDown'];
					}
					
					$tSQL1 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'Mikrotik-Rate-Limit', ':=', '".$rate_limit."');";
					$mcon->query($tSQL1);
				}

				if($_REQUEST['pfAddressList']<>''){
					$tSQL2 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'Mikrotik-Address-List', ':=', '".$_REQUEST['pfAddressList']."');";
					$mcon->query($tSQL2);
				}
				
				if($_REQUEST['pfUrlRedirect']<>''){
					$tSQL3 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'WISPr-Redirection-URL', ':=', '".$_REQUEST['pfUrlRedirect']."');";
					$mcon->query($tSQL3);
				}

				if($_REQUEST['pfShareUsers']<>''){
					$tSQL4 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'Port-Limit', ':=', '".$_REQUEST['pfShareUsers']."');";
					$mcon->query($tSQL4);
				}

				if($_REQUEST['pfSessionTimout']<>''){
					$tSQL5 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'Session-Timeout', ':=', '".$_REQUEST['pfSessionTimout']."');";
					$mcon->query($tSQL5);
				}

				if($_REQUEST['pfIdleTimeout']<>''){
					$tSQL6 = "INSERT INTO tbl_master_radgroupreply (groupname,attribute,op,value) VALUES ('".$record_id."', 'Idle-Timeout', ':=', '".$_REQUEST['pfIdleTimeout']."');";
					$mcon->query($tSQL6);
				}

				if($_REQUEST['pfUptime']<>''){
					$tSQL7 = "INSERT INTO tbl_master_radgroupcheck (groupname,attribute,op,value) VALUES ('".$record_id."', 'Max-All-Session', ':=', '".$_REQUEST['pfUptime']."');";
					$mcon->query($tSQL7);
				}

				if($_REQUEST['pfValidity']<>''){
					$tSQL8 = "INSERT INTO tbl_master_radgroupcheck (groupname,attribute,op,value) VALUES ('".$record_id."', 'Expire-After', ':=', '".$_REQUEST['pfValidity']."');";
					$mcon->query($tSQL8);
				}

			}

			echo '<script language="javascript">';
			echo 'alert("บันทึกรายการเรียบร้อย")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=profile.php">';
		}else{
			echo '<script language="javascript">';
			echo 'alert("ไม่สามารถบันทึกรายการได้")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=profile.php">';
		}

		$mcon->close();

	}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>OTIKRD - ระบบศูนย์กลางผู้ใช้งาน</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Blue Moon - Responsive Admin Dashboard" />
    <meta name="keywords" content="Notifications, Admin, Dashboard, Bootstrap3, Sass, transform, CSS3, HTML5, Web design, UI Design, Responsive Dashboard, Responsive Admin, Admin Theme, Best Admin UI, Bootstrap Theme, Wrapbootstrap, Bootstrap, bootstrap.gallery" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/wysi/bootstrap-wysihtml5.css" rel="stylesheet">

    <link href="css/new.css" rel="stylesheet">

    <link href="fonts/font-awesome.min.css" rel="stylesheet">
	<!-- Drop down selector -->
	<link rel="stylesheet" href="css/bootstrap-select.min.css" />		
	
  </head>

  <body>

  
	<!-- Header Start -->
    <?php include_once('header.php'); ?>
	<!-- Header End -->

    <!-- Main Container start -->
    <div class="dashboard-container">

      <div class="container">
        <!-- Top Nav Start -->
        <?php include_once('menu.php'); ?>
        <!-- Top Nav End -->

        <!-- Sub Nav End -->
        <div class="sub-nav hidden-sm hidden-xs">
          <ul>
            <li><a href="" class="heading">แพ็คเกตอินเตอร์เน็ต</a></li>
          </ul>

        </div>
        <!-- Sub Nav End -->

        <!-- Dashboard Wrapper Start -->
        <div class="dashboard-wrapper">
          
        	<!-- Left Sidebar Start -->
        	<div class="left-sidebar">

        		<!-- Row Start -->
        		<div class="row gutter">
        			<div class="col-lg-12 col-md-12">
        				<div class="widget">
        					<div class="widget-header">
        						<div class="title">
        							กำหนดรายละเอียด
        							<span class="mini-title">Please fill your profile details </a></span>
        						</div>
        					</div>
        					<div class="widget-body">
        						<form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        							<div class="form-group">
        								<label for="userName" class="col-sm-3 control-label">ชื่อแพ็คเกต * </label>
        								<div class="col-sm-7">
        									<input type="hidden" name="pfID" value="<?=(( isset($pfID))?$pfID:'')?>">
        									<input type="text" class="form-control" id="pfName" name="pfName" value="<?=(( isset($pfName))?$pfName:'')?>" placeholder="Profile name">
        									<label style="color: #696a6d; margin-top: 10px;" id="lbName"><img src="img/help.png"> กำหนดชื่อ Profile เช่น NET-VIP</label>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="userName" class="col-sm-3 control-label">ราคาจำหน่าย * </label>
        								<div class="col-sm-7">
        									<input type="text" class="form-control" id="pfPrice" name="pfPrice" value="<?=(( isset($pfPrice))?$pfPrice:'')?>" placeholder="Price">
        									<label style="color: #696a6d; margin-top: 10px;" id="lbPrice"><img src="img/help.png"> ราคาจำหน่ายบัตร เช่น 199 บาท</label>
        								</div>
        							</div>


        							<div class="form-group">
        								<label for="pfSpeedLimitUp" class="col-sm-3 control-label">อัปโหลด</label>
        								<div class="col-sm-9">
        									<div class="row gutter">
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfSpeedLimitUp" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSpeedLimitUp" value="" id="pfSpeedLimitUp">                                
        												<?php

        												function xBox($x1='',$x2=''){
        													if($x1 == $x2){
        														return " selected";
        													}else{
        														return "";
        													}

        												}

        												?>

        												<option value="" <?=(( isset($pfPrice))?xBox('128k',$pfSpeedLimitUp):'')?>>Unlimited</option>
        												<option value="128k" <?=(( isset($pfPrice))?xBox('128k',$pfSpeedLimitUp):'')?>>128 Kbps</option>
        												<option value="256k" <?=(( isset($pfPrice))?xBox('256k',$pfSpeedLimitUp):'')?>>256 Kbps</option>
        												<option value="512k" <?=(( isset($pfPrice))?xBox('512k',$pfSpeedLimitUp):'')?>>512 Kbps</option>
        												<option value="1m" <?=(( isset($pfPrice))?xBox('1m',$pfSpeedLimitUp):'')?>>1 Mbps</option>
        												<option value="2m" <?=(( isset($pfPrice))?xBox('2m',$pfSpeedLimitUp):'')?>>2 Mbps</option>
        												<option value="3m" <?=(( isset($pfPrice))?xBox('3m',$pfSpeedLimitUp):'')?>>3 Mbps</option>
        												<option value="4m" <?=(( isset($pfPrice))?xBox('4m',$pfSpeedLimitUp):'')?>>4 Mbps</option>
        												<option value="5m" <?=(( isset($pfPrice))?xBox('5m',$pfSpeedLimitUp):'')?>>5 Mbps</option>
        												<option value="6m" <?=(( isset($pfPrice))?xBox('6m',$pfSpeedLimitUp):'')?>>6 Mbps</option>
        												<option value="7m" <?=(( isset($pfPrice))?xBox('7m',$pfSpeedLimitUp):'')?>>7 Mbps</option>
        												<option value="8m" <?=(( isset($pfPrice))?xBox('8m',$pfSpeedLimitUp):'')?>>8 Mbps</option>
        												<option value="9m" <?=(( isset($pfPrice))?xBox('9m',$pfSpeedLimitUp):'')?>>9 Mbps</option>
        												<option value="10m" <?=(( isset($pfPrice))?xBox('10m',$pfSpeedLimitUp):'')?>>10 Mbps</option>
        												<option value="15m" <?=(( isset($pfPrice))?xBox('15m',$pfSpeedLimitUp):'')?>>15 Mbps</option>
        												<option value="20m" <?=(( isset($pfPrice))?xBox('20m',$pfSpeedLimitUp):'')?>>20 Mbps</option>
        												<option value="25m" <?=(( isset($pfPrice))?xBox('25m',$pfSpeedLimitUp):'')?>>25 Mbps</option>
        												<option value="30m" <?=(( isset($pfPrice))?xBox('30m',$pfSpeedLimitUp):'')?>>30 Mbps</option>
        												<option value="35m" <?=(( isset($pfPrice))?xBox('35m',$pfSpeedLimitUp):'')?>>35 Mbps</option>
        												<option value="40m" <?=(( isset($pfPrice))?xBox('40m',$pfSpeedLimitUp):'')?>>40 Mbps</option>
        												<option value="45m" <?=(( isset($pfPrice))?xBox('45m',$pfSpeedLimitUp):'')?>>45 Mbps</option>
        												<option value="50m" <?=(( isset($pfPrice))?xBox('50m',$pfSpeedLimitUp):'')?>>50 Mbps</option>
        												<option value="55m" <?=(( isset($pfPrice))?xBox('55m',$pfSpeedLimitUp):'')?>>55 Mbps</option>
        												<option value="60m" <?=(( isset($pfPrice))?xBox('60m',$pfSpeedLimitUp):'')?>>60 Mbps</option>
        												<option value="70m" <?=(( isset($pfPrice))?xBox('70m',$pfSpeedLimitUp):'')?>>70 Mbps</option>
        												<option value="80m" <?=(( isset($pfPrice))?xBox('80m',$pfSpeedLimitUp):'')?>>80 Mbps</option>
        												<option value="90m" <?=(( isset($pfPrice))?xBox('90m',$pfSpeedLimitUp):'')?>>90 Mbps</option>
        												<option value="100m" <?=(( isset($pfPrice))?xBox('100m',$pfSpeedLimitUp):'')?>>100 Mbps</option>								
        											</select>
        											<label style="color: #696a6d; margin-top: 10px;" id="lbSpeedUpload"><img src="img/help.png"> ตั้งค่าดาวน์โหลด หรือค่า Rx เช่น 10 Mbps</label>
        										</div>
        									</div>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pfSpeedLimitDown" class="col-sm-3 control-label">ดาวน์โหลด</label>
        								<div class="col-sm-9">
        									<div class="row gutter">
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfSpeedLimitDown" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSpeedLimitDown" value="">                                
        												<option value="" <?=(( isset($pfPrice))?xBox('128k',$pfSpeedLimitDown):'')?>>Unlimited</option>
        												<option value="128k" <?=(( isset($pfSpeedLimitDown))?xBox('128k',$pfSpeedLimitDown):'')?>>128 Kbps</option>
        												<option value="256k" <?=(( isset($pfSpeedLimitDown))?xBox('256k',$pfSpeedLimitDown):'')?>>256 Kbps</option>
        												<option value="512k" <?=(( isset($pfSpeedLimitDown))?xBox('512k',$pfSpeedLimitDown):'')?>>512 Kbps</option>
        												<option value="1m" <?=(( isset($pfSpeedLimitDown))?xBox('1m',$pfSpeedLimitDown):'')?>>1 Mbps</option>
        												<option value="2m" <?=(( isset($pfSpeedLimitDown))?xBox('2m',$pfSpeedLimitDown):'')?>>2 Mbps</option>
        												<option value="3m" <?=(( isset($pfSpeedLimitDown))?xBox('3m',$pfSpeedLimitDown):'')?>>3 Mbps</option>
        												<option value="4m" <?=(( isset($pfSpeedLimitDown))?xBox('4m',$pfSpeedLimitDown):'')?>>4 Mbps</option>
        												<option value="5m" <?=(( isset($pfSpeedLimitDown))?xBox('5m',$pfSpeedLimitDown):'')?>>5 Mbps</option>
        												<option value="6m" <?=(( isset($pfSpeedLimitDown))?xBox('6m',$pfSpeedLimitDown):'')?>>6 Mbps</option>
        												<option value="7m" <?=(( isset($pfSpeedLimitDown))?xBox('7m',$pfSpeedLimitDown):'')?>>7 Mbps</option>
        												<option value="8m" <?=(( isset($pfSpeedLimitDown))?xBox('8m',$pfSpeedLimitDown):'')?>>8 Mbps</option>
        												<option value="9m" <?=(( isset($pfSpeedLimitDown))?xBox('9m',$pfSpeedLimitDown):'')?>>9 Mbps</option>
        												<option value="10m" <?=(( isset($pfSpeedLimitDown))?xBox('10m',$pfSpeedLimitDown):'')?>>10 Mbps</option>
        												<option value="15m" <?=(( isset($pfSpeedLimitDown))?xBox('15m',$pfSpeedLimitDown):'')?>>15 Mbps</option>
        												<option value="20m" <?=(( isset($pfSpeedLimitDown))?xBox('20m',$pfSpeedLimitDown):'')?>>20 Mbps</option>
        												<option value="25m" <?=(( isset($pfSpeedLimitDown))?xBox('25m',$pfSpeedLimitDown):'')?>>25 Mbps</option>
        												<option value="30m" <?=(( isset($pfSpeedLimitDown))?xBox('30m',$pfSpeedLimitDown):'')?>>30 Mbps</option>
        												<option value="35m" <?=(( isset($pfSpeedLimitDown))?xBox('35m',$pfSpeedLimitDown):'')?>>35 Mbps</option>
        												<option value="40m" <?=(( isset($pfSpeedLimitDown))?xBox('40m',$pfSpeedLimitDown):'')?>>40 Mbps</option>
        												<option value="45m" <?=(( isset($pfSpeedLimitDown))?xBox('45m',$pfSpeedLimitDown):'')?>>45 Mbps</option>
        												<option value="50m" <?=(( isset($pfSpeedLimitDown))?xBox('50m',$pfSpeedLimitDown):'')?>>50 Mbps</option>
        												<option value="55m" <?=(( isset($pfSpeedLimitDown))?xBox('55m',$pfSpeedLimitDown):'')?>>55 Mbps</option>
        												<option value="60m" <?=(( isset($pfSpeedLimitDown))?xBox('60m',$pfSpeedLimitDown):'')?>>60 Mbps</option>
        												<option value="70m" <?=(( isset($pfSpeedLimitDown))?xBox('70m',$pfSpeedLimitDown):'')?>>70 Mbps</option>
        												<option value="80m" <?=(( isset($pfSpeedLimitDown))?xBox('80m',$pfSpeedLimitDown):'')?>>80 Mbps</option>
        												<option value="90m" <?=(( isset($pfSpeedLimitDown))?xBox('90m',$pfSpeedLimitDown):'')?>>90 Mbps</option>
        												<option value="100m" <?=(( isset($pfSpeedLimitDown))?xBox('100m',$pfSpeedLimitDown):'')?>>100 Mbps</option>							
        											</select>						
        											<label style="color: #696a6d; margin-top: 10px;" id="lbSpeedLimitDown"><img src="img/help.png"> ตั้งค่าดาวน์โหลด หรือค่า Rx เช่น 10 Mbps</label>
        										</div>
        									</div>
        								</div>
        							</div>


        							<div class="form-group">
        								<label for="emailId" class="col-sm-3 control-label">ลิสที่อยู่ (Addr List)</label>
        								<div class="col-sm-7">
        									<input type="text" class="form-control" id="pfAddressList" name="pfAddressList" value="<?=(( isset($pfAddressList))?$pfAddressList:'')?>" placeholder="Customer-Address-List">
        									<label style="color: #696a6d; margin-top: 10px;" id="lbAddressList"><img src="img/help.png"> ตั้งไมโครติกแอ็ดเดรสลิส ในเมนู IP | Address List เช่น VIP-LIST</label>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">ส่งไปยังเว็บ</label>
        								<div class="col-sm-7">
        									<input type="text" class="form-control" id="pfUrlRedirect" name="pfUrlRedirect" value="<?=(( isset($pfUrlRedirect))?$pfUrlRedirect:'')?>" placeholder="http://www.otiknetwork.com">
        									<label style="color: #696a6d; margin-top: 10px;" id="lbUrlRedirect"><img src="img/help.png"> ตั้งค่าเว็บไซต์ที่ต้องการส่งไป เมื่อเข้าสู่ระบบสำเร็จ เช่น http://www.otiknetwork.com</label>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">จำนวนใช้ร่วมกัน</label>
        								<div class="col-sm-7">
        									<input type="number" min="0" max="99" class="form-control" id="pfShareUsers" name="pfShareUsers" value="<?=(( isset($pfShareUsers))?$pfShareUsers:'1')?>" placeholder="Share users">						  
        									<label style="color: #696a6d; margin-top: 10px;" id="lbShareUsers"><img src="img/help.png"> ตั้งค่าจำนวนอุปกรณ์ที่สามารถเข้าใช้งานพร้อมกัน เช่น 2 (ไม่เกิน 99)</label>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">เวลาใช้งานต่อครั้ง</label>
        								<div class="col-sm-9">
        									<div class="row gutter">                          
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfSessionTimout" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSessionTimout" value="">                                
        												<option value=""  <?=(( isset($pfSessionTimout))?xBox('',$pfSessionTimout):'')?>>Default</option>
        												<option value="600" <?=(( isset($pfSessionTimout))?xBox('600',$pfSessionTimout):'')?>>10 Minute</option>
        												<option value="900" <?=(( isset($pfSessionTimout))?xBox('900',$pfSessionTimout):'')?>>15 Minute</option>
        												<option value="1200" <?=(( isset($pfSessionTimout))?xBox('1200',$pfSessionTimout):'')?>>20 Minute</option>
        												<option value="1500" <?=(( isset($pfSessionTimout))?xBox('1500',$pfSessionTimout):'')?>>25 Minute</option>
        												<option value="1800" <?=(( isset($pfSessionTimout))?xBox('1800',$pfSessionTimout):'')?>>30 Minute</option>							
        												<option value="2100" <?=(( isset($pfSessionTimout))?xBox('2100',$pfSessionTimout):'')?>>35 Minute</option>	
        												<option value="2400" <?=(( isset($pfSessionTimout))?xBox('2400',$pfSessionTimout):'')?>>40 Minute</option>	
        												<option value="2700" <?=(( isset($pfSessionTimout))?xBox('2700',$pfSessionTimout):'')?>>45 Minute</option>	
        												<option value="3000" <?=(( isset($pfSessionTimout))?xBox('3000',$pfSessionTimout):'')?>>50 Minute</option>	
        												<option value="3300" <?=(( isset($pfSessionTimout))?xBox('3300',$pfSessionTimout):'')?>>55 Minute</option>	
        												<option value="3600" <?=(( isset($pfSessionTimout))?xBox('3600',$pfSessionTimout):'')?>>60 Minute</option>							
        											</select>
        										</div>
        									</div>
        									<label style="color: #696a6d; margin-top: 10px;" id="lbSessionTimeout"><img src="img/help.png"> ตั้งค่าจำนวนสูงสุดที่เข้าใช้งานต่อครั้ง เช่น 30 นาที คือ ระบบตัดการเชื่อมต่อทุกๆ 30 นาที</label>                        
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">ตัดเมื่อไม่ใช้งาน</label>
        								<div class="col-sm-9">

        									<div class="row gutter">                          
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfIdleTimeout" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfIdleTimeout" value="">                                
        												<option value=""  <?=(( isset($pfIdleTimeout))?xBox('',$pfIdleTimeout):'')?>>Default</option>
        												<option value="600" <?=(( isset($pfIdleTimeout))?xBox('600',$pfIdleTimeout):'')?>>10 Minute</option>
        												<option value="900" <?=(( isset($pfIdleTimeout))?xBox('900',$pfIdleTimeout):'')?>>15 Minute</option>
        												<option value="1200" <?=(( isset($pfIdleTimeout))?xBox('1200',$pfIdleTimeout):'')?>>20 Minute</option>
        												<option value="1500" <?=(( isset($pfIdleTimeout))?xBox('1500',$pfIdleTimeout):'')?>>25 Minute</option>
        												<option value="1800" <?=(( isset($pfIdleTimeout))?xBox('1800',$pfIdleTimeout):'')?>>30 Minute</option>							
        												<option value="2100" <?=(( isset($pfIdleTimeout))?xBox('2100',$pfIdleTimeout):'')?>>35 Minute</option>	
        												<option value="2400" <?=(( isset($pfIdleTimeout))?xBox('2400',$pfIdleTimeout):'')?>>40 Minute</option>	
        												<option value="2700" <?=(( isset($pfIdleTimeout))?xBox('2700',$pfIdleTimeout):'')?>>45 Minute</option>	
        												<option value="3000" <?=(( isset($pfIdleTimeout))?xBox('3000',$pfIdleTimeout):'')?>>50 Minute</option>	
        												<option value="3300" <?=(( isset($pfIdleTimeout))?xBox('3300',$pfIdleTimeout):'')?>>55 Minute</option>	
        												<option value="3600" <?=(( isset($pfIdleTimeout))?xBox('3600',$pfIdleTimeout):'')?>>60 Minute</option>	
        											</select>

        										</div>
        									</div>		  
        									<label style="color: #696a6d; margin-top: 10px;" id="lbIdleTimeout"><img src="img/help.png"> ตั้งค่าตัดการเชื่อมต่อเมื่อไม่มีการใช้งาน เช่น 10 นาที</label>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">เวลาที่ใช้งานได้ </label>
        								<div class="col-sm-7">
        									<div class="row gutter">                          
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfUptime" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfUptime" value="">                                
        												<option value="" <?=(( isset($pfUptime))?xBox('',$pfUptime):'')?>>Default</option>
        												<option value="900" <?=(( isset($pfUptime))?xBox('900',$pfUptime):'')?>>15 Minute</option>
        												<option value="1800" <?=(( isset($pfUptime))?xBox('1800',$pfUptime):'')?>>30 Minute</option>
        												<option value="3600" <?=(( isset($pfUptime))?xBox('3600',$pfUptime):'')?>>1 Hour</option>
        												<option value="10800" <?=(( isset($pfUptime))?xBox('10800',$pfUptime):'')?>>3 Hour</option>
        												<option value="18000" <?=(( isset($pfUptime))?xBox('18000',$pfUptime):'')?>>5 Hour</option>
        												<option value="28800" <?=(( isset($pfUptime))?xBox('28800',$pfUptime):'')?>>8 Hour</option>							
        												<option value="43200" <?=(( isset($pfUptime))?xBox('43200',$pfUptime):'')?>>12 Hour</option>
        												<option value="86400" <?=(( isset($pfUptime))?xBox('86400',$pfUptime):'')?>>24 Hour</option>
        											</select>

        										</div>
        									</div>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">หมดอายุภายใน</label>
        								<div class="col-sm-7">
        									<div class="row gutter">                          
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfValidity" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfValidity" value="">                                
        												<option value="0"  <?=(( isset($pfUptime))?xBox('0',$pfValidity):'')?>>Default</option>
        												<option value="86400"  <?=(( isset($pfUptime))?xBox('86400',$pfValidity):'')?>>1 Day</option>
        												<option value="604800" <?=(( isset($pfUptime))?xBox('604800',$pfValidity):'')?>>1 Week</option>
        												<option value="2629746" <?=(( isset($pfUptime))?xBox('2629746',$pfValidity):'')?>>1 Month</option>
        												<option value="7889238" <?=(( isset($pfUptime))?xBox('7889238',$pfValidity):'')?>>3 Month</option>
        												<option value="15778476" <?=(( isset($pfUptime))?xBox('15778476',$pfValidity):'')?>>6 Month</option>
        												<option value="31556952" <?=(( isset($pfUptime))?xBox('31556952',$pfValidity):'')?>>1 Year</option>								
        											</select>

        										</div>
        									</div>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="pwd" class="col-sm-3 control-label">ระดับความสำคัญ</label>
        								<div class="col-sm-7">
        									<div class="row gutter">                          
        										<div class="col-md-8 col-sm-4 col-xs-4">
        											<select id="pfPriority" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfPriority" value="">                                
        												<option value="1" <?=(( isset($pfPriority))?xBox('1',$pfPriority):'')?>>1</option>
        												<option value="2" <?=(( isset($pfPriority))?xBox('2',$pfPriority):'')?>>2</option>
        												<option value="3" <?=(( isset($pfPriority))?xBox('3',$pfPriority):'')?>>3</option>
        												<option value="4" <?=(( isset($pfPriority))?xBox('4',$pfPriority):'')?>>4</option>
        												<option value="5" <?=(( isset($pfPriority))?xBox('5',$pfPriority):'')?>>5</option>
        												<option value="6" <?=(( isset($pfPriority))?xBox('6',$pfPriority):'')?>>6</option>
        												<option value="7" <?=(( isset($pfPriority))?xBox('7',$pfPriority):'')?>>7</option>								
        												<option value="8" <?=(( isset($pfPriority))?xBox('8',$pfPriority):'selected')?>>8</option>								
        											</select>

        										</div>
        									</div>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="acConfirmPassword" class="col-sm-3 control-label">ใช้งานบน API</label>
        								<div class="col-sm-7">
        									<div class="radio">
        										<label><input type="radio" name="pfAPI" value="1" checked>เปิด</label>
        										<label><input type="radio" name="pfAPI" value="0">ปิด</label>
        									</div>
        								</div>
        							</div>

        							<div class="form-group">
        								<label for="acConfirmPassword" class="col-sm-3 control-label">สถานะ</label>
        								<div class="col-sm-7">
        									<div class="radio">
        										<label><input type="radio" name="pfStatus" value="1" checked>อุนมัติ</label>
        										<label><input type="radio" name="pfStatus" value="0">ร่างไว้ก่อน</label>
        									</div>
        								</div>
        							</div>


        							<input type="hidden" name="WhoCreate" value="npintong">
        							<input type="hidden" name="WhoUpdate" value="gorapin">

        							<div class="form-group">
        								<div class="col-sm-offset-3 col-sm-10">
        									<button type="submit" name="<?php echo $cmdbutton; ?>" id="<?php echo $cmdbutton; ?>" value="<?php echo $cmdbutton; ?>" id="<?php echo $cmdbutton; ?>" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span> ประมวลผล</button>
        								</div>
        							</div>

        						</form>
        					</div>
        				</div>
        			</div>
        		</div>
        		<!-- Row End -->
        	</div>

        </div>
        <!-- Left Sidebar End -->

          
        <!-- Dashboard Wrapper End -->

	<!-- Footer start -->
	<?php include_once('footer.php'); ?>
	<!-- Footer End -->

      </div>
    </div>
    <!-- Main Container end -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.scrollUp.js"></script>
    

    <!-- Custom JS -->
    <script src="js/menu.js"></script>
     <!-- Bootstrap selector JS -->
	<script src="js/bootstrap-select.min.js"></script>   
	
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Top', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      //Tooltip
      $('a').tooltip('hide');

      //Popover
      $('.popover-pop').popover('hide');

      //Dropdown
      $('.dropdown-toggle').dropdown();


      //Color Pickers
      $(document).ready( function() {
      
        $('.demo').each( function() {
          $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function(hex, opacity) {
              if( !hex ) return;
              if( opacity ) hex += ', ' + opacity;
              try {
                console.log(hex);
              } catch(e) {}
            },
            theme: 'bootstrap'
          });
                
        });
      
      });

    </script>

	<script>
	
		$(document).ready(function(){
			
			// hide all label warning
			$("#lbName").hide();
			$("#lbSpeedLimitUp").hide();
			$("#lbSpeedLimitDown").hide();
			$("#lbAddressList").hide();
			$("#lbUrlRedirect").hide();
			$("#lbFirewallFilter").hide();
			$("#lbRoute").hide();
			$("#lbShareUsers").hide();
			$("#lbSessionTimeout").hide();
			$("#lbIdleTimeout").hide();
			$("#lbLoginTime").hide();
			$("#lbLoginTime1").hide();
			$("#lbLoginTime2").hide();
			$("#lbLoginTime3").hide();
			$("#lbLoginTime4").hide();
			$("#lbValidity").hide();			
			$("#lbUptime").hide();
			$("#lbIPPool").hide();
			$("#LoginTimeAdvanced").hide();
			$("#lbTimeLogin").hide();
			$("#lbSpeedUpload").hide();
			$("#lbPrice").hide();

			$("#btnconfirm").attr("disabled","disabled");
			
			// btnconfirm
			
			$("#pfName").focusout(function(){

				if ($.trim($("#pfName").val()).length > 0 ){
					 	$("#btnconfirm").removeAttr('disabled');
					}else{
						$("#btnconfirm").attr("disabled","disabled");
					}

			});	


			
			// click LoginTime Advanced
			$( "#btnLoginTimeAdvanced" ).click(function() {
				$( "#LoginTimeAdvanced" ).show();
				$( "#TimeLogin" ).hide();
				$( "#DayLogin" ).hide();
			});
			
			// click LoginTime Basic
			$( "#btnLoginTimeBasic" ).click(function() {
				$( "#LoginTimeAdvanced" ).hide();
				$( "#TimeLogin" ).show();
				$( "#DayLogin" ).show();
			});
			
			// pfName
			$("#pfName").focus(function(){
				$("#lbName").show();
			});
			
			$("#pfName").focusout(function(){
				$("#lbName").hide();
			});	

			// pfName
			$("#pfPrice").focus(function(){
				$("#lbPrice").show();
			});
			
			$("#pfPrice").focusout(function(){
				$("#lbPrice").hide();
			});	

			// pfLoginTime
			$("#pfLoginTime").focus(function(){
				$("#lbLoginTime").show();
				$("#lbLoginTime1").show();
				$("#lbLoginTime2").show();
				$("#lbLoginTime3").show();
				$("#lbLoginTime4").show();
			});
			
			$("#pfLoginTime").focusout(function(){
				$("#lbLoginTime").hide();
				$("#lbLoginTime1").hide();
				$("#lbLoginTime2").hide();
				$("#lbLoginTime3").hide();
				$("#lbLoginTime4").hide();
			});	

			// pfSpeedLimitUp
			$("#pfSpeedLimitUp").focus(function(){
				$("#lbSpeedLimitUp").show();
			});
			
			$("#pfSpeedLimitUp").focusout(function(){
				$("#lbSpeedLimitUp").hide();
			});	

			// pfSpeedLimitDown
			$("#pfSpeedLimitDown").focus(function(){
				$("#lbSpeedLimitDown").show();
			});
			
			$("#pfSpeedLimitDown").focusout(function(){
				$("#lbSpeedLimitDown").hide();
			});	
			
			// pfAddressList
			$("#pfAddressList").focus(function(){
				$("#lbAddressList").show();
			});
			
			$("#pfAddressList").focusout(function(){
				$("#lbAddressList").hide();
			});	
			
			// pfUrlRedirect
			$("#pfUrlRedirect").focus(function(){
				$("#lbUrlRedirect").show();
			});
			
			$("#pfUrlRedirect").focusout(function(){
				$("#lbUrlRedirect").hide();
			});
			
			// pfFirewallFilter
			$("#pfFirewallFilter").focus(function(){
				$("#lbFirewallFilter").show();
			});
			
			$("#pfFirewallFilter").focusout(function(){
				$("#lbFirewallFilter").hide();
			});
			
			// lbRoute
			$("#pfRoute").focus(function(){
				$("#lbRoute").show();
			});
			
			$("#pfRoute").focusout(function(){
				$("#lbRoute").hide();
			});
			
			// pfShareUsers
			$("#pfShareUsers").focus(function(){
				$("#lbShareUsers").show();
			});
			
			$("#pfShareUsers").focusout(function(){
				$("#lbShareUsers").hide();
			});
			
			// lbSessionTimeout
			$("#pfSessionTimeout").focus(function(){
				$("#lbSessionTimeout").show();
			});
			
			$("#pfSessionTimeout").focusout(function(){
				$("#lbSessionTimeout").hide();
			});
			
			// lbIdleTimeout
			$("#pfIdleTimeout").focus(function(){
				$("#lbIdleTimeout").show();
			});
			
			$("#pfIdleTimeout").focusout(function(){
				$("#lbIdleTimeout").hide();
			});
		
			// lbTimeLogin
			$("#pfTimeLogin").focus(function(){
				$("#lbTimeLogin").show();
			});
			
			$("#pfTimeLogin").focusout(function(){
				$("#lbTimeLogin").hide();
			});	
			// lbValidity
			$("#pfValidity").focus(function(){
				$("#lbValidity").show();
			});
			
			$("#pfValidity").focusout(function(){
				$("#lbValidity").hide();
			});
			
			// lbUptime
			$("#pfUptime").focus(function(){
				$("#lbUptime").show();
			});
			
			$("#pfUptime").focusout(function(){
				$("#lbUptime").hide();
			});
			
			// pfIPPool
			$("#pfIPPool").focus(function(){
				$("#lbIPPool").show();
			});
			
			$("#pfIPPool").focusout(function(){
				$("#lbIPPool").hide();
			});
			
			// Convert to Second
			$("#btnSesConvertToSec").click(function(){
				
				var iOrgTime = $("#pfSessionTimeout").val();
				var iCalcTime = iOrgTime * 60;				
				$("#pfSessionTimeout").val(iCalcTime);
				
			});
	
			// SessionTimeout Set Default
			$("#btnSesDefault").click(function(){
				$("#pfSessionTimeout").val(0);
			});	
			
			// IdleTimeout Convert to Second
			$("#btnIdleConvertToSec").click(function(){
				
				var iOrgTime = $("#pfIdleTimeout").val();
				var iCalcTime = iOrgTime * 60;
				$("#pfIdleTimeout").val(iCalcTime);
				
			});

			// IdleTimeout Set Default
			$("#btnIdleDefault").click(function(){
				$("#pfIdleTimeout").val(900);
			});	
			
			// allow numberic only
			$(document).on("input", "#pfShareUsers", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});
			
			$(document).on("input", "#pfSessionTimeout", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});	
			
			$(document).on("input", "#pfIdleTimeout", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});

			
		});
	</script>

	
	<script type="text/javascript">
		function autoTab(obj){
			/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
			หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
			4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
			รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
			หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
			ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
			*/
				var pattern=new String("____-____"); // กำหนดรูปแบบในนี้
				var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
				var returnText=new String("");
				var obj_l=obj.value.length;
				var obj_l2=obj_l-1;
				for(i=0;i<pattern.length;i++){           
					if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
						returnText+=obj.value+pattern_ex;
						obj.value=returnText;
					}
				}
				if(obj_l>=pattern.length){
					obj.value=obj.value.substr(0,pattern.length);           
				}
		}
	</script>
	
  </body>
</html>