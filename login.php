<?php

session_start();

date_default_timezone_set('Asia/Bangkok');

if(isset($_SESSION['user_id'])){
	header('Location: index.php');
	exit();
}

if(isset($_POST['cmdLogin'])){
	
	require_once('config.inc.php');
	
	$tUserName = $_REQUEST['tUserName'];
	$tPasswd = $_REQUEST['tPasswd'];
	
	$msg ="";
	
	if(empty($tUserName) or empty($tPasswd)){
		$msg .= ' 
				<div class="alert alert-block alert-danger fade in" id="success-msg">
					<button data-dismiss="alert" class="close" type="button">
					  ×
					</button>
					<p>
					  <i class="fa fa-times-circle fa-lg"></i> ท่านต้องกรอกชื่อบัญชี และรหัสผ่าน ให้ครบถ้วน กรุณาลองอีกครั้ง.
					</p>
				</div>
		';
		
	}else{
				
		$rs = $mcon->query("SELECT uID,uUserName,uPasswd,uFullName,uGrpID,uStatus,uDep,uPersProfile,uPersAccount,uPersReports,uPersOnline FROM tbl_master_administrator WHERE uUserName='".$tUserName."' AND uPasswd='".MD5($tPasswd)."' LIMIT 0,1;");		
		
		if($rs->num_rows > 0){
			
			while($rows = $rs->fetch_assoc()){
				
				$_SESSION['sUser_id'] = $rows['uUserName'];
				$_SESSION['sFullName'] = $rows['uFullName'];
				$_SESSION['sGrpID'] = $rows['uGrpID'];				
				$_SESSION['sDep'] = $rows['uDep'];

				// condition
				$_SESSION['scFilter'] = 'today';
				$_SESSION['scPackage'] = 'all';
				$_SESSION['scUsrFilter'] = 'all';
				
				// permission
				$_SESSION['pProfile'] = $rows['uPersProfile'];
				$_SESSION['pAccount'] = $rows['uPersAccount'];
				$_SESSION['pReport'] = $rows['uPersReports'];
				$_SESSION['pOnline'] = $rows['uPersOnline'];
				$_SESSION['mySession'] = uniqid();				
				$_SESSION['condition'] = ' WHERE DATE(AC.DateCreate)=CURDATE() ';
				

			}

			
			$msg .= ' 
					<div class="alert alert-block alert-success fade in" id="success-msg">
						<button data-dismiss="alert" class="close" type="button">
						  ×
						</button>
						<p>
						  <i class="glyphicon glyphicon-ok"></i> เข้าสู่ระบบสำเร็จ กรุณารอสักครู่ระบบกำลังนำท่านเข้าสู่หน้าหลัก
						</p>
					</div>
			';
			
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=online.php">';

		}else{
			$msg .= ' 
					<div class="alert alert-block alert-warning fade in" id="success-msg">
						<button data-dismiss="alert" class="close" type="button">
						  ×
						</button>
						<p>
						  <i class="fa fa-times-circle fa-lg"></i> ข้อมูลที่ท่านกรอกไม่ถูกต้อง กรุณาลองอีกครั้ง.
						</p>
					</div>
			';				
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
    <meta name="description" content="OTIK NETWORK CO.,LTD." />
    <meta name="keywords" content="OTIKRD,OTIKNETWORK,RADIUS" />
    <meta name="author" content="OTIKRD,OTIKNETWORK,RADIUS" />
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/new.css" rel="stylesheet">
    <!-- Important. For Theming change primary-color variable in main.css  -->

    <link href="fonts/font-awesome.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Main Container start -->
    <div class="dashboard-container">

      <div class="container">

        <!-- Row Start -->
        <div class="row gutter">
          <div class="col-lg-4 col-md-4 col-md-offset-4">
            <div class="sign-in-container">
              <form action="login.php" class="login-wrapper" method="post" name="frmLogin">
                <div class="header">
                  <div class="row gutter">
                    <div class="col-md-12 col-lg-12">
					
                      <h3>เข้าสู่ระบบ<img src="img/logo1.png" alt="Logo" class="pull-right"></h3>
                      <p>ยินดีต้อนรับท่านเข้าสู่ระบบศูนย์รวมผู้ใช้ <strong>โอติกอาร์ดี</strong></p>					  
						<?php if(!empty($msg)){ echo $msg; } ?>					  
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div class="form-group">
                    <label for="tUserName">ชื่อบัญชีผู้ใช้</label>
                    <input type="text" class="form-control" id="tUserName" name="tUserName" placeholder="User Name">
                  </div>
                  <div class="form-group">
                    <label for="tPasswd">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="tPasswd" name="tPasswd" placeholder="Password">
                  </div>
                </div>
                <div class="actions">
                  <input class="btn btn-danger" name="cmdLogin" type="submit" value="เข้าสู่ระบบ">
                  <!--<a class="link" href="#">ลืมรหัสผ่าน ?</a>-->
                  <div class="clearfix" style="color: gray;">พัฒนาโดย <a href="http://www.otiknetwork.com">บริษัท โอติก เน็ตเวิร์ค จำกัด</a></div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Row End -->
        
      </div>
    </div>
    <!-- Main Container end -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		$("#success-msg").fadeTo(2000, 500).slideUp(500, function(){
			$("#success-msg").slideUp(500);
		});
	</script>

  </body>
</html>