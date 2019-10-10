
<?php
include("usersheader.php");
require_once("../includes/dbconnect.php");

require_once("../includes/classes/user.php");
require_once("../includes/classes/Loan.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
$loan=new Loan($con,$_SESSION['user']) ;

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
<body style="background-image: linear-gradient(to top, rgba(255,0,0,0), rgba(0,255,255,.1));"><br>
<div class="container">
 <div class="row">
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>Total Saving  <span style="color: green;"><b><?php echo  $transaction->getBalance()?> </b>Rwf</span></center></h5>
 	</div>
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>You have <?php if ($loan->loanAmount()=="") {
         echo "O Rwf";
        } else echo $loan->loanAmount()."&nbsp Rwf"; ?> loan Now</center></h5>
 	</div>
 	<div class="col-md-4">
 		<h5 class="alert alert-success"><center>Next Saving Date</center></h5>
 	</div>
 </div>

 <hr>

<div class="row" id="profile">
	<div class="col-md-12">
		<div class="card" style="box-shadow: none;border: 1px solid;">
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
						Bank:<b><?php echo $userLoggedIn->getBankName(); ?></b>&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp 
						Account No.: &nbsp;&nbsp;<b><?php echo $userLoggedIn->getAccountNumber(); ?></b>
						</label>
						<label class="form-control">Date of Birth:&nbsp;&nbsp;<b><?php echo $userLoggedIn->getDob(); ?></b></label>
						<label class="form-control">
						Gender: &nbsp;&nbsp;&nbsp;<b><?php echo $userLoggedIn->getMeritalStatus(); ?></b>
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
include "../includes/footer.php";
?>

