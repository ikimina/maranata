<?php
session_start();
include("colheader.php");
include "../includes/dbconnect.php";

require_once("../includes/classes/user.php");
require_once("../includes/classes/transaction.php");
require_once("../includes/classes/Loan.php");

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
$loan=new Loan($con,$phone) ;
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
					<div class="col-md-6">Unpaid Loan&nbsp;<b><?php echo $loan->loanAmount(); ?>&nbsp;</b>Rwf&nbsp;<a href="">Other Loan Info</a> </div>
					
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" onclick="ShowForm()">Provide Loan</button>
				
				<div id="form" style="display: none;">
					<label>Amount</label>
					<input type="text" name="" id="amount">
					<label>Duration</label>
					<select id="duration">
						<option value="1">Month</option>
						<option value="3"> 3 Mounth</option>
						<option value="6"> 6 Mounths</option>
						<option value="12">Year</option>
						<option value="18">Year 6 Mouths</option>
						<option value="22">2 years</option>
					</select>
					<button class="btn btn-sm btn-primary" id="allowLoan" onclick="allowLoan()">Allow</button><span id="resp"></span>
			
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	function _(id) {
		return document.getElementById(id);
	}
	function ShowForm() {
    document.getElementById('form').style.display="block";
	}
	function allowLoan() {

		var userPhone="<?php echo $phone; ?>";
		var amount=_("amount").value;
		var duration=_("duration").value;
		if (amount=="") {
			 _("resp").innerHTML="<br><span style='color:red;'>insert Amount</span>";
			return;
		}
		var dataString="user="+userPhone+"&amount="+amount+"&dur="+duration;
		       xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		      var res=this.responseText;
		         
		      _("resp").innerHTML=res;
		     
		    }
		  }
		  xmlhttp.open("GET","saveloan.php?"+dataString,true);
		  xmlhttp.send();
	}
</script>