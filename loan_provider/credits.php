<?php
include("colheader.php");
include "../includes/dbconnect.php";

require_once("../includes/classes/user.php");
$user=new User($con,null) ;
//pagination
$sql = "SELECT COUNT(id) FROM members WHERE active='yes'";
$rows = $con->query($sql)->fetchColumn();

//pagination
?>



<!DOCTYPE html>
<html>
<head>
	<title>Maranata-<?php echo $_SESSION['user']?> | Dashboard</title>
</head>
<body>
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><center>All members</center><button style="border: none;background: transparent;"><form action=""> <input type="search" name="member" style="border-radius: 10px;" placeholder="Search"><button style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;background: transparent;"><img src="../images/search.png" width="20" height="20"  ></button></form></button></div>
		<div class="card-body">
			<!-- <table class="table table-stripped table-bordered">
				<th>No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Telephone</th>
				
				<th><a href="user_info_page.php">View</a></th>
				<tr>
					<td>1.</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table> -->
			<div id="list"></div>
       <div   id="pagination_controls"></div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	

	function _(id) {
  return document.getElementById(id);
}

  
    retrieveMemberList(1);


function retrieveMemberList(pn) {
         pn=parseInt(pn);
    //var entry=_("entry").value;
     var entry=10;
  // _("currentPage").value=pn;
var total_r=<?php echo $rows; ?>; // last page number
  var last= Math.ceil(total_r/entry);
  var results_box = document.getElementById("list");
  var pagination_controls = document.getElementById("pagination_controls");
  results_box.innerHTML = "loading results ...";
  var hr = new XMLHttpRequest();
    hr.open("POST", "../superadmin/membersList.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
      var dataArray = hr.responseText;  
       _('list').innerHTML= dataArray ; 
        
    }
    }
    hr.send("entry="+entry+"&last="+last+"&pn="+pn);
  // Change the pagination controls
  var paginationCtrls = "";
    // Only if there is more than 1 page worth of results give the user pagination controls
    if(last != 1){
    if (pn > 1) {
      if (pn>last) {pn=last;}
      paginationCtrls += '<button id="back" onclick="retrieveMemberList('+(pn-1)+')">&lt;</button>';
      }
    paginationCtrls += ' &nbsp; &nbsp; <b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
      if (pn != last) {
          paginationCtrls += '<button id="forward" onclick="retrieveMemberList('+(pn+1)+')">&gt;</button>';
      }
    }
  pagination_controls.innerHTML = paginationCtrls;}
function par(){
  return _("currentPage").value;
}

</script>



