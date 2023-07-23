<?php

	$active = "profile";

	date_default_timezone_set('Asia/Bangkok');
	$current_time = date("Y-m-d H:i:s");
	require_once("config.inc.php");


	if(isset($_POST['btnconfirm'])){
		/*
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		*/
		//require_once("config.inc.php");

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
					'".$mcon->real_escape_string($_POST['pfName'])."',
					'".$mcon->real_escape_string($_POST['pfSpeedLimitUp'])."',
					'".$mcon->real_escape_string($_POST['pfSpeedLimitDown'])."', 
					'".$mcon->real_escape_string($_POST['pfAddressList'])."',
					'".$mcon->real_escape_string($_POST['pfUrlRedirect'])."',
					'".$mcon->real_escape_string($_POST['pfShareUsers'])."',
					'".$mcon->real_escape_string($_POST['pfSessionTimout'])."', 
					'".$mcon->real_escape_string($_POST['pfIdleTimeout'])."', 
					'".$mcon->real_escape_string($_POST['pfUptime'])."', 
					'".$mcon->real_escape_string($_POST['pfValidity'])."', 
					'".$mcon->real_escape_string($_POST['pfStatus'])."',
					'".$mcon->real_escape_string($_POST['WhoCreate'])."', 
					'".$mcon->real_escape_string($current_time)."',
					'".$mcon->real_escape_string($_POST['WhoUpdate'])."',
					'".$mcon->real_escape_string($current_time)."',
					'".$mcon->real_escape_string($_POST['pfPriority'])."',
					'".$mcon->real_escape_string($_POST['pfPrice'])."'
					);";

		if($mcon->query($tSQL)){
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
		exit();
	}

		//$tSQL = "SELECT * FROM tbl_master_nas WHERE id='".$_REQUEST['id']."' LIMIT 0,1;";
		$tSQL = " SELECT
				  pfID,
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
				FROM
				  tbl_master_profiles WHERE pfID='".$_REQUEST['id']."' LIMIT 0, 1;
				";
				//echo $tSQL;
		$rs = $mcon->query($tSQL);
		//inial variable
		  $pfID = "";
		  $pfName = "";
		  $pfSpeedLimitUp = "";
		  $pfSpeedLimitDown = "";
		  $pfAddressList = "";
		  $pfUrlRedirect = "";
		  $pfShareUsers = "";
		  $pfSessionTimout = "";
		  $pfIdleTimeout = "";
		  $pfUptime = "";
		  $pfValidity = "";
		  $pfStatus = "";
		  $WhoCreate = "";
		  $DateCreate = "";
		  $WhoUpdate = "";
		  $DateUpdate = "";
		  $pfPriority = "";
		  $pfPrice = "";

