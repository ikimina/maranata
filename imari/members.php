<?php
session_start();

 include("imariheader.php");


include "../includes/dbconnect.php";
require_once("../includes/classes/Constants.php"); 
require_once("../includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/Account.php");
require_once("../includes/classes/user.php");

$account = new Account($con);

if(isset($_POST["register"])) {

    $sex=@$_POST["sex"];
    $firstName = FormSanitizer::sanitizeFormString($_POST["fname"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lname"]);
    $idNo=$_POST["idno"];
    $phone=FormSanitizer::sanitizeTelephone($_POST["phone"]);
    $merital=@$_POST["mStatus"];
    $dob=$_POST["age"];
    $province = FormSanitizer::sanitizeFormString($_POST["province"]);
    $district = FormSanitizer::sanitizeFormString($_POST["district"]);
    $sector = FormSanitizer::sanitizeFormString($_POST["sector"]);
    $cell = FormSanitizer::sanitizeFormString($_POST["cell"]);
    $village = FormSanitizer::sanitizeFormString($_POST["village"]);

    $wasSuccessful = $account->register($firstName, $lastName, $phone, $idNo, $sex, $merital, $dob,$province,$district,$sector,$cell,$village,null,null,null);

    if(is_array($wasSuccessful)) {
      $query = $con->prepare("INSERT INTO credential(user_id, username, password,type)
                                    VALUES (:uid, :username, :password, :type)") ;          

        $query->bindParam(":uid", $uid);
        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
         $query->bindParam(":type", $type);

        $uid= $wasSuccessful[0];
        $username=$wasSuccessful[1];
        $password="00000";
        $type=$wasSuccessful[2];
        if ($query->execute()) {
          $_SESSION["userLoggedIn"] = $username;
          echo "<script>alert('Done')</script>";
        }
        else{
           echo "<script>alert('failed')</script>";
        }
        
     
    }

}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
//pagination
$sql = "SELECT COUNT(id) FROM members WHERE active='yes'";
$rows = $con->query($sql)->fetchColumn();

//pagination
?>
<br>
 <div class="container-fluid">
<button class="btn btn-primary" id="showUserList">Registered Members</button><a href="registration.php"><button id="newMember" class="btn btn-primary" style="display: none;">New Members</button></a>
  <div class="card"  id="registrationForm">
    <?php
    if (isset($_GET['r'])) {
      ?>

      <div class="alert alert-success alert-dismissible fade show" role="alert">
  Registration Success
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php     } ?>
    <div class="card-header">User Registration</div>
    <div class="card-body">
    <form method="POST" action="registration.php">
      <div class="row">

        <div class="col-md-6">

        <center><h5 class="alert alert-success">Basic info</h5></center>
            
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
          <input class="form-control" type="text" name="fname" placeholder="First Name" value="<?php getInputValue('fname'); ?>"><br>
           <?php echo $account->getError(Constants::$lastNameCharacters); ?>
          <input class="form-control" type="text" name="lname" placeholder="Last Name" value="<?php getInputValue('lname'); ?>"><br>
           <?php echo $account->getError(Constants::$IdInvalid); ?>
            <?php echo $account->getError(Constants::$IdNotAlphanumeric); ?>
          <input class="form-control" type="text" name="idno" min="1" placeholder="ID Number" value="<?php getInputValue('idno'); ?>"><br>
                 <?php echo $account->getError(Constants::$PhoneInvalid); ?>
           <?php echo $account->getError(Constants::$usernameTaken); ?>
    
      <input type="number" class="form-control" name="phone" min="0" placeholder="Telephone"><br>
   
           <?php echo $account->getError(Constants::$SelectSex); ?>
          <select class="form-control" name="sex">
          <option selected disabled>Select Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select><br>
           <?php echo $account->getError(Constants::$SelectMeritalStatus); ?>
          <select class="form-control" name="mStatus">
          <option selected disabled>Select Marital Status</option>
            <option value="Single">Single</option>
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
      <input type="date" class="form-control" name="age"   min='1910-01-01' max='2010-01-01' value="<?php getInputValue('age'); ?>">
       </div>
        </div>
        <div class="col-md-6">
        <center><h5 class="alert alert-success">Adress info</h5></center>
  
  <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Province</span>

      </div>
        <select class="form-control" name="province" id="province" onchange="populateDistrict(this.id,'district1')">
            <option ></option>
            <option value="Est">Est</option>
            <option value="North">North</option>
            <option value="West">West</option>
            <option value="South">South</option>
            <option value="Kigali City">Kigali City</option>

          </select>
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       District&nbsp&nbsp</span>
      </div>
      <select class="form-control" name="district" onchange="" id="district1">

          </select>
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Sector&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="sector" >
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Cell&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="cell" >
    </div>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">
       Village&nbsp&nbsp&nbsp&nbsp</span>
      </div>
      <input type="text" class="form-control" name="village" >
     </div>
      
        <center><h5 class="alert alert-success">Other info</h5></center>
        <select class="form-control" name="bank" id="province" >
            <option ></option>
            <option value="Bank Of Kigali">Bank Of Kigali</option>
            <option value="BPR">BPR</option>
            <option value="Equity">Equity</option>
            <option value="Sacco">Sacco</option>
            <option value="Git Bank">Git Bank</option>

          </select>
      
      <input type="text" class="form-control" name="bankaccount" min="0" placeholder="Account Number"><br>
      <input type="text" class="form-control" name="accountowner" min="0" placeholder="Account Owner"><br>
    </div></div>
     <div class="row">
          <button class="btn btn-success  btn-sm" name="register"  >Register</button>
        
          <button class="btn btn-warning  btn-sm" type="button" id="cancel">Cancel</button>
       
     </div>
   </form>
      </div>
    </div>
    <br>
    <div class="card" id="userList" style="display: none;">
      <div class="card-header"><span>Registered members</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>
          Show&nbsp;<select id="entry" onchange="retrieveMemberList(par())">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>

          </select>  &nbsp; Entries     <input type="hidden" name="" id="currentPage"> </span><button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export PDF </button>
        <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export EXCEL </button>
      <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Export CSV </button>
    <button class="btn btn-sm" style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;">Copy</button><button style="border: none;background: transparent;"><form> <input type="search" name="" style="border-radius: 10px;"><button style="font-weight: 600 !important;border: 1px solid;border-radius: 10px;background: transparent;"><img src="../images/search.png" width="20" height="20" ></button></form></button></div>
      <div class="card-body">
        

           
         
       <div id="list"></div>
       <div   id="pagination_controls"></div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  $("#showUserList").click(function(){
      $("#registrationForm").hide(600);
     $("#userList").show(700);
     $("#newMember").show(700);
     $(this).hide();
  });
  $("#cancel").click(function(){
    $("#registrationForm").hide(600);
   $("#userList").show(700);
 });
  function populateDistrict(s1,s2){
  var s1 = document.getElementById(s1);
  var s2 = document.getElementById(s2);

  s2.innerHTML = ""
  if(s1.value == "Est"){
    var optionArray = ["|","Gatsibo|Gatsibo","Nyagatare|Nyagatare","Kayonza|Kayonza","Rwamagana|Rwamagana"];
  } else if(s1.value == "West"){
    var optionArray = ["|","Rubavu|Rubavu","Nyabihu|Nyabihu","Ngororero|Ngororero"];
  } else if(s1.value == "North"){
    var optionArray = ["|","Gicumbi|Gicumbi","Musanze|Musanze","Rulindo|Rulindo","Gakenke|Gakenke","Burera|Burera"];
  }
  for(var option in optionArray){
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair[1];
    s2.options.add(newOption);
  }
}
function _(id) {
  return document.getElementById(id);
}
$( document ).ready(function() {
  
    retrieveMemberList(1);
});

function retrieveMemberList(pn) {
         pn=parseInt(pn);
    var entry=_("entry").value;

   _("currentPage").value=pn;
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
<style type="text/css">
  .errorMessage {
    color: #f00;
    font-size: 14px;
    font-weight: 400;
    text-align: center;
}

</style>

