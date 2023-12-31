<?php

// function time
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a วัน, %h ชัวโมง, %i นาที  %s วินาที');
}

function IdleTimeOut($val){
	
	switch ($val) {
		case "600":
			return "10 Minute";
			break;
		case "900":
			return "15 Minute";
			break;
		case "1200":
			return "20 Minute";
			break;
		case "1500":
			return "25 Minute";
			break;
		case "1800":
			return "30 Minute";
			break;
		case "2100":
			return "35 Minute";
			break;
		case "2400":
			return "40 Minute";
			break;
		case "2700":
			return "45 Minute";
			break;
		case "3000":
			return "50 Minute";
			break;	
		case "3300":
			return "55 Minute";
			break;
		case "3600":
			return "60 Minute";
			break;
		default:
			return "Unlimit";	
	}
}

function UpTime($val){
	
	switch ($val) {
		case "900":
			return "15 Minute";
			break;
		case "1800":
			return "30 Minute";
			break;
		case "3600":
			return "1 Hour";
			break;
		case "10800":
			return "3 Hour";
			break;
		case "18000":
			return "5 Hour";
			break;
		case "28800":
			return "8 Hour";
			break;
		case "43200":
			return "12 Hour";
			break;
		case "86400":
			return "24 Hour";
			break;
		default:
			return "Unlimit";	
	}
}

function dValidity($val){
	
	switch ($val) {
		case "86400":
			return "1 Day";
			break;
		case "604800":
			return "1 Week";
			break;
		case "2629746":
			return "1 Month";
			break;
		case "7889238":
			return "3 Month";
			break;
		case "15778476":
			return "6 Month";
			break;
		case "31556952":
			return "1 Year";
			break;
		default:
			return "Unlimit";	
	}
}


function validateThaiCitizenID($citizenID) {
    // Remove any non-digit characters from the input
    $cleanedID = preg_replace('/\D/', '', $citizenID);
    
    // Check if the cleaned ID is exactly 13 digits
    if (strlen($cleanedID) !== 13) {
        return false;
    }
    
    // Extract the individual digits for validation
    $digits = str_split($cleanedID);
    
    // Calculate the checksum
    $checksum = 0;
    for ($i = 0; $i < 12; $i++) {
        $checksum += (int)$digits[$i] * (13 - $i);
    }
    
    // Calculate the expected checksum (last digit of the ID)
    $expectedChecksum = $checksum % 11;
    $expectedChecksum = ($expectedChecksum === 0) ? 1 : (11 - $expectedChecksum);
    
    // Compare the calculated checksum with the expected checksum
    return (int)$digits[12] === $expectedChecksum;
}

function TimeNow(){

	date_default_timezone_set('Asia/Bangkok');
	$currentDateTime = date('Y-m-d H:i:s');

	return $currentDateTime;

}