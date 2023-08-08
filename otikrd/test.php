
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

    // Query option
    $tSQL = "SELECT sOption1 FROM tbl_master_setting WHERE id='1' LIMIT 1;";
    $rs = $mcon->query($tSQL)->fetch_assoc();

    $sToken = $rs['sOption1'];
    $sMessage = $rs['sOption1'];

    echo $sToken;

    // Check if empty token
    if(empty($sToken)){
        exit();
    }

    exit();

    function sendLineNotify($message = "Notify-Option")
    {
        $token = $sToken;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'error:' . curl_error($ch);
        } else {
            $res = json_decode($result, true);
            echo "status : " . $res['status'];
            echo "message : " . $res['message'];
        }
        curl_close($ch);
    }

    if (isset($argv[1])) {
        $msg = "User Login : " . $argv[1];
        sendLineNotify($msg);
    }

?>
