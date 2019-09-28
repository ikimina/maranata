<?php
require_once("../includes/dbconnect.php");

require_once("../includes/classes/user.php");
if (isset($_REQUEST['tel'])) {
	$tel=$_REQUEST['tel'];
$user=new User($con,$tel) ;
echo "

    <span style='color:red;' id='user'>".$user->isUserValid()."</span>
    <div style='margin-top:10px;'>
  	<div style='float: left'>
  		<label>Names:</label><b>".$user->getNames()."</b><br>
  		<label>Telephone:</label><b id='phone'>".$tel."</b><br>
  		<label>Sex:</label><b>".$user->getSex()."</b><br>

  	</div>
  	<div style='float: right;''>
  		<label >Sector:</label><b>".$user->getCell()."</b><br>
  		<label>Cell:</label><b>".$user->getSector()."</b><br>
  		<label>Village:</label><b>".$user->getVillage()."</b><br>
  		

  	</div></div>
";
 

 
}
 ?>

