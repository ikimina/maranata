
<?php
include("usersheader.php");
require_once("../includes/dbconnect.php");

require_once("../includes/classes/user.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;

if ($userLoggedIn->getChangingPasswordCount()<2) {
	header("location: ../passwordChange.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>

	<title>Maranata-<?php echo  $userLoggedIn->getFname();?> | Dashboard</title>

</head>
<body><br>
<div class="container">
 <div class="row">
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>Total Saving  <span style="color: green;"><b><?php echo  $transaction->getBalance()?> </b>Rwf</span></center></h5>
 	</div>
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>You have 0 loan yet</center></h5>
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

<div class="row" id="profile">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header alert alert-success" style="margin-bottom: -1px !important;">
			<center>
			Informations about you  <b><?php echo   $userLoggedIn->getNames();?></b>
			</center>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<p class="alert alert-success">Basic info</p>
						<label class="form-control">First Name:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getFname(); ?></b></label>
						<label class="form-control">Last Name:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getLname(); ?></b></label>
						<label class="form-control">
						Bank:&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp 
						Account No.: &nbsp;&nbsp;<b><?php echo $userLoggedIn->getAccountNo(); ?></b>
						</label>
						<label class="form-control">Date of Birth:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getDob(); ?></b></label>
						<label class="form-control">
						Gender: &nbsp&nbsp&nbsp      
						Marital-Status::&nbsp;&nbsp;<b><?php echo $userLoggedIn->getMeritalStatus(); ?></b>
						</label>
					</div>
				<div class="col-md-6">
					<p class="alert alert-success">Adress info</p>
					<label class="form-control">Province:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getProvince(); ?></b></label>
						<label class="form-control">District:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getDistrict(); ?></b></label>
						<label class="form-control">Sector:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getSector(); ?></b></label>
						<label class="form-control">Cell:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getCell(); ?></b></label>
						<label class="form-control">Village:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getVillage(); ?></b></label>
						<label class="form-control">Telephone:&nbsp;&nbsp;<b><?php echo $_SESSION['user']; ?></b></label>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

</body>
</html>
<?php
include "includes/footer.php";
?>

