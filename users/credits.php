<?php
include ("usersheader.php");
include ("../includes/dbconnect.php");
require_once("../includes/classes/user.php");
require_once("../includes/classes/Loan.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
$loan=new Loan($con,$_SESSION['user']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo  $_SESSION["user"]?> | Credits</title>
</head>
<body><br>
<div class="container">
	<div class="card" style="box-shadow: none;border:1px solid;">
	  <center>
	  <p class="alert alert-info"><b>Active Loan Description</b></p>
	  </center>
	  <div class="card-body">
           
              <?php 

              $haslaon=$loan->haveLoan();
            
              $s=explode('|', $haslaon);
               if ($s[0]=="1") {
               	echo "You Have laon yet";
               }
               else{
               ?>
	  			<table class="table">
	  				<th>Amount</th>
	  				<th>Return-Amount</th>
	  				<th>Issued-Date</th>
	  				<th>Ending-Date</th>
	  				<th>Installment</th>
	  				<th>Returned</th>
	  				<th>Rest</th>
	  				<th>Progress</th>
	  				<tr>
	  					<td><?php echo $loan->loanAmount()."&nbsp Rwf";  ?></td>
	  					<td title="<?php echo "At Rate of ".$loan->getRate()."%" ?>"><?php echo $loan->getAmountToReturn()."&nbsp Rwf"; ?></td>
	  					<td><?php echo $loan->receivedDate(); ?></td>
	  					<td><?php echo $loan->payementDeadline(); ?></td>
	  					<td>3</td>
	  					<td><?php echo $loan->payedLoan()."&nbsp Rwf"; ?></td>
	  					<td><?php echo ((int)$loan->loanAmount()-(int)$loan->payedLoan())."&nbsp Rwf";?></td>
	  					<td><?php
                            $pro=0;
                             $lo=(int)$loan->loanAmount();

                                 if ($lo!=0) {
                                 	$pro=(((int)$loan->payedLoan()*100)/$lo);
                                 }

	  					 echo $pro."%"; ?></td>
	  				</tr>
	  			</table>

	  			<div class="row">
	  				<div class="col-md-6">
	  				<p class="alert alert-info"><b>Referees</b></p>
	  				<table class="table">
	  					<tr><th>#</th>
	  						<th>Refere Names</th>
	  					</tr>
	  					
	  				<?php
	  				$j=0;
                    $Referees=$loan->getReffere();

                      if (is_array($Referees)) {
                      	for ($i=0; $i <count( $Referees) ; $i++) { 
                    	$j++;
                     $ref=new User($con,$Referees['ref_phone']);
                     echo "<tr><td>".$j."</td><td>".$ref->getNames()."<br></td></tr>";
                    }

                      }
                      else{
                      	echo "No refere";
                      }
                    

	  				 ?></table>
	  				</div>
	  				<div class="col-md-6">
	  				<p class="alert alert-info"><b>Paying Schedule</b></p>
                       <?php
                        $total=(int)$loan->getAmountToReturn();
                        $oneInt=$total/3;
                        $paymenttime=(int)$loan->getDuration()/3;
                        $first_ins_date=date("Y-m-d",strtotime('+'.$paymenttime.' months', strtotime($loan->receivedDate())));
                        $second_ins_date=date("Y-m-d",strtotime('+'.($paymenttime * 2) .' months', strtotime($loan->receivedDate())));
                        

                        ?>
	  				<table class="table">
	  					<th>Instalment</th>
	  					<th>amount</th>
	  					<th>End pay</th>
	  					<th>Status</th>
	  					<th>Date</th>

	  					<tr>
	  						<td>1</td>
	  						<td><?php echo $oneInt."&nbsp;Rwf"; ?></td>
	  						<td><?php echo $first_ins_date; ?></td>
	  						<td><input type="checkbox" name="#" checked=""> Paid</td>
	  						<td>12-Sept-2015</td>
	  					</tr>
	  					<tr>
	  						<td>2</td>
	  						<td><?php echo $oneInt."&nbsp;Rwf"; ?></td>
	  						<td><?php echo $second_ins_date; ?></td>
	  						<td><input type="checkbox" name="#"> Unpaid</td>
	  						<td></td>
	  					</tr>
	  					<tr>
	  						<td>2</td>
	  						<td><?php echo $oneInt."&nbsp;Rwf"; ?></td>
	  						<td><?php echo $loan->payementDeadline(); ?></td>
	  						<td><input type="checkbox" name="#"> Unpaid</td>
	  						<td></td>
	  					</tr>
	  				</table>	
	  				</div>
	  			</div>
               <?php } ?>
               <a href="#" type='button' class='btn  btn-sm mr-4 form-control' style="box-shadow: none;">Loan History</a>
               <div class="card">
               	<?php 
               	$u=$_SESSION['user'];
				$query = $con->prepare("SELECT COUNT(id) FROM loan WHERE user_id='$u'");
                   
                    $query->execute();
                    $rows= $query->fetchColumn();
                  $last=ceil($rows/5) ;
                  if (isset($_GET['pn'])) {
                  (int)$pn=$_GET['pn'];
                  }
                  else $pn=1;
                  echo $loan->getUserAllLoan(5,$pn,$last);

                  $paginationCtrls = "";
    // Only if there is more than 1 page worth of results give the user pagination controls
    if($last != 1){
    if ($pn > 1) {
      if ($pn>$last) {
      	$pn=$last;
      }
      $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.(string)($pn-1).'"><button >&lt;</button></a>';
      }
    $paginationCtrls .= ' &nbsp; &nbsp; <b>Page '.$pn.' of '.$last.'</b> &nbsp; &nbsp; ';
      if ($pn != $last) {
          $paginationCtrls .= '<a href='.$_SERVER['PHP_SELF'].'?pn='.(string)($pn+1).'><button>&gt;</button></a>';
      }
    }
echo "<tr><td colspan='4'>".$paginationCtrls."</td><tr></table>";

				?>
               </div>
	  </div>
	</div>
</div>
</body>
</html>