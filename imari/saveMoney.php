<?php 
require_once("../includes/dbconnect.php");

require_once("../includes/classes/transaction.php");


if ($_REQUEST['phone']) {

$phone=$_REQUEST['phone'];

$transaction=new Transaction($con,$phone) ;
$amount=$_REQUEST['ammount'];
$comment=$_REQUEST['comment'];
$res=$transaction->saveTransaction($amount,$comment);
if ($res) {
	echo "successful saving done";
}
else{
	echo "saving Fail try again";
}
}
 ?>