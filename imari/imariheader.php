
<?php

include ("../includes/header.php");
include ("../includes/dbconnect.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !="1") {

    header("location: ../index.php"); 
    exit();
} 
$username= $_SESSION["user"];

require_once("../includes/classes/user.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;

?>
<!DOCTYPE html>
<html>

<body>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg" style="" >
  <a class="navbar-brand" href="index.php">Maranata</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
   <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Dashboard
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php">Members</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="transaction.php">Transaction</a>
      </li>

    </ul>

       <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
        <i class="fa fa-user" aria-hidden="true">&nbsp&nbsp&nbsp<span><?php echo  $userLoggedIn->getFname()?> </span></i> 
          <!-- &nbsp&nbsp&nbsp&nbsp | -->
        </a>
      </li>

<!-- &nbsp&nbsp&nbsp -->         
      <li class="nav-item">
      <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>





