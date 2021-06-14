<?php
include_once 'connect.php';
switch($_REQUEST['Action']) {
	case "SearchBanksOld":
		$returnArray = fnBankNames($_GET['term']);
		echo json_encode($returnArray);
		break;
	case "SearchBanks":
		$returnArray = fnBankNames();
		echo json_encode($returnArray);
		break;
	default:
		break;
}
function fnBankNamesOld($srchTxt){
	$retnArr = array();
	global $con;
	$BankNameList = mysqli_query($con, "SELECT DISTINCT BankName FROM Savings WHERE TRIM(LOWER(BankName)) LIKE TRIM(LOWER('%$srchTxt%'))");
	while($Banks = @mysqli_fetch_assoc($BankNameList)){
		array_push($retnArr, $Banks['BankName']);	
	}
	return $retnArr;
}
function fnBankNames(){
	$retnArr = array();
	global $con;
	$BankNameList = mysqli_query($con, "SELECT DISTINCT BankName FROM Savings");
	while($Banks = @mysqli_fetch_assoc($BankNameList)){
		array_push($retnArr, $Banks['BankName']);	
	}
	return $retnArr;
}
?>