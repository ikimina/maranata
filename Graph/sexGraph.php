<?php

include ("../includes/dbconnect.php");
require_once("../includes/classes/user.php");
 header('Content-Type: application/json');
$user =new User($con,null);
$s=$user->getSexGraph();
$m=0;
$f=0;
foreach ($s as $row) {
	if ($row['sex']=="M") {
		$m++;
	}
	else{
		$f++;
	}


}
//$data= array();
$data='[{"gen":"Male","num":"'.$m.'"},{"gen":"Female","num":"'.$f.'"}]';
echo $data;

?>