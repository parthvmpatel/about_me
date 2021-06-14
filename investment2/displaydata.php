<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boothstrap</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
	
</head>
<body>
 

<!-- Modal -->
<div class="modal fade" id="newfdmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New FD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Name</label>
			<div class="col-sm-10">
			  <input type="text" name="name" class="form-control" placeholder="Name">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Bank Name</label>
			<div class="col-sm-10">
			  <input type="text" name="bankname" class="form-control" placeholder="Enter the Bank Name">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Account Number</label>
			<div class="col-sm-10">
			  <input type="text" name="accountnumber" class="form-control" placeholder="Enter the Account Number">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">FD Date</label>
			<div class="col-sm-3">
			  <input type="date" name="fddate" class="form-control" placeholder="Enter the Bank Name">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Maturity Date</label>
			<div class="col-sm-3">
			  <input type="date" name="maturitydate" class="form-control" placeholder="Enter the Maturity Date">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Principle Amount</label>
			<div class="col-sm-10">
			  <input type="text" name="principleamount" class="form-control" placeholder="Enter the Principle Amount">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Maturity Amount</label>
			<div class="col-sm-10">
			  <input type="text" name="maturityamount" class="form-control" placeholder="Enter the Maturity Amount">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Intrest Rate</label>
			<div class="col-sm-10">
			  <input type="text" name="intrestrate" class="form-control" placeholder="Enter the Intrest Rate">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label for="colFormLabelSm" class="col-sm-2 col-form-label">Period</label>
			<div class="col-sm-10">
			  <input type="text" name="period" class="form-control" placeholder="Enter the Period">
			</div>
		  </div>
 
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid">
	<div class="jumbotroner">
		<div class="card">
			<h2 align="center">Welcome Bank Data</h2>
		</div>
		<div class="card">
			<div class="card-body">
				<form method = 'POST' action = 'displaydata.php'>
					<label >Select Status : </label>
					<select name="status">
						<option value="all">All status</option>
						<option value="unrenewed">New</option>
						<option value="renewed">Renewed</option>
					</select>
					<br>
					<label>Select Bank name : </label>
					<select name="bankname">
						<option value="all">All bank name</option>
						<option value="Dena Bank">Dena Bank</option>
						<option value="SBI">SBI</option>
						<option value="Bank of Baroda">Bank of Baroda</option>
						<option value="Panjab N Bank">Panjab N Bank</option>
						<option value="Central Bank">Central Bank</option>
						<option value="NSC">NSC</option>
						<option value="KVP">KVP</option>
					</select>
					<br>
					<!-- creating the option for date collection -->
					<label>Enter the date : </label>
					<input type="date" name="startdate" value="Enter the starting date">
					<label> To </label>
					<input type="date" name="enddate" value="Enter the ending date ">
					<input type="submit" class="btn btn-light" name="search" value="submit">
					<br>
					<!-- creating a button to add new data  -->
					<button type="button" class="btn btn-light" data-toggle="modal" data-target="#newfdmodal">Add New Data</button>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<table id="displaytable" class="table table-hover">
					<thead>
						<tr>
							<td>ID</td>
							<td>Name</td>
							<td>Bank Name</td>
							<td>A/C No.</td>
							<td>Valu Date</td>
							<td>Due Date</td>
							<td>Principle Amount</td>
							<td>Maturity Amount</td>
							<td>Int. Rate</td>
							<td>Other</td>
							<td>Status</td>
							<td>Action</td>
						</tr>
					</thead>
					
					<tbody>
						<?php
							include_once 'connect.php';
								print_r($_REQUEST);
									if(isset($_POST['search'])){
										$startdate = mysqli_real_escape_string($con, $_POST['startdate']);
										$enddate = mysqli_real_escape_string($con, $_POST['enddate']);
										$status = mysqli_real_escape_string($con, $_POST['status']);
										$bankname = mysqli_real_escape_string($con, $_POST['bankname']);                            
										echo $bankname;
										if ($status != "all" && $bankname == "all" && $startdate == NULL && $enddate == NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE status = '{$status}'");    
										elseif($status == "all" && $bankname != "all" && $startdate == NULL && $enddate == NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE Bank_Name = '{$bankname}'"); 
										elseif($status != "all" && $bankname != "all" && $startdate == NULL && $enddate == NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE Bank_Name = '{$bankname}' AND status = '{$status}'");
										elseif ($status == "all" && $bankname == "all" && $startdate != NULL && $enddate != NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE Due_Date between '{$startdate}' and '{$enddate}'");
										elseif ($status == "all" && $bankname != "all" && $startdate != NULL && $enddate != NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE Bank_Name = '{$bankname}' and Due_Date between '{$startdate}' and '{$enddate}'");
										elseif ($status != "all" && $bankname == "all" && $startdate != NULL && $enddate != NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE status = '{$status}' and Due_Date between '{$startdate}' and '{$enddate}'");
										elseif ($status != "all" && $bankname != "all" && $startdate != NULL && $enddate != NULL)
											$sql = mysqli_query($con, "SELECT * FROM investmentdata WHERE Bank_Name = '{$bankname}' and status = '{$status}' and Due_Date between '{$startdate}' and '{$enddate}'");    
										else
											$sql = mysqli_query($con, "SELECT * FROM investmentdata");
									}else{
									$sql = $con->query('SELECT * FROM investmentdata');
									}
								while($data = $sql->fetch_array()) {
						   
								echo '<tr>
									<td>'.$data['Id'].'</td>    
									<td>'.$data['Name'].'</td>    
									<td>'.$data['Bank_Name'].'</td>	
									<td>'.$data['AC_No'].'</td>	
									<td>'.$data['Valu_Date'].'</td>	
									<td>'.$data['Due_Date'].'</td>	
									<td>'.$data['Principal_Amount'].'</td>
									<td>'.$data['Maturity_Amount'].'</td>	
									<td>'.$data['Int_Rate'].'</td>  
									<td>'.$data['Other'].'</td>     
									<td>'.$data['status'].'</td>
								</tr>';
								}      
						?>
					</tbody> 
				</table>
			</div>
		</div>
	</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		$('#displaytable').DataTable();
	});
</script>
</body>
</html>