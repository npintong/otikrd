<?php
session_start();

if(!isset($_SESSION['sUser_id'])){
	header('Location: login.php');
	exit();
}

?>
<html>
<head>
<title>Import CSV to Database</title>
</head>
<body>
<?php



require_once("config.inc.php");

$uploads_dir = 'csv';

unlink("$uploads_dir/".$_FILES["fileCSV"]["name"]);
move_uploaded_file($_FILES["fileCSV"]["tmp_name"], "$uploads_dir/".$_FILES["fileCSV"]["name"]);

date_default_timezone_set('Asia/Bangkok');
$current_time = date("Y-m-d H:i:s");
$pfID = $_POST['pPackage'];
$sess = $_SESSION['mySession'];

$mcon->query("DELETE FROM tbl_temp_import_account WHERE sess='".$sess."';");

$objCSV = fopen("$uploads_dir/".$_FILES["fileCSV"]["name"], "r");
$row = 0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {

    $row++;    
    
    $tSQL = "
                    INSERT INTO tbl_temp_import_account (
                    sess,
                    pfID,
                    acUser,
                    acPassWd,
                    tNote,                      
                    mobile,
                    idcode,
                    acStatus,
                    WhoCreate,
                    DateCreate,
                    WhoUpdate,
                    DateUpdate
                    )
                    VALUES
                    (
                        '".$sess."',
                        '".$mcon->real_escape_string($pfID)."',
                        '".$mcon->real_escape_string($objArr[0])."',
                        '".$mcon->real_escape_string($objArr[1])."',
                        '".$mcon->real_escape_string($objArr[2])."',
                        '".$mcon->real_escape_string($objArr[3])."',
                        '".$mcon->real_escape_string($objArr[4])."',
                        '".$mcon->real_escape_string('0')."',
                        '".$mcon->real_escape_string('system')."',
                        '".$mcon->real_escape_string($current_time)."',
                        '".$mcon->real_escape_string('system')."',
                        '".$mcon->real_escape_string($current_time)."'
                    );
                ";
    
    if($row > 1){
        
        if(strlen($tSQL) > 0){
            $mcon->query($tSQL);
            
        }         
    }    
    
    
}

if($_POST['Prc'] == 'insert'){
    $excute = "
            INSERT INTO tbl_trans_account(            
                pfID,
                acUser,
                acPassWd,
                idcode,
                tNote,
                mobile,
                acStatus,
                WhoCreate,
                DateCreate,
                WhoUpdate,
                DateUpdate
            ) 
            SELECT             
                pfID,
                acUser,
                acPassWd,
                idcode,
                tNote,
                mobile,
                acStatus,
                WhoCreate,
                DateCreate,
                WhoUpdate,
                DateUpdate
            FROM tbl_temp_import_account
            WHERE sess = '".$sess."' and acUser not in(SELECT acUser FROM tbl_trans_account);
    ";
}else{
    $excute = "
            UPDATE tbl_trans_account a
            JOIN tbl_temp_import_account b
            ON a.acUser = b.acUser

            SET 
                a.idcode = b.idcode,
                a.tNote = b.tNote,
                a.mobile = b.mobile
            WHERE b.sess = '".$sess."'
    ";
}

$mcon->query($excute);

fclose($objCSV);
$mcon->close();

echo "Upload & Import Done.";


?>
<br>
<a href="account.php">กลับหน้าหลัก</a>

</table>
</body>
</html>