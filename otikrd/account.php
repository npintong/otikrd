<?php

session_start();
define('BASEPATH', TRUE);

if(!isset($_SESSION['sUser_id'])){
	header('Location: login.php');
	exit();
}
	
$active = "account";
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


//$condition = ' WHERE DATE(AC.DateCreate)=CURDATE() ';

if(isset($_POST['btnSearch'])){

  if($_REQUEST['pFilter'] <> 'all'){
    
    $_SESSION['scFilter'] = $_POST['pFilter'];

    switch ($_SESSION['scFilter']) {
      case 'today':
        $condition = ' WHERE DATE(AC.DateCreate)=CURDATE() ';
        break;
      case 'week':
        $condition = ' WHERE YEARWEEK(AC.DateCreate)=YEARWEEK(NOW()) ';
        break;
      case 'month':
        $condition = ' WHERE YEAR(AC.DateCreate) = YEAR(CURRENT_DATE()) AND MONTH(AC.DateCreate) = MONTH(CURRENT_DATE()) ';
        break;
      case 'year':
        $condition = ' WHERE YEAR(AC.DateCreate) = YEAR(CURRENT_DATE()) ';
        break;
      case 'all':
        $condition = '';
        break;     
    }

  }else{
    $_SESSION['scFilter'] = 'all';
    $condition = '';
  }

  if($_REQUEST['pPackage'] <> 'all'){
    $_SESSION['scPackage'] = $_REQUEST['pPackage'];
    $condition .= " AND PF.pfID='".$_SESSION['scPackage']."' ";
  }else{
    $_SESSION['scPackage'] = 'all';
    $condition .= '';
  }

  if($_REQUEST['pKeyword'] <> ''){
    $_SESSION['scKeyword'] = $_REQUEST['pKeyword'];
    $condition .= " AND AC.acUser='".$_SESSION['scKeyword']."' ";
  }else{
    $_SESSION['scKeyword'] = '';
    $condition .= '';
  }


  $_SESSION['condition'] = $condition;


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
    <link href="css/new.css" rel="stylesheet">


    <link href="fonts/font-awesome.min.css" rel="stylesheet">
  	<!-- Drop down selector-->
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
            <li><a href="" class="heading">Account</a></li>
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
                      แสดงรายการบัญชี

                    </div>
					<?php
						if($_SESSION['pAccount']== 1){
							
					?>
                    <span class="tools"><a href="account_form.php"><span class="glyphicon glyphicon-plus-sign"></span> <strong>เพิ่มรายการ</strong></a> 
                    <!--| <span class="tools"><a href="" data-toggle="modal" data-target="#myModalImport"><span class="glyphicon glyphicon-download-alt"></span> <strong>นำเข้าข้อมูล</strong></a>--> | <a href="#"><label id="pPrint"> <span class="glyphicon glyphicon-print"></span> พิมพ์รายการ</label></a> | <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search"></span> เงื่อนไขการแสดง</a></span>
						<?php }else{ ?>
					<span class="tools"><a href="#"><label id="pPrint"> <span class="glyphicon glyphicon-print"></span> พิมพ์รายการ</label></a> | <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search"></span> เงื่อนไขการแสดง</a></span>	
						<?php } ?>
					
                  </div>
                  <div class="widget-body">

<!-- Modal -->
<div id="myModalImport" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">กำหนดเงื่อนไขการนำเข้าข้อมูล</h4>
      </div>
      <div class="modal-body">
        <form action="account_import_form.php" method="POST" enctype="multipart/form-data" name="frmImportData">
        <div class="form-group">
          <label for="pFilter">เงื่อนไข</label>
          <select class="form-control" id="Prc" name="Prc">
            <option value="insert">นำเข้ารายการใหม่</option>
            <option value="update">อัปเดทรายการ</option>            
          </select>
        </div>

        <div class="form-group">
          <label for="pPackage">เลือกแพ้คเกต</label>
          <select class="form-control" id="pPackage" name="pPackage">
            
            <?php
              
			      $tSQL = "SELECT * FROM tbl_master_profiles";
              $rs = $mcon->query($tSQL);
                while($rows = $rs->fetch_assoc()){
                  echo "<option value=\"".$rows['pfID']."\">".$rows['pfName']."</option>";
                }

            ?>

          </select>
        </div>

        <div class="form-group">
          <label for="sel1">เลือกไฟล์ CSV</label> *<a href="template.csv">คลิกโหลดไฟล์ตัวอย่าง</a>
          <input type="file" name="fileCSV" id="fileCSV" class="form-control">
        </div>        
        <button class="btn btn-success" type="submit" name="btnImport"><span class="glyphicon glyphicon-download-alt"></span> นำเข้าข้อมูล</button>

      </div>
    </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">กำหนดเงื่อนไขการแสดงผล</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <div class="form-group">
          <label for="pFilter">เงื่อนไข</label>
          <select class="form-control" id="pFilter" name="pFilter">
          
            <option value="today" <?=$result = ($_SESSION['scFilter'] == 'today') ? ' selected' : '';?>>วันนี้</option>
            <option value="week" <?=$result = ($_SESSION['scFilter'] == 'week') ? ' selected' : '';?>>สัปดาห์นี้</option>
            <option value="month" <?=$result = ($_SESSION['scFilter'] == 'month') ? ' selected' : '';?>>เดือนนี้</option>
            <option value="year" <?=$result = ($_SESSION['scFilter'] == 'year') ? ' selected' : '';?>>ปีนี้</option>
            <option value="all" <?=$result = ($_SESSION['scFilter'] == 'all') ? ' selected' : '';?>>ทั้งหมด</option>
          </select>
        </div>

        <div class="form-group">
          <label for="pPackage">เลือกแพ้คเกต</label>
          <select class="form-control" id="pPackage" name="pPackage">
            <option value="all">ทั้งหมด</option>
            <?php
              
			  $tSQL = "SELECT * FROM tbl_master_profiles";
              $rs = $mcon->query($tSQL);
                while($rows = $rs->fetch_assoc()){
                  if($rows['pfID']==$_SESSION['scPackage']){
                    echo "<option value=\"".$rows['pfID']."\" selected>".$rows['pfName']."</option>";  
                  }else{
                    echo "<option value=\"".$rows['pfID']."\">".$rows['pfName']."</option>";
                  }
                  
                }

            ?>

          </select>
        </div>

        <div class="form-group">
          <label for="sel1">ระบุบัญชี (ปล่อยว่างถ้าไม่ต้องการ)</label>
          <input type="text" class="form-control" name="pKeyword" id="pKeyword" value="<?=$_SESSION['scKeyword'];?>">
        </div>        
        <button class="btn btn-success" type="submit" name="btnSearch"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>

      </div>
    </form>
    </div>

  </div>
</div>

<?php
  //echo "demo";
  /*
  echo $_SESSION['scFilter'];
  echo " | ";
  echo $_SESSION['scPackage'];
  echo " | ";  
  echo $_SESSION['scKeyword'];
  */
?>
                    <table class="table-responsive">
					<table class="table table-condensed table-striped table-hover table-bordered no-margin" style="font-size: 13px;">
                      <thead style="height: 35px;">
                        <tr">
                          <th style="width:2%; text-align: center;">
                            <input type="checkbox" class="no-margin" id="chkall" />
                          </th>
                          <th style="width:10%">
							ชื่อบัญชีผู้ใช้
                          </th>
                          <th style="width:10%; text-align: left;" class="hidden-xs">
							รหัสผ่าน
                          </th>
                          <th style="width:20%; text-align: left;" class="hidden-xs">
							ชื่อ-นามสกุล
                          </th>						  
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							โพรไฟล์
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							เวลาใช้งานได้
                          </th>
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							ใช้งานได้
                          </th>                           
                          <th style="width:10% ; text-align: right;" class="hidden-xs">
							ราคา (บาท)
                          </th>                          
                          <th style="width:10%; text-align: center;" class="hidden-xs">
							จัดการ
                          </th>
                        </tr>
                      </thead>
                      <tbody>


<?php

$tSQL = "SELECT COUNT(acID) cnt FROM tbl_trans_account AS AC INNER JOIN tbl_master_profiles AS PF ON AC.pfID = PF.pfID ".$_SESSION['condition'].";";
$rs = $mcon->query($tSQL)->fetch_assoc();;
$total_record = $rs['cnt'];


$pagelen = 18; // กำหนดให้แสดงกี่เร็คคอร์ดต่อหนึ่งหน้าจอ
$page = (( isset($_REQUEST['page']))?$_REQUEST['page']:''); // รับหมายเลขหน้า

if(empty($page)){ $page=1;} // ตรวจสอบมีหน้าหรือปล่าว

$totalpage = ceil($total_record/$pagelen); // หาจำนวนหน้าจากเร้คคอร์ดทั้งหมด
$goto = ($page-1) * $pagelen;

//echo $totalpage;


$tSQL = "
        SELECT
          acID,
          acUser,
          acPasswd,
		  tNote,
          AC.pfID,
          pfName,
          pfSpeedLimitUp,
          pfSpeedLimitDown,
          pfUptime,
          pfValidity,
          pfPrice,
          acStatus,
		  PF.pfID
        FROM
          tbl_trans_account AS AC
          INNER JOIN tbl_master_profiles AS PF
            ON AC.pfID = PF.pfID ".$_SESSION['condition']." ORDER BY  acID DESC LIMIT ".$goto.",".$pagelen.";
    ";

//echo $tSQL;

$rs = $mcon->query($tSQL);

if ($rs->num_rows > 0) {

    while($row = $rs->fetch_assoc()) {

		echo "                        <tr>\n";
		echo "                          <td  style=\"text-align: center;\">\n";
		echo "                            <input type=\"checkbox\" name=\"acID[]\" value=\"".$row['acUser']."\"class=\"no-margin\" id=\"chk\" />\n";
		echo "                          </td>\n";
		echo "                          <td>\n";
		echo "                            <span class=\"name\">\n";
		echo "                              <b>".$row['acUser']."</b>\n";
		echo "                            </span>\n";
		echo "                          </td>\n";
		echo "                          <td align=\"left\">\n";
		echo "                             ".$row['acPasswd']." \n";
		echo "                          </td>\n";
		echo "                          <td align=\"left\">\n";
		echo "                             ".$row['tNote']." \n";
		echo "                          </td>\n";		
		echo "                          <td align=\"center\">\n";
		echo "							               ".$row['pfName']."	\n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\" style=\"color:green;\">\n";
		echo "                            ".UpTime($row['pfUptime'])."\n";
		echo "                          </td>\n";
		echo "                          <td align=\"center\" style=\"color:red;\">\n";
		echo "                            ".dValidity($row['pfValidity'])."\n";
		echo "                          </td>\n";
		echo "                          <td align=\"right\">\n";
		echo "                            ".$row['pfPrice']."\n";
		echo "                          </td>\n";        
		echo "                          <td class=\"hidden-xs\" style=\"text-align: center;\">\n";
		
		if($_SESSION['pAccount']==1){
			//echo "							<button onclick=\"AccountDelete('".$row['acUser']."')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-trash\"></span></button>";		
		
		
    if($row['acStatus']=='1'){
      $Str = 'disable';
      $sign = "glyphicon glyphicon-lock";
      $btnsign = "btn-warning";
    }else{
      $Str = 'enable';
      $sign = "glyphicon glyphicon-ok";
      $btnsign = "btn-default";
    }

		echo "							<button onclick=\"DisableEnable('".$row['acUser']."','".$Str."')\" class=\"btn ".$btnsign." btn-sm\"><span class=\"".$sign."\"></span></button>";
		}
    echo "              <button onclick=\"oShowDetail('".$row['acUser']."')\" class=\"btn btn-success btn-sm\"><span class=\"glyphicon glyphicon-eye-open\"></span></button>";
		echo "                          </td>\n";
		echo "                        </tr>\n";
	}
}
	$mcon->close();

	?>



                      </tbody>
                    </table>
					</table>
					<div class="widget-body clearfix" style="text-align: right;">
						<ul class="pagination no-margin">
						  <li ><a href="account.php?page=1">«</a></li>
						
                        <?php
                          for($i=1;$i<=$totalpage;$i++){
                            if($page==$i){
                              //echo "<a class=\"active\" href=\"#\">2</a>";
                              //echo " <a class=\"active\"href=\"account.php?page=".$i."\" style=\"font-weight: bold; font-size: 150%;\">".$i."</a> ";
							  echo "<li class=\"active\"><a href=\"account.php?page=".$i."\">".$i." <span class=\"sr-only\">(current)</span></a></li>";
                            }else{
                              echo "<li><a href=\"account.php?page=".$i."\">".$i."</a> </li>";							  
                            }
                          }
                          
                        ?>
						  <li><a href="account.php?page=<?php echo $totalpage; ?>">»</a></li>
					   </ul>
					</div>					  
					  
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
        $.ajax({
          url:"account_proc_del.php",
          data:{id:id},
          type:"post",
          success:function(data){
            $("#result").html(data);
            window.location.reload();           
          }
        });
      } else {
        false;
      }
    }
		
		function DisableEnable(id,mode)
		{
      var id = id;
      var mode = mode;
      if (confirm("กรุณายืนยัน เพื่อดำเนินการ?")) {     
        $.ajax({
            url:"account_proc_disable.php",
            data:{id:id,mode:mode},
            type:"post",
            success:function(data){
              $("#result").html(data);
               window.location="account.php";
            }
          });
      } else {
        false;
      }
    }

    function oShowDetail(id){
     window.open('account_detail.php?id='+id, '_blank');
    }
	</script>
  </body>
</html>
