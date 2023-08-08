<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

        <!-- Top Nav Start -->
        <div id='cssmenu'>
          <ul>
            <!--<li <?php echo ($active == 'home' ? "class=\"active\"": ""); ?> ><a href='index.php'><i class="fa fa-dashboard"></i>DASHBOARD</a></li>-->
            <li <?php echo ($active == 'online' ? "class=\"active\"": ""); ?> ><a href='online.php'><i class="fa fa-dashboard"></i>ออนไลน์</a></li>
            <li <?php echo ($active == 'account' ? "class=\"active\"": ""); ?> ><a href="account.php"><i class="glyphicon glyphicon-user"></i>บัญชี</a></li>
            <li <?php echo ($active == 'profile' ? "class=\"active\"": ""); ?> ><a href='profile.php'><i class=" glyphicon glyphicon-th-large"></i>กลุ่มบัญชี</a></li>            
			
			<?php
				if($_SESSION['pReport']==1){		
			?>
			<li <?php echo ($active == 'configure' ? "class=\"active\"": ""); ?> ><a href='configure.php'><i class="glyphicon glyphicon-cog"></i>ผู้ดูแล</a></li>
				<?php } ?>

        <?php
				if($_SESSION['pSetting']==1){		
			?>
			<li <?php echo ($active == 'setting' ? "class=\"active\"": ""); ?> ><a href='setting.php'><i class="glyphicon glyphicon-alert"></i>ตั้งค่าแจ้งเตือน</a></li>
				<?php } ?>
				
			<li <?php echo ($active == 'license' ? "class=\"active\"": ""); ?> ><a href='license.php'><i class="glyphicon glyphicon-info-sign"></i>ลิขสิทธิ์</a></li>
          </ul>
        </div>
        <!-- Top Nav End -->