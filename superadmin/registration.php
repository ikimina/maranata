<?php
include("adminheader.php");
?>
<br>
 <div class="container-fluid">

		<div class="card">
			<div class="card-header">Registered members</div>
			<div class="card-body">
				<table class="table table-stipped table-bordered">
					<th>No</th>
					<th>F Name</th>
					<th>L Name</th>
					<th>Type</th>
					<th>Telephone</th>
				</table>
			</div>
		</div><br>
	<div class="card">
		<div class="card-header">User Registration</div>
		<div class="card-body">
		<form method="POST">
			<div class="row">

				<div class="col-md-6">

				<center><h5 class="alert alert-success">Basic info</h5></center>
				
					<input class="form-control" type="text" name="" placeholder="First Name"><br>
					<input class="form-control" type="text" name="" placeholder="Last Name"><br>
					<input class="form-control" type="number" name="" placeholder="ID Number"><br>
					<select class="form-control">
					<option>Select Gender</option>
						<option>Male</option>
						<option>Female</option>
					</select><br>
					<select class="form-control">
					<option>Select Marital Status</option>
						<option>Single</option>
						<option>Married</option>
						<option>Divorced</option>
						<option>Widow</option>
						<option>Other</option>
					</select>
					<br>
		<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Date Of Birth</span>
      </div>
      <input type="date" class="form-control" name="age" >
       </div>
				</div>
				<div class="col-md-6">
				<center><h5 class="alert alert-success">Adress info</h5></center>

	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Province</span>
      </div>
      <input type="text" class="form-control" name="age" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       District&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="age" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Sector&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="age" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Cell&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="age" >
    </div>
    	<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Village&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="age" >
     </div>
     <select class="form-control">
     	<option>Select Type</option>
     	<option>User</option>
     	<option>Accountant</option>
     	<option>Nyobozi</option>
     	<option>Ushinzwe gutanga inguzanyo</option>
     	<option>Ushinzwe kugaruza inguzanyo</option>
     </select><br>
       
       <div class="row">
       	<div class="col-md-6">
       		<button class="btn btn-success btn-block btn-sm" >Register</button>
       	</div>
       	<div class="col-md-6">
       		<button class="btn btn-warning btn-block btn-sm">Cancel</button>
       	</div>
	   </div>
		</div>
	 </form>
			</div>
		</div>
	</div>
