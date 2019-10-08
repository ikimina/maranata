<?php  
require_once ("../includes/dbconnect.php");

if (isset($_REQUEST['user'])) {
$user=$_REQUEST['user'];
$amount=$_REQUEST['amount'];
$dur=$_REQUEST['dur'];
$payed="0";
$status="pending";
$rate="12";
$active="yes";
$query = $con->prepare("INSERT INTO loan(user_id, amount, rate, payed, active, status, duration) VALUES (:uid, :amount, :rate, :payed,:active,:status,:duration)") ;          
      
        $query->bindParam(":uid", $user);
        $query->bindParam(":amount", $amount);
        $query->bindParam(":rate", $rate);
         $query->bindParam(":payed", $payed);
          $query->bindParam(":active", $active);
          $query->bindParam(":status", $status);
          $query->bindParam(":duration", $dur);
             
        if ($query->execute()) {
            echo "Done";
        }
        else{
        echo "Fail";
                }

}


?>