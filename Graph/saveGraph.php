<?php

include ("../includes/dbconnect.php");
require_once("../includes/classes/user.php");
 header('Content-Type: application/json');
$user =new User($con,null);
$g=$user->getSavingMounthy('2019');
$json='[{"moth":"Jan","rain":"'.$g[0].'"},{"moth":"Feb","rain":"'.$g[1].'"},{"moth":"Mar","rain":"'.$g[2].'"},{"moth":"Apr","rain":"'.$g[3].'"},{"moth":"May","rain":"'.$g[4].'"},{"moth":"Jun","rain":"'.$g[5].'"},{"moth":"Jul","rain":"'.$g[6].'"},{"moth":"Aug","rain":"'.$g[7].'"},{"moth":"Sep","rain":"'.$g[8].'"},{"moth":"Oct","rain":"'.$g[9].'"},{"moth":"Nov","rain":"'.$g[10].'"},{"moth":"Dec","rain":"'.$g[11].'"}]';




echo $json;

?>