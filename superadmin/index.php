
<?php
session_start();
include("adminheader.php");
include "../includes/dbconnect.php";
require_once("../includes/classes/user.php");
require_once("../includes/classes/transaction.php");
$transaction= new Transaction($con,null);
$user=new User($con,null) ;
?>
<br>
<div class="container"></div>

<div class="container-fluid">
	<div class="card">
	<div class="card-header">Loans</div>
	<div class="card-body"><form>
		<div class="row">
			<div class="col-md-3">
				<select class="form-control">
					<option>Select Year</option>
          <?php
           $y=date("Y");
           $start=2015;
           for ($i=(int)$y; $i >=$start; $i--) { 
             echo "<option>".$i ."</option>";
           }

           ?>
				</select><br>
							
			</div>
			<div class="col-md-4"><center><h5>2019</h5></center></div> 	
			<div class="col-md-5">
				<label class="form-control">
				<center>Total Loan this year   450000</center>
				</label>
			</div>

        <table class="table table-stripped table-bordered">
         	<th>Jan</th>
         	<th>Feb</th>
         	<th>Mar</th>
         	<th>Apl</th>
         	<th>May</th>
         	<th>Jun</th>
         	<th>Jul</th>
         	<th>Aug</th>
         	<th>Sep</th>
         	<th>Oct</th>
         	<th>Nov</th>
         	<th>Dec</th>
         	<tr>
         		<td>45000</td>
         		<td>45000</td>
           		<td>45000</td>
         		<td>45000</td>
         		<td>45000</td>
                <td>45000</td> 
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
         	</tr>
         </table>
		</div>
		</form>
	</div>
	</div><br>
   <div class="row">
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font><i class="fas fa-users"></i>&nbsp;All Members</font></center>
   				<hr>
   				<center><h3><?php echo $user->getAllUser(); ?></h3></center>
   				<hr>
   				<a href="registration.php">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
   				<center><font><i class="fas fa-money-check"></i>&nbsp;Total Savings</font></center>
   				<hr>
   				<center><h3><?php echo $transaction->getTotalBalance(); ?><span style="font-size: 13px;">Rwf</span></h3></center>
   				<hr>
   				<a href="saving.php">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font>Returned Loans</font></center>
   				<hr>
   				<center><h3>50000</h3></center>
   				<hr>
   				<a href="">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font>Unreturned Loans</font></center>
   				<hr>
   				<center><h3>12000</h3></center>
   				<hr>
   				<a href="">Read More</a>
   			</div>
   		</div>
   	</div>
   </div>	

</div>

