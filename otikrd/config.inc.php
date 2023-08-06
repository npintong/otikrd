<?php

$db_host = "127.0.0.1";
$db_user = "otikuser";
$db_password = "Love@OtikNetWork";
$db_dbname = "otikdb";

$mcon = new mysqli($db_host,$db_user,$db_password,$db_dbname);
mysqli_set_charset($mcon,"utf8");

if(mysqli_connect_error()){
	echo "Error: could not connect to database.";
	exit();
}

?>
