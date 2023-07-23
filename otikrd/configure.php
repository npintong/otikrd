<?php
	session_start();
	define('BASEPATH', TRUE);

	if(!isset($_SESSION['sUser_id'])){
		header('Location: login.php');
		exit();
	}

	$active = "configure";
	
	if($_SESSION['pReport']==0){
		echo "Permission deny";
		exit();
	}
		
	if(isset($_REQUEST['r'])){
		include_once('common.class.php');	
		if($_REQUEST['r']==1){
					
			$msg=msg('บันทึกรายการสำเร็จ','success');
		}else{
			$msg=msg('ไม่สามารถลบรายการได้ กรุณาลองใหม่อีกครั้ง','danger');
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
            <li><a href="" class="heading">System Administrator</a></li>
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
						        รายชื่อผู้ดูแลระบบ
                    </div>

                    <span class="tools"><a href="configure_form.php"><span class="glyphicon glyphicon-plus-sign"></span> <strong>เพิ่มรายการ</strong></a> | <i class="fa fa-cogs"></i></span>
                  </div>
                  <div class="widget-body">
                    <table class="table table-responsive table-striped table-bordered table-hover no-margin"  style="font-size: 15px;">
                      <thead>
                        <tr>
                          <th style="width:5%; text-align:center;">
							ลำดับ
                          </th>
                          <th style="width:30%;">
							ชื่อ - นามสกุล
                          </th>
                          <th style="width:20%" class="hidden-xs">
							อีเมล
                          </th>
                          <th style="width:5%; text-align:center;" class="hidden-xs">
							PRF
                          </th>
                          <th style="width:5%; text-align:center;" class="hidden-xs">
							ACT
                          </th>
                          <th style="width:5%; text-align:center;" class="hidden-xs">
							SYS
                          </th>
                          <th style="width:5%; text-align:center;" class="hidden-xs">
							ONL
                          </th>						  
                          <th style="width:10%; text-align:center;" class="hidden-xs">
							สถานะ
                          </th>
                          <th style="width:15%; text-align:center;" class="hidden-xs">
							จัดการ
                          </th>
                        </tr>
                      </thead>
                      <tbody>

						<?php
						
						require_once('config.inc.php');
						
						$rs = $mcon->query("SELECT * FROM tbl_master_administrator;");
						$i=1;
						if ($rs->num_rows > 0) {

							while($row = $rs->fetch_assoc()) {

								echo "                        <tr>\n";
								echo "                          <td style=\"text-align:center;\">\n";
								echo "                            ".$i++."\n";
								echo "                          </td>\n";
								echo "                          <td>\n";
								echo "                            <span class=\"name\">\n";
								echo "                              ".$row['uFullName']."\n";
								echo "                            </span>\n";
								echo "                          </td>\n";
								echo "                          <td>\n";
								echo "                            ".$row['uEmail']."\n";
								echo "                          </td>\n";
								echo "                          <td style=\"text-align:center;\">\n";
								
								if($row['uPersProfile']==1){
									echo '<span class="label label-success">F</span>';
								}else{
									echo '<span class="label label-danger">R</span>';
								}
								
								echo "                          </td>\n";
								echo "                          <td style=\"text-align:center;\">\n";
								
								if($row['uPersAccount']==1){
									echo '<span class="label label-success">F</span>';
								}else{
									echo '<span class="label label-danger">R</span>';
								}
								
								echo "                          </td>\n";
								echo "                          <td style=\"text-align:center;\">\n";
								
								if($row['uPersReports']==1){
									echo '<span class="label label-success">F</span>';
								}else{
									echo '<span class="label label-danger">R</span>';
								}
								
								echo "                          </td>\n";
								echo "                          <td style=\"text-align:center;\">\n";
								
								if($row['uPersOnline']==1){
									echo '<span class="label label-success">F</span>';
								}else{
									echo '<span class="label label-danger">R</span>';
								}
								
								echo "                          </td>\n";								
								echo "                          <td style=\"text-align:center;\">\n";							

								if($row['uStatus']==1){
									echo '<span class="label label-success">ใช้งาน</span>';
								}else{
									echo '<span class="label label-danger">ระงับ</span>';
								}
								
								echo "                          </td>\n";
								echo "                          <td class=\"hidden-xs\" style=\"text-align:center;\">\n";
								
								echo "	<button onclick=\"configureEdit('".$row['uUserName']."')\" class=\"btn btn-warning btn-sm\"><span class=\"glyphicon glyphicon-edit\"></span></button>";
								
								if($row['uUserName'] == 'sysadmin'){
									echo "	<button disabled onclick=\"configureDelete('".$row['uUserName']."')\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
								}else{
									echo "	<button onclick=\"configureDelete('".$row['uUserName']."')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
								}
								echo "	<button onclick=\"changepwd('".$row['uUserName']."')\" class=\"btn btn-success btn-sm\"><span class=\"fa fa-key\"></span></button>";
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
    
    <!-- Color Picker -->
    <script src="js/color-picker/jquery.minicolors.js"></script>

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

    </script>

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
	
	<script>
		function configureDelete(str){
			var id = str;
			if (confirm("คุณต้องการลบรายการนี้จริงหรือไม่ กรุณายืนยัน?")) {
				window.location = 'configure_delete.php?id='+id;
			} else {
				false;
			}
		}
		
		function configureEdit(str)
		{
			var id = str
			window.location = 'configure_detail.php?id='+id;
		}
		
		function changepwd(id)
		{
			var id = id;
			window.location = 'chgpaswd.php?id='+id;
		}
	</script>
  </body>
</html>