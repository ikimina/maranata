<?php
session_start();
include("colheader.php");
?>



<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo $_SESSION['user']?> | Dashboard</title>
</head>
<body>
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><center>All members</center></div>
		<div class="card-body">
			<table class="table table-stripped table-bordered">
				<th>No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Telephone</th>
				
				<th><a href="user_info_page.php">View</a></th>
				<tr>
					<td>1.</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</body>
</html>



