<!--- --------------------------------------------------------------------------
	prHeader.php
--------------------------------------------------------------------------- --->
<?php
session_start();
if(!isset($_SESSION['LoginUser'])) {
	header("Location: index.php?ErrMode=1" );
}
include_once 'connect.php';
?>
<link href="my.css" rel="stylesheet" type="text/css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
<link href="jquery/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="jquery/datatable/datatables.min.css" rel="stylesheet" type="text/css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap4/js/tether.min.js"></script>
<script src="bootstrap4/umd/popper.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="bootstrap4/js/bootbox.min.js"></script>
<script src="jquery/datatable/datatables.min.js"></script>

<table cellpadding="0" cellspacing="0" class="headerBG" width=100%>
	<tr>		
		<td class="Motto" valign=center rowspan="2">Savings Management</td>
	</tr>
	<tr>
		<td class="hdUser2 right"><?php echo($_SESSION['LoginUser']) ?></td>				
	</tr>		
</table>
<div class="navbar navbar-static pnav" width="100%" >
	<div class="navbar-inner" style="width:100%;">			
		<ul class="nav pull-left" id="MLeft">
			<li><a href="ofsMenu.cfm" class="menutab"><i class="fa fa-home fa-lg"></i> Savings list </a></li>
			<li><a href="ofsMenu.cfm" class="menutab"><i class="fa fa-plus fa-lg"></i> Add new Saving</a></li>
		</ul>
		<ul class="nav pull-right">
			 <li><a href="ofsLogoff.cfm" class="menutab"><i class="fa fa-power-off"></i> Logoff</a></li>
		</ul>
	</div>
</div><br>
<div class="container-fluid" >


	