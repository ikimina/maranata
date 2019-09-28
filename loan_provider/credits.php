<?php
include("colheader.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo $_SESSION['user']?> | Loans</title>
</head>
<body>
<div class="continer-fluid">
	<br><div class="row">
		<div class="col-md-8">
			<div class="card">
			<h5 class="alert alert-info"><center>User Credits</center></h5>
				<div class="card-body">
				<table class="table table-stripped table-bordered">
				<th>No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Telephone</th>
				<th>Credit amount</th>
				
				<th>Details</th>
				<tr>
					<td>1.</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<th><a href="user_info_page.php">View</a></th>
				</tr>
			</table>	
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
			<h5 class="alert alert-info"><center>Overall summary</center></h5>
			<div class="card-body">

			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>