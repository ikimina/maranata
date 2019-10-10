<?php
session_start();
include("collector_header.php");
include ("../includes/dbconnect.php");
require_once("../includes/classes/Loan.php");
require_once("../includes/classes/user.php");
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

		<div class="col-md-8"><br>
			<div class="card" style="box-shadow: none;border: 1px solid;border-radius: 0px;">
				<div class="card-header"><center><u>Loan</u></center><br>

                    

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
                  echo $loan->getAllLoanCorrector(6,$pn,$last);

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
		</div>
    <div class="col-md-4">
    <br>
    
      <div class="card">
        <div class="card-header"><center>Payment tab</center></div>
        <div class="card-body">
          <div class="row">
          <form method="POST">
             <div class="card-header"><label>Telephone:</label>
             <input type="search" name="" id="searchInput">
             <input type="button" name="" id="search" value="Search" onclick="retriveMemberInfo()">
            </div>
            </form>
          </div><br>

           <div id="userInfo">
                        
          </div>
   <center> <p class="alert alert-info">PAYMENT INFO</p></center>

    <input type="number" name="" class="form-control" placeholder="Amount" id="ammount" min="1000"><br>
  
    <textarea class="form-control"  placeholder="Comment" id="comment">
      
    </textarea>
    <span id="saveRes" style="color: green"></span>
    <button class="btn btn-sm btn-default" onclick="saveTranscation()">Save and print 
    </button>
            
 
        </div>
      </div>
    </div>
	</div>
</div>





  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>



  <?php
include("../includes/footer.php");
?> 
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
<script type="text/javascript">
  
 function _(id) {
  return document.getElementById(id);
   }
  function retriveMemberInfo() {

    var tel=_("searchInput").value;
         xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      var res=this.responseText;

      _('userInfo').innerHTML=res;
      //_('worspace').style.display="block";
    }
  }
  xmlhttp.open("GET","../imari/retriveUser.php?telcorrector="+tel,true);
  xmlhttp.send();
  }
  function saveTranscation() {
    _("error").innerHTML="";
    var userval=_("user").innerHTML;
  var ammount=_("ammount").value;
  _("ammount").value="";
  var phone=_('phone').innerHTML;
   if (userval !="") {
    _("error").innerHTML="To who are saving to?";
    return;
  }
  if (ammount=="") {
  
    _("error").innerHTML=" Are trying to save nothing? , you must put some value here";
    return;
  } 
 var comment=_('comment').value;
 _('comment').value="";
 var dataString="phone="+phone+"&ammount="+ammount+"&comment="+comment;
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      var res=this.responseText;
      
      _('saveRes').innerHTML=res;
    }
  }
  xmlhttp.open("GET","saveMoney.php?"+dataString,true);
  xmlhttp.send();
  }
 </script>