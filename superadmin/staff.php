<?php
include("adminheader.php");


include "../includes/dbconnect.php";
require_once("../includes/classes/Constants.php"); 
require_once("../includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/Account.php");

$account = new Account($con);
if (isset($_POST['register'])) {
     $sex=@$_POST["sex"];
    $firstName = FormSanitizer::sanitizeFormString($_POST["fname"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lname"]);
    $email=FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $idNo=FormSanitizer::sanitizeTelephone($_POST["idno"]);
    $phone=FormSanitizer::sanitizeTelephone($_POST["phone"]);
    $merital=@$_POST["mStatus"];
    $dob=$_POST["age"];
    $province = FormSanitizer::sanitizeFormString($_POST["province"]);
    $district = FormSanitizer::sanitizeFormString($_POST["district"]);
    $sector = FormSanitizer::sanitizeFormString($_POST["sector"]);
    $cell = FormSanitizer::sanitizeFormString($_POST["cell"]);
    $village = FormSanitizer::sanitizeFormString($_POST["village"]);
    $type=@$_POST["type"];
    $file=$_FILES["pic"];

    $wasSuccessful = $account->register($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$type,$file,$email);
  echo $wasSuccessful;

               echo $account->getError(Constants::$registerFailed); 
//     if(is_array($wasSuccessful)) {
// echo "work succeffuy";
//     //   $query = $con->prepare("INSERT INTO credential(user_id, username, password,type)
//     //                                 VALUES (:uid, :username, :password, :type)") ;          

//     //     $query->bindParam(":uid", $uid);
//     //     $query->bindParam(":username", $username);
//     //     $query->bindParam(":password", $password);
//     //      $query->bindParam(":type", $type);

//     //     $uid= $wasSuccessful[0];
//     //     $username=$wasSuccessful[1];
//     //     $password="00000";
//     //     $type=$wasSuccessful[2];
//     //     if ($query->execute()) {
//     //       $_SESSION["userLoggedIn"] = $username;
//     //       echo "<script>alert('Done')</script>";
//     //     }
//     //     else{
//     //        echo "<script>alert('failed')</script>";
//     //     }
        
     
//     // }
//     }
  }
?>
<br>
<style type="text/css">
  .noradius{
    border-radius: 0px !important;
  }
</style>
 <div class="container-fluid"><!-- 
    <button class="btn btn-primary">New Staff</button> -->

		<div class="card" style="box-shadow: none!important;" >
      <?php if (!isset($_GET['new_staff'])) {
      
     ?>
			<div class="card-header">Registered members <div style="float: right;"><a href="<?php echo $_SERVER['PHP_SELF']."?new_staff=nstf" ?>">New Staff&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></a></div></div>
			<div class="card-body">
				<table class="table table-stipped table-bordered">
					<th>No</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Duties</th>
					<th>Telephone</th>
          <th colspan="2">Operation</th>
				</table>
			</div>
		</div><br><?php } ?>
        <?php if (isset($_GET['new_staff'])) {
      
     ?>
	<div class="card">
		<div class="card-header">Staff Registration &nbsp;&nbsp; <div style="float: right;"><a href="staff.php">Staff List <i class="fas fa-list"></i></a></div> </div>
		<div class="card-body">
		<form method="POST" action="staff.php" enctype="multipart/form-data">
			<div class="row">

				<div class="col-md-6">

				<center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Basic info</h5></center>
				
					<input class="form-control" type="text" name="fname" placeholder="First Name" required><br>
					<input class="form-control" type="text" name="lname" placeholder="Last Name" required><br>
					<input class="form-control" type="number" name="idno" placeholder="ID Number" required><br>

          <input class="form-control" type="email" name="email" placeholder="Email" required><br>
       
      <input type="number" class="form-control" name="phone" placeholder="Telephone" required><br>
					<select class="form-control" name="sex" >
					<option selected disabled >Select Gender</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select><br>
					<select class="form-control" name="mStatus">
					<option selected disabled>Select Marital Status</option>
						<option>Single</option>
						<option>Married</option>
						<option>Divorced</option>
						<option>Widow</option>
						<option>Other</option>
					</select>
					<br>
		<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Date Of Birth</span>
      </div>
      <input type="date" class="form-control" name="age" required>
       </div>
      
				</div>
				<div class="col-md-6">
				<center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Adress info</h5></center>

	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Province</span>
      </div>
      <input type="text" class="form-control" name="province" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       District&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="district" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Sector&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="sector" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Cell&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="cell" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Village&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="village" >
     </div>
     
       <center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Other info</h5></center><br>
       <select class="form-control" name="type">
      <option selected disabled>Select Type</option>
      <option value="1">Accountant</option>
      <option value="3">Nyobozi</option>
      <option value="2">Ushinzwe gutanga inguzanyo</option>
      <option value="4">Ushinzwe kugaruza inguzanyo</option>
     </select><br>
     <label>Picture</label><br>
     <input type="file" name="pic">
     </div>
</div>
<div class="row">
          <button class="btn btn-success btn-sm" name="register">Register</button>
      
          <button class="btn btn-warning btn-sm" name="cancel">Cancel</button>
      
       </div>
	 </form>
					
    <?php }?>
	</div>
</div>