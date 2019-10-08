<?php
session_start();
include("colheader.php");
include "../includes/dbconnect.php";

require_once("../includes/classes/user.php");
require_once("../includes/classes/transaction.php");

$transaction=new Transaction($con,$_SESSION['user']) ;
$phone="";
if (isset($_GET['user'])) {
	$phone=$_GET['user'];
}
else{
	header("Location:index.php");
	exit();
}
$user=new User($con,$phone) ;
$transaction=new Transaction($con,$phone) ;
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
			<div class="card"><span class="alert alert-info"><div class="row"><div class="col-md-4">
			<img class="d-flex rounded-circle avatar z-depth-1-half mr-3" src="<?php echo $user->getProfilePic() ?>" width="50" height="50"
    alt="Avatar"><div><b>
					<?php echo $user->getNames(); ?></b></div></div>
<div class="col-md-8">USER INFO</div></div></span>
				<div class="card-body">
					<label class="form-control userinfo">
					Names:&nbsp;&nbsp;<b>
					<?php echo $user->getNames(); ?></b>
					</label>
					<label class="form-control userinfo">
					DOB:&nbsp;&nbsp;<b>
					<?php echo $user->getDob(); ?></b><?php leaveSpace(20)?>
					Gender:&nbsp;&nbsp;<b>
					<?php echo $user->getSex(); ?></b><?php leaveSpace(10)?>
					Marital status:&nbsp;&nbsp;<b>
					<?php  //$user->getMeritalStatus();
					 ?></b>
					</label>
					<label class="form-control userinfo">
					Telephone:&nbsp;&nbsp;<b>
					<?php echo $phone; ?></b>
					</label>

					Adress
					<hr>
					<label class="form-control userinfo">
					District:&nbsp;&nbsp;<b><?php echo $user->getDistrict(); ?></b><?php leaveSpace(40)?>
					Sector:&nbsp;&nbsp;<b><?php echo $user->getSector(); ?></b>
					</label>
					<label class="form-control userinfo">
					Cell:&nbsp;&nbsp;<b><?php echo $user->getCell(); ?></b><?php leaveSpace(40)?>
					Village:&nbsp;&nbsp;<b><?php echo $user->getVillage(); ?></b>
					</label>
					Bank
					<hr>
					<label class="form-control userinfo">
					Bank Name:&nbsp;&nbsp;<b><?php echo $user->getBankName(); ?></b><?php leaveSpace(40)?>
					Bank account:&nbsp;&nbsp;<b><?php echo $user->getAccountNumber(); ?></b>
					</label>
				</div>
			</div>
		</div>
		<?php ?>
		<div class="col-md-6">
			<div class="card">
			<h5 class="alert alert-info"><center>Account usage info</center></h5>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">Saving Balance:&nbsp;<b><?php echo $transaction->getBalance() ?></b>&nbsp;Rwf&nbsp;<a href="">Other Saving Info</a></div>
					<div class="col-md-6">Unpaid Loan&nbsp;<b>0&nbsp;</b>Rwf&nbsp;<a href="">Other Loan Info</a> </div>
					
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" onclick="ShowForm()">Provide Loan</button>
				<div id="form" style="display: none;">
					<label>Amount</label>
					<input type="text" name="">
					<label>Duration</label>
					<select>
						<option>Month</option>
						<option> 3 Mounth</option>
						<option> 6 Mounths</option>
						<option>Year</option>
						<option>Year 6 Mouths</option>
						<option>2 years</option>
					</select>
					<button class="btn btn-sm btn-primary">Allow</button>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	
	function ShowForm() {
    document.getElementById('form').style.display="block";
	}
</script>