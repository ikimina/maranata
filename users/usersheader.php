<?php
include ("../includes/header.php");
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !="6") {

    header("location: ../index.php"); 
    exit();
} 
$username= $_SESSION["user"];

include '../includes/dbconnect.php';

require_once("../includes/classes/user.php");
require_once("../includes/classes/transaction.php");
$userLoggedIn=new User($con,$_SESSION['user']) ;
$transaction=new Transaction($con,$_SESSION['user']) ;
?>

<!DOCTYPE html>
<html>

<body>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg" style="" >
  <a class="navbar-brand" href="index.php">Maranata</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class=""><i class="fa fa-bars"></i></span>
  </button> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
   <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Dashboard
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="credits.php">Loan <span class="badge badge-warning">00000</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="transaction.php">Transaction </a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="notification.php">Notification <span class="badge badge-info">3</span></a>
      </li>

    </ul>

       <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item">
        <a href="../logout.php" class="nav-link waves-effect waves-light">
        Balance&nbsp;&nbsp;<span style="color: green;"><b><?php echo  $transaction->getBalance()?> </b>Rwf</span></i> 
          <!-- &nbsp&nbsp&nbsp&nbsp | -->
      </a>
      </li>
          <li class="nav-item">
        <a href="../logout.php" class="nav-link waves-effect waves-light">
        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp; <span><?php echo  $userLoggedIn->getFname()?> </span>
          <!-- &nbsp&nbsp&nbsp&nbsp | -->
        </a>
      </li>

<!-- &nbsp&nbsp&nbsp -->         
    </ul>
  </div>
</nav>
<!--/.Navbar -->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>






