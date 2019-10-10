<?php
session_start();
include("imariheader.php");
include ("../includes/dbconnect.php");
require_once("../includes/classes/transaction.php");
$transaction= new Transaction($con,null);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo  $_SESSION["user"]?> | </title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		
		</div>

		<div class="col-md-10"><br>
			<div class="card" style="box-shadow: none;border: 1px solid;border-radius: 0px;">
				<div class="card-header"><center><u>Transactions</u></center><br>

                    <label>Filter</label><select>
                    	<option>All</option>
                    	<option>Saving</option>
                    	
                    </select>
                  <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export PDF </button>
        <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export EXCEL </button>
      <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export CSV </button>
    <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Copy</button>

    <button style="border: none;background: transparent;"><form> <input type="search" name="" style="border-radius: 10px;"><button style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;background: transparent;"><img src="../images/search.png" width="20" height="20" ></button></form></button>

    <button style="border: none;background: transparent;">Total balance &nbsp;&nbsp;<b><?php echo $transaction->getTotalBalance(); ?></b>&nbsp;<span style="font-size: 11px;">Rwf</span></button>
				</div>
				<div class="card-body">
                    
                    
					<?php 
				$query = $con->prepare("SELECT COUNT(id) FROM transactions ");
                   
                    $query->execute();
                // $sql = "SELECT COUNT(id) FROM transactions WHERE user_phone=".$_SESSION["user"]."";
                //  $rows = $con->query($sql)->fetchColumn();
                    $rows= $query->fetchColumn();
                  $last=ceil($rows/6) ;
                  if (isset($_GET['pn'])) {
                  (int)$pn=$_GET['pn'];
                  }
                  else $pn=1;
                  echo $transaction->getAllTransaction(6,$pn,$last);

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

				?></div>
			</div>
		</div><div class="col-md-1"></div>
	</div>
</div>





  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>