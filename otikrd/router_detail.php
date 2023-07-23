<?php

// Edit form
$active = "router";
require_once("config.inc.php");


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
            <li><a href="" class="heading">Router [<strong> Edit Mode </strong>]</a></li>
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
		  <span id="result"></span>
			<!-- Rows End -->

            <!-- Row Start -->
            <div class="row gutter">
              <div class="col-lg-12 col-md-12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						Router Details
						<span class="mini-title">Please fill your router details </a></span>
                    </div>
                  </div>

                  <div class="widget-body">
<?php

if($_POST){

	$tSQL = "
			UPDATE tbl_master_nas SET 			
			nasname='".$mcon->real_escape_string($_POST['tSiteName'])."',
			shortname='".$mcon->real_escape_string($_POST['tNasidentity'])."',
			type='".$mcon->real_escape_string($_POST['tType'])."',
			ports='".$mcon->real_escape_string($_POST['tPorts'])."',
			secret='".$mcon->real_escape_string($_POST['tSecret'])."',
			server='".$mcon->real_escape_string($_POST['tServer'])."',
			community='".$mcon->real_escape_string($_POST['tDescription'])."',
			description='".$mcon->real_escape_string($_POST['tDescription'])."',
			SiteName='".$mcon->real_escape_string($_POST['tSiteName'])."',
			Nasidentity='".$mcon->real_escape_string($_POST['tNasidentity'])."',
			HotSpotName='".$mcon->real_escape_string($_POST['tHotspotName'])."',
			CheckKickInterval='".$mcon->real_escape_string($_POST['tCheckKickInterval'])."',
			GPS1='".$mcon->real_escape_string($_POST['tGPS1'])."',
			GPS2='".$mcon->real_escape_string($_POST['tGPS2'])."',
			Contact='".$mcon->real_escape_string($_POST['tContact'])."',
			Phone='".$mcon->real_escape_string($_POST['tPhone'])."',
			email='".$mcon->real_escape_string($_POST['tEmail'])."',
			status='".$mcon->real_escape_string($_POST['tStatus'])."'
			 WHERE id='".$mcon->real_escape_string($_POST['id'])."'
			";


	if($mcon->query($tSQL)){
		echo '<script language="javascript">';
		echo 'alert("บันทึกรายการเรียบร้อย")';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0;url=router.php">';
	}else{
		echo '<script language="javascript">';
		echo 'alert("ไม่สามารถบันทึกรายการได้")';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0;url=router.php">';
	}
	$mcon->close();
	exit();
}
				
		$tSQL = "SELECT * FROM tbl_master_nas WHERE id='".$_REQUEST['id']."' LIMIT 0,1;";
		//echo $tSQL;
		$rs = $mcon->query($tSQL);

		//inial variable
		$id = '';
		$nasname = '';
		$shortname = '';
		$type = '';
		$ports = '';
		$secret = '';
		$server = '';
		$community = '';
		$description = '';
		$SiteName = '';
		$Nasidentity = '';
		$HotSpotName = '';
		$CheckKickInterval = '';
		$GPS1 = '';
		$GPS2 = '';
		$Contact = '';
		$Phone = '';
		$email = '';
		$status = '';
		
