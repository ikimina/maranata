<?php

if (isset($_REQUEST['entry'])) {
	# code...

$rpp= $_POST['entry'];
 $pn=$_POST['pn'];
$last=$_POST['last'];
require_once("../includes/dbconnect.php");
 if ($pn < 1) { 
      $pn = 1; 
  } else if ($pn > $last) { 
      $pn = $last; 
  }
 
$a=($pn - 1) * $rpp;

$sql1 = "SELECT * FROM members  WHERE active='yes' LIMIT $rpp OFFSET $a";
$q1=$con->query($sql1);

 $dataString = "<table class='table table-stipped table-bordered'>
          <tr>
          <th>No</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Telephone</th>
          <th>Action</th></tr>
         <tr >";
$i=1;
foreach ($q1 as $row) {
    # code...
     $dataString .='<tr> <td>'.$i++.'</td>
    <td>'.$row['fname'].'</td><td>'.$row['lname'].'</td><td>'.$row['phone']."</td><td>view</td></tr>";
  }
   $dataString ." </table>";
 
echo  $dataString ;
}



?>