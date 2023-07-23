<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}

	$active = "configure";
	
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}
	
	if(isset($_REQUEST['btnSave'])){
	
		if($_REQUEST['acPass']=='' OR $_REQUEST['acPassConfirm']==''){
			echo "<center>";
			echo "Please fill password and confirm password.";
			echo "<br/>";
			echo "<a href=\"#\" onclick=\"window.history.go(-1); return false;\"> กลับไปแก้ไข </a>";
			echo "</center>";
			exit();			
		}else if($_REQUEST['acPass'] <> $_REQUEST['acPassConfirm']){
			echo "<center>";
			echo "Password and Confirm password not match.";
			echo "<br/>";
			echo "<a href=\"#\" onclick=\"window.history.go(-1); return false;\"> กลับไปแก้ไข </a>";
			echo "</center>";
			exit();				
		}else{
			require_once("config.inc.php");			
			
			$tSQL = "UPDATE tbl_master_administrator SET uPasswd = '".MD5($_REQUEST['acPass'])."' WHERE uUserName='".$_REQUEST['acUser']."';";			
			
			if($mcon->query($tSQL)){
				$mcon->close();
				echo '<script language="javascript">';
				echo 'alert("บันทึกรายการเรียบร้อย")';
				echo '</script>';
				echo '<meta http-equiv="refresh" content="0;url=online.php">';
			}else{
				$mcon->close();
				echo '<script language="javascript">';
				echo 'alert("ไม่สามารถบันทึกรายการได้")';
				echo '</script>';
				echo '<meta http-equiv="refresh" content="0;url=account_form.php">';				
			}
			
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
    <link href="css/wysi/bootstrap-wysihtml5.css" rel="stylesheet">

    <link href="css/new.css" rel="stylesheet">
    <!-- Important. For Theming change primary-color variable in main.css  -->

    <!-- Color Picker -->
    <link rel="stylesheet" href="css/color-picker/jquery.minicolors.css">

    <link href="fonts/font-awesome.min.css" rel="stylesheet">
    <link href="css/otikstyle.css" rel="stylesheet">
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
            <li><a href="" class="heading">เปลี่ยนรหัสผ่าน</a></li>
          </ul>

        </div>
        <!-- Sub Nav End -->

        <!-- Dashboard Wrapper Start -->
        <div class="dashboard-wrapper">
          
          <!-- Left Sidebar Start -->
          <div class="left-sidebar">
            
                       

            <!-- Row Start -->
            <div class="row gutter">
              <div class="col-lg-11 col-md-11">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						เปลี่ยนรหัสผ่านผู้ใช้งาน					
                    </div>
                  </div>
					  <div class="widget-body">
						<form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
							<div class="form-group">
								<label for="acUser" class="col-sm-3 control-label">ชื่อบัญชี </label>
								<div class="col-sm-6">
									<div class="input-group">
										<input type="text" class="form-control" id="acUser" name="acUser" maxlength="13" value="<?php echo $id; ?>" placeholder="Username" readonly>
									</div>								
								</div>
							</div>		
							<div class="form-group">
								<label for="acUser" class="col-sm-3 control-label">รหัสผ่านใหม่ </label>
								<div class="col-sm-6">
									<div class="input-group">
										<input type="password" class="form-control" id="acPass" name="acPass" maxlength="13" placeholder="Password">
									</div>								
								</div>
							</div>		
							<div class="form-group">
								<label for="acUser" class="col-sm-3 control-label">ยืนยันรหัสผ่าน </label>
								<div class="col-sm-6">
									<div class="input-group">
										<input type="password" class="form-control" id="acPassConfirm" name="acPassConfirm" maxlength="13" placeholder="Confirm password">
									</div>								
								</div>
							</div>	
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-10">							
									<button type="submit" class="btn btn-info" name="btnSave"><span class="glyphicon glyphicon-floppy-save"></span> บันทึก</button>							
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
                       
        </div>
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

    </script>

  </body>
</html>