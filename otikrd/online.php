<?php

session_start();
define('BASEPATH', TRUE);

if(!isset($_SESSION['sUser_id'])){
	header('Location: login.php');
	exit();
}
	
$active = "online";
require_once("config.inc.php");
require_once('function.php');

date_default_timezone_set('Asia/Bangkok');
$msg ="";

if(isset($_REQUEST['mode']) && isset($_REQUEST['id'])){
	
	if($_REQUEST['mode']=='del' && $_REQUEST['id']!=''){
		
		require_once('config.inc.php');
		require_once('common.class.php');

		
		if($mcon->query("delete from tbl_trans_account where acUser='".$_REQUEST['id']."';")){
			$mcon->query("delete from tbl_master_radusergroup where username='".$_REQUEST['id']."';");
			$msg .= msg('ลบรายการเรียบร้อย','success');
		}else{
			$msg .= msg('ไม่สามารถทำรายการได้','warning');
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
    <link href="fonts/font-awesome.min.css" rel="stylesheet">
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
            <li><a href="" class="heading">User Online</a></li>
          </ul>
		  
          <div class="custom-search hidden-sm hidden-xs">
			<form method="GET" action="account_detail.php" target="_blank" name="frmsearch">
            <input type="text" class="search-query" name="id" id="id" placeholder="ตรวจสอบการใช้งานผู้ใช้ ...">
			</form>
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
			<?php echo $msg; ?>
			
			<!-- Row Start -->
            <div class="row gutter">
              <div class="col-lg-12 col-md-12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						        รายการผู้ใช้ ออนไลน์ ปัจจุบัน
                    </div>					
                    
					
                  </div>
                  <div class="widget-body">
                
				  
                    <!--<table class="table table-responsive table-striped table-bordered table-hover no-margin">-->
					<table class="table table-condensed table-striped table-hover table-bordered no-margin" style="font-size: 13px;">
                      <thead style="height: 35px;">
                        <tr">
                          <th style="width:2%; text-align: center;">
                            <!--<input type="checkbox" class="no-margin" id="chkall" />-->
                          </th>
                          <th style="width:10%">
							ชื่อบัญชีผู้ใช้
                          </th>
                          <th style="width:10%; text-align: left;" class="hidden-xs">
							วันที่เริ่มใช้งาน
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							เข้าใช้งานจาก
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							MAC Address
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							เลขไอพีที่ใช้งาน
                          </th>                           
                          <th style="width:10% ; text-align: center;" class="hidden-xs">
							สถานะ
                          </th> 
<!--						  
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							ยกเลิกใช้งาน
                          </th>
						  -->
                        </tr>
                      </thead>
                      <tbody>


<?php

$tSQL = "SELECT count(*)cnt FROM tbl_master_radacct WHERE acctstoptime  is null";
$rs = $mcon->query($tSQL)->fetch_assoc();
$total_record = $rs['cnt'];


$pagelen = 16; // กำหนดให้แสดงกี่เร็คคอร์ดต่อหนึ่งหน้าจอ
$page = (( isset($_REQUEST['page']))?$_REQUEST['page']:''); // รับหมายเลขหน้า

if(empty($page)){ $page=1;} // ตรวจสอบมีหน้าหรือปล่าว

$totalpage = ceil($total_record/$pagelen); // หาจำนวนหน้าจากเร้คคอร์ดทั้งหมด
$goto = ($page-1) * $pagelen;

//echo $totalpage;


$tSQL = "SELECT * FROM tbl_master_radacct WHERE acctstoptime is null LIMIT ".$goto.",".$pagelen.";
    ";

$rs = $mcon->query($tSQL);
$no=1;
if ($rs->num_rows > 0) {

    while($row = $rs->fetch_assoc()) {

		echo "                        <tr>\n";
		echo "                          <td  style=\"text-align: center;\">\n";
		
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "                            <span class=\"name\">\n";
		echo "                              <b>".$row['username']."</b>\n";
		echo "                            </span>\n";
		echo "                          </td>\n";
		echo "                          <td align=\"left\">\n";
		echo "                             ".$row['acctstarttime']." \n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\">\n";
		echo "							               ".$row['calledstationid']."	\n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\">\n";
		echo "                            ".$row['callingstationid']."\n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\">\n";
		echo "                            ".$row['framedipaddress']."\n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\" style=\"background-color:white;\">\n";
		echo "                            <label style=\"color:green;\"><img src=\"img/online.gif\" style=\"width:31px;\"></label>\n";
		echo "                          </td>\n";        
		//echo "                          <td class=\"hidden-xs\" style=\"text-align: center;\">\n";
		//echo "							<button onclick=\"AccountDelete('".$row['username']."')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-log-out\"></span></button>";		
//		echo "							<button onclick=\"AccountDisable('".$row['acUser']."')\" class=\"btn btn-warning\"><span class=\"glyphicon glyphicon-lock\"></span></button>";
		//echo "                          </td>\n";
		echo "                        </tr>\n";
	}
}
	$mcon->close();

	?>



                      </tbody>
                    </table>
					<div class="widget-body clearfix" style="text-align: right;">
						<ul class="pagination no-margin">
						  <li ><a href="online.php?page=1">«</a></li>
						
                        <?php
                          for($i=1;$i<=$totalpage;$i++){
                            if($page==$i){
                              //echo "<a class=\"active\" href=\"#\">2</a>";
                              //echo " <a class=\"active\"href=\"account.php?page=".$i."\" style=\"font-weight: bold; font-size: 150%;\">".$i."</a> ";
							  echo "<li class=\"active\"><a href=\"online.php?page=".$i."\">".$i." <span class=\"sr-only\">(current)</span></a></li>";
                            }else{
                              echo "<li><a href=\"online.php?page=".$i."\">".$i."</a> </li>";							  
                            }
                          }
                          
                        ?>
						  <li><a href="online.php?page=<?php echo $totalpage; ?>">»</a></li>
					   </ul>
					</div>					  
					  
                  </div>
			
			  
                </div>
				<h4>จำนวนออนไลน์ทั้งหมด <?php echo $total_record; ?> คน</h4>
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
                    <span>จำนวนคน Online ทั้งหมด</span>
                    <span class="pull-right">78%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>จำนวน กลุ่มบัญชีทั้งหมด</span>
                    <span class="pull-right">32%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>จำนวนบัญชีทั้งหมด</span>
                    <span class="pull-right">84%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100" style="width: 84%">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="details">
                    <span>จำนวนผู้ดูแลระบบ</span>
                    <span class="pull-right">44%</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100" style="width: 44%">
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
    <script src="js/jquery.dataTables.js"></script>
	

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
			

			$("#pPrint").click(function(){
				var selected_value = []; // initialize empty array 
				$("input:checkbox[id=chk]:checked").each(function () {
					
					selected_value.push($(this).val());
				});
				
				if(selected_value.length > 0){   
					$.ajax({
					url:"pPrint.php",
					data:{data:selected_value},
					type:"post",
					success:function(data){
							//console.log(data);						
							if(data!==""){
								 window.open('pPrint.php','_blank');
							}						 
						}
					});				
				}else{
					alert("กรุณาเลือกรายการ ที่ต้องการพิมพ์ ลองอีกครั้ง");
				}

			});
			
			$("#chkall").change(function(){
				if(this.checked){
				  $("input:checkbox[id=chk]").each(function(){
					this.checked=true;
				  })              
				}else{
				  $("input:checkbox[id=chk]").each(function(){
					this.checked=false;
				  })              
				}
			  });
  
			// hide msg
			$("#success-msg").fadeTo(2000, 500).slideUp(500, function(){
				$("#success-msg").slideUp(500);
			});
			
		});
	</script>
	<script>
		function AccountDelete(str){
			var id = str;
			if (confirm("คุณต้องการลบรายการนี้จริงหรือไม่ กรุณายืนยัน?")) {			
				window.location = 'account.php?mode=del&id='+id;
			} else {
				false;
			}
		}
		
		function AccountDisable(str)
		{
			var id = str
			window.location = 'account.php?mode=edit&id='+id;
		}
	</script>
  </body>
</html>
