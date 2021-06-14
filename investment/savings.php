<?php
include_once 'prheader.php';
//include_once 'UserSel.php';
if(isset($_REQUEST['Mode'])){
	$Mode = $_REQUEST['Mode'];
}else{
	$Mode="";
}
switch($Mode){
	case "Save":
		SaveNewFD();
		header("Location: savings.php" );
		break;
	case "Update":
		break;
	case "Delete":
		break;
	case "Renew":	
		break;
	default:
		ShowList();
		break;
}
?>

<?php
//Function to Get and Set user sel values
function USGet($Field){
	global $con;
	$rsUSel = mysqli_query($con, "SELECT UVal FROM UserSel WHERE UField = '{$Field}' AND UId = '{$_SESSION['LoginUser']}'");
}
function USSet($Field, $Value){
	global $con;
	$qry = "INSERT INTO UserSel (UId, UField, UVal) VALUES ('{$_SESSION['LoginUser']}', '{$Field}', '{$Value}')";
	//print($qry);
	mysqli_query($con, $qry);	
}

/*Functions for different mode*/
function ShowList(){
	//Set Required variables
	global $con;
	if(isset($_REQUEST)){
		$cboStatus = $_REQUEST['cboStatus'];
		$cboName = $_REQUEST['cboName'];
		$cboBankName = $_REQUEST['cboBankName'];
		$cboFDYear = $_REQUEST['cboFDYear'];
		$txtMatSTDt = $_REQUEST['txtMatSTDt'];
		$txtMatENDt = $_REQUEST['txtMatENDt'];

		//To Set usersel
		USSet('Status', $cboStatus);
		USSet('Name', $cboName);
		USSet('BankName', $cboBankName);
		USSet('FDYear', $cboFDYear);
		USSet('MatSTDt', $txtMatSTDt);
		USSet('MatENDt', $txtMatENDt);

	}else{
		$cboStatus = USGet('Status');
		$cboStatus = (is_null($cboStatus)? "" : $cboStatus);
		$cboName = USGet('Name');
		$cboName = (is_null($cboName)? "" : $cboName);
		$cboBankName = USGet('BankName');
		$cboBankName = (is_null($cboBankName)? "" : $cboBankName);
		$cboFDYear = USGet('FDYear');
		$cboFDYear = (is_null($cboFDYear)? "" : $cboFDYear);
		$txtMatSTDt = USGet('MatSTDt');
		$txtMatSTDt = (is_null($txtMatSTDt)? "" : $txtMatSTDt);
		$txtMatENDt = USGet('MatENDt');
		$txtMatENDt = (is_null($txtMatENDt)? "" : $txtMatENDt);
		/*
		$cboStatus = "";
		$cboName = "";
		$cboBankName = "";
		$cboFDYear = "";
		$txtMatSTDt = "";
		$txtMatENDt = "";*/
	}

	//SQL Section
	$StatusList = mysqli_query($con, "SELECT DISTINCT Status FROM Savings");
	$NameList = mysqli_query($con, "SELECT DISTINCT Name FROM Savings");
	$BankNameList = mysqli_query($con, "SELECT DISTINCT BankName FROM Savings");
	$FDYearList = mysqli_query($con, "SELECT DISTINCT YEAR(FDDATE) as FDYear FROM savings ORDER BY FDYear");
	
	//Build saving list query
	$qry = "SELECT *,  
			DATE_FORMAT(FDDate, '%b %e, %Y') AS DispFDDate, 
			DATE_FORMAT(FDDueDate, '%b %e, %Y') AS DispFDDueDate  
			FROM Savings WHERE 1 = 1 ";
	if($cboStatus != ""){
		$qry .= " AND Status = '{$cboStatus}'";
	}
	if($cboName != ""){
		$qry .= " AND Name = '{$cboName}'";
	}
	if($cboBankName != ""){
		$qry .= " AND BankName = '{$cboBankName}'";
	}
	if($cboFDYear != ""){
		$qry .= " AND YEAR(FDDate) = '{$cboFDYear}'";
	}
	if($txtMatSTDt != ""){
		$qry .= " AND FDDueDate >= '{$txtMatSTDt}'";
	}
	if($txtMatENDt != ""){
		$qry .= " AND FDDueDate <= '{$txtMatENDt}'";
	}
	//print($qry);
	$SavingList = mysqli_query($con, $qry);
	?>

	<!--- Code for filter panel --->
	<form name="frmSVList" id="frmSVList" action="savings.php" method="post">
		<h5>Saving List: </h5>
		<table><tbody>
			<tr>			
				<td class="formTextLT14 RPad10"><b>Status:</b></td>
				<td class="RPad10">
					<select name="cboStatus" id="cboStatus" class="ctrlSm" style="width:250;">	
						<option value="" selected="">All</option>	
						<?php
						while($Status = @mysqli_fetch_assoc($StatusList)){
							print("<option value=\"" . $Status['Status'] . "\"");		
							if($cboStatus == $Status['Status'])
								print(" selected=\"selected\"");
							print(">");
							print(htmlentities($Status['Status'], ENT_QUOTES)."</option>");
						}
						?>							
					</select>
				</td>
				<td class="formTextLT14 RPad10"><b>Name:</b></td>
				<td class="RPad10">	
					<select name="cboName" id="cboName" class="ctrlSm" style="width:250;">	
						<option value="" selected="">All</option>	
						<?php
						while($Names = @mysqli_fetch_assoc($NameList)){
							print("<option value=\"" . $Names['Name'] . "\"");		
							if($cboName == $Names['Name'])
								print(" selected=\"selected\"");
							print(">");
							print(htmlentities($Names['Name'], ENT_QUOTES)."</option>");
						}
						?>									
					</select>
				</td>	
				<td class="formTextLT14 RPad10"><b>Bank Name:</b></td>
				<td class="RPad10">
					<select name="cboBankName" id="cboBankName" class="ctrlSm" style="width:250;">	
						<option value="" selected="">All</option>	
						<?php
						while($Banks = @mysqli_fetch_assoc($BankNameList)){
							print("<option value=\"" . $Banks['BankName'] . "\"");		
							if($cboBankName == $Banks['BankName'])
								print(" selected=\"selected\"");
							print(">");
							print(htmlentities($Banks['BankName'], ENT_QUOTES)."</option>");
						}
						?>
					</select>
				</td>
			</tr>
			<tr>	
				<td class="formTextLT14 RPad10"><b>FD Year:</b></td>
				<td class="RPad10">
					<select name="cboFDYear" id="cboFDYear" class="ctrlSm" style="width:250;">	
						<option value="" selected="">All</option>	
						<?php
						while($FDYears = @mysqli_fetch_assoc($FDYearList)){
							print("<option value=\"" . $FDYears['FDYear'] . "\"");		
							if($cboFDYear == $FDYears['FDYear'])
								print(" selected=\"selected\"");
							print(">");
							print(htmlentities($FDYears['FDYear'], ENT_QUOTES)."</option>");
						}
						?>
					</select>
				</td>
				<td class="formTextLT14 RPad10" colspan="4"><b>Maturity Date Range:  </b>
					<input type="text" class="ctrlSm dtCtrl" name="txtMatSTDt" id="txtMatSTDt" value="<?php echo($txtMatSTDt); ?>" size="12" maxlength="10"> &nbsp;&nbsp;to &nbsp;&nbsp;
					<input type="text" class="ctrlSm dtCtrl" name="txtMatENDt" id="txtMatENDt" value="<?php echo($txtMatENDt); ?>" size="12" maxlength="10"> &nbsp;
					<button type="submit" class="btnBlack"><i class="fa fa-search"></i> Apply Filter </button>  
					<button type="button" class="btnBlack reset"><i class="fa fa-times"></i> Clear Filter </button> 
				</td>							
			</tr>			
		</tbody></table>	
		<hr>		
	</form>

	<a href="#" class="btnWhite FDLink" style="text-decoration:none;" data-toggle="modal" data-target="#AddEditFD" data-id="0"><i class="fa fa-plus"></i> Add New  </a>
	<hr>

	<!--- Saving list table --->
	<div class='prPanel'>
		<table class='svTbl' id='svList' cellpadding="0" cellspacing="0">
			<thead>
				<th class='tblHdr'>ID</th>
				<th class='tblHdr'>Name</th>
				<th class='tblHdr'>Bank</th>
				<th class='tblHdr'>Account No.</th>
				<th class='tblHdr' >FD Date</th>
				<th class='tblHdr' >Maturity Date</th>
				<th class='tblHdr'>Principle Amount</th>
				<th class='tblHdr'>Maturity Amount</th>
				<th class='tblHdr'>Intrest Rate</th>
				<th class='tblHdr'>Period</th>
				<th class='tblHdr' style="text-align:center;">Status</th>
				<th class='tblHdr' style="text-align:center;">Action</th>
			</thead>
			<tbody>
			<?php
			while($rowGetInfo = @mysqli_fetch_assoc($SavingList)){
				$ID = $rowGetInfo['ID'];
				$Name = $rowGetInfo['Name'];
				$BankName = $rowGetInfo['BankName'];
				$AccountNumber = $rowGetInfo['AccountNumber'];
				$FDDate = $rowGetInfo['FDDate'];
				$FDDueDate = $rowGetInfo['FDDueDate'];
				$DispFDDate = $rowGetInfo['DispFDDate'];
				$DispFDDueDate = $rowGetInfo['DispFDDueDate'];
				$PrincipalAmount = $rowGetInfo['PrincipalAmount'];
				$MaturityAmount = $rowGetInfo['MaturityAmount'];
				$IntRate = $rowGetInfo['IntRate'];
				$Period = $rowGetInfo['Period'];
				$rStatus = $rowGetInfo['Status'];
				print("<tr>");
					print("<td>$ID</td>");
					print("<td>$Name</td>");
					print("<td>$BankName</td>");
					print("<td>$AccountNumber</td>");
					print("<td>$DispFDDate</td>");
					print("<td>$DispFDDueDate</td>");
					print("<td>" . number_format($PrincipalAmount, 2) . " </td>");
					print("<td>" . number_format($MaturityAmount, 2) . " </td>");
					print("<td>" . number_format($IntRate, 2) . "%</td>");
					print("<td>$Period</td>");
					print("<td style='text-align:center;'>$rStatus</td>");
					print("<td style='text-align:center;'>");
						print("<i class='fa fa-pencil'></i>&nbsp;");
						print("<i class='fa fa-trash'></i>&nbsp;");
					print("</td>");
				print("</tr>");
			}
			?> 
			</tbody>
		</table>
	</div><br/><br/>
<?php	
	AddEditPopup($NameList, $BankNameList);
}
?> 

