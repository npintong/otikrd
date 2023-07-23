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