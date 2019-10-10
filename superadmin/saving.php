
<?php 
session_start();
include("adminheader.php");

include "../includes/dbconnect.php";
require_once("../includes/classes/Constants.php"); 
require_once("../includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/Account.php");
require_once("../includes/classes/user.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
 ?>

<br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="table-responsive">
        <table class="table table-stripped table-bordered">
        <th>No</th>
        <th>Names</th>
        <th>Gender</th>
        <th>Telephone</th>
        <th>Saving amount</th>
        
        <th>Details</th>
        <tr>
          <td>1.</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th><a href="user_info_page.php">View</a></th>
        </tr>
      </table>
      </div>
    </div>

    <div class="col-md-4">
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

           <div>
            <p class="alert alert-danger alert-dismissible fade show">May be the user has not unpaid loan
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
            </p>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Names</span>
            </div>
            <label  class="form-control" ></label>
             </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Unpaid</span>
            </div>
            <label  class="form-control" ></label>
             </div>            
          </div>
   <center> <p class="alert alert-info">SAVINGS INFO</p></center>

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
</div><br>
<div class="container-fluid">
<div class="card">
  <div class="card-header">
  <?php
    include("../includes/footer.php");
  ?>    
  </div>
</div><br>

</div>

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