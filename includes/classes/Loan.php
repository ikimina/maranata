<?php
/**
 * 
 */

class Loan
{
	private $con,$tel,$sqlData,$hasLoan;
	function __construct($con,$tel)
	{   

		$this->con=$con;
		$this->tel=$tel;
		$this->hasLoan;

		$query = $this->con->prepare("SELECT * FROM loan WHERE user_id = :un AND active=:active");
		$active='yes';
        $query->bindParam(":un", $tel);
        $query->bindParam(":active", $active);
        $query->execute();
        if($query->rowCount() == 0) {
           $this->hasLoan="1|Has no Loan" ;
        }
        else{
        	$this->hasLoan="2|Has Loan of";
        }
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);

	}
	public function haveLoan()
	{
		return $this->hasLoan . "&nbsp;Payed&nbsp;".$this->payedLoan()."&nbsp;Remain&nbsp;".$this->remainLoan();

	}
	public function getReffere()
	{
		$query = $this->con->prepare("SELECT * FROM refere WHERE user_phone = :un AND loan_id=:active");
		
        $query->bindParam(":un", $this->tel);
        $query->bindParam(":active", $this->sqlData['id']);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
	}
	public function getLoanStatus()
	{
		return $this->sqlData['status'];
	}
	public function getAmountToReturn()
	{
		return (int)$this->sqlData['amount']+((int)$this->sqlData['amount'] * (int) $this->sqlData['rate']);
	}
	
	public function payedLoan()
	{
		return $this->sqlData['payed'];
		
	}
	public function remainLoan()
	{
		# code...
	}
	public function loanAmount()
	{
		return $this->sqlData['amount'];
	}
	public function totalTaken($from,$to)
	{
		
	}
	public function getTotalUnPaidLaon()
	{
		# code...
	}
	public function receivedDate()
	{
		return strftime("%b %d, %Y",strtotime($this->sqlData["rec_date"]));
	}
	
	public function payementDeadline()
	{
		return date("Y-m-d",strtotime('+3 months', strtotime($this->sqlData["rec_date"])));
	}
	public function getDuration()
	{
		return $this->sqlData['duration'];
	}public function getRate()
	{
		return $this->sqlData['rate'];
	}
  
	public function getUserAllLoan($rpp, $pn,$last){
         
  $user=$this->tel;
 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM loan  WHERE user_id='$user' LIMIT $rpp OFFSET $a";
$q1=$this->con->query($sql1);

 $dataString = "<table class='table table-stipped '>
          <tr>
          <th>No</th>
                    	<th>Date</th>
                    	<th>Amount</th>
                    	<th>Payed</th>
                  
                    	<th>Status</th>
                    	</tr>
         <tr >";
$i=1;

foreach ($q1 as $row) {
    
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'. strftime("%b %d, %Y",strtotime($row['rec_date'])).'</td>
    <td>'.$row['amount'].'</td>
    <td>'.$row['payed'].'</td>
   
    <td>'.$row['status']."</td></tr>";
  }
   
 
          return $dataString ;
	}
	
	public function getAllLoan($rpp, $pn,$last)
	{

 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM loan LIMIT $rpp OFFSET $a";
$q1=$this->con->query($sql1);

 $dataString = "<table class='table table-stipped '>
          <tr>
          <th>No</th>
                    	<th>Date</th>
                    	<th>Names</th>
                    	<th>Amount</th>
                    	<th>Status</th>
                    	<th>Referee</th></tr>
         <tr >";
$i=1;

foreach ($q1 as $row) {
	$user=new User($this->con,$row['user_id']);
	$status="";
	$ref="<a type='button' class='btn  btn-sm mr-4' href='refprofile.php?user=".$row['user_id']."&l=".$row['id']."'><i class='fas fa-eye'></i>View Referees</a>";
     $loanid=(int) $row['id'];
     if ($row['status']=="pending") {
     	$onclick='populate('.'"'.$row['user_id'].'"'.','.$loanid.')';
     	$status="<a href='#' type='button' class='btn  btn-sm mr-4' data-toggle='modal' data-target='#basicExampleModal' onclick='".$onclick."'>Provide Loan</a>";
     	$ref="No Referee Yet";
     }
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'.$row['rec_date'].'</td>
    <td id="names">'.$user->getNames().'</td><td>'
    .$row['amount'].'</td><td>'.$row['status'].'&nbsp;&nbsp;'.$status.'</td><td>'
    .$ref.'</td></tr>';
  }
   
 
          return $dataString ;
	}
	// public function getReffere()
	// {   $tel=$this->$tel;
	// 	$query = $this->con->prepare("SELECT * FROM refere WHERE user_phone = :un");
 //        $query->bindParam(":un", $tel);
 //        $query->execute();
        
 //       return  $query->fetch(PDO::FETCH_ASSOC);
	// }

}



 ?>