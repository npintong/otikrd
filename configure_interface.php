<?php

	$active = "configure";
	
	if(isset($_REQUEST['int'])){
		$interface = $_REQUEST['int'];
	}else{
		$interface = '';
		exit();
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
            <li><a href="" class="heading">Network configuration</a></li>
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
            <div class="row gutter">
              <div class="col-lg-12 col-md-12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
						Interface name : <?php echo $interface; ?>
						<span class="mini-title">Configuration details </a></span>
                    </div>
                  </div>
                  <div class="widget-body">
                    <form class="form-horizontal no-margin">
                      <div class="form-group">
                        <label for="userName" class="col-sm-3 control-label">interface </label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="userName" placeholder="" value="<?php echo $interface; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-9">
                          <div class="row gutter">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                              <select id="DateOfBirthMonth" class="form-control">
                                <option value="10">
                                  Factory
                                </option>
                                <option value="20" selected>
                                  Static
                                </option>
                                <option value="30">
                                  Dhcp
                                </option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="emailId" class="col-sm-3 control-label">MAC</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="emailId" placeholder="Hotspot Server" value="A0:98:05:01:6D:7C" readonly>
                        </div>
                      </div>					  					  
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pwd" placeholder="IP Address" value="172.16.210.125">
                        </div>
                      </div>
						<div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Subnet</label>
                        <div class="col-sm-9">
                          <div class="row gutter">
                            <div class="col-md-5 col-sm-5 col-xs-5">
                              <select id="DateOfBirthMonth" class="form-control">
								<option value="30">255.255.255.252</option>
								<option value="29">255.255.255.248</option>
								<option value="28">255.255.255.240</option>
								<option value="27">255.255.255.224</option>
								<option value="26">255.255.255.192</option>
								<option value="25">255.255.255.128</option>
								<option value="24" selected>255.255.255.0</option>
								<option value="23">255.255.254.0</option>
								<option value="22">255.255.252.0</option>
								<option value="21">255.255.248.0</option>
								<option value="20">255.255.240.0</option>
								<option value="19">255.255.224.0</option>
								<option value="18">255.255.192.0</option>
								<option value="17">255.255.128.0</option>
								<option value="16">255.255.0.0</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">Default Gateway</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pwd" placeholder="IP Address" value="172.16.0.1">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">DNS Server 1</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pwd" placeholder="IP Address" value="8.8.8.8">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pwd" class="col-sm-3 control-label">DNS Server 1</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="pwd" placeholder="IP Address" value="8.8.4.4">
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

      //Color Pickers
      $(document).ready( function() {
      
        $('.demo').each( function() {
          $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function(hex, opacity) {
              if( !hex ) return;
              if( opacity ) hex += ', ' + opacity;
              try {
                console.log(hex);
              } catch(e) {}
            },
            theme: 'bootstrap'
          });
                
        });
      
      });

    </script>

	<script>
	$(document).ajaxStart(function(){
    $('#loading').show();
 }).ajaxStop(function(){
    $('#loading').hide();
 });
	</script>
  </body>
</html>