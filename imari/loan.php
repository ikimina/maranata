<?php
session_start();
include("imariheader.php");
include ("../includes/dbconnect.php");
require_once("../includes/classes/Loan.php");
$loan= new Loan($con,null);

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
				<div class="card-header"><center><u>Loan</u></center><br>

                    <?php 
                    
                    ?>

    <button style="border: none;background: transparent;"><form> <input type="search" name="" style="border-radius: 10px;"><button style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;background: transparent;"><img src="../images/search.png" width="20" height="20" ></button></form></button>
<div style="float: right;">
    <button style="border: none;background: transparent;">Total Unpaid Loan &nbsp;&nbsp;<b><?php echo $loan->getTotalUnPaidLaon(); ?></b>&nbsp;<span style="font-size: 11px;">Rwf</span></button></div>
				</div>
				<div class="card-body">
                    
                    
					<?php 
				$query = $con->prepare("SELECT COUNT(id) FROM loan ");
                   
                    $query->execute();
                    $rows= $query->fetchColumn();
                  $last=ceil($rows/6) ;
                  if (isset($_GET['pn'])) {
                  (int)$pn=$_GET['pn'];
                  }
                  else $pn=1;
                  echo $loan->getAllLoan(6,$pn,$last);

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

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Referee Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
        	
        	<label>Telephone</label>
        	<input type="text" name="old" readonly value="" style="background-color: transparent;" id="user" class="form-control"><br>
          <input type="hidden"  id="user1" >
          <input type="hidden"  id="lid" >
        	<label>
        		Referee 1
        	</label><span id="ref1">&nbsp;<b></b></span>
        	<input type="text" name="new" id="r1" class="form-control" placeholder="Telephone For Referee 1" onkeyup="bringRef(this.value,'ref1')"><br>

        	<label>
        		Referee 2
        	</label><span id="ref2">&nbsp;<b></b></span>
        	<input type="text" id="r2" name="new" class="form-control" placeholder="Telephone For Referee 2" onkeyup="bringRef(this.value,'ref2')"><br>

        	<label>
        		Referee 3
        	</label><span id="ref3">&nbsp;<b></b></span>
        	<input type="text" id="r3" name="new" class="form-control" placeholder="Telephone For Referee 3" onkeyup="bringRef(this.value,'ref3')"><br>

        

        </form>
      </div>
      <div class="modal-footer"><span id="refresponse"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveRef()">Save</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function _(id) {
		return document.getElementById(id);
	}
	function populate(user,id) {
		
        _("user").value=user;
        _("user1").value=user;
        _("lid").value=id;
        
	}

	function bringRef(tel,id){
       
  

           var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    var  response=this.responseText;
                           _(id).innerHTML=response;
            
        };}
        xmlhttp.open("GET", "checkref.php?tel="+tel, true);
           xmlhttp.send();

	}
	function saveRef() {
    var user=_('user1').value;
		var id=_('lid').value;
		var re1=_('r1').value;
		var re2=_('r2').value;
	var re3=_('r3').value;
	if (re1=="") {
   return;
 }
    
		 var data="r1="+re1+"&r2="+re2+"&r3="+re3+"&user="+user+"&id="+id;
   
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    var  response=this.responseText;
                   
                           _("refresponse").innerHTML=response;
                      _('r1').value="";
                      _('r2').value="";
                      _('r3').value="";
            
        };}
        xmlhttp.open("GET", "checkref.php?"+data, true);
           xmlhttp.send();
	}
</script>