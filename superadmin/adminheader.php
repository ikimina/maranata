<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !="5") {

    header("location: ../index.php"); 
    exit();
} 
$username= $_SESSION["user"];
include ("../includes/header.php");
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
        <a class="nav-link" href="registration.php">Members</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="staff.php">Staff</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Credit</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Debit</a>
      </li>

    </ul>

       <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
        <i class="fa fa-user" aria-hidden="true">&nbsp&nbsp&nbsp<span>User</span></i> 
          <!-- &nbsp&nbsp&nbsp&nbsp | -->
        </a>
      </li>

<!-- &nbsp&nbsp&nbsp --> 
             
      <li class="nav-item">
      <a class="nav-link" href="admin.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>







