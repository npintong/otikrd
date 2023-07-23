<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}

	if($_SESSION['pAccount']==0){
		echo "Permission deny";
		exit();
	}
	
	$active = "account";
	date_default_timezone_set('Asia/Bangkok');
	$current_time = date("Y-m-d H:i:s");
	require_once("config.inc.php");
	require_once('hash.php');

	if(isset($_POST['btnconfirm'])){
		
		if($_REQUEST['acUser']=='' || $_REQUEST['acPasswd']=='' || $_REQUEST['acConfirmPassword']==''){
			echo "<center>";
			echo "กรุณากำหนด UserName & Password";
			echo "<br/>";
			echo "<a href=\"#\" onclick=\"window.history.go(-1); return false;\"> กลับไปแก้ไข </a>";
			echo "</center>";
			exit();
		}

		if($_REQUEST['acPasswd'] <> $_REQUEST['acConfirmPassword']){

			echo "<center>";
			echo "กรุณายืนยันรหัสผ่านอีกครั้ง";
			echo "<br/>";
			echo "<a href=\"#\" onclick=\"window.history.go(-1); return false;\"> กลับไปแก้ไข </a>";
			echo "</center>";
			exit();
		}


	    $tSQL = "
					INSERT INTO tbl_trans_account (
					  pfID,
					  acUser,
					  acPassWd,
					  tNote,
					  acStatus,
					  WhoCreate,
					  DateCreate,
					  WhoUpdate,
					  DateUpdate
					)
					VALUES
					  (
					  	'".$mcon->real_escape_string($_POST['pfID'])."',
					  	'".$mcon->real_escape_string($_POST['acUser'])."',
						'".$mcon->real_escape_string($_POST['acPasswd'])."',
					  	'".$mcon->real_escape_string($_POST['tNote'])."',
					  	'".$mcon->real_escape_string($_POST['acStatus'])."',
					  	'".$mcon->real_escape_string('npintong')."',
					  	'".$mcon->real_escape_string($current_time)."',
					  	'".$mcon->real_escape_string('npintong')."',
					  	'".$mcon->real_escape_string($current_time)."'
					  );
				";

		if($mcon->query($tSQL)){
			
			if($_REQUEST['acStatus']=="1"){
				
				$tSQL1 ="INSERT INTO tbl_master_radcheck(username,attribute,op,value)VALUES('".$mcon->real_escape_string($_POST['acUser'])."','Cleartext-Password',':=','".$mcon->real_escape_string($_POST['acPasswd'])."');";
				$mcon->query($tSQL1);

				$tSQL2 ="INSERT INTO tbl_master_radusergroup (username,groupname,priority)VALUES('".$mcon->real_escape_string($_POST['acUser'])."','".$mcon->real_escape_string($_POST['pfID'])."','8');";
				$mcon->query($tSQL2);

			}

			$mcon->close();
			echo '<script language="javascript">';
			echo 'alert("บันทึกรายการเรียบร้อย")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=account.php">';
		}else{
			$mcon->close();
			echo '<script language="javascript">';
			echo 'alert("ไม่สามารถบันทึกรายการได้")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=account_form.php">';
		}

		
	}


	if(isset($_POST['btnBatchGen'])){

		$iNumOfUser = $_REQUEST['iNumOfUser'];

		if($_REQUEST['iLenOfUser']<>''){
			$iLenOfUser = $_REQUEST['iLenOfUser'];
		}else{
			$iLenOfUser = 8;
		}

		if($_REQUEST['iLenOfPasswd']<>''){
			$iLenOfPasswd = $_REQUEST['iLenOfPasswd'];
		}else{
			$iLenOfPasswd = 8;
		}

		$tPrefix = $_REQUEST['tPrefix'];

		$tNote = $_POST['tNote'];
		
		for($i=1;$i<=$iNumOfUser;$i++){
			$gAccount = $tPrefix.GeraHash($iLenOfUser);
			$gPass = GeraHashNum($iLenOfPasswd);
			
			$tSQL = "INSERT INTO tbl_trans_account (pfID,acUser,acPassWd,tNote,acStatus,WhoCreate,DateCreate,WhoUpdate,DateUpdate)VALUES(
					'".$mcon->real_escape_string($_POST['pfID'])."',						    
					'".$mcon->real_escape_string($gAccount)."',
					'".$mcon->real_escape_string($gPass)."',
					'".$mcon->real_escape_string($tNote)."',
					'1',
					'1',
					'".$current_time."',
					'1',
					'".$current_time."'
					)
					";
			$rs = $mcon->query($tSQL);
			$mcon->query("insert into tbl_master_radusergroup(username,groupname,priority)values('".$gAccount."','".$_POST['pfID']."','8');");
						
			$mcon->query("INSERT INTO tbl_master_radcheck(username,attribute,op,value)VALUES('".$gAccount."','Cleartext-Password',':=','".$gPass."');");

		}

		
		if($rs){			
			echo '<script language="javascript">';
			echo 'alert("บันทึกรายการเรียบร้อย")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=account.php">';
		}else{
			$mcon->close();
			echo '<script language="javascript">';
			echo 'alert("ไม่สามารถบันทึกรายการได้")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=account_form.php">';
		}

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
    <link href="css/new.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />		
    <link href="fonts/font-awesome.min.css" rel="stylesheet">

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
            <li><a href="" class="heading">Account</a></li>
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
 
			<!-- start row-->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#AddUser"><span class="glyphicon glyphicon-user"></span> เพิ่มทีละรายการ</a></li>
			  <li><a data-toggle="tab" href="#GenerateUser"><span class="glyphicon glyphicon-random"></span> เพิ่มจำนวนมาก</a></li>			  
			</ul>

			<div class="tab-content">
			  <div id="AddUser" class="tab-pane fade in active">
				<br/>
				<form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				
				<div class="form-group">
					<label for="acPassword" class="col-sm-3 control-label">บันทึกช่วยจำ</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="tNote" name="tNote" maxlength="100" placeholder="บันทึกช่วยจำ">
						<label style="color: #696a6d; margin-top: 10px;" id="lbtFullName"><img src="img/help.png"> ชื่อ - นามสกุล ผู้ขอใช้งาน เช่น อำนวย ปิ่นทอง</label>
					</div>
				</div>
				
				<div class="form-group">
						<label for="acUser" class="col-sm-3 control-label">ชื่อบัญชี </label>
						<div class="col-sm-7">
							<div class="input-group">
								<input type="text" class="form-control" id="acUser" name="acUser" maxlength="13" placeholder="Username">
								<span class="input-group-btn">
									<button class="btn btn-danger" type="button" id="btnGenUser"><span class="glyphicon glyphicon-random"> </span> สุ่มอักษร</button>
								</span>
							</div>	
							<label style="color: #696a6d; margin-top: 10px;" id="lbUsername"><img src="img/help.png"> ตั้งค่าชื่อบัญชีสำหรับเข้าสู่ระบบ a-z A-Z 0-9 เช่น 09015</label>
						</div>
					</div>
					<div class="form-group">
						<label for="acPassword" class="col-sm-3 control-label">รหัสผ่าน</label>
						<div class="col-sm-7">
							<div class="input-group">
								<input type="text" class="form-control" id="acPasswd" name="acPasswd" maxlength="13" placeholder="Password">
								<span class="input-group-btn">
									<button class="btn btn-danger" type="button" id="btnGenPass"><span class="glyphicon glyphicon-random"> </span> สุ่มอักษร</button>
								</span>
							</div>						
							
							<label style="color: #696a6d; margin-top: 10px;" id="lbPassword"><img src="img/help.png"> ตั้งค่ารหัสผ่านไม่น้อยกว่า 3 ตัวอักษร เช่น 123456</label>
						</div>
					</div>
					<div class="form-group">
						<label for="acConfirmPassword" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>
						<div class="col-sm-7">
							<div class="input-group">
								<input type="text" class="form-control" id="acConfirmPassword" name="acConfirmPassword" maxlength="13" placeholder="Password">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" id="btnCopyPass"><span class="glyphicon glyphicon-random"> </span> คัดลอก</button>
								</span>
							</div>							
							
							<label style="color: #696a6d; margin-top: 10px;" id="lbConfirmPassword"><img src="img/help.png"> ยืนยันรหัสผ่านอีกครั้ง สามารถคลิก Copy ได้ ต้องตรงกับรหัสผ่าน เช่น 123456</label>
						</div>
					</div>

					
					<div class="form-group">
						<label for="acConfirmPassword" class="col-sm-3 control-label">สถานะ</label>
						<div class="col-sm-7">
							<div class="radio">
								<label><input type="radio" name="acStatus" value="1" checked>อนุมัติ</label>								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="acConfirmPassword" class="col-sm-3 control-label">แพ็คเกตอินเตอร์เน็ต</label>
						<div class="col-sm-7">
							<div class="row gutter">                          
							  	<div class="col-md-8 col-sm-4 col-xs-4">
							        <select id="pfID" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfID" value="">                                
							        	
							        	<?php

							        		$tSQL = "SELECT pfID, pfName FROM  tbl_master_profiles";
											$rs = $mcon->query($tSQL);
											if($rs->num_rows > 0){
												while($rows = $rs->fetch_assoc()){													
													echo "<option value=\"".$rows['pfID']."\">".$rows['pfName']."</option>";
												}
											}


							        	?>
										
													
	                              	</select>
								</div>
							</div>					
						</div>
					</div>	

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							
							<button type="submit" class="btn btn-info" name="btnconfirm"><span class="glyphicon glyphicon-floppy-save"></span> ประมวลผล</button>
							
						</div>
					</div>
				</form>

			</div>
			
			<div id="GenerateUser" class="tab-pane fade">
				<br/>
				<form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

					<div class="form-group">
						<label for="acPassword" class="col-sm-3 control-label">บันทึกช่วยจำ</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="tNote" name="tNote" maxlength="100" placeholder="บันทึกช่วยจำ เพิ่มเติม เช่น กิจกรรมวันขึ้นปีใหม่">
							<label style="color: #696a6d; margin-top: 10px;" id="lbtNote"><img src="img/help.png"> ชื่อ - นามสกุล ผู้ขอใช้งาน เช่น อำนวย ปิ่นทอง</label>
						</div>
					</div>
				
					
					<div class="form-group">
						<label for="acUsername" class="col-sm-3 control-label">จำนวนที่ต้องการสร้าง </label>
						<div class="col-sm-7">
							<input type="number" class="form-control" id="iNumOfUser" min="1" max="20" value="1" name="iNumOfUser" placeholder="10">
							<label style="color: #696a6d; margin-top: 10px;" id="lbiNumOfUser"><img src="img/help.png"> จำนวนชื่อบัญชีที่ต้องการสร้าง เช่น 10 เป็นต้น</label>
						</div>
					</div>
					<div class="form-group">
						<label for="acPassword" class="col-sm-3 control-label">อักษรนำหน้า (ตัวเลือก)</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="tPrefix" name="tPrefix" maxlength="2" placeholder="S">
							<label style="color: #696a6d; margin-top: 10px;" id="lbtPrefix"><img src="img/help.png"> ตัวอักษรนำหน้าที่ต้องการ เช่น S เป็นต้น</label>
						</div>
					</div>
				  
					<div class="form-group">
						<label for="emailId" class="col-sm-3 control-label">ความยาวของชื่อบัญชี</label>
						<div class="col-sm-7">
							<input type="number" class="form-control" id="iLenOfUser" min="4" max="13" value="8" name="iLenOfUser" placeholder="8">
							<label style="color: #696a6d; margin-top: 10px;" id="lbiLenOfUser"><img src="img/help.png"> ความยาวของบัญชีผู้ใช้ เช่น 8</label>
						</div>
					</div>					  					  
					<div class="form-group">
						<label for="acMacAddress" class="col-sm-3 control-label">ความยาวของรหัสผ่าน</label>
						<div class="col-sm-7">
							<input type="number" class="form-control" id="iLenOfPasswd" name="iLenOfPasswd" min="4" max="13" value="8" placeholder="8">
							<label style="color: #696a6d; margin-top: 10px;" id="lbiLenOfPasswd"><img src="img/help.png"> ความยาวของรหัสผ่าน เช่น 8</label>
						</div>
					</div>
					
					<div class="form-group">
						<label for="acConfirmPassword" class="col-sm-3 control-label">สถานะ</label>
						<div class="col-sm-7">
							<div class="radio">
								<label><input type="radio" name="tstatus" checked>อนุมัติ</label>								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="acConfirmPassword" class="col-sm-3 control-label">แพ็คเกตอินเตอร์เน็ต</label>
						<div class="col-sm-7">
							<div class="row gutter">                          
							  	<div class="col-md-8 col-sm-4 col-xs-4">
							        <select id="pfID" class="selectpicker" data-show-subtext="true" data-live-search="true" name="pfID" value="">                                
							        	
							        	<?php

							        		$tSQL = "SELECT pfID, pfName FROM  tbl_master_profiles";
											$rs = $mcon->query($tSQL);
											if($rs->num_rows > 0){
												while($rows = $rs->fetch_assoc()){													
													echo "<option value=\"".$rows['pfID']."\">".$rows['pfName']."</option>";
												}
											}


							        	?>		
	                              	</select>
								</div>
							</div>					
						</div>
					</div>	

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button type="submit" class="btn btn-info" name="btnBatchGen" id="btnBatchGen"><span class="glyphicon glyphicon-floppy-save"></span> ประมวลผล</button>
						</div>
					</div>
				</form>
			</div>
			

			</div>
			<!-- end row-->
            

          </div>
          <!-- Left Sidebar End -->

 
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

			$("#lbUsername").hide();
			$("#lbPassword").hide();
			$("#lbConfirmPassword").hide();
			$("#lbIPAddress").hide();
			$("#lbMacAddress").hide();
			$("#lbRoute").hide();
			$("#lbtFullName").hide();
			$("#lbtNote").hide();

			//Generate User hide label
			$("#lbiNumOfUser").hide();
			$("#lbtPrefix").hide();
			$("#lbiLenOfUser").hide();
			$("#lbiLenOfPasswd").hide();
			$("#lbtRoute").hide();



			// lbUsername
			$("#acUsername").focus(function(){
				$("#lbUsername").show();
			});
			
			$("#acUsername").focusout(function(){
				$("#lbUsername").hide();
			});	
			
			// lbPassword
			$("#acPassword").focus(function(){
				$("#lbPassword").show();
			});
			
			$("#acPassword").focusout(function(){
				$("#lbPassword").hide();
			});	

			// lbConfirmPassword
			$("#acConfirmPassword").focus(function(){
				$("#lbConfirmPassword").show();
			});
			
			$("#acConfirmPassword").focusout(function(){
				$("#lbConfirmPassword").hide();
			});	

			// lbIPAddress
			$("#acIPAddress").focus(function(){
				$("#lbIPAddress").show();
			});
			
			$("#acIPAddress").focusout(function(){
				$("#lbIPAddress").hide();
			});	
			
			// lbMacAddress
			$("#acMacAddress").focus(function(){
				$("#lbMacAddress").show();
			});
			
			$("#acMacAddress").focusout(function(){
				$("#lbMacAddress").hide();
			});	
			
			// lbRoute
			$("#acRoute").focus(function(){
				$("#lbRoute").show();
			});
			
			$("#acRoute").focusout(function(){
				$("#lbRoute").hide();
			});

			//Generate user
			// lbiNumOfUser
			$("#iNumOfUser").focus(function(){
				$("#lbiNumOfUser").show();
			});
			$("#iNumOfUser").focusout(function(){
				$("#lbiNumOfUser").hide();
			});	

			// tPrefix
			$("#tPrefix").focus(function(){
				$("#lbtPrefix").show();
			});
			$("#tPrefix").focusout(function(){
				$("#lbtPrefix").hide();
			});	

			// lbiLenOfUser
			$("#iLenOfUser").focus(function(){
				$("#lbiLenOfUser").show();
			});
			$("#iLenOfUser").focusout(function(){
				$("#lbiLenOfUser").hide();
			});	

			// lbiLenOfPasswd
			$("#iLenOfPasswd").focus(function(){
				$("#lbiLenOfPasswd").show();
			});
			$("#iLenOfPasswd").focusout(function(){
				$("#lbiLenOfPasswd").hide();
			});	

			// lbiLenOfPasswd
			$("#tRoute").focus(function(){
				$("#lbtRoute").show();
			});
			$("#tRoute").focusout(function(){
				$("#lbtRoute").hide();
			});	


			// Convert to Second
			$("#btnSesConvertToSec").click(function(){
				
				var iOrgTime = $("#pfSessionTimeout").val();
				var iCalcTime = iOrgTime * 60;				
				$("#pfSessionTimeout").val(iCalcTime);
				
			});	
			
			// Convert to Second
			$("#btnIdleConvertToSec").click(function(){
				
				var iOrgTime = $("#pfIdleTimeout").val();
				var iCalcTime = iOrgTime * 60;
				$("#pfIdleTimeout").val(iCalcTime);
				
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

			// allow numberic only
			$(document).on("input", "#iNumOfUser", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});


			// Random username
			$("#btnGenUser").click(function(){
				
				var strRandom = stringGen(8);				
				$("#acUser").val(strRandom);
				
			});
			// Random password
			$("#btnGenPass").click(function(){
				
				var strRandom = stringGen(8);				
				$("#acPasswd").val(strRandom);
				
			});
			// Copy password
			$("#btnCopyPass").click(function(){
				
				var strPassWd = $("#acPasswd").val();
				$("#acConfirmPassword").val(strPassWd);
				
			});
			
			// function random secret key
			function stringGen(len)
			{
				var text = "";			
				var charset = "abcdefghijklmnopqrstuvwxyz0123456789";			
				for( var i=0; i < len; i++ )
					text += charset.charAt(Math.floor(Math.random() * charset.length));			
				return text;
			}
			
			function PassGen(len)
			{
				var text = "";			
				var charset = "0123456789";			
				for( var i=0; i < len; i++ )
					text += charset.charAt(Math.floor(Math.random() * charset.length));			
				return text;
			}
			
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
				var pattern=new String("__:__:__:__:__:__"); // กำหนดรูปแบบในนี้
				var pattern_ex=new String(":"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
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