<?php
session_start();
include("adminheader.php");


include "../includes/dbconnect.php";
require_once("../includes/classes/Constants.php"); 
require_once("../includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/Account.php");

$account = new Account($con);
function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
$reg="";
if (isset($_POST['register'])) {
    $sex=@$_POST["sex"];
    $firstName = FormSanitizer::sanitizeFormString($_POST["fname"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lname"]);
    $email=FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $idNo=FormSanitizer::sanitizeTelephone($_POST["idno"]);
    $phone=FormSanitizer::sanitizeTelephone($_POST["phone"]);
    $merital=@$_POST["mStatus"];
    $dob=$_POST["age"];
    $province = FormSanitizer::sanitizeFormString($_POST["province"]);
    $district = FormSanitizer::sanitizeFormString($_POST["district"]);
    $sector = FormSanitizer::sanitizeFormString($_POST["sector"]);
    $cell = FormSanitizer::sanitizeFormString($_POST["cell"]);
    $village = FormSanitizer::sanitizeFormString($_POST["village"]);
    $type=@$_POST["type"];
    $file=$_FILES["pic"];
 
    $wasSuccessful = $account->register($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,$type,$file,$email,null,null,null,null);

    if($wasSuccessful) {
                                
         $reg="<span class='alert alert-info'>".Constants::$done."</span>";
         
        }
        else{
          $reg="<span class='alert alert-danger'>".Constants::$fail."</span>";
        }
        
     
    
    
  }
?>



<?php
$sql = "SELECT COUNT(id) FROM staff WHERE active='yes'";
$rows = $con->query($sql)->fetchColumn();
$page_rows = 3;

$last = ceil($rows/$page_rows);
if($last < 1){
  $last = 1;
}
$pagenum = 1;
if(isset($_GET['pn'])){
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
$a=($pagenum - 1) * $page_rows ;

$sql1 = "SELECT * FROM staff  WHERE active='yes' LIMIT $page_rows OFFSET $a";
$q1=$con->query($sql1);
$textline1 = "(<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
$paginationCtrls = '';
if($last != 1){
  if ($pagenum > 1) {
        $previous = $pagenum - 1;
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
      }
      }
    }
  $paginationCtrls .= ''.$pagenum.' &nbsp; ';
  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
    if($i >= $pagenum+4){
      break;
    }
  }    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}
//$list = '';
$out="";
$i=1;

foreach ($q1 as $row) {
  $roles="";
  switch ($row['role']) {
    case '1':
      $roles="Accountant";
      break;
    case '2':
      $roles="Loan Provider";
      break;
    case '3':
      $roles="Ruling Council";
      break;
    case '4':
      $roles="Loan Return";
      break;
    default:
      break;
  }
    # code...
    $out.='<tr> <td>'.$i++.'</td>
    <td>'.$row['fname'].'</td> <td>'.$row['lname'].'</td><td>'.$row['phone'].'</td><td>'.$row['email'].'</td> <td>'.$row['sex'].'</td> <td>'.$row['sector'].'</td> <td>'.$row['cell'].'</td> <td>'.$row['village'].'</td> <td>'.$roles."</td><td>
<a class='btn btn-sm dropdown-toggle mr-4' type='button' data-toggle='dropdown' aria-haspopup='true'
  aria-expanded='false' style='color:#000 !important;'>Action</a>

<div class='dropdown-menu'>
   
  <a class='dropdown-item' href='".$row['id']."'><i class='fas fa-trash-alt'></i>&nbsp;Delete</a>
 
  <a class='dropdown-item' href='#'> <i class='fas fa-edit'></i>&nbsp;Edit</a>
  <a class='dropdown-item' href='#'><i class='fas fa-exchange-alt'></i>&nbsp;Change Role</a>
  
</div></td></tr>";
  }












 ?>
<br>
<style type="text/css">
  .noradius{
    border-radius: 0px !important;
  }
