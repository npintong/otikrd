<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}

	$active = "setting";
	
	if($_SESSION['pSetting']==0){
		echo "Permission deny";
		exit();
	}
	
  require_once("config.inc.php");

  if(isset($_POST['btnconfirm'])){
		
		$tSQL = "UPDATE tbl_master_setting SET ";
    $tSQL .=" sOption1='".$_POST['sOption1']."',";
    $tSQL .=" sOption2='".$_POST['sOption2']."',";   
    $tSQL .=" iOption1='".$_POST['iOption1']."',";
    $tSQL .=" iOption2=0,";
    $tSQL .=" iOption3=0";
    $tSQL .=" WHERE id='1';";

    if($mcon->query($tSQL)){
      echo '<script language="javascript">';
      echo 'alert("บันทึกรายการเรียบร้อยแล้ว")';
      echo '</script>';
    }else{
      echo '<script language="javascript">';
      echo 'alert("Error")';
      echo '</script>';
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
            <li><a href="" class="heading">System Setting</a></li>
          </ul>

        </div>
        <!-- Sub Nav End -->

        <!-- Dashboard Wrapper Start -->
        <div class="dashboard-wrapper">
          
          <!-- Left Sidebar Start -->
          <div class="left-sidebar">

		  <?php 
			if(isset($msg)){
				echo $msg;
			}
		  ?>
		  
			<!-- Row Start -->
            <div class="row gutter">
              <div class="col-lg-12 col-md-12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						        ตั้งระบบการแจ้งเตือนผ่านไลน์แอบพลิเคชั่น | Line Notify
                    </div>
                  </div>

                  <div class="widget-body">
                    <?php

                      $tSQL = "SELECT * FROM tbl_master_setting WHERE id='1' LIMIT 1;";
                      $rs = $mcon->query($tSQL)->fetch_assoc();

                      $sOption1 = $rs['sOption1']; // token
                      $sOption2 = $rs['sOption2']; // 
                      $iOption1 = $rs['iOption1']; // enable & disalbe
                      $iOption2 = $rs['iOption2'];
                      $iOption3 = $rs['iOption3'];
                      


                    ?>
                    
                    <form class="form-horizontal no-margin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    
                        <div class="form-group">
                          <label for="acPassword" class="col-sm-2 control-label">การใช้งาน</label>
                          <div class="col-sm-6">
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="op1" name="iOption1" value="1" <?=$result = ($iOption1 == '1') ? ' checked' : '';?>> &nbsp;เปิด
                              &nbsp;&nbsp;
                              <input type="radio" class="form-check-input" id="op2" name="iOption1" value="0" <?=$result = ($iOption1 == '0') ? ' checked' : '';?>> &nbsp;ปิด
                              
                            </div>

                          </div>
                        </div>

                        <div class="form-group">
                          <label for="acPassword" class="col-sm-2 control-label">โทคเค่น (Token)</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="sOption1" name="sOption1" maxlength="100" value="<?=$sOption1;?>" placeholder="กรอก Token ของไลน์">						
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="acPassword" class="col-sm-2 control-label">ข้อความที่</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="sOption2" name="sOption2" maxlength="100" value="<?=$sOption2;?>" placeholder="กรอก ข้อความที่ 1">						
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            
                            <button type="submit" class="btn btn-info" name="btnconfirm"><span class="glyphicon glyphicon-floppy-save"></span> บันทึก</button>
                            
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
    

	<script>
    $(document).ajaxStart(function(){
      $('#loading').show();
    }).ajaxStop(function(){
      $('#loading').hide();
    });
    
    $("#success-msg").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-msg").slideUp(500);
    });		
		
	</script>
	

  </body>
</html>

