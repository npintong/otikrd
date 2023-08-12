<?php

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require_once('config.inc.php');
    require_once('function.php');
    require_once('hash.php');    

    $tSQL = "SELECT sOption3 FROM tbl_master_setting WHERE id='1' LIMIT 1;";
    $rs = $mcon->query($tSQL)->fetch_assoc();

    // Define the valid token
    $valid_token = $rs['sOption3'];

    // Check if the token is provided in the request headers
    $headers = apache_request_headers();
    if (isset($headers['Authorization']) && $headers['Authorization'] === 'Bearer ' . $valid_token) {
        // Get the JSON data from the request body
        $json_data = file_get_contents('php://input');
        
        // Attempt to decode the JSON data
        $data = json_decode(trim($json_data), true);
        
        

        if ($data === null) {
            // JSON decoding failed            
            $response = array('message' => 'error', 'data' => 'Invalid JSON data');
        } else {
            // JSON decoding successful
            if (isset($data['FirstName']) && isset($data['LastName']) && isset($data['CardID']) && isset($data['Mobile']) && isset($data['Email'])) {

                $pfID =  '1';
                $acUser =  GeraHash(8);
                $acPassWd =  GeraHashNum(8);
                $tNote =  $data['FirstName'].' '.$data['LastName'].' (WebRegis)';
                $acStatus =  '1';
                $FirstName =  $data['FirstName'];
                $LastName =  $data['LastName'];
                $CardID =  $data['CardID'];
                $Email = $data['Email'];  
                $Mobile = $data['Mobile'];  
                $WhoCreate =  'register';
                $DateCreate =  TimeNow();
                $WhoUpdate =  'register';
                $DateUpdate =  TimeNow();

                if(validateThaiCitizenID($CardID)==false){                    
                    $response = array('message' => 'error', 'data' => 'Invalid Citizen id');
                }else{
                    $tSQL = "INSERT INTO tbl_trans_account";
                    $tSQL .= " (pfID,acUser,acPassWd,tNote,acStatus,FirstName,LastName,CardID,Email,Mobile,WhoCreate,DateCreate,WhoUpdate,DateUpdate)";
                    $tSQL .= " VALUES(";
                    $tSQL .= "'".$pfID."',";
                    $tSQL .= "'".$acUser."',";
                    $tSQL .= "'".$acPassWd."',";
                    $tSQL .= "'".$tNote."',";
                    $tSQL .= "'".$acStatus."',";
                    $tSQL .= "'".$FirstName."',";
                    $tSQL .= "'".$LastName."',";
                    $tSQL .= "'".$CardID."',";
                    $tSQL .= "'".$Email."',";
                    $tSQL .= "'".$Mobile."',";
                    $tSQL .= "'".$WhoCreate."',";
                    $tSQL .= "'".$DateCreate."',";
                    $tSQL .= "'".$WhoUpdate."',";
                    $tSQL .= "'".$DateUpdate."'";
                    $tSQL .= ");";
                    
                    if($mcon->query($tSQL)){

                        $tSQL ="INSERT INTO tbl_master_radcheck(username,attribute,op,[value]) VALUES ('".$acUser."','Cleartext-Password',':=','".$acPassWd."');";
                        $mcon->query($tSQL);

                        $tSQL ="INSERT INTO tbl_master_radusergroup (username,groupname,priority) VALUES ('".$acUser."','".$pfID."','8');";
                        $mcon->query($tSQL);

                        $data = array('UserName'=>$acUser,'Password'=>$acPassWd);                        
                        $response = array('message' => 'Successfully', 'data' => $data);

                    }else{                                                      
                        $response = array('message' => 'error', 'data' => 'Can not insert data');
                    }
                    
                }
                
            }else{                
                $response = array('message' => 'error', 'data' => 'Invalid JSON data');
            }
            
        }
    } else {
        // Unauthorized
        $response = array('error' => 'Unauthorized');
    }
} else {
    // Method not allowed
    $response = array('error' => 'Method not allowed');
}

// Send the response
echo json_encode($response);

?>

