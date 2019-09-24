<?php
include ("usersheader.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo  $_SESSION["user"]?> | T-History</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
		 <div class="card">
		 	<div class="card-header">
		 	<?php
          for ($i=0; $i <1 ; $i++) { 
          	echo '<br>';}
          ?>
		 	<div>
		 	<i class="fa fa-bell" aria-hidden="true" aria-hidden="true">&nbsp&nbsp&nbsp&nbspLatest<span class="badge badge-light">10</span></i>
		 </div>
		 <div>
		 	<i class="fa fa-folder-open" aria-hidden="true">&nbsp&nbsp&nbsp&nbspSavings</i>
		 </div>
		 <div>
		 	<i class="fa fa-folder" aria-hidden="true">&nbsp&nbsp&nbsp&nbspCredits</i>
		 </div>
		 <div>
		 	<i class="fa fa-archive" aria-hidden="true">&nbsp&nbsp&nbsp&nbspArchive</i>
		 </div>	
		 <?php
          for ($i=0; $i < 14 ; $i++) { 
          	echo '<br>';}
          ?>
         </div>

		 </div>

		</div>

		<div class="col-md-10">
			<div class="card">
				<div class="card-header"><center>Transactions</center></div>
				<div class="card-body"></div>
				<div class="card-footer"></div>
			</div>
		</div>
	</div>
</div>





  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>