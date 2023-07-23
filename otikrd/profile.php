<?php

session_start();
define('BASEPATH', TRUE);

if(!isset($_SESSION['sUser_id'])){
	header('Location: login.php');
	exit();
}

	
require_once("config.inc.php");
require_once('function.php');

date_default_timezone_set('Asia/Bangkok');

$active = "profile";
$msg = "";

if(isset($_REQUEST['mode']) and isset($_REQUEST['id'])){
	if($_REQUEST['mode']=='del'){
		
		include_once('common.class.php');
		
		// check existing voucher
		$r = $mcon->query("SELECT groupname FROM tbl_master_radusergroup WHERE groupname='".$_REQUEST['id']."' LIMIT 0,1;");

		if($r->num_rows > 0){
			$msg .= msg('ไม่สามารถลบรายการได้ เนื่องจากมีการสร้าง ชื่อบัญชีผูกอยู่กับรายการนี้','warning');	
		}else{
			// delete profile
			$tSQL = "DELETE FROM tbl_master_profiles WHERE pfID='".$_REQUEST['id']."';";
			
			if($mcon->query($tSQL)){
				$mcon->query("DELETE FROM tbl_master_radgroupcheck WHERE groupname='".$_REQUEST['id']."';");
				$mcon->query("DELETE FROM tbl_master_radgroupreply WHERE groupname='".$_REQUEST['id']."';");
				$msg .= msg('ลบรายการเรียบร้อย','success');
				
			}else{
				$msg .= msg('ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้ง','warning');
			}
			
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
    <link href="css/otikstyle.css" rel="stylesheet">
  </head>

  <body>

  <?php

      //แสดงข้อความ popup เมื่อสั่งลบรายการสำเร็จ
      // ตรวจสอบว่ามีการสั่งลบหรือไม่
      if(isset($_REQUEST['mod']) && isset($_REQUEST['id'])){

        switch($_REQUEST['mod']){
          case 'd':

            $tSQL = "DELETE FROM tbl_master_profiles WHERE pfID=".$_REQUEST['id'].";";
            $rs = $mcon->query($tSQL);

            if($rs > 0){
              echo "<script>\n";
              echo "    alert(\"Completed\");\n";
              echo "</script>\n";
            }else{
              echo "<script>\n";
              echo "    alert(\"Not complete.\");\n";
              echo "</script>\n";
            }

            break;
          default:
        }
      }

  ?>

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
            <li><a href="" class="heading">Profiles</a></li>
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
						        รายการกลุ่มชื่อบัญชี
                    </div>
					
					<?php
						if($_SESSION['pProfile']==1){
					?>
                    <span class="tools"><a href="profile_form.php"><span class="glyphicon glyphicon-plus-sign"></span> <strong>เพิ่มแพ็คเกต</strong></a> | <i class="fa fa-cogs"></i></span>
						<?php } ?>
					
                  </div>
                  <div class="widget-body">
                    <table class="table table-responsive table-striped table-bordered table-hover no-margin" style="font-size: 13px;">
                      <thead>
                        <tr>
                          <th style="width:5%">
                            <input type="checkbox" class="no-margin" />
                          </th>
                          <th style="width:20%">
							ชื่อแพ็คเกต
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
                            แบนวิดที่ไดรับ
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
                            เวลาที่ใช้งานได้
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
                            หมดอายุภายใน
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
                            จำนวนบัญชี
                          </th>                           
                          <th style="width:15%; text-align: right;" class="hidden-xs">
                            ราคาจำหนาย (บาท)
                          </th>                          
                          <th style="width:10%; text-align: center;" class="hidden-xs">
                            ดำเนินการ
                          </th>
                        </tr>
                      </thead>
                      <tbody>


						<?php

						$tSQL = "
								  SELECT
									pf.pfID,
									pf.pfName,
									pf.pfSpeedLimitUp,
									pf.pfSpeedLimitDown,
									pf.pfAddressList,
									pf.pfUrlRedirect,
									pf.pfShareUsers,
									pf.pfSessionTimout,
									pf.pfIdleTimeout,
									pf.pfUptime,
									pf.pfValidity,
									pf.pfStatus,
									pf.WhoCreate,
									pf.DateCreate,
									pf.WhoUpdate,
									pf.DateUpdate,
									pf.pfPriority,
									pf.pfPrice,
									IFNULL(ac.cnt, 0) cnt
								  FROM
									tbl_master_profiles AS pf
									LEFT JOIN
									  (SELECT
										pfID,
										COUNT(acID) cnt
									  FROM
										tbl_trans_account
									  GROUP BY pfID) ac
									  ON pf.pfID = ac.pfID
									  ORDER BY pf.pfID DESC
							";

						$rs = $mcon->query($tSQL);

						if ($rs->num_rows > 0) {

							while($row = $rs->fetch_assoc()) {

								echo "                        <tr>\n";
								echo "                          <td>\n";
								echo "                            <input type=\"checkbox\" class=\"no-margin\" />\n";
								echo "                          </td>\n";
								echo "                          <td>\n";
								echo "                            <span class=\"name\">\n";
								echo "                              <b>".$row['pfName']."</b>\n";
								echo "                            </span>\n";
								echo "                          </td>\n";
								echo "                          <td align=\"center\">\n";

							if($row['pfSpeedLimitUp']=="" & $row['pfSpeedLimitDown']==""){
								echo "Unlimited";
							}else if($row['pfSpeedLimitUp']==""){
								echo "Unlimited/".$row['pfSpeedLimitDown']."\n"; 
							}else if($row['pfSpeedLimitDown']==""){
								echo "".$row['pfSpeedLimitUp']."/Unlimited\n"; 
							}else{
								echo "".$row['pfSpeedLimitUp']."/".$row['pfSpeedLimitDown']."\n"; 
							}

								echo "                          </td>\n";
								echo "                          <td align=\"center\">\n";
								echo "							               ".UpTime($row['pfUptime'])."	\n";
								echo "                          </td>\n";
								echo "                          <td align=\"center\">\n";
								echo "                            ".dValidity($row['pfValidity'])."\n";
								echo "                          </td>\n";
								echo "                          <td align=\"center\">\n";
								echo "                            ".$row['cnt']."\n";
								echo "                          </td>\n";
								echo "                          <td align=\"right\">\n";
								echo "                            ".$row['pfPrice']."\n";
								echo "                          </td>\n";        
								echo "                          <td class=\"hidden-xs\" style=\"text-align: center;\">\n";
								
								if($_SESSION['pProfile']==1){
									echo "	<button onclick=\"ProfileEdit('".$row['pfID']."')\" class=\"btn btn-warning btn-sm\"><span class=\"glyphicon glyphicon-edit\"></span></button>";
									echo "	<button onclick=\"ProfileDel('".$row['pfID']."')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-trash\"></span></button>";								
								}else{
									echo "	<button disabled onclick=\"ProfileEdit('".$row['pfID']."')\" class=\"btn btn-warning btn-sm\"><span class=\"glyphicon glyphicon-edit\"></span></button>";
									echo "	<button disabled onclick=\"ProfileDel('".$row['pfID']."')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-trash\"></span></button>";																	
								}
								
								echo "                          </td>\n";
								echo "                        </tr>\n";
							}
						}
							$mcon->close();

							?>



                      </tbody>
                    </table>
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
		$(document).ready(function(){

			$("#lbSiteName").hide();
			$("#lbNasidentity").hide();
			$("#lbHotspotName").hide();
			$("#lbServer").hide();
			$("#lbType").hide();
			$("#lbPorts").hide();
			$("#lbSecret").hide();
			$("#lbDescription").hide();
			$("#lbContact").hide();
			$("#lbPhone").hide();
			$("#lbEmail").hide();
			$("#lbStatus").hide();
			$("#lbGPS1").hide();
			$("#lbGPS2").hide();
			$("#lbCheckKickInterval").hide();

			// tSiteName
			$("#tSiteName").focus(function(){
				$("#lbSiteName").show();
			});

			$("#tSiteName").focusout(function(){
				$("#lbSiteName").hide();
			});

			// tSiteName
			$("#tNasidentity").focus(function(){
				$("#lbNasidentity").show();
			});

			$("#tNasidentity").focusout(function(){
				$("#lbNasidentity").hide();
			});
			// tHotspotName
			$("#tHotspotName").focus(function(){
				$("#lbHotspotName").show();
			});

			$("#tHotspotName").focusout(function(){
				$("#lbHotspotName").hide();
			});
			// tServer
			$("#tServer").focus(function(){
				$("#lbServer").show();
			});

			$("#tServer").focusout(function(){
				$("#lbServer").hide();
			});
			// tType
			$("#tType").focus(function(){
				$("#lbType").show();
			});

			$("#tType").focusout(function(){
				$("#lbType").hide();
			});
			// tPorts
			$("#tPorts").focus(function(){
				$("#lbPorts").show();
			});

			$("#tPorts").focusout(function(){
				$("#lbPorts").hide();
			});
			// tSecret
			$("#tSecret").focus(function(){
				$("#lbSecret").show();
			});

			$("#tSecret").focusout(function(){
				$("#lbSecret").hide();
			});
			// tDescription
			$("#tDescription").focus(function(){
				$("#lbDescription").show();
			});

			$("#tDescription").focusout(function(){
				$("#lbDescription").hide();
			});
			// tContact
			$("#tContact").focus(function(){
				$("#lbContact").show();
			});

			$("#tContact").focusout(function(){
				$("#lbContact").hide();
			});
			// tPhone
			$("#tPhone").focus(function(){
				$("#lbPhone").show();
			});

			$("#tPhone").focusout(function(){
				$("#lbPhone").hide();
			});
			// tEmail
			$("#tEmail").focus(function(){
				$("#lbEmail").show();
			});

			$("#tEmail").focusout(function(){
				$("#lbEmail").hide();
			});
			// tStatus
			$("#tStatus").focus(function(){
				$("#lbStatus").show();
			});

			$("#tStatus").focusout(function(){
				$("#lbStatus").hide();
			});
			// lbGPS1
			$("#tGPS1").focus(function(){
				$("#lbGPS1").show();
			});

			$("#tGPS1").focusout(function(){
				$("#lbGPS1").hide();
			});
			// tStatus
			$("#tGPS2").focus(function(){
				$("#lbGPS2").show();
			});

			$("#tGPS2").focusout(function(){
				$("#lbGPS2").hide();
			});
			// lbCheckKickInterval
			$("#tCheckKickInterval").focus(function(){
				$("#lbCheckKickInterval").show();
			});

			$("#tCheckKickInterval").focusout(function(){
				$("#lbCheckKickInterval").hide();
			});

			// Random Secret key
			$("#btnRandom").click(function(){

				var strRandom = stringGen(40);
				//alert(strRandom);
				$("#tSecret").val(strRandom);

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

			// allow numberic only
			$(document).on("input", "#tPorts", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});

			$(document).on("input", "#tGPS1", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});

			$(document).on("input", "#tGPS2", function() {
				this.value = this.value.replace(/[^\d\.\-]/g,'');
			});
			
			// hide msg
			$("#success-msg").fadeTo(2000, 500).slideUp(500, function(){
				$("#success-msg").slideUp(500);
			});
	
	
		});
	</script>
	<script>
		function ProfileDel(str){
			var id = str;
			if (confirm("คุณต้องการลบรายการนี้จริงหรือไม่ กรุณายืนยัน?")) {
				window.location = 'profile.php?mode=del&id='+id;
			} else {
				false;
			}
		}
		
		function ProfileEdit(str)
		{
			var id = str
			window.location = 'profile_form.php?mode=edit&id='+id;
		}
	</script>
	
  </body>
</html>