<!--- ------------------------------------------------------------------------------------
		AddEditPopup - This function will allow to Add, Edit and Renew a FD
------------------------------------------------------------------------------------- --->
<?php	
function AddEditPopup($NameList, $BankNameList){
	/*print_r($NameList);
	print_r($BankNameList);*/
?>
	<div id="AddEditFD" class="modal fade bs-example-modal-lg" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<!--- Modal content--->
			<div class="modal-content">
				<div class="modal-header" style="align-items:flex-start !important;">		
					<div id=FDTitle>
						<h4 class="modal-title"></h4>
					</div>			
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form name="frmFD" id="frmFD" method="post">
						<input type="hidden" name="FDId" id="FDId" value="">
						<!--- For Status --->
						<div class="prPanelBody">
							<table class='FrmTbl'>									
								<tbody>									
									<tr>
										<td class=formText width=200px>Name: </td>
										<td>
											<input type="text" class="ctrlSm" name="txtName" id="txtName" value="" size="50" placeholder="Enter Name" list="lstNames">
											<div id="NameErr" class="errMsg"></div>
											<!-- Fetch autocomplete name list using datalist -->
											<datalist name="lstNames" id="lstNames">
											<?php
												mysqli_data_seek($NameList,0);
												while($Names = @mysqli_fetch_assoc($NameList)){
													print("<option value=\"" . $Names['Name'] . "\">");		
													print(htmlentities($Names['Name'], ENT_QUOTES)."</option>");
												}
											?>		
											</datalist>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Bank: </td>
										<td>
											<input type="text" class="ctrlSm" name="txtBankName" id="txtBankName" value="" size="50" placeholder="Enter Bank Name" list="lstBankNames">
											<div id="BankErr" class="errMsg"></div>
											<!-- Fetch autocomplete bank name list using datalist-->
											<datalist name="lstBankNames" id="lstBankNames">
											<?php
												mysqli_data_seek($BankNameList,0);
												while($BankNames = @mysqli_fetch_assoc($BankNameList)){
													print("<option value=\"" . $BankNames['BankName'] . "\">");		
													print(htmlentities($BankNames['BankName'], ENT_QUOTES)."</option>");
												}
											?>		
											</datalist>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Account No.: </td>
										<td>
											<input type="text" class="ctrlSm" name="txtAcctNo" id="txtAcctNo" value="" size="50" placeholder="Enter Account No.">
											<div id="AcctErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>FD Date: </td>
										<td>
											<input type="text" class="ctrlSm dtCtrl" name="txtFDDate" id="txtFDDate" value="" size="10" placeholder="yyyy-mm-dd" readonly>
											<div id="FDDateErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Maturity Date: </td>
										<td>
											<input type="text" class="ctrlSm dtCtrl" name="txtMaturityDate" id="txtMaturityDate" value="" size="10" placeholder="yyyy-mm-dd" readonly>
											<div id="MDateErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Principle Amount: </td>
										<td>
											<input type="number" class="ctrlSm" name="txtPAmt" id="txtPAmt" value="" size="50" placeholder="Enter Principle Amount">
											<div id="PAmtErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Maturity Amount: </td>
										<td>
											<input type="number" class="ctrlSm" name="txtMAmt" id="txtMAmt" value="" size="50" placeholder="Enter Maturity Amount">
											<div id="MAmtErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Intrest Rate: </td>
										<td>
											<input type="number" class="ctrlSm" name="txtIntRate" id="txtIntRate" value="" size="50" placeholder="Enter Intrest Rate">
											<div id="IRateErr" class="errMsg"></div>
										</td>
									</tr>
									<tr>
										<td class=formText width=200px>Period: </td>
										<td>
											<input type="text" class="ctrlSm" name="txtPeriod" id="txtPeriod" value="" size="50" placeholder="Enter Period">
											<div id="PeriodErr" class="errMsg"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
				<div class="modal-footer text-center">
					<div style="width:100%;">
						<button type="button" class="btnBlack" OnClick="SubmitForm();">Save</button>
						<button type="button" class="btnBlack" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

function SaveNewFD(){
	global $con;
	$Name = $BankName = $AcctNo = $FDDate = $MaturityDate = $Period = "";
	$PAmt = $MAmt = $IntRate = 0;
	if(isset($_REQUEST)){
		$Name = $_REQUEST['txtName'];
		$BankName = $_REQUEST['txtBankName'];
		$AcctNo = $_REQUEST['txtAcctNo'];
		$FDDate = $_REQUEST['txtFDDate'];
		$MaturityDate = $_REQUEST['txtMaturityDate'];
		$PAmt = $_REQUEST['txtPAmt'];
		$MAmt = $_REQUEST['txtMAmt'];
		$IntRate = $_REQUEST['txtIntRate'];
		$Period = $_REQUEST['txtPeriod'];
	} 
	$qry = "INSERT INTO savings(Name, BankName, AccountNumber, FDDate, FDDueDate, PrincipalAmount, MaturityAmount, IntRate, Period, Status, CreatedBy, CreatedOn) VALUES ('{$Name}', '{$BankName}', '{$AcctNo}', '{$FDDate}', '{$MaturityDate}', '{$PAmt}', '{$MAmt}', '{$IntRate}', '{$Period}', 'New', '{$_SESSION['LoginUser']}', SYSDATE())";

	print($qry);
	mysqli_query($con, $qry);	
}
?>

<style>
	#svList_length, #svList_info{			
		float:left;			
	}			
