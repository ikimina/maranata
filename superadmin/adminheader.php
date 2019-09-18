<?php
include ("../includes/header.php");
?>




<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg" style="background-color:  #00b386;" >
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
        <a class="nav-link" href="oursongs.php">Members</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="oursongs.php">Staff</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Credit</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Debit</a>
      </li>

    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
         Login
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
          <a class="dropdown-item" href="#">Login Help</a>
        </div>
      </li>
              
    </ul>
  </div>
</nav>
<!--/.Navbar -->





