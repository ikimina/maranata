<?php
session_start();
include("imariheader.php");

 ?>

<div class="container"></div>

<div class="container-fluid">
	<div class="card">
	<div class="card-header"Savings</div>
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
				<center>Total Savings this year   450000</center>
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
  				<center><font>All Members</font></center>
   				<hr>
   				<center><h3>70</h3></center>
   				<hr>
   				<a href="">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
   				<center><font>Total Savings</font></center>
   				<hr>
   				<center><h3>350000</h3></center>
   				<hr>
   				<a href="">Read More</a>
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