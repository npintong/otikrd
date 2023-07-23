<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
$current_time = date("Y-m-d H:i:s");
require_once("config.inc.php");
	
if(isset($_POST["btnImport"])){
	
		$mcon->query("truncate table tbl_temp_account;");
		
		$filename=$_FILES["file"]["tmp_name"];		
		
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
			utf8_encode(fgets($file));
	        while (($getData = fgetcsv($file, 1000, ",")) !== FALSE)
	         {
				 
				//echo $getData[2];
					$tSQL = "
								INSERT INTO tbl_temp_account (
								  pfID,
								  acUser,
								  acPassWd,
								  tNote
								)
								VALUES
								  (
									'".$_POST['pPackage']."',
									'".$getData[1]."',
									'".$getData[0]."',
									'".$getData[2]."'
								  );
							";	
				
				echo $tSQL;
				echo "<br/>";
				
				$mcon->query($tSQL);
				
				/*
				$tSQL1 ="INSERT INTO tbl_master_radcheck(username,attribute,op,value)VALUES('".$getData[1]."','Cleartext-Password',':=','".$getData[0]."');";
				$mcon->query($tSQL1);

				$tSQL2 ="INSERT INTO tbl_master_radusergroup (username,groupname,priority)VALUES('".$getData[1]."','".$getData[0]."','8');";
				$mcon->query($tSQL2);
				*/

	         }
			//$mcon->close();
	         fclose($file);	
		 }
	}	 


 ?>
 <div>
 <hr/>
 <form method="POST" action="imports.php" name="frmImport" enctype="multipart/form-data">
	 <label>Choose file :</label>
	  <input type="file" name="file" value="">
	  
		<select id="pPackage" name="pPackage">
            
            <?php
              $tSQL = "SELECT * FROM tbl_master_profiles";
              $rs = $mcon->query($tSQL);
                while($rows = $rs->fetch_assoc()){
                  echo "<option value=\"".$rows['pfID']."\">".$rows['pfName']."</option>";
                }

            ?>

          </select>	
		  
	  <input type="submit" name="btnImport" value="Import">
  </form>
 </div>
