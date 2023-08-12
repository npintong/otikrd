<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $CardID = $_POST['CardID'];
    $Mobile = $_POST['Mobile'];
    $Email = $_POST['Email'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://192.168.98.33/otikrd/otikrd/services.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "FirstName":"'.$FirstName.'",
        "LastName":"'.$LastName.'",
        "CardID":"'.$CardID.'",
        "Mobile":"'.$Mobile.'",
        "Email":"'.$Email.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer Wlb0VzOxFlC5esxF4xH2YNF5a2j6Qb',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    echo json_encode($response);

}else{
    header("Location: index.php");
}