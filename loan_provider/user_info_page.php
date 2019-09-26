<?php
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
				<div class="card-body">
					<label class="form-control userinfo">
					First Name:<?php leaveSpace(40)?>
					Last Name:
					</label>
					<label class="form-control userinfo">
					DOB:<?php leaveSpace(20)?>
					Gender:<?php leaveSpace(10)?>
					Marital status:
					</label>
					<label class="form-control userinfo">
					Telephone:
					</label>

					Adress
					<hr>
					<label class="form-control userinfo">
					District:<?php leaveSpace(40)?>
					Sector:
					</label>
					<label class="form-control userinfo">
					Cell:<?php leaveSpace(40)?>
					Village
					</label>
					Bank
					<hr>
					<label class="form-control userinfo">
					Bank Name:<?php leaveSpace(40)?>
					Bank account:
					</label>
				</div>
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