<?php 
 session_start();
 include ("includes/header.php");
require_once("includes/dbconnect.php");
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 
require_once("includes/classes/Account.php");
require_once("includes/classes/user.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
$account = new Account($con);


   $change="";
if (isset($_POST['savechange'])) {
	
     $user_id=$userLoggedIn->getId();
	$tel=$_SESSION['user'];
	$query = $con->prepare("SELECT type FROM credential WHERE username=:em");
    $query->bindParam(":em", $tel);
    $query->execute();
    $type=$query->fetch(PDO::FETCH_ASSOC)['type'];
	$password = FormSanitizer::sanitizeFormPassword($_POST["new"]);
	$password2 = FormSanitizer::sanitizeFormPassword($_POST["renew"]);
	$res=$account->getChangingPassword($user_id,$tel,$type,$password,$password2 );

	if ($res) {
	$query = $con->prepare("UPDATE credential SET active='no' WHERE id !=:em AND user_id='$user_id' ");
	$query->bindParam(":em", $res);
	if($query->execute()){
		header("Location:index.php?ver=true");
		exit();
	}


	}
	else
	{
		echo "Fail";
	}
	
	

}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Maranata Password changing</title>
 </head>
 <body>
 	<div class="container">
 <div class="row" style="margin-top: 50px;"></div><center>
 	<h1>Maranata</h1>
 </center>
 <div class="row">
 	<div class="col-md-3">
 		
 	</div>
 	<div class="col-md-6">
 		<div class="card" style="border-radius: 0px!important;">
  <div class="card-header">
   Changing Password
  </div>
  
        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>

 		<form class="form" style="padding: 0px 10px 0px 10px !important;" action="passwordChange.php" method="POST">
        	<label>Old Password</label>
        	<input type="password" name="old" readonly value="00000" class="form-control"><br>

        	<label>New Password</label>
        	<input type="password" name="new" class="form-control"><br>

        	<label>Re-Enter New Password</label>
        	<input type="password" name="renew" class="form-control" ><br>
              <input type="submit" name="savechange" class="btn btn-primary">

        </form>
         <br>
    </div>
 	</div>
 	<div class="col-md-3">
 		
 	</div>
 </div>
</div>
 </body>
 </html>
 <style type="text/css">
 	.errorMessage {
    color: #f00;
    font-size: 14px;
    font-weight: 400;
    text-align: center;
}
 </style>