if($rs->num_rows > 0){
	while($rows = $rs->fetch_assoc()){

		$pfID = $rows['pfID'];
		$pfName = $rows['pfName'];
		$pfSpeedLimitUp = $rows['pfSpeedLimitUp'];
		$pfSpeedLimitDown = $rows['pfSpeedLimitDown'];
		$pfAddressList = $rows['pfAddressList'];
		$pfUrlRedirect = $rows['pfUrlRedirect'];
		$pfShareUsers = $rows['pfShareUsers'];
		$pfSessionTimout = $rows['pfSessionTimout'];
		$pfIdleTimeout = $rows['pfIdleTimeout'];
		$pfUptime = $rows['pfUptime'];
		$pfValidity = $rows['pfValidity'];
		$pfStatus = $rows['pfStatus'];
		$WhoCreate = $rows['WhoCreate'];
		$DateCreate = $rows['DateCreate'];
		$WhoUpdate = $rows['WhoUpdate'];
		$DateUpdate = $rows['DateUpdate'];
		$pfPriority = $rows['pfPriority'];
		$pfPrice = $rows['pfPrice'];
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
    <!-- Important. For Theming change primary-color variable in main.css  -->

    <!-- Color Picker -->
    <link rel="stylesheet" href="css/color-picker/jquery.minicolors.css">

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
            <li><a href="" class="heading">Profile</a></li>
          </ul>
          <div class="custom-search hidden-sm hidden-xs">
            <input type="text" class="search-query" placeholder="Search here ...">
            <i class="fa fa-search"></i>
          </div>
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
						Profile details
						<span class="mini-title">Please fill your profile details </a></span>
                    </div>
                  </div>
                  <div class="widget-body">
                    <form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                      <div class="form-group">
                        <label for="userName" class="col-sm-3 control-label">Name * </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pfName" name="pfName" value="<?php echo $pfName; ?>" placeholder="Profile name">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbName"><img src="img/help.png"> กำหนดชื่อ Profile เช่น NET-VIP</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="userName" class="col-sm-3 control-label">Price * </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pfPrice" name="pfPrice" value="<?php echo $pfPrice; ?>" placeholder="Price">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbPrice"><img src="img/help.png"> ราคาจำหน่ายบัตร เช่น 199 บาท</label>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pfSpeedLimitUp" class="col-sm-3 control-label">Connection Upload</label>
                        <div class="col-sm-9">
                          <div class="row gutter">
                            <div class="col-md-8 col-sm-4 col-xs-4">
                              <select id="pfSpeedLimitUp" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSpeedLimitUp" value="" id="pfSpeedLimitUp">                                
								<option value="" selected>Unlimited</option>
								<option value="128k" <?php echo ($pfSpeedLimitUp=="128k" ? 'selected' : ''); ?>>128 Kbps</option>
								<option value="256k" <?php echo ($pfSpeedLimitUp=="256k" ? 'selected' : ''); ?>>256 Kbps</option>
								<option value="512k" <?php echo ($pfSpeedLimitUp=="512k" ? 'selected' : ''); ?>>512 Kbps</option>
								<option value="1m" <?php echo ($pfSpeedLimitUp=="1m" ? 'selected' : ''); ?>>1 Mbps</option>
								<option value="2m" <?php echo ($pfSpeedLimitUp=="2m" ? 'selected' : ''); ?>>2 Mbps</option>
								<option value="3m" <?php echo ($pfSpeedLimitUp=="3m" ? 'selected' : ''); ?>>3 Mbps</option>
								<option value="4m" <?php echo ($pfSpeedLimitUp=="4m" ? 'selected' : ''); ?>>4 Mbps</option>
								<option value="5m" <?php echo ($pfSpeedLimitUp=="5m" ? 'selected' : ''); ?>>5 Mbps</option>
								<option value="6m" <?php echo ($pfSpeedLimitUp=="6m" ? 'selected' : ''); ?>>6 Mbps</option>
								<option value="7m" <?php echo ($pfSpeedLimitUp=="7m" ? 'selected' : ''); ?>>7 Mbps</option>
								<option value="8m" <?php echo ($pfSpeedLimitUp=="8m" ? 'selected' : ''); ?>>8 Mbps</option>
								<option value="9m" <?php echo ($pfSpeedLimitUp=="9m" ? 'selected' : ''); ?>>9 Mbps</option>
								<option value="10m" <?php echo ($pfSpeedLimitUp=="10m" ? 'selected' : ''); ?>>10 Mbps</option>
								<option value="15m" <?php echo ($pfSpeedLimitUp=="15m" ? 'selected' : ''); ?>>15 Mbps</option>
								<option value="20m" <?php echo ($pfSpeedLimitUp=="20m" ? 'selected' : ''); ?>>20 Mbps</option>
								<option value="25m" <?php echo ($pfSpeedLimitUp=="25m" ? 'selected' : ''); ?>>25 Mbps</option>
								<option value="30m" <?php echo ($pfSpeedLimitUp=="30m" ? 'selected' : ''); ?>>30 Mbps</option>
								<option value="35m" <?php echo ($pfSpeedLimitUp=="35m" ? 'selected' : ''); ?>>35 Mbps</option>
								<option value="40m" <?php echo ($pfSpeedLimitUp=="40m" ? 'selected' : ''); ?>>40 Mbps</option>
								<option value="45m" <?php echo ($pfSpeedLimitUp=="45m" ? 'selected' : ''); ?>>45 Mbps</option>
								<option value="50m" <?php echo ($pfSpeedLimitUp=="50m" ? 'selected' : ''); ?>>50 Mbps</option>
								<option value="55m" <?php echo ($pfSpeedLimitUp=="55m" ? 'selected' : ''); ?>>55 Mbps</option>
								<option value="60m" <?php echo ($pfSpeedLimitUp=="60m" ? 'selected' : ''); ?>>60 Mbps</option>
								<option value="70m" <?php echo ($pfSpeedLimitUp=="70m" ? 'selected' : ''); ?>>70 Mbps</option>
								<option value="80m" <?php echo ($pfSpeedLimitUp=="80m" ? 'selected' : ''); ?>>80 Mbps</option>
								<option value="90m" <?php echo ($pfSpeedLimitUp=="90m" ? 'selected' : ''); ?>>90 Mbps</option>
								<option value="100" <?php echo ($pfSpeedLimitUp=="100" ? 'selected' : ''); ?>>100 Mbps</option>								
                              </select>
							  <label style="color: #696a6d; margin-top: 10px;" id="lbSpeedUpload"><img src="img/help.png"> ตั้งค่าดาวน์โหลด หรือค่า Rx เช่น 10 Mbps</label>
                            </div>
                          </div>
                        </div>
                      </div>

					<div class="form-group">
                        <label for="pfSpeedLimitDown" class="col-sm-3 control-label">Connection Download</label>
                        <div class="col-sm-9">
							<div class="row gutter">
								<div class="col-md-8 col-sm-4 col-xs-4">
									<select id="pfSpeedLimitDown" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSpeedLimitDown" value="">                                
										<option value="" selected>Unlimited</option>
										<option value="128k" <?php echo ($pfSpeedLimitDown=="128k" ? 'selected' : ''); ?>>128 Kbps</option>
										<option value="256k" <?php echo ($pfSpeedLimitDown=="256k" ? 'selected' : ''); ?>>256 Kbps</option>
										<option value="512k" <?php echo ($pfSpeedLimitDown=="512k" ? 'selected' : ''); ?>>512 Kbps</option>
										<option value="1m" <?php echo ($pfSpeedLimitDown=="1m" ? 'selected' : ''); ?>>1 Mbps</option>
										<option value="2m" <?php echo ($pfSpeedLimitDown=="2m" ? 'selected' : ''); ?>>2 Mbps</option>
										<option value="3m" <?php echo ($pfSpeedLimitDown=="3m" ? 'selected' : ''); ?>>3 Mbps</option>
										<option value="4m" <?php echo ($pfSpeedLimitDown=="4m" ? 'selected' : ''); ?>>4 Mbps</option>
										<option value="5m" <?php echo ($pfSpeedLimitDown=="5m" ? 'selected' : ''); ?>>5 Mbps</option>
										<option value="6m" <?php echo ($pfSpeedLimitDown=="6m" ? 'selected' : ''); ?>>6 Mbps</option>
										<option value="7m" <?php echo ($pfSpeedLimitDown=="7m" ? 'selected' : ''); ?>>7 Mbps</option>
										<option value="8m" <?php echo ($pfSpeedLimitDown=="8m" ? 'selected' : ''); ?>>8 Mbps</option>
										<option value="9m" <?php echo ($pfSpeedLimitDown=="9m" ? 'selected' : ''); ?>>9 Mbps</option>
										<option value="10m" <?php echo ($pfSpeedLimitDown=="10m" ? 'selected' : ''); ?>>10 Mbps</option>
										<option value="15m" <?php echo ($pfSpeedLimitDown=="15m" ? 'selected' : ''); ?>>15 Mbps</option>
										<option value="20m" <?php echo ($pfSpeedLimitDown=="20m" ? 'selected' : ''); ?>>20 Mbps</option>
										<option value="25m" <?php echo ($pfSpeedLimitDown=="25m" ? 'selected' : ''); ?>>25 Mbps</option>
										<option value="30m" <?php echo ($pfSpeedLimitDown=="30m" ? 'selected' : ''); ?>>30 Mbps</option>
										<option value="35m" <?php echo ($pfSpeedLimitDown=="35m" ? 'selected' : ''); ?>>35 Mbps</option>
										<option value="40m" <?php echo ($pfSpeedLimitDown=="40m" ? 'selected' : ''); ?>>40 Mbps</option>
										<option value="45m" <?php echo ($pfSpeedLimitDown=="45m" ? 'selected' : ''); ?>>45 Mbps</option>
										<option value="50m" <?php echo ($pfSpeedLimitDown=="50m" ? 'selected' : ''); ?>>50 Mbps</option>
										<option value="55m" <?php echo ($pfSpeedLimitDown=="55m" ? 'selected' : ''); ?>>55 Mbps</option>
										<option value="60m" <?php echo ($pfSpeedLimitDown=="60m" ? 'selected' : ''); ?>>60 Mbps</option>
										<option value="70m" <?php echo ($pfSpeedLimitDown=="70m" ? 'selected' : ''); ?>>70 Mbps</option>
										<option value="80m" <?php echo ($pfSpeedLimitDown=="80m" ? 'selected' : ''); ?>>80 Mbps</option>
										<option value="90m" <?php echo ($pfSpeedLimitDown=="90m" ? 'selected' : ''); ?>>90 Mbps</option>
										<option value="100" <?php echo ($pfSpeedLimitDown=="100" ? 'selected' : ''); ?>>100 Mbps</option>								
									</select>						
								  	<label style="color: #696a6d; margin-top: 10px;" id="lbSpeedLimitDown"><img src="img/help.png"> ตั้งค่าดาวน์โหลด หรือค่า Rx เช่น 10 Mbps</label>
								</div>
							</div>
                        </div>
                    </div>
					  
					  
                      <div class="form-group">
                        <label for="emailId" class="col-sm-3 control-label">Address List</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pfAddressList" name="pfAddressList" value="<?php echo $pfAddressList; ?>" placeholder="Customer-Address-List">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbAddressList"><img src="img/help.png"> ตั้งไมโครติกแอ็ดเดรสลิส ในเมนู IP | Address List เช่น VIP-LIST</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Url Redirect</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pfUrlRedirect" name="pfUrlRedirect" value="<?php echo $pfUrlRedirect; ?>" placeholder="http://www.otiknetwork.com">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbUrlRedirect"><img src="img/help.png"> ตั้งค่าเว็บไซต์ที่ต้องการส่งไป เมื่อเข้าสู่ระบบสำเร็จ เช่น http://www.otiknetwork.com</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Share users</label>
                        <div class="col-sm-7">
                          <input type="number" min="0" max="99" class="form-control" id="pfShareUsers" name="pfShareUsers" value="<?php echo $pfShareUsers; ?>" placeholder="Share users">						  
						  <label style="color: #696a6d; margin-top: 10px;" id="lbShareUsers"><img src="img/help.png"> ตั้งค่าจำนวนอุปกรณ์ที่สามารถเข้าใช้งานพร้อมกัน เช่น 2 (ไม่เกิน 99)</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Session timeout</label>
                        <div class="col-sm-9">
                          	<div class="row gutter">                          
							  	<div class="col-md-8 col-sm-4 col-xs-4">
							        <select id="pfSessionTimout" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfSessionTimout" value="">                                
										<option value="" selected>Default</option>
										<option value="600" <?php echo ($pfSessionTimout=="600" ? 'selected' : ''); ?>>10 Minute</option>
										<option value="900" <?php echo ($pfSessionTimout=="900" ? 'selected' : ''); ?>>15 Minute</option>
										<option value="1200" <?php echo ($pfSessionTimout=="1200" ? 'selected' : ''); ?>>20 Minute</option>
										<option value="1500" <?php echo ($pfSessionTimout=="1500" ? 'selected' : ''); ?>>25 Minute</option>
										<option value="1800" <?php echo ($pfSessionTimout=="1800" ? 'selected' : ''); ?>>30 Minute</option>							
										<option value="2100" <?php echo ($pfSessionTimout=="2100" ? 'selected' : ''); ?>>35 Minute</option>	
										<option value="2400" <?php echo ($pfSessionTimout=="2400" ? 'selected' : ''); ?>>40 Minute</option>	
										<option value="2700" <?php echo ($pfSessionTimout=="2700" ? 'selected' : ''); ?>>45 Minute</option>	
										<option value="3000" <?php echo ($pfSessionTimout=="3000" ? 'selected' : ''); ?>>50 Minute</option>	
										<option value="3300" <?php echo ($pfSessionTimout=="3300" ? 'selected' : ''); ?>>55 Minute</option>	
										<option value="3600" <?php echo ($pfSessionTimout=="3600" ? 'selected' : ''); ?>>60 Minute</option>							
	                              	</select>
								</div>
							</div>
						  <label style="color: #696a6d; margin-top: 10px;" id="lbSessionTimeout"><img src="img/help.png"> ตั้งค่าจำนวนสูงสุดที่เข้าใช้งานต่อครั้ง เช่น 30 นาที คือ ระบบตัดการเชื่อมต่อทุกๆ 30 นาที</label>                        
						</div>
                      </div>
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Idle timeout</label>
                        <div class="col-sm-9">
                          
						  <div class="row gutter">                          
							  	<div class="col-md-8 col-sm-4 col-xs-4">
							        <select id="pfIdleTimeout" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfIdleTimeout" value="">                                
										<option value="" selected>Default</option>
										<option value="600" <?php echo ($pfIdleTimeout=="600" ? 'selected' : ''); ?>>10 Minute</option>
										<option value="900" <?php echo ($pfIdleTimeout=="900" ? 'selected' : ''); ?>>15 Minute</option>
										<option value="1200" <?php echo ($pfIdleTimeout=="1200" ? 'selected' : ''); ?>>20 Minute</option>
										<option value="1500" <?php echo ($pfIdleTimeout=="1500" ? 'selected' : ''); ?>>25 Minute</option>
										<option value="1800" <?php echo ($pfIdleTimeout=="1800" ? 'selected' : ''); ?>>30 Minute</option>							
										<option value="2100" <?php echo ($pfIdleTimeout=="2100" ? 'selected' : ''); ?>>35 Minute</option>	
										<option value="2400" <?php echo ($pfIdleTimeout=="2400" ? 'selected' : ''); ?>>40 Minute</option>	
										<option value="2700" <?php echo ($pfIdleTimeout=="2700" ? 'selected' : ''); ?>>45 Minute</option>	
										<option value="3000" <?php echo ($pfIdleTimeout=="3000" ? 'selected' : ''); ?>>50 Minute</option>	
										<option value="3300" <?php echo ($pfIdleTimeout=="3300" ? 'selected' : ''); ?>>55 Minute</option>	
										<option value="3600" <?php echo ($pfIdleTimeout=="3600" ? 'selected' : ''); ?>>60 Minute</option>	
	                              	</select>

								</div>
							</div>		  
						  <label style="color: #696a6d; margin-top: 10px;" id="lbIdleTimeout"><img src="img/help.png"> ตั้งค่าตัดการเชื่อมต่อเมื่อไม่มีการใช้งาน เช่น 10 นาที</label>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Uptime </label>
                        <div class="col-sm-7">
                          <div class="row gutter">                          
							  	<div class="col-md-8 col-sm-4 col-xs-4">
							        <select id="pfUptime" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfUptime" value="">                                
										<option value="" selected>Default</option>
										<option value="900" <?php echo ($pfUptime=="900" ? 'selected' : ''); ?>>15 Minute</option>
										<option value="1800" <?php echo ($pfUptime=="1800" ? 'selected' : ''); ?>>30 Minute</option>
										<option value="3600" <?php echo ($pfUptime=="3600" ? 'selected' : ''); ?>>1 Hour</option>
										<option value="10800" <?php echo ($pfUptime=="10800" ? 'selected' : ''); ?>>3 Hour</option>
										<option value="18000" <?php echo ($pfUptime=="18000" ? 'selected' : ''); ?>>5 Hour</option>
										<option value="28800" <?php echo ($pfUptime=="28800" ? 'selected' : ''); ?>>8 Hour</option>							
										<option value="43200" <?php echo ($pfUptime=="43200" ? 'selected' : ''); ?>>12 Hour</option>
										<option value="86400" <?php echo ($pfUptime=="86400" ? 'selected' : ''); ?>>24 Hour</option>
	                              	</select>

								</div>
							</div>
                        </div>
                      </div>

						<div class="form-group">
							<label for="pwd" class="col-sm-3 control-label">Validity</label>
							<div class="col-sm-7">
								<div class="row gutter">                          
								  	<div class="col-md-8 col-sm-4 col-xs-4">
								        <select id="pfValidity" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfValidity" value="">                                
											<option value="0" <?php echo ($pfValidity=="0" ? 'selected' : ''); ?>>Default</option>
											<option value="86400"  <?php echo ($pfValidity=="86400" ? 'selected' : ''); ?>>1 Day</option>
											<option value="604800" <?php echo ($pfValidity=="604800" ? 'selected' : ''); ?>>1 Week</option>
											<option value="2629746" <?php echo ($pfValidity=="2629746" ? 'selected' : ''); ?>>1 Month</option>
											<option value="7889238" <?php echo ($pfValidity=="7889238" ? 'selected' : ''); ?>>3 Month</option>
											<option value="15778476" <?php echo ($pfValidity=="15778476" ? 'selected' : ''); ?>>6 Month</option>
											<option value="31556952" <?php echo ($pfValidity=="31556952" ? 'selected' : ''); ?>>1 Year</option>								
								      	</select>

									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="pwd" class="col-sm-3 control-label">Priority</label>
							<div class="col-sm-7">
								<div class="row gutter">                          
								  	<div class="col-md-8 col-sm-4 col-xs-4">
								        <select id="pfPriority" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfPriority" value="">                                
											<option value="1" <?php echo ($pfPriority=="1" ? 'selected' : ''); ?>>1</option>
											<option value="2" <?php echo ($pfPriority=="2" ? 'selected' : ''); ?>>2</option>
											<option value="3" <?php echo ($pfPriority=="3" ? 'selected' : ''); ?>>3</option>
											<option value="4" <?php echo ($pfPriority=="4" ? 'selected' : ''); ?>>4</option>
											<option value="5" <?php echo ($pfPriority=="5" ? 'selected' : ''); ?>>5</option>
											<option value="6" <?php echo ($pfPriority=="6" ? 'selected' : ''); ?>>6</option>
											<option value="7" <?php echo ($pfPriority=="7" ? 'selected' : ''); ?>>7</option>								
											<option value="8" <?php echo ($pfPriority=="8" ? 'selected' : ''); ?>>8</option>								
								      	</select>

									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="pfStatus" value="0">
						<input type="hidden" name="WhoCreate" value="npintong">
						<input type="hidden" name="WhoUpdate" value="gorapin">
					  
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
							  <button type="submit" name="btnconfirm" id="btnconfirm" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span> UPDATE</button>
							</div>
						</div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row End -->

            

          </div>
          <!-- Left Sidebar End -->

          <!-- Right Sidebar Start -->
          <div class="right-sidebar">
            
            <div class="wrapper">
              <ul class="progress-stats">
                <li>
                  <div class="details">
                    <span>Windows</span>
                    <span class="pull-right">78%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>Windows 8</span>
                    <span class="pull-right">32%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>Mac</span>
                    <span class="pull-right">84%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100" style="width: 84%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>Linux</span>
                    <span class="pull-right">44%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100" style="width: 44%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>IPhone/IPad</span>
                    <span class="pull-right">67%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            
            <hr class="hr-stylish-1">
            </div>
            
          <!-- Right Sidebar End -->
        </div>
        <!-- Dashboard Wrapper End -->

	<!-- Footer start -->
	<?php include_once('footer.php'); ?>
	<!-- Footer End -->

      </div>
    </div>
    <!-- Main Container end -->

    <script src="js/wysi/wysihtml5-0.3.0.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wysi/bootstrap3-wysihtml5.js"></script>
    <script src="js/jquery.scrollUp.js"></script>
    
    <!-- Color Picker -->
    <script src="js/color-picker/jquery.minicolors.js"></script>

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

      //wysihtml5
      $('.textarea').wysihtml5();

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