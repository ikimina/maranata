<?php
require_once("../includes/dbconnect.php");

require_once("../includes/classes/user.php");
require_once("../includes/classes/Loan.php");
if (isset($_REQUEST['tel'])) {
	$tel=$_REQUEST['tel'];
$user=new User($con,$tel) ;

 


echo '<div> <span style="color:red;" id="user">'.$user->isUserValid().'</span>
  <div class="row">
    <div class="col-md-5">
     
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">Names</span>
      </div>
      <label  class="form-control" ><b>'.$user->getNames().'</b></label>
       </div>
    

      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">Phone&nbsp</span>
      </div>
       <label  class="form-control" ><b>'.$tel.'</b></label>
       </div>

      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">Gender</span>
      </div>
       <label  class="form-control" ><b>'.$user->getSex().'</b></label>
       </div>

      </div> 
    <div class="col-md-2"></div>
    <div class="col-md-5">
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">Sector</span>
      </div>
       <label  class="form-control" ><b>'.$user->getSector().'</b></label>       </div>
    

      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">
      Cell &nbsp&nbsp&nbsp&nbsp
      </span>
      </div>
    <label  class="form-control" ><b>'.$user->getCell().'</b></label>
       </div>

      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3">Village</span>
      </div>
       <label  class="form-control" ><b>'.$user->getVillage().'</b></label>
       </div>
    </div>
  </div>
</div>';
 
}
if (isset($_REQUEST['telcorrector'])) {
    $tel=$_REQUEST['telcorrector'];
  $user=new User($con,$tel) ;
  $loan=new Loan($con,$tel);
  $Unpaid="";
  if ($loan->loanAmount()==null) {
    $Unpaid='<p class="alert alert-danger alert-dismissible fade show" id="">the user has not unpaid loan
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
            </p>
';
  }
  echo '    <span>'.$Unpaid.'</span>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Names</span>
            </div>
            <label  class="form-control" ><b>'.$user->getNames().'</b></label>
             </div>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Unpaid</span>
            </div>
            <label  class="form-control" ><b>'.$loan->loanAmount().'</b></label>
             </div>';
}
 ?>

 