if($rs->num_rows > 0){
	while($rows = $rs->fetch_assoc()){
		$id = $rows['id'];
		$nasname = $rows['nasname'];
		$shortname = $rows['shortname'];
		$type = $rows['type'];
		$ports = $rows['ports'];
		$secret = $rows['secret'];
		$server = $rows['server'];
		$community = $rows['community'];
		$description = $rows['description'];
		$SiteName = $rows['SiteName'];
		$Nasidentity = $rows['Nasidentity'];
		$HotSpotName = $rows['HotSpotName'];
		$CheckKickInterval = $rows['CheckKickInterval'];
		$GPS1 = $rows['GPS1'];
		$GPS2 = $rows['GPS2'];
		$Contact = $rows['Contact'];
		$Phone = $rows['Phone'];
		$email = $rows['email'];
		$status = $rows['status'];		
	}
	$mcon->close();
}
?>
                    <form class="form-horizontal no-margin" id="frmRouter" method="POST" action="router_detail.php">
                      <div class="form-group">
					  <input type="hidden" value="<?php echo $id; ?>" name="id">
                        <label for="tSiteName" class="col-sm-3 control-label"><strong>Site Name</strong> * </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tSiteName" name="tSiteName" value="<?php echo $SiteName; ?>" placeholder="SiteName">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbSiteName"><img src="img/help.png"> ชื่อของไซต์ที่ฮ๊อตสป็อตทำการติดตั้ง เช่น Otik-Office</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tNasidentity" class="col-sm-3 control-label"><strong>Nasidentity</strong> *</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tNasidentity" name="tNasidentity" value="<?php echo $Nasidentity; ?>" placeholder="NasIdentity">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbNasidentity"><img src="img/help.png"> ชื่ออุปกรณ์ไมโครติก เช่น Otik-NAS</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tHotspotName" class="col-sm-3 control-label">Hotspot Name</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tHotspotName" name="tHotspotName" value="<?php echo $HotSpotName; ?>" placeholder="Hotspot Server">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbHotspotName"><img src="img/help.png"> ชื่อของฮ๊อตสป็อตในไมโครติก เช่น hotspot1 เป็นต้น</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tServer" class="col-sm-3 control-label">Server</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tServer" name="tServer" value="<?php echo $server; ?>" placeholder="Server">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbServer"><img src="img/help.png"> ไอพีหรือเน็ตเวิร์คของอุปกรณ์ไมโครติก เช่น 10.10.10.99  หรือ 10.10.10.0/24</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tType" class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tType" name="tType" value="<?php echo $type; ?>" placeholder="type" readonly>
						  <label style="color: #696a6d; margin-top: 10px;" id="lbType"><img src="img/help.png"> ประเภทของอุปกรณ์ เช่น other (ไม่สามารถแก้ไขได้)</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tPorts" class="col-sm-3 control-label">Ports</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tPorts" name="tPorts" value="<?php echo $ports; ?>" placeholder="ports" size="5" maxlength="5" onkeydown="validateNumber(event);">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbPorts"><img src="img/help.png"> พอร์ตที่ต้องการสื่อสาร เช่น ค่าพื้นฐานคือ 1812</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tSecret" class="col-sm-3 control-label">Secret</label>
                        <div class="col-sm-7">

							<div class="input-group">
							<input type="text" class="form-control" id="tSecret" name="tSecret" value="<?php echo $secret; ?>" placeholder="secret">
								<span class="input-group-btn">
									<button class="btn btn-danger" type="button" id="btnRandom"><span class="glyphicon glyphicon-random"> </span> Gen</button>
								</span>
							</div>


						  <label style="color: #696a6d; margin-top: 10px;" id="lbSecret"><img src="img/help.png"> รหัสผ่านที่เอาไว้เชื่อมกับอุปกรณ์ไมโครติก เช่น otik@secret12345#</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tCheckKickInterval" class="col-sm-3 control-label">Kick Interval</label>
                        <div class="col-sm-9">
                          <div class="row gutter">
                            <div class="col-md-5 col-sm-5 col-xs-5">
                              <select id="tCheckKickInterval" class="selectpicker" data-show-subtext="true" data-live-search="true" name="tCheckKickInterval" id="tCheckKickInterval">
                                <option value="10">10s</option>
								<option value="20">20s</option>
								<option value="30">30s</option>
								<option value="40">40s</option>
								<option value="50">50s</option>
								<option value="60">60s</option>
                              </select>
							  <label style="color: #696a6d; margin-top: 10px;" id="lbCheckKickInterval"><img src="img/help.png"> ตั้งค่าเวลารีเฟรส เช่น 30 วินาที</label>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tDescription" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tDescription"  name="tDescription" value="<?php echo $description; ?>" placeholder="Description">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbDescription"><img src="img/help.png"> คำอธิบายหรือที่ตั้งของอุปกรณ์ เช่น บริษัท โอติก จำกัด (ลาดพร้าว 71)</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tGPS1" class="col-sm-3 control-label">GPS</label>

                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="tGPS1"  name="tGPS1" value="<?php echo $GPS1; ?>" placeholder="Latitude">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbGPS1"><img src="img/help.png"> ค่าที่ต้้ง-ละติจูด</label>
                        </div>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="tGPS2"  name="tGPS2" value="<?php echo $GPS2; ?>" placeholder="Longtitude">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbGPS2"><img src="img/help.png"> ค่าที่ตั้ง-ลองติจูด</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tContact" class="col-sm-3 control-label">Contact</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tContact"  name="tContact" value="<?php echo $Contact; ?>" placeholder="Contact">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbContact"><img src="img/help.png"> ชื่อผู้ที่ติดต่อในไซต์นั้นๆ เช่น อำนวย ปิ่นทอง</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tPhone" class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tPhone"  name="tPhone" value="<?php echo $Phone; ?>" placeholder="Phone">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbPhone"><img src="img/help.png"> เบอร์โทร เช่น 095-549-9819</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tEmail" class="col-sm-3 control-label">E-mail</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="tEmail" name="tEmail" value="<?php echo $email; ?>" placeholder="E-mail">
						  <label style="color: #696a6d; margin-top: 10px;" id="lbEmail"><img src="img/help.png"> อีเมล์ผู้ติดต่อ เช่น otiksystem@gmail.com</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tStatus" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-7">
						<?php
							// check status on - off
							if($status==1){
								echo "<input type=\"checkbox\" class=\"form-control\" id=\"tStatus\" value=\"1\"  checked data-toggle=\"toggle\" data-on=\"On\" data-off=\"Off\" data-onstyle=\"success\" data-offstyle=\"danger\" name=\"tStatus\" value=\"\" placeholder=\"Status\" >\n"; 
							}else{
								echo "<input type=\"checkbox\" class=\"form-control\" id=\"tStatus\" value=\"1\" checked  data-toggle=\"toggle\" data-on=\"On\" data-off=\"Off\" data-onstyle=\"success\" data-offstyle=\"danger\" name=\"tStatus\" value=\"\" placeholder=\"Status\" >\n";
							}
							
						?>
						  <label style="color: #696a6d; margin-top: 10px;" id="lbStatus"><img src="img/help.png"> สถานะการใช้งาน เช่น เปิด หรือ ปิด</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-info" name="btnCreate" id="btnCreate"><span class="glyphicon glyphicon-floppy-save"></span> บันทึก</button>
						  <button type="button" class="btn btn-danger" name="btnEdit" id="btnEdit"><span class="glyphicon glyphicon-edit"></span> คลิกแก้ไข</button>
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

			$("#tSiteName").attr("disabled","disabled");
			$("#tNasidentity").attr("disabled","disabled");
			$("#tHotspotName").attr("disabled","disabled");
			$("#tServer").attr("disabled","disabled");
			$("#tType").attr("disabled","disabled");
			$("#tPorts").attr("disabled","disabled");
			$("#tSecret").attr("disabled","disabled");
			$("#tDescription").attr("disabled","disabled");
			$("#tContact").attr("disabled","disabled");
			$("#tPhone").attr("disabled","disabled");
			$("#tEmail").attr("disabled","disabled");
			$("#tStatus").attr("disabled","disabled");
			$("#tGPS1").attr("disabled","disabled");
			$("#tGPS2").attr("disabled","disabled");
			$("#tCheckKickInterval").attr("disabled","disabled");
			$("#btnCreate").attr("disabled",true);

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
			
			// edit button
			$("#btnEdit").click(function (){
				$("#tSiteName").attr("disabled",false);
				$("#tNasidentity").attr("disabled",false);
				$("#tHotspotName").attr("disabled",false);
				$("#tServer").attr("disabled",false);
				$("#tType").attr("disabled",false);
				$("#tPorts").attr("disabled",false);
				$("#tSecret").attr("disabled",false);
				$("#tDescription").attr("disabled",false);
				$("#tContact").attr("disabled",false);
				$("#tPhone").attr("disabled",false);
				$("#tEmail").attr("disabled",false);
				$("#tStatus").attr("disabled",false);
				$("#tGPS1").attr("disabled",false);
				$("#tGPS2").attr("disabled",false);
				$("#tCheckKickInterval").attr("disabled",false);
				$("#btnCreate").attr("disabled",false);
				$("#btnEdit").attr("disabled",true);
			});

		});
	</script>
  </body>
</html>
