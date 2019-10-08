<?php
session_start();
include("colheader.php");

 function leaveSpace($size)
{
	for ($i=0; $i <$size ; $i++) { 
		echo '&nbsp';
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo $_SESSION['user']?> | User info</title>
	<style type="text/css">
		.userinfo{
			border: 1px solid green !important;
		}
	</style>
</head>
<body>
<div class="continer-fluid">
	<br><div class="row">
		<div class="col-md-6">
			<div class="card">
			<h5 class="alert alert-info"><center>User info</center></h5>

			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
			<h5 class="alert alert-info"><center>Account usage info</center></h5>
			<div class="card-body">
				
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>