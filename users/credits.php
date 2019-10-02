<?php
include ("usersheader.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo  $_SESSION["user"]?> | Credits</title>
</head>
<body><br>
<div class="container">
	<div class="card" style="box-shadow: none;border:1px solid;">
	  <center>
	  <p class="alert alert-info"><b>Credits Description</b></p>
	  </center>
	  <div class="card-body">


	  			<table class="table">
	  				<th>No</th>
	  				<th>Amount</th>
	  				<th>Return-Amount</th>
	  				<th>Issued-Date</th>
	  				<th>Ending-Date</th>
	  				<th>Installment</th>
	  				<th>Returned</th>
	  				<th>Rest</th>
	  				<th>Progress</th>
	  				<tr>
	  					<td>1</td>
	  					<td>100000</td>
	  					<td>120000</td>
	  					<td>12-May-2015</td>
	  					<td>12-May-2016</td>
	  					<td>4</td>
	  					<td>80000</td>
	  					<td>40000</td>
	  					<td>80%</td>
	  				</tr>
	  			</table>

	  			<div class="row">
	  				<div class="col-md-6">
	  				<p class="alert alert-info"><b>Referees</b></p>
	  				</div>
	  				<div class="col-md-6">
	  				<p class="alert alert-info"><b>Paying Schedule</b></p>

	  				<table class="table">
	  					<th>Instalment</th>
	  					<th>amount</th>
	  					<th>Status</th>
	  					<th>Date</th>

	  					<tr>
	  						<td>1</td>
	  						<td>30000</td>
	  						<td><input type="checkbox" name="#" checked=""> Paid</td>
	  						<td>12-Sept-2015</td>
	  					</tr>
	  					<tr>
	  						<td>2</td>
	  						<td>30000</td>
	  						<td><input type="checkbox" name="#"> Unpaid</td>
	  						<td></td>
	  					</tr>
	  				</table>	
	  				</div>
	  			</div>

	  </div>
	</div>
</div>
</body>
</html>