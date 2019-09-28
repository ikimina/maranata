<?php 
session_start();
include("imariheader.php");


include "../includes/dbconnect.php";
require_once("../includes/classes/Constants.php"); 
require_once("../includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/Account.php");
require_once("../includes/classes/user.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
 ?>

<br><br>
 <div class="container-fluid">
 <div class="row" >
 	<div class="col-md-2"></div>
 	<div class="col-md-8">
<div class="card" style="box-shadow: none;border-radius: 0px;border: 1px solid;">
  <div class="card-header"><label>Telephone:</label>
   <input type="search" name="" id="searchInput">
   <input type="button" name="" id="search" value="Search" onclick="retriveMemberInfo()">
  </div>
  <div style="display: none;" id="worspace">
  <div class="card" style="box-shadow: none;">
  <div class="card-body">
    <div id="userInfo">


</div>
  	
  </div>
</div>
<div class="card" style="box-shadow: none;">
  <div class="card-body">
<div class="container">
	<center><u>SAVING DETAILS</u></center><br>
  <label>Amount </label>
  <span id="error" style="color: red;"></span>

  	<input type="number" name="" class="form-control" placeholder="Amount" id="ammount" min="1000">
<br>
  	
  	<textarea class="form-control"  placeholder="Comment" id="comment">
  		
  	</textarea><br>
    <span id="saveRes" style="color: green"></span><br>
    <button class="btn btn-sm btn-default" onclick="saveTranscation()">Save and print </button>
  </div>
  </div>

</div>
</div>
</div>

 	</div>
 	<div class="col-md-2"></div>
 </div></div>
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
      _('worspace').style.display="block";
    }
  }
  xmlhttp.open("GET","retriveUser.php?tel="+tel,true);
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