<?php

// Initial values
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

  <?php

      //แสดงข้อความ popup เมื่อสั่งลบรายการสำเร็จ
      // ตรวจสอบว่ามีการสั่งลบหรือไม่
      if(isset($_REQUEST['mod']) && isset($_REQUEST['id'])){

        switch($_REQUEST['mod']){
          case 'd':
            $tSQL = "DELETE FROM tbl_master_nas WHERE id=".$_REQUEST['id'].";";
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
            <li><a href="" class="heading">ROUTERS</a></li>
          </ul>
          <div class="custom-search hidden-sm hidden-xs">
            <input type="text" class="search-query" placeholder="ค้นหา ...">
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
						        Router List
                    </div>

                    <span class="tools"><a href="router_form"><span class="glyphicon glyphicon-plus-sign"></span> <strong>Add New</strong></a> | <i class="fa fa-cogs"></i></span>
                  </div>
                  <div class="widget-body">
                    <table class="table table-responsive table-striped table-bordered table-hover no-margin">
                      <thead>
                        <tr>
                          <th style="width:5%">
                            <input type="checkbox" class="no-margin" />
                          </th>
                          <th style="width:40%">
							ชื่อ [Name]
                          </th>
                          <th style="width:20%" class="hidden-xs">
                            Mac Address
                          </th>
                          <th style="width:10%" class="hidden-xs">
                            Status
                          </th>
                          <th style="width:15%" class="hidden-xs">
                            Create Date
                          </th>
                          <th style="width:10%" class="hidden-xs">
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>


<?php

$tSQL = "SELECT id,nasname,shortname,type,ports,secret,SERVER,community,description,SiteName,Nasidentity,HotSpotName,CheckKickInterval,GPS1,GPS2,Contact,Phone,email,STATUS FROM tbl_master_nas ORDER BY id DESC;";
$rs = $mcon->query($tSQL);

if ($rs->num_rows > 0) {

    while($row = $rs->fetch_assoc()) {

		echo "                        <tr>\n";
		echo "                          <td>\n";
		echo "                            <input type=\"checkbox\" class=\"no-margin\" />\n";
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "                            <span class=\"name\">\n";
		echo "                              ".$row['nasname']."\n";
		echo "                            </span>\n";
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "                            00:00:00:00:00:01\n";
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "							<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-globe\"> <span>OFF-LINE</span>	\n";
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "                            15-02-2013\n";
		echo "                          </td>\n";
		echo "                          <td class=\"hidden-xs\">\n";
		echo "                            <div class=\"btn-group\">\n";
		echo "                              <button data-toggle=\"dropdown\" class=\"btn btn-default btn-xs dropdown-toggle\">\n";
		echo "                                Action \n";
		echo "                                <span class=\"caret\"></span>\n";
		echo "                              </button>\n";
		echo "                              <ul class=\"dropdown-menu pull-right\">\n";
		echo "                                <li>\n";
		echo "                                  <a href=\"router_detail?id=".$row['id']."\"><span class=\"glyphicon glyphicon-th-list\" style=\"color: green;\"></span> Detail</a>\n";
		echo "                                </li>\n";
		echo "                                <li>\n";
		echo "                                  <a href=\"router?mod=d&id=".$row['id']."\"onclick=\"return confirm('Are you sure you want to Remove?');\"><span class=\"glyphicon glyphicon-trash\" style=\"color: red;\"></span> Delete</a>\n";
		echo "                                </li>\n";
		echo "                              </ul>\n";
		echo "                            </div>\n";
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
		});
	</script>
  </body>
</html>
