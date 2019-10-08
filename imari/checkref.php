<?php
	include ("../includes/dbconnect.php");
	require_once("../includes/classes/user.php");

if (isset($_REQUEST['tel'])) {
	$user=new User($con,$_REQUEST['tel']);
	echo $user->getNames();

}
if (isset($_REQUEST['r1'])) {
	
	$user=$_REQUEST['user'];
	$loan_id=$_REQUEST['id'];
	$r1=$_REQUEST['r1'];
	$r2=$_REQUEST['r2'];
	$r3=$_REQUEST['r3'];

	$query=$con->prepare("INSERT INTO refere(ref_phone, loan_id, user_phone) VALUES (:ref_phone, :loan_id, :user_phone)") ;          
      
        $query->bindParam(":ref_phone", $r1);
        $query->bindParam(":loan_id", $loan_id);
        $query->bindParam(":user_phone", $user);    
       $res= $query->execute(); 
     	
    if ($r2!="") {
    	
   
	$query=$con->prepare("INSERT INTO refere(ref_phone, loan_id, user_phone) VALUES (:ref_phone, :loan_id, :user_phone)") ;          
      
        $query->bindParam(":ref_phone", $r2);
        $query->bindParam(":loan_id", $loan_id);
        $query->bindParam(":user_phone", $user);    
       $res= $query->execute(); 
        
 }
 if ($r3!="") {
	$query=$con->prepare("INSERT INTO refere(ref_phone, loan_id, user_phone) VALUES (:ref_phone, :loan_id, :user_phone)") ;          
      
        $query->bindParam(":ref_phone", $r3);
        $query->bindParam(":loan_id", $loan_id);
        $query->bindParam(":user_phone", $user);    
       $res= $query->execute(); 
       
        }
if ($res) {
       $query=$con->prepare("UPDATE loan SET status=:status WHERE id=:id");
       $status="Taken";
       $query->bindParam(":status", $status);
       $query->bindParam(":id", $loan_id);
       $query->execute(); 
       	echo "Done";
       }
}
	
 ?>