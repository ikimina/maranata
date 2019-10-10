<?php
session_start();
include("imariheader.php");
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
<div class="container-fluid">
	<br><div class="row">
	    <div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-4">
					
			<img class="d-flex rounded-circle avatar mr-3" src="../images/logo.jpg <?php //<?php echo $user->getProfilePic()?>" width="50" height="50"
         alt="Avatar">
					</div>
					<div class="col-md-8" style="margin-top: 20px;">
						About <b>
					<?php echo $user->getNames(); ?></b>
					</div>
				</div>
			</div>
				
				<div class="card-body">

		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Names</span>
		      </div>
		      <label  class="form-control" ><b>
					<?php echo $user->getNames(); ?></b>
			  </label>
		      </div>

		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">DOB&nbsp;&nbsp;&nbsp;&nbsp;</span>
		      </div>
		      <label  class="form-control" >
		      	<b><?php echo $user->getDob(); ?></b>
		      </label> &nbsp;
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Gender</span>
		      </div>
		      <label  class="form-control" >
		      	<b><?php echo $user->getSex(); ?></b>
		      </label>
		      </div>

		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Phone</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $phone; ?></b>
			  </label>
		      </div>

					Adress
					<hr>
		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">District</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $user->getDistrict(); ?></b>
			  </label>&nbsp;
			  <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Sector</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $user->getSector(); ?></b>
			  </label>
		      </div>

		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Cell&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $user->getCell(); ?></b>
			  </label>&nbsp;
			  <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Village</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $user->getVillage(); ?></b>
			  </label>
		      </div>
					Bank
					<hr>

		      <div class="input-group mb-3">
		      <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Bank name</span>
		      </div>
		      <label  class="form-control">
					<b><?php echo $user->getBankName(); ?></b>
			  </label>&nbsp;
			  <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon3">Acc. Number</span>
		      </div>
		      <label  class="form-control" >
					<b><?php echo $user->getAccountNumber(); ?></b>
			  </label>
		      </div>
				</div>
			</div>
		</div>
		<?php ?>
		<div class="col-md-2"></div>
	</div>
</div><br>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<?php
               include("../includes/footer.php");
			?>
		</div>
	</div>
</div><br>
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