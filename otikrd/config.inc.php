<?php

$db_host = "192.168.98.21";
$db_user = "root";
$db_password = "1Qazxsw2!!";
$db_dbname = "otikrd";

$mcon = new mysqli($db_host,$db_user,$db_password,$db_dbname);
mysqli_set_charset($mcon,"utf8");

if(mysqli_connect_error()){
	echo "Error: could not connect to database.";
	exit();
}

?>
