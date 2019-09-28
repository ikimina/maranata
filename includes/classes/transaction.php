
<?php 
/**
 * eric
 */
require_once ("user.php");
class Transaction
{
	
	function __construct($con,$tel)
	{
		$this->con=$con;
		$this->tel=$tel;
	}
	public function saveTransaction($ammount,$comment)
	{
		 $query = $this->con->prepare("INSERT INTO transactions(
	user_phone, amount, actions, coment,tr_id)
	VALUES (:user_phone, :amount, :actions, :coment,:tr_id)");
                             $action="saving" ; 
                             $tr_id="1";         

        $query->bindParam(":user_phone", $this->tel);
        $query->bindParam(":amount", $ammount);
        $query->bindParam(":actions", $action);
        $query->bindParam(":coment", $comment);
        $query->bindParam(":tr_id", $tr_id);
        
         if ($query->execute()) {
          
        return true;
         }
         else{
            return false;
         }

	}
	public function getBalance()
	{
		return $this->saving() - $this->expence();
	}
    public function saving(){

        $query = $this->con->prepare("SELECT amount FROM transactions WHERE user_phone = :un AND tr_id='1'");
        $query->bindParam(":un", $this->tel);
        $query->execute();
        $total=0;
        foreach ($query as $row) {
         $total=$total + (int) $row['amount'];

        }

    	return $total;
    }
    public function expence(){

        $query = $this->con->prepare("SELECT amount FROM transactions WHERE user_phone = :un AND tr_id='0'");
        $query->bindParam(":un", $this->tel);
        $query->execute();
        $total=0;
        foreach ($query as $row) {
         $total=$total + (int) $row['amount'];

        }

    	return $total;
    }

	public function getUserAllTransaction($rpp, $pn,$last){
         
  $user=$this->tel;
 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM transactions  WHERE user_phone='$user' LIMIT $rpp OFFSET $a";
$q1=$this->con->query($sql1);

 $dataString = "<table class='table table-stipped '>
          <tr>
          <th>No</th>
                    	<th>Date</th>
                    	<th>Amount</th>
                    	<th>Action</th></tr>
         <tr >";
$i=1;

foreach ($q1 as $row) {
    
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'.$row['done_on'].'</td><td>'.$row['amount'].'</td><td>'.$row['actions']."</td></tr>";
  }
   
 
          return $dataString ;
	}
	
	public function getAllTransaction($rpp, $pn,$last)
	{

 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM transactions LIMIT $rpp OFFSET $a";
$q1=$this->con->query($sql1);

 $dataString = "<table class='table table-stipped '>
          <tr>
          <th>No</th>
                    	<th>Date</th>
                    	<th>Names</th>
                    	<th>Amount</th>
                    	<th>Action</th></tr>
         <tr >";
$i=1;

foreach ($q1 as $row) {
	$user=new User($this->con,$row['user_phone']);
    
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'.$row['done_on'].'</td>
    <td>'.$user->getNames().'</td><td>'
    .$row['amount'].'</td><td>'.$row['actions']."</td></tr>";
  }
   
 
          return $dataString ;
	}



public function getTotalBalance()
	{
		return $this->totalSaving() - $this->totalExpence();
	}
    public function totalSaving(){

        $query = $this->con->prepare("SELECT amount FROM transactions WHERE  tr_id='1'");

        $query->execute();
        $total=0;
        foreach ($query as $row) {
         $total=$total + (int) $row['amount'];

        }

    	return $total;
    }
    public function totalExpence(){

        $query = $this->con->prepare("SELECT amount FROM transactions WHERE  tr_id='0'");
        
        $query->execute();
        $total=0;
        foreach ($query as $row) {
         $total=$total + (int) $row['amount'];

        }

    	return $total;
    }}
?>