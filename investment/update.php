<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New form</title>
    <h1 align="center">Bank Data</h1>
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<!-- Adding filter option in data base page  -->
    <div class = 'filter'>
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
            <input type="submit" name="search" value="submit">
            <!-- creating a button to creat the new row in data base  -->
            <input type="submit" name="new" value="new">
        </form>
    </div>

  <!-- Addin the data base page to display and to fatch data from php -->

    <div class="container" style="margin-top: 20px">
        <table class="table table-bordered table-hover" >
        
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
                    <td>' .'<input type="image" src="update.png" alt="Submit" width="28" height="20" data-target="#add_data" data-toggle="modal"">',
                    '<input type="image" src="delete.png" alt="Submit" width="19" height="19">'.'</td> 
                </tr>';
                echo '</form>';
                }      
                
            ?>
        </tbody>
         
        </table>

        <div class="row">
        <div class="col-md-12">
		<button data-toggle="modal"  data-target="#add_data">add</button>
            <div class="modal" id="add_data">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="model-header">
							<button class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add New FD</h4>
						</div>
						<div class="modal-body">
							This is body
						</div>
						<div class="modal-footer">
							<input class="btn btn-default" value="close">
						</div>
						</div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").DataTable();
        });
    </script>
    
</body>
</html>