</style>
<script language="JavaScript" type="text/javascript">
	$(document).ready(function(){	
		$('#svList').DataTable({
			"dom": '<"top"if>rt<"bottom"lp><"clear">',
			"pageLength": 50,
			"lengthMenu": [[25, 50, 100, 200, 250, -1], [25, 50, 100, 200, 250, "All"]],
			order: [[0, 'asc']],
			columns: [		null,
							null,
							null,
							{ orderable: false},
							null,
							null,
							null,
							null,
							null,
							null,
							{ orderable: false},
							{ orderable: false}
						]
		});
		$(".dtCtrl").datepicker({
			showOn: "button",
			buttonImage: 'graphics/calendar.png',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd',								
			changeMonth: true,
			changeYear: true			
		});	
		$(document).on("click", ".reset", function () {
			$("#cboStatus").val("");
			$("#cboName").val("");
			$("#cboBankName").val("");
			$("#cboFDYear").val("");
			$("#txtMatSTDt").val("");
			$("#txtMatENDt").val("");
			$("#frmSVList").submit();
		});

		$(document).on("click", ".FDLink", function () {
			var FDId = $(this).data('id');
			if(FDId == 0){
				$("#AddEditFD #FDTitle").html("<h4 class='modal-title'>Add New FD</h4>");
				$('#frmFD').attr('action', 'savings.php?Mode=Save');
			}else{
				/*$("##AddEditNameAlias ##AECTitle").html("<h4 class='modal-title'>Edit Name Alias</h4>");
				$('##frmAddEditName').attr('action', '#this.PageName#?Mode=UpdateNameAlias&ContributorId=#this.ContributorId#');

				$("##AddEditNameAlias ##cboTitle").val($(this).data('title'));
				$("##AddEditNameAlias ##txtName").val($(this).data('name'));
				$("##AddEditNameAlias ##txtMiddleName").val($(this).data('mname'));
				$("##AddEditNameAlias ##txtSurname").val($(this).data('surname'));
				$("##AddEditNameAlias ##cboSuffix").val($(this).data('suffix'));
				$("##AddEditNameAlias ##txtEntityName").val($(this).data('entityname'));*/
			}
		});	
	});
	function SubmitForm(){
		$("#NameErr, #BankErr, #AcctErr, #FDDateErr, #MDateErr, #PAmtErr, #MAmtErr, #IRateErr, #PeriodErr").html("");
		$("#NameErr, #BankErr, #AcctErr, #FDDateErr, #MDateErr, #PAmtErr, #MAmtErr, #IRateErr, #PeriodErr").hide();

		var IsValidFD = 1;
		var FirstErrField = null;
		var Name = $("#txtName").val().trim(); 
		var Bank = $("#txtBankName").val().trim(); 
		var AccountNo = $("#txtAcctNo").val().trim(); 
		var FDDate = $("#txtFDDate").val().trim(); 
		var MDate = $("#txtMaturityDate").val().trim();
		var PAmt = $("#txtPAmt").val().trim(); 
		var MAmt = $("#txtMAmt").val().trim(); 
		var IntRate = $("#txtIntRate").val().trim(); 
		var Period = $("#txtPeriod").val().trim();

		if (Name.length == 0){ 				
			IsValidFD = 0;
			FirstErrField = $("#txtName");
			$("#NameErr").show();
			$("#NameErr").html("<i class='fa fa-exclamation-circle'></i> Please provide a name.");
		}
		if (Bank.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtBankName");
			$("#BankErr").show();
			$("#BankErr").html("<i class='fa fa-exclamation-circle'></i> Please provide a bank name.");
		}
		if (AccountNo.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtAcctNo");
			$("#AcctErr").show();
			$("#AcctErr").html("<i class='fa fa-exclamation-circle'></i> Please provide an account number.");
		}
		if (FDDate.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtFDDate");
			$("#FDDateErr").show();
			$("#FDDateErr").html("<i class='fa fa-exclamation-circle'></i> Please provide FD date.");
		}
		if (MDate.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtMaturityDate");
			$("#MDateErr").show();
			$("#MDateErr").html("<i class='fa fa-exclamation-circle'></i> Please provide maturity date.");
		}
		if (PAmt.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtPAmt");
			$("#PAmtErr").show();
			$("#PAmtErr").html("<i class='fa fa-exclamation-circle'></i> Please provide principle amount.");
		}
		if (MAmt.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtMAmt");
			$("#MAmtErr").show();
			$("#MAmtErr").html("<i class='fa fa-exclamation-circle'></i> Please provide maturity amount.");
		}
		if (IntRate.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtIntRate");
			$("#IRateErr").show();
			$("#IRateErr").html("<i class='fa fa-exclamation-circle'></i> Please provide intrest rate.");
		}
		if (Period.length == 0){ 				
			IsValidFD = 0;
			if(!FirstErrField) FirstErrField = $("#txtPeriod");
			$("#PeriodErr").show();
			$("#PeriodErr").html("<i class='fa fa-exclamation-circle'></i> Please provide period.");
		}
		if(IsValidFD){				
			$("#frmFD").submit();
		}else{
			FirstErrField.focus();
		}

	}
</script>