</style>
 <div class="container-fluid"><!-- 
    <button class="btn btn-primary">New Staff</button> -->

		<div class="card" style="box-shadow: none!important;" >
      <?php if (!isset($_GET['new_staff'])) {
      
     ?>
			<div class="card-header">Registered members<span>
          Show&nbsp;<select id="entry" onchange="retrieveMemberList(par())">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>

          </select>  &nbsp; Entries     <input type="hidden" name="" id="currentPage"> </span><button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export PDF </button>
        <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export EXCEL </button>
      <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export CSV </button>
    <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Copy</button> <div style="float: right;"><a href="<?php echo $_SERVER['PHP_SELF']."?new_staff=nstf" ?>">Add new Role&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></a>&nbsp;&nbsp;<a href="<?php echo $_SERVER['PHP_SELF']."?new_staff=nstf" ?>">New Staff&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></a></div></div>
			<div class="card-body">
				<table class="table table-stipped table-bordered">
					<th>No</th>
					<th>First Name</th>
					<th>Last Name</th>
          <th>Telephone</th>
          <th>Email</th>
          <th>Sex</th>
          <th>Sector</th>
          <th>Cell</th>
          <th>Village</th>
					<th>Duties</th>
          <th>Operation</th>
          <?php echo $out; ?>
				</table>

  <center> <b><?php echo $textline1; ?> Staff</b></center>
  <p><?php echo $textline2; ?></p>
  <div id="pagination_controls"><?php echo $paginationCtrls; ?></div><br>

			</div>
		</div><br><?php } ?>
        <?php if (isset($_GET['new_staff'])) {
      
     ?>
	<div class="card">
		<div class="card-header">Staff Registration &nbsp;&nbsp; <?php echo $reg; ?> <div style="float: right;"><a href="staff.php">Staff List <i class="fas fa-list"></i></a></div> </div>
		<div class="card-body">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?new_staff=nstf" ?>" enctype="multipart/form-data">
			<div class="row">

				<div class="col-md-6">

				<center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Basic info</h5></center>
				
					<input class="form-control" type="text" name="fname" placeholder="First Name" required value="<?php getInputValue('fname'); ?>"><br>

           <?php echo $account->getError(Constants::$lastNameCharacters); ?>
					<input class="form-control" type="text" name="lname" placeholder="Last Name" required value="<?php getInputValue('lname'); ?>"><br>
          <?php echo $account->getError(Constants::$IdInvalid); ?>
            <?php echo $account->getError(Constants::$IdNotAlphanumeric); ?>
					<input class="form-control" type="number" name="idno" placeholder="ID Number" required value="<?php getInputValue('idno'); ?>"><br>
              <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
          <input class="form-control" type="email" name="email" placeholder="Email" required value="<?php getInputValue('email'); ?>"><br>
<?php echo $account->getError(Constants::$PhoneInvalid); ?>
           <?php echo $account->getError(Constants::$usernameTaken); ?>
      <input type="number" class="form-control" name="phone" placeholder="Telephone" required value="<?php getInputValue('phone'); ?>"><br>
					<select class="form-control" name="sex"  >
					<option selected disabled >Select Gender</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select><br>
					<select class="form-control" name="mStatus">
					<option selected disabled>Select Marital Status</option>
						<option  value="Single">Single</option>
						<option value="Married">Married</option>
						<option value="Divorced">Divorced</option>
						<option value="Widow">Widow</option>
						<option value="Other">Other</option>
					</select>
					<br>
		<div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Date Of Birth</span>
      </div>
      <input type="date" class="form-control" name="age" required value="<?php getInputValue('age'); ?>">
       </div>
      
				</div>
				<div class="col-md-6">
				<center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Adress info</h5></center>
 <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Province</span>

      </div>
        <select class="form-control" name="province" id="province" onchange="getRegion(this.value,'district1','1')">
            

          </select>
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       District&nbsp;&nbsp;&nbsp;</span>
      </div>
      <select class="form-control" name="district"  id="district1" onchange="getRegion(this.value,'sector','2')">

          </select>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
      Sector&nbsp;&nbsp;&nbsp;&nbsp;</span>
      </div>
      <select class="form-control" name="sector"  id="sector" onchange="getRegion(this.value,'cell','3')">

          </select>
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
      Cell&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      </div>
      <select class="form-control" name="cell"  id="cell" onchange="getRegion(this.value,'village','4')">

          </select>
    </div>
      
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
      Village&nbsp&nbsp</span>
      </div>
      <select class="form-control" name="village"  id="village" >

          </select>
    </div>
     
       <center><h5 class="alert alert-success" style="
    border-radius: 0px !important;">Other info</h5></center><br>
       <select class="form-control" name="type">
      <option selected disabled>Select Type</option>
      <option value="1">Accountant</option>
      <option value="3">Nyobozi</option>
      <option value="2">Ushinzwe gutanga inguzanyo</option>
      <option value="4">Ushinzwe kugaruza inguzanyo</option>
     </select><br>
     <label>Picture</label><br>
     <input type="file" name="pic">
     </div>
</div>
<div class="row">
          <button class="btn btn-success btn-sm" name="register">Register</button>
      
          <button class="btn btn-warning btn-sm" name="cancel">Cancel</button>
      
       </div>
	 </form>
					
    <?php }?>
	</div>
</div>
<script type="text/javascript">
  function _(id) {
    return document.getElementById(id);
  }
  getRegion(null,'province','0');

  function getRegion(s1,s2,s3){
           xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      var res=this.responseText;
         
      _(s2).innerHTML=res;
      // _('worspace').style.display="block";
    }
  }
  xmlhttp.open("GET","../region.php?id="+s1+"&sel="+s3,true);
  xmlhttp.send();
  }
</script>
<style type="text/css">
  .errorMessage {
    color: #f00;
    font-size: 14px;
    font-weight: 400;
    text-align: center;
}

</style>
