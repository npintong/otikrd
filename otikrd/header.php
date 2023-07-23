<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
?>
<!-- Header Start -->
    <header>
      <a href="index.html" class="logo">
        <img src="img/otik_logo.png" alt="Logo"/>
      </a>
      <div class="pull-right">
        <ul id="mini-nav" class="clearfix">
          
          <!--
          <li class="list-box dropdown">
            <a id="drop5" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calendar"></i>
            </a>
            <span class="info-label success-bg">6</span>
            <ul class="dropdown-menu server-activity">
              <li>
                <p><i class="fa fa-flag text-info"></i> Pending request<span class="time">3 hrs</span></p>
              </li>
              <li>
                <p><i class="fa fa-fire text-warning"></i> Server Crashed<span class="time">3mins</span></p>
              </li>
              <li>
                <p><i class="fa fa-user text-success"></i> 3 New users<span class="time">1 min</span></p>
              </li>
              <li>
                <p><i class="fa fa-bell text-danger"></i>9 pending requests<span class="time">5 min</span></p>
              </li>
              <li>
                <p><i class="fa fa-plane text-info"></i> Performance<span class="time">25 min</span></p>
              </li>
              <li>
                <p><i class="fa fa-envelope text-warning"></i>12 new emails<span class="time">25 min</span></p>
              </li>
              <li>
                <p><i class="fa fa-cog icon-spin text-success"></i> Location settings<span class="time">4 hrs</span></p>
              </li>
			  
            </ul>
          </li>
		  -->
          <li class="list-box user-profile">
            <a id="drop7" href="#" role="button" class="dropdown-toggle user-avtar" data-toggle="dropdown">
              <img src="img/default-user.png" alt="ผู้ใช้งาน">
            </a>
            <ul class="dropdown-menu server-activity">
			<!--
              <li>
                <p><i class="fa fa-cog text-info"></i> Account Settings</p>
              </li>
              <li>
                <p><i class="fa fa-fire text-warning"></i> Payment Details</p>
              </li>
              <li>
                <div class="demo-btn-group clearfix">
                  <a href="#" data-original-title="" title="">
                    <i class="fa fa-facebook fa-lg icon-rounded info-bg"></i>
                  </a>
                  <a href="#" data-original-title="" title="">
                    <i class="fa fa-twitter fa-lg icon-rounded twitter-bg"></i>
                  </a>
                  <a href="#" data-original-title="" title="">
                    <i class="fa fa-linkedin fa-lg icon-rounded linkedin-bg"></i>
                  </a>
                  <a href="#" data-original-title="" title="">
                    <i class="fa fa-pinterest fa-lg icon-rounded danger-bg"></i>
                  </a>
                  <a href="#" data-original-title="" title="">
                    <i class="fa fa-google-plus fa-lg icon-rounded success-bg"></i>
                  </a>
                </div>
              </li>
			  -->
              <li>
                <div class="demo-btn-group " style="background-color: #fff; color: #000; border: none;">
                  <a href="chgpaswd.php?id=<?php echo $_SESSION['sUser_id']; ?>" class="btn btn-danger btn-lg">
					เปลี่ยนรหัสผ่าน (<?php echo $_SESSION['sUser_id']; ?>)
                  </a>
                </div>				
              </li>			  
              <li>
                <div class="demo-btn-group clearfix">
                  <a href="logout.php" class="btn btn-danger btn-lg">
					ออกจากระบบ
                  </a>
                </div>				
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </header>
    <!-- Header End -->