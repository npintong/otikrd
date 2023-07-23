<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}
	
	$active = "configure";
	$msg = "";

	if(isset($_POST['cmdSave'])){
		
		require_once('config.inc.php');
		require_once('common.class.php');
		
	if(empty($_REQUEST['tFullName']) or empty($_REQUEST['tEmail']))
		{
			$msg .= msg('คุณต้องกรอกข้อมูลให้ครบทุกช่องที่มีเครื่องหมาย * ลองใหม่อีกครั้ง','warning');
			$tUserName = $_REQUEST['tUserName'];
			$tFullName = $_REQUEST['tFullName'];
			$tEmail = $_REQUEST['tEmail'];
			$tAddress = $_REQUEST['tAddress'];
			
		}else{

			$tSQL = "
					UPDATE tbl_master_administrator SET							
					uFullName='".$_REQUEST['tFullName']."', 
					uStatus='".$_REQUEST['tStatus']."', 							
					uUpdDate=NOW(),							
					uEmail='".$_REQUEST['tEmail']."',
					uPersProfile='".$_REQUEST['tPersProfile']."',
					uPersAccount='".$_REQUEST['tPersAccount']."',
					uPersReports='".$_REQUEST['tPersReports']."',
					uPersOnline='".$_REQUEST['tPersOnline']."',
					uAddress='".$_REQUEST['tAddress']."'
					WHERE uUserName='".$_REQUEST['tUserName']."';
					";
					
				if($mcon->query($tSQL))
				{
					$msg .=msg('บันทึกรายการสำเร็จ','success');
					echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=configure.php">';
					exit();
				}else{
					$msg .=msg('ไม่สามารถบันทึกรายการได้ กรุณาตรวจสอบอีกครั้ง','danger');
					$tUserName = $_REQUEST['tUserName'];
					$tFullName = $_REQUEST['tFullName'];
					$tEmail = $_REQUEST['tEmail'];
					$tAddress = $_REQUEST['tAddress'];							
					}
				
		}
	$mcon->close();
	}
		
	if(isset($_REQUEST['id'])){
		require_once('config.inc.php');
		$detail = $mcon->query("SELECT * FROM tbl_master_administrator WHERE uUserName='".$_REQUEST['id']."' LIMIT 0,1");
		
		while($row = $detail->fetch_assoc()){
			
			$tUserName = $row['uUserName'];
			$tFullName = $row['uFullName'];
			$tEmail = $row['uEmail'];
			$tAddress = $row['uAddress'];
			$tStatus = $row['uStatus'];
			$tPersProfile = $row['uPersProfile'];
			$tPersAccount = $row['uPersAccount'];
			$tPersReports = $row['uPersReports'];
			$tPersOnline = $row['uPersOnline'];
			
		}
		$mcon->close();
	}
	
	if(isset($_REQUEST['mode']) and isset($_REQUEST['id'])){
		if($_REQUEST['mode']=='d' and $_REQUEST['id']<>''){
			
			require_once('config.inc.php');
			$mcon->query("DELETE FROM tbl_master_administrator WHERE uUserName='".$_REQUEST['id']."' LIMIT 0,1;");
			
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=configure.php">';
			exit();
			
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
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">

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
            <li><a href="" class="heading">บันทึกผู้ดูแลระบบ</a></li>
          </ul>

        </div>
        <!-- Sub Nav End -->

        <!-- Dashboard Wrapper Start -->
        <div class="dashboard-wrapper">
          
          <!-- Left Sidebar Start -->
          <div class="left-sidebar">

		  <!-- Row Start -->
		  <span id="result"></span>
			<!-- Rows End -->
			
			<?php echo $msg; ?>
			
            <!-- Row Start -->
            <div class="row gutter">
              <div class="col-lg-12 col-md-12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						ฟอร์มบันทึกผู้ดูแลระบบ
						<span class="mini-title">administrator form. </a></span>
                    </div>
                  </div>
				  
                  <div class="widget-body">

                    <form class="form-horizontal no-margin" id="frmUsers" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> ">
                      <div class="form-group">
                        <label for="tUserName" class="col-sm-3 control-label">ชื่อผู้ใช้ *</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tUserName" name="tUserName" value="<?=(( isset($tUserName))?$tUserName:'')?>" placeholder="User Name" disabled>
						  <label style="color: #696a6d; margin-top: 10px;" id="lbUserName"><img src="img/help.png"> ชื่อบัญชีผู้ใช้ ภาษาอังกฤษเท่านั้น เช่น amnuay และต้องไม่ซ้ำกันในระบบ</label>
						  <input type="hidden" name="tUserName" value="<?=(( isset($tUserName))?$tUserName:'')?>">
						  
                        </div>
                      </div>					  					  				  					
                      <div class="form-group">
                        <label for="tFullName" class="col-sm-3 control-label"><strong>ชื่อ - นามสกุล</strong> * </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tFullName" name="tFullName" value="<?=(( isset($tFullName))?$tFullName:'')?>" placeholder="Full name">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbFullName"><img src="img/help.png"> กำหนดชื่อ - นามสกุล เช่น อำนวย ปิ่นทอง</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tEmail" class="col-sm-3 control-label"><strong>อีเมล</strong> * </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tEmail" name="tEmail" value="<?=(( isset($tEmail))?$tEmail:'')?>" placeholder="Email">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbEmail"><img src="img/help.png"> กำหนดอีเมล เช่น amnuay@otiknetwork.com</label>
                        </div>
                      </div>					  
                      <div class="form-group">
                        <label for="tAddress" class="col-sm-3 control-label"><strong>ที่อยู่</strong> </label>
                        <div class="col-sm-7">
                          <textarea  class="form-control" rows="4" cols="50" id="tAddress" name="tAddress" placeholder="Address"><?=(( isset($tAddress))?$tAddress:'')?></textarea>
						  <label style="color: #696a6d; margin-top: 10px;" id="lbAddress"><img src="img/help.png"> กำหนดที่อยู่ของท่าน เช่น ลาดพร้าว กรุงเทพฯ 10230</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tPersProfile" class="col-sm-3 control-label"><strong>สิทธิ์เมนู Profile [PRF]</strong> </label>
                        <div class="col-sm-7">
							<div class="radio">
							  <label><input type="radio" name="tPersProfile" value="1" <?php if(isset($tPersProfile)){ if($tPersProfile==1){ echo "checked"; }} ?>>ทุกอย่าง</label>							  
							  <label><input type="radio" name="tPersProfile" value="0" <?php if(isset($tPersProfile)){ if($tPersProfile==0){ echo "checked"; }} ?>>อ่านอย่างเดียว</label>							  
							</div>								
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tPersAccount" class="col-sm-3 control-label"><strong>สิทธิ์เมนู Account [ACT]</strong> </label>
                        <div class="col-sm-7">
							<div class="radio">
							  <label><input type="radio" name="tPersAccount" value="1"  <?php if(isset($tPersAccount)){ if($tPersAccount==1){ echo "checked"; }} ?>>ทุกอย่าง</label>							  
							  <label><input type="radio" name="tPersAccount" value="0"  <?php if(isset($tPersAccount)){ if($tPersAccount==0){ echo "checked"; }} ?>>อ่านอย่างเดียว</label>							  
							</div>								
                        </div>
                      </div>	
                      <div class="form-group">
                        <label for="tPersReports" class="col-sm-3 control-label"><strong>สิทธิ์เมนู SYS [SYS]</strong> </label>
                        <div class="col-sm-7">
							<div class="radio">
							  <label><input type="radio" name="tPersReports" value="1"  <?php if(isset($tPersReports)){ if($tPersReports==1){ echo "checked"; }} ?>>ทุกอย่าง</label>							  
							  <label><input type="radio" name="tPersReports" value="0"  <?php if(isset($tPersReports)){ if($tPersReports==0){ echo "checked"; }} ?>>ไม่มีสิทธิ์</label>							  
							</div>								
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tPersOnline" class="col-sm-3 control-label"><strong>สิทธิ์เมนู Online [ONL]</strong> </label>
                        <div class="col-sm-7">
							<div class="radio">
							  <label><input type="radio" name="tPersOnline" value="1"  <?php if(isset($tPersOnline)){ if($tPersOnline==1){ echo "checked"; }} ?>>ทุกอย่าง</label>							  
							  <label><input type="radio" name="tPersOnline" value="0"  <?php if(isset($tPersOnline)){ if($tPersOnline==0){ echo "checked"; }} ?>>ไม่มีสิทธิ์</label>							  
							</div>								
                        </div>
                      </div>					  
                      <div class="form-group">
                        <label for="uGrpID" class="col-sm-3 control-label"><strong>สถานะ</strong> </label>
                        <div class="col-sm-7">
							<div class="radio">
							  <label><input type="radio" name="tStatus" value="1" <?php if(isset($tStatus)){ if($tStatus==1){ echo "checked"; }} ?>>ใช้งาน</label>
							  <label><input type="radio" name="tStatus"  value="0" <?php if(isset($tStatus)){ if($tStatus==0){ echo "checked"; }} ?>>ยกเลิก</label>
							</div>								
                        </div>
                      </div>					  
                      <div class="form-group">
                        <label for="tPicture" class="col-sm-3 control-label"><strong>รูปภาพ</strong> </label>
                        <div class="col-sm-7">
                          <input type="file" class="form-control" id="tPicture" name="tPicture" value="" placeholder="picture">						  
                        </div>
                      </div>					  
					  
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-info" name="cmdSave" id="btnCreate">บันทึก</button>						  
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
          <div class="right-sidebar" style="display:none;">
            
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
    <script src="js/bootstrap-toggle.min.js"></script>
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


    </script>
	
	<script>
		
		$("#success-msg").fadeTo(2000, 500).slideUp(500, function(){
			$("#success-msg").slideUp(500);
		});
		
		$(document).ready(function(){

			$("#lbFullName").hide();
			$("#lbEmail").hide();
			$("#lbAddress").hide();
			$("#lbUserName").hide();
			$("#lbPasswd").hide();
			$("#lbConfPasswd").hide();
			
			// FullName
			$("#tFullName").focus(function(){
				$("#lbFullName").show();
			});
			
			$("#tFullName").focusout(function(){
				$("#lbFullName").hide();
			});	

			// Email
			$("#tEmail").focus(function(){
				$("#lbEmail").show();
			});
			
			$("#tEmail").focusout(function(){
				$("#lbEmail").hide();
			});	
			
			// Address
			$("#tAddress").focus(function(){
				$("#lbAddress").show();
			});
			
			$("#tAddress").focusout(function(){
				$("#lbAddress").hide();
			});	

			// UserName
			$("#tUserName").focus(function(){
				$("#lbUserName").show();
			});
			
			$("#tUserName").focusout(function(){
				$("#lbUserName").hide();
			});	

			// Passwd
			$("#tPasswd").focus(function(){
				$("#lbPasswd").show();
			});
			
			$("#tPasswd").focusout(function(){
				$("#lbPasswd").hide();
			});	

			// ConfPasswd
			$("#tConfPasswd").focus(function(){
				$("#lbConfPasswd").show();
			});
			
			$("#tConfPasswd").focusout(function(){
				$("#lbConfPasswd").hide();
			});	
			
		});
	</script>

	
	
  </body>
</html>