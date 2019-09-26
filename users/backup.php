<?php
include("usersheader.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo  $_SESSION["user"]?> | Dashboard</title>
</head>
<body>
<div class="container">
 <div class="row">
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>Total Saving  500000</center></h5>
 	</div>
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>You have no credit yet</center></h5>
 	</div>
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>Next Saving Date</center></h5>
 	</div>
 </div>

 <hr>

	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="header">
					<br><br><br><br>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="header">
					<br><br><br><br>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="header">
					<br><br><br><br>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="header">
					<br><br><br><br>
				</div>
			</div>
		</div>
	</div>

	<hr>
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				<br><br><br>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
	<div class="col-md-3"></div>
</div>
<hr>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header alert alert-success" style="margin-bottom: -1px !important;">
			<center>
			Informations about you  <b><?php echo  $_SESSION["user"]?></b>
			</center>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<p class="alert alert-success">Basic info</p>
						<label class="form-control">First Name:</label>
						<label class="form-control">Last Name:</label>
						<label class="form-control">E-mail:</label>
						<label class="form-control">
						Bank:&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp 
						Account No.:
						</label>
						<label class="form-control">Date of Birth:</label>
						<label class="form-control">
						Gender: &nbsp&nbsp&nbsp      
						Marital-Status:
						</label>
					</div>
				<div class="col-md-6">
					<p class="alert alert-success">Adress info</p>
						<label class="form-control">District:</label>
						<label class="form-control">Sector:</label>
						<label class="form-control">Cell:</label>
						<label class="form-control">Village:</label>
						<label class="form-control">Telephone:</label>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

</body>
</html>
