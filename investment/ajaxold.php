<?php
include_once 'connect.php';
switch($_REQUEST['Action']) {
	/*Ajax call for CUS01 screen to auto complete the search text box*/
	case "SearchBanks":
		$returnArray = fnBankNames($_GET['term']);
		echo json_encode($returnArray);
		break;
	default:
		break;
}

function fnBankNames($srchTxt){
	$retnArr = array();
	global $con;
	$BankNameList = mysqli_query($con, "SELECT DISTINCT BankName FROM Savings WHERE TRIM(LOWER(BankName)) LIKE TRIM(LOWER('%$srchTxt%'))");
	while($Banks = @mysqli_fetch_assoc($BankNameList)){
		array_push($retnArr, $Banks['BankName']);	
	}
	return $retnArr;
}